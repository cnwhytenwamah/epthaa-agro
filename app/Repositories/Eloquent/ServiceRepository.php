<?php

namespace App\Repositories\Eloquent;

use App\Dto\Service\ServiceDto;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;
use App\Repositories\Interface\ServiceRepositoryInterface;


class ServiceRepository implements ServiceRepositoryInterface
{
    public function create(ServiceDto $dto): Service
    {
        $payload = $dto->toArray();
        // Laravel mass assignment will handle casting, etc.
        return Service::create($payload);
    }

    public function findById(int $id): ?Service
    {
        return Service::find($id);
    }

    public function all(array $filters = []): array
    {
        $query = Service::query();

        if (isset($filters['is_active'])) {
            $query->where('is_active', (bool)$filters['is_active']);
        }

        if (isset($filters['search'])) {
            $q = $filters['search'];
            $query->where(fn($qBuilder) =>
                $qBuilder->where('title', 'like', "%{$q}%")
                         ->orWhere('description', 'like', "%{$q}%")
            );
        }

        return $query->get()->toArray();
    }

    public function update(int $id, ServiceDto $dto): Service
    {
        $service = $this->findById($id);
        if (! $service) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException("Service with id {$id} not found.");
        }

        $service->update($dto->toArray());
        return $service->refresh();
    }

    public function delete(int $id): bool
    {
        $service = $this->findById($id);
        if (! $service) {
            return false;
        }

        return (bool)$service->delete();
    }
}
