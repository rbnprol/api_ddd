<?php

namespace App\Auth\Infrastructure\Repository;


use App\Auth\Domain\Auth;
use App\Auth\Domain\AuthRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class DoctrineAuthRepository extends ServiceEntityRepository implements AuthRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Auth::class);
    }

    public function findByToken(string $apiToken): ?Auth
    {
        return $this->getEntityManager()->getRepository(Auth::class)->findOneBy([
            'apiToken' => $apiToken
        ]);
    }
}
