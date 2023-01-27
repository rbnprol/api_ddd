<?php

namespace App\Shop\Application\Find;

use App\Shop\Domain\Shop;
use App\Shop\Domain\ShopRepository;

class FindOneByIdShopService
{

    private ShopRepository $repository;

    public function __construct(ShopRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $project, $id): ?Shop
    {
        return $this->repository->findById($project, $id);
    }

}
