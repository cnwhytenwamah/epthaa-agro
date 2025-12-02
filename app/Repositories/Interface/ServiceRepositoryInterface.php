<?php

namespace App\Repositories\Interface;

use App\Dto\Service\ServiceDto;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;

interface ServiceRepositoryInterface
{
    public function create(ServiceDto $dto): Service;

    public function findById(int $id): ?Service;

    /**
     * Return all records (optionally apply filters/pagination later)
     * @return array
     */
    public function all(array $filters = []): array;

    public function update(int $id, ServiceDto $dto): Service;

    public function delete(int $id): bool;
}
