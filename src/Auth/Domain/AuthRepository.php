<?php

namespace App\Auth\Domain;

interface AuthRepository
{
    public function findByToken(string $apiToken): ?Auth;
}
