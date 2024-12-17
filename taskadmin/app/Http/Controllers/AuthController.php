<?php

namespace App\Http\Controllers;

use App\Http\Responses\Auth\LoginResponse;
use App\Http\Responses\Auth\LogoutResponse;
use App\Http\Responses\Auth\RefreshResponse;
use App\Src\Interfaces\Services\AuthServiceInterface;
use Illuminate\Http\Request;

final readonly class AuthController
{

    public function __construct(
        private AuthServiceInterface $authService,
    )
    {}

    public function login(Request $request): LoginResponse
    {
        $credentials = base64_decode(substr($request->header('Authorization'), 6));
        [$username, $password] = explode(':', $credentials);

        $result = $this->authService->login($username, $password);

        return new LoginResponse($result->getAccessToken(), $result->getRefreshToken());
    }

    public function logout(Request $request): LogoutResponse
    {
        $this->authService->logout($request->user());

        return new LogoutResponse('', '');
    }

    public function refresh(Request $request): RefreshResponse
    {
        $result = $this->authService->refresh($request->user());

        return new RefreshResponse($result->getAccessToken(), $result->getRefreshToken());
    }
}
