<?php

namespace App\Visit\Application\Find;

use App\Visit\Domain\VisitRepository;

class FindAllVisitService
{
    private VisitRepository $repository;

    public function __construct(VisitRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $project): array
    {
        return $this->repository->findAllVisits($project);
    }

}
