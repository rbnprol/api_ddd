<?php

namespace App\Visit\Domain;

interface VisitRepository
{
    public function findAllVisits(int $project): array;

    public function findOneVisitById(int $project, int $id): ?Visit;

    public function findAllVisitsByShop(int $project, $shopId): array;
}
