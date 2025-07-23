<?php

namespace App\Domains\Dealership\Services;

use App\Domains\Dealership\Contracts\DealershipRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class DealershipService
{
    public function __construct(
        private DealershipRepositoryInterface $repository
    ){}

    public function getAllDealerships(): Collection
    {
        return $this->repository->all();
    }
}
