<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPermissionPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool {}

    public function view(User $user, UserPermission $userPermission): bool {}

    public function create(User $user): bool {}

    public function update(User $user, UserPermission $userPermission): bool {}

    public function delete(User $user, UserPermission $userPermission): bool {}

    public function restore(User $user, UserPermission $userPermission): bool {}

    public function forceDelete(User $user, UserPermission $userPermission): bool {}
}
