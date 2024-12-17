<?php

namespace App\Http\Responses\Auth;

class LoginResponse
{
    public string $accessToken;

    public string $refreshToken;

    /**
     * @param string $accessToken
     * @param string $refreshToken
     */
    public function __construct(string $accessToken, string $refreshToken)
    {
        $this->setAccessToken($accessToken);
        $this->setRefreshToken($refreshToken);
    }

    private function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
        cookie('access_token', $accessToken);
    }

    private function setRefreshToken(string $refreshToken): void
    {
        $this->refreshToken = $refreshToken;
        cookie('refresh_token', $refreshToken);
    }

}
