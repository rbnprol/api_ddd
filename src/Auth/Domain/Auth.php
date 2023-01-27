<?php

namespace App\Auth\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

final class Auth
{
    public function __construct(
        private int $id,
        private string $apiToken,
        private int $project
    )
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getProject(): ?int
    {
        return $this->project;
    }

    public function setProject(int $project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getApiToken(): ?string
    {
        return $this->apiToken;
    }

    public function setApiToken(string $apiToken): self
    {
        $this->apiToken = $apiToken;

        return $this;
    }
}
