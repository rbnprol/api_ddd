<?php

namespace App\Auth\Application;

use App\Auth\Domain\Auth;
use App\Auth\Domain\AuthRepository;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;

class AuthService
{

    private AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function __invoke(string $apiToken = null): ?Auth
    {
        if (!$apiToken) {
            return null;
        }
        return $this->authRepository->findByToken($apiToken);
    }
}
