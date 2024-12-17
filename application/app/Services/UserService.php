<?php

namespace App\Services;

use App\Mail\AuthMail;
use App\Models\Role;
use App\Models\User;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Nette\Utils\Random;

class UserService
{

    public function __construct(
        private RBACService $rbacService,
    )
    {}

    /**
     * Создание пользователя админом
     *
     * @param string $username
     * @param string $email
     * @param string $password
     * @param int $roleId
     * @param int $companyId
     *
     * @return void
     */
    public function create(
        string $username,
        string $email,
        string $password,
        int $roleId,
        int $companyId,
    ): void {
        DB::transaction(function () use ($username, $email, $password, $roleId, $companyId) {
            $user = $this->createUser($username, $email, $password, $companyId);
            $role = Role::query()->find($roleId);

            $user->roles()->attach($role);
        });

        Mail::to($email)->send(new AuthMail($password, $email));
    }

    /**
     * Создание и заполнение данных пользователя
     *
     * @param string $username
     * @param string $email
     * @param string $password
     * @param int $companyId
     *
     * @return User
     */
    private function createUser(
        string $username,
        string $email,
        string $password,
        int $companyId,
    ): User
    {
        $user = new User();
        $user->company_id = $companyId;
        $user->name = $username;
        $user->email = $email;
        $user->password = Hash::make($password);

        $user->save();

        return $user;
    }

    /**
     * Создание админа компании
     *
     * @param string $email
     * @param int $companyId
     *
     * @return User
     */
    public function createAdminUser(string $email, int $companyId): User
    {
        $password = Random::generate();

        $user = new User();
        $user->email = $email;
        $user->company_id = $companyId;
        $user->name = $email;
        $user->password = Hash::make($password);
        $user->save();

        $user->roles()->attach(
            $this->rbacService->createAdminRole($user)->id
        );

        Mail::to($email)->send(new AuthMail($password, $email));

        return $user;
    }
}
