<?php

namespace App\Shop\Application\Find;

use App\Shop\Domain\ShopRepository;

class FindAllShopService
{
    private ShopRepository $repository;

    public function __construct(ShopRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $project): array
    {
        return $this->repository->findAllByProject($project);
    }
}
