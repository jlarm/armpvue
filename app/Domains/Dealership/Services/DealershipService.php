<?php

namespace App\Domains\Dealership\Services;

use App\Domains\Dealership\Contracts\DealershipRepositoryInterface;
use App\Domains\Dealership\DTOs\CreateDealershipDTO;
use App\Domains\Dealership\DTOs\UpdateDealershipDTO;
use App\Domains\Dealership\Events\DealershipCreated;
use App\Domains\Dealership\Events\DealershipUpdated;
use App\Domains\Dealership\Models\Dealership;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class DealershipService
{
    public function __construct(
        private readonly DealershipRepositoryInterface $repository
    ) {}

    public function getAllDealerships(): Collection
    {
        return $this->repository->all();
    }

    public function getPaginatedDealerships(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function getDealership(int $id): ?Dealership
    {
        return $this->repository->find($id);
    }

    public function createDealership(CreateDealershipDTO $dto): Dealership
    {
        $dealership = $this->repository->create($dto);

        event(new DealershipCreated($dealership));

        return $dealership;
    }

    public function updateDealership(int $id, UpdateDealershipDTO $dto): Dealership
    {
        $originalDealership = $this->repository->findOrFail($id);
        $updatedDealership = $this->repository->update($id, $dto);

        event(new DealershipUpdated($originalDealership, $updatedDealership));

        return $updatedDealership;
    }

    public function deleteDealership(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function getDealershipsByUser(int $userId): Collection
    {
        return $this->repository->findByUser($userId);
    }

    public function searchDealerships(string $query): Collection
    {
        return $this->repository->search($query);
    }

    public function assignUserToDealership(int $dealershipId, int $userId): Dealership
    {
        $dealership = $this->repository->findOrFail($dealershipId);
        $dealership->users()->attach($userId);

        return $dealership->fresh(['users']);
    }

    public function removeUserFromDealership(int $dealershipId, int $userId): Dealership
    {
        $dealership = $this->repository->findOrFail($dealershipId);
        $dealership->users()->detach($userId);

        return $dealership->fresh(['users']);
    }
}
