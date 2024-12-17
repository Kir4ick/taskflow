<?php

namespace App\Http\Controllers;

use App\Services\UserService;

class UserController
{

    public function __construct(
        private readonly UserService $userService
    )
    {}

    public function create()
    {

    }
}
