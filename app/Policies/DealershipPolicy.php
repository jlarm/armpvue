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

    public function create(User $user) {}

    public function update(User $user, Dealership $dealership) {}

    public function delete(User $user, Dealership $dealership) {}

    public function restore(User $user, Dealership $dealership) {}

    public function forceDelete(User $user, Dealership $dealership) {}
}
