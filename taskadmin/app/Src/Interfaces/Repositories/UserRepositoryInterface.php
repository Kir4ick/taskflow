<?php

namespace App\Src\Interfaces\Repositories;

use App\Models\User;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function getUserByCredentials(string $username, string $password): ?User;

}
