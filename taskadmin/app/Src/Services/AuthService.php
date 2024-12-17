<?php

namespace App\Src\Services;

use App\Models\User;
use App\Src\DTO\Auth\TokensReturnData;
use App\Src\Interfaces\Repositories\UserRepositoryInterface;
use App\Src\Interfaces\Services\AuthServiceInterface;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class AuthService implements AuthServiceInterface
{

    public function __construct(
        private UserRepositoryInterface $userRepository,
    )
    {}

    public function login(string $username, string $password): TokensReturnData
    {
        $user = $this->userRepository->getUserByCredentials($username, $password);
        if (!$user) {
            throw new UnauthorizedHttpException('');
        }

        Auth::login($user);

        return new TokensReturnData();
    }

    public function logout(User $user): void
    {
        // TODO: Implement logout() method.
    }

    public function refresh(User $user): TokensReturnData
    {
        // TODO: Implement refresh() method.
    }

}
