<?php

namespace App\Policies;

use App\Models\Store;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class StorePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true; // All authenticated users can view stores
    }

    public function view(User $user, Store $store): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->canAccessDealership($store->dealership_id);
    }

    public function create(User $user): bool
    {
        if ($user->isAdmin()) {
            return true;
        }
        return $user->isConsultant();
    }

    public function update(User $user, Store $store): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isConsultant()) {
            return $user->canAccessDealership($store->dealership_id);
        }

        return false;
    }

    public function delete(User $user, Store $store): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isConsultant()) {
            return $user->canAccessDealership($store->dealership_id);
        }

        return false;
    }
}
