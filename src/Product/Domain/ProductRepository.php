<?php

namespace App\Product\Domain;

interface ProductRepository
{
    public function getAllProducts(int $project): array;

    public function getProductById(int $project, int $id): ?Product;
}
