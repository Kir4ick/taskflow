<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class UserController
{

    public function __construct(
        private readonly UserService $userService
    )
    {}

    public function create(CreateUserRequest $request): RedirectResponse
    {
        $companyId = Auth::user()->company_id;

        $this->userService->create(
            $request->post('username'),
            $request->post('email'),
            $request->post('password'),
            $request->post('roleId'),
            $companyId
        );

        return redirect(route('user-create.page'));
    }
}
