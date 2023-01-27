<?php

namespace App\Visit\Infrastructure\Repository;


use App\Visit\Domain\Visit;
use App\Visit\Domain\VisitRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineVisitRepository extends ServiceEntityRepository implements VisitRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visit::class);
    }

    public function findAllVisits(int $project): array
    {
        return $this->getEntityManager()->getRepository(Visit::class)->findBy([
            'projectId' => $project
        ]);
    }

    public function findOneVisitById(int $project, int $id): ?Visit
    {
        return $this->getEntityManager()->getRepository(Visit::class)->findOneBy([
            'projectId' => $project,
            'id' => $id
        ]);
    }

    public function findAllVisitsByShop(int $project, $shopId): array
    {
        return $this->getEntityManager()->getRepository(Visit::class)->findBy([
            'projectId' => $project,
            'shopId' => $shopId
        ]);
    }
}
