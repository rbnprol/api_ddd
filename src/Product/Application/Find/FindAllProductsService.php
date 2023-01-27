<?php

namespace App\Product\Application\Find;

use App\Product\Domain\ProductRepository;

class FindAllProductsService
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $project): array
    {
        return $this->repository->getAllProducts($project);
    }
}
