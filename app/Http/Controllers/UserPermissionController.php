<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPermissionRequest;
use App\Http\Resources\UserPermissionResource;
use App\Models\UserPermission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserPermissionController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', UserPermission::class);

        return UserPermissionResource::collection(UserPermission::all());
    }

    public function store(UserPermissionRequest $request): \App\Http\Resources\UserPermissionResource
    {
        $this->authorize('create', UserPermission::class);

        return new UserPermissionResource(UserPermission::create($request->validated()));
    }

    public function show(UserPermission $userPermission): \App\Http\Resources\UserPermissionResource
    {
        $this->authorize('view', $userPermission);

        return new UserPermissionResource($userPermission);
    }

    public function update(UserPermissionRequest $request, UserPermission $userPermission): \App\Http\Resources\UserPermissionResource
    {
        $this->authorize('update', $userPermission);

        $userPermission->update($request->validated());

        return new UserPermissionResource($userPermission);
    }

    public function destroy(UserPermission $userPermission)
    {
        $this->authorize('delete', $userPermission);

        $userPermission->delete();

        return response()->json();
    }
}
