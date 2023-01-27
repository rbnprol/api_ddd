<?php

namespace App\Shop\Infrastructure\Repository;


use App\Shop\Domain\Shop;
use App\Shop\Domain\ShopRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class DoctrineShopRepository extends ServiceEntityRepository implements ShopRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shop::class);
    }

    public function findAllByProject(int $project): array
    {
        return $this->getEntityManager()->getRepository(Shop::class)->findBy([
            'projectId' => $project
        ]);
    }

    public function findById(int $project, int $id): ?Shop
    {
        return $this->getEntityManager()->getRepository(Shop::class)->findOneBy([
            'projectId' => $project,
            'id' => $id
        ]);
    }
}
