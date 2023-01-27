<?php

namespace App\Product\Infrastructure\Repository;

use App\Product\Domain\Product;
use App\Product\Domain\ProductRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineProductRepository extends ServiceEntityRepository implements ProductRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getAllProducts(int $project): array
    {
        return $this->getEntityManager()->getRepository(Product::class)->findBy([
            'projectId' => $project
        ]);
    }

    public function getProductById(int $project, int $id): ?Product
    {
        return $this->getEntityManager()->getRepository(Product::class)->findOneBy([
            'projectId' => $project,
            'id' => $id
        ]);
    }
}
