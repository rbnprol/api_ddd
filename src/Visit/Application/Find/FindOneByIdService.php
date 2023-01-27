<?php

namespace App\Visit\Application\Find;

use App\Visit\Domain\Visit;
use App\Visit\Domain\VisitRepository;

class FindOneByIdService
{
    private VisitRepository $repository;

    public function __construct(VisitRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $project, int $id): ?Visit
    {
        return $this->repository->findOneVisitById($project, $id);
    }

}
