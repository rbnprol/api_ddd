<?php

namespace App\Visit\Application\Find;

use App\Visit\Domain\VisitRepository;

class FindAllVisitsByShopService
{
    private VisitRepository $repository;

    public function __construct(VisitRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $project, int $shopId): array
    {
        return $this->repository->findAllVisitsByShop($project, $shopId);
    }
}
