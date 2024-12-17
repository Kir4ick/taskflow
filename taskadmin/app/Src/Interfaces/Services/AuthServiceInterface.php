<?php

namespace App\Src\Interfaces\Services;

use App\Models\User;
use App\Src\DTO\Auth\TokensReturnData;

interface AuthServiceInterface
{
    public function login(string $username, string $password): TokensReturnData;

    public function logout(User $user): void;

    public function refresh(User $user): TokensReturnData;
}
