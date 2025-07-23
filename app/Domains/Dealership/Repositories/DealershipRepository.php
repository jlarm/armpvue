<?php

namespace App\Domains\Dealership\Repositories;

use App\Domains\Dealership\Contracts\DealershipRepositoryInterface;
use App\Domains\Dealership\Models\Dealership;
use Illuminate\Database\Eloquent\Collection;

class DealershipRepository implements DealershipRepositoryInterface
{
    public function all(): Collection
    {
        return Dealership::all();
    }
}
