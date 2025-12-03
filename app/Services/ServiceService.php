<?php

namespace App\Service;

use App\Dto\Service\ServiceDto;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;
use App\Repositories\Interface\ServiceRepositoryInterface;

class ServiceService
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        protected ServiceRepositoryInterface $repository
    ) {}

    public function create(ServiceDto $dto): Service
    {
        return $this->repository->create($dto);
    }

    public function getAll(array $filters = []): array
    {
        return $this->repository->all($filters);
    }

    public function getById(int $id): ?Service
    {
        return $this->repository->findById($id);
    }

    public function update(int $id, ServiceDto $dto): Service
    {
        return $this->repository->update($id, $dto);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
