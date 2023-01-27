<?php

namespace App\Product\Application\Find;

use App\Product\Domain\Product;
use App\Product\Domain\ProductRepository;

class FindOneProductByIdService
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $project, int $id): ?Product
    {
        return $this->repository->getProductById($project, $id);
    }
}
