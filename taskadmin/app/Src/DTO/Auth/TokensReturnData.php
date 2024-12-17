<?php

namespace App\Src\DTO\Auth;

class TokensReturnData
{
    private string $accessToken;

    private string $refreshToken;

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
    }

    private function setRefreshToken(string $refreshToken): void
    {
        $this->refreshToken = $refreshToken;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

}
