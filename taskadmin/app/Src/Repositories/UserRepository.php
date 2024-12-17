<?php

namespace App\Src\Repositories;

use App\Models\User;
use App\Src\Abstracts\AbstractRepository;
use App\Src\Interfaces\Repositories\RepositoryInterface;
use App\Src\Interfaces\Repositories\UserRepositoryInterface;

/**
 * @implements RepositoryInterface<User>
 */
class UserRepository extends AbstractRepository implements UserRepositoryInterface
{

    protected function getModel(): string
    {
        return User::class;
    }

    public function getUserByCredentials(string $username, string $password): ?User
    {
        return User::query()
            ->where('username', $username)
            ->where('password', $password)
            ->first();
    }

}
