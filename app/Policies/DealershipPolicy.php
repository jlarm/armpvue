<?php

namespace App\Policies;

use App\Models\Dealership;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DealershipPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->isConsultant();
    }

    public function view(User $user, Dealership $dealership): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        return $user->canAccessDealership($dealership->id);
    }

    public function create(User $user): bool
    {
        if ($user->isAdmin()) {
            return true;
        }
        return $user->isConsultant();
    }

    public function update(User $user, Dealership $dealership): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isConsultant()) {
            return $user->canAccessDealership($dealership->id);
        }

        return false;
    }

    public function delete(User $user, Dealership $dealership): bool
    {
        return $user->isAdmin();
    }

    public function assignUsers(User $user, Dealership $dealership): bool
    {
        if ($user->isAdmin()) {
            return true;
        }

        if ($user->isConsultant()) {
            return $user->canAccessDealership($dealership->id);
        }

        return false;
    }
}
