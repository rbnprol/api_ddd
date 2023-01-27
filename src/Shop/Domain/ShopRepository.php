<?php

namespace App\Shop\Domain;

interface ShopRepository
{
    public function findAllByProject(int $project): array;

    public function findById(int $project, int $id): ?Shop;
}
