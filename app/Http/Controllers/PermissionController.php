<?php

namespace App\Http\Controllers;

use App\Domains\Permission\Models\Permission;
use App\Http\Requests\PermissionRequest;
use App\Http\Resources\PermissionResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PermissionController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Permission::class);

        return PermissionResource::collection(Permission::all());
    }

    public function store(PermissionRequest $request): \App\Http\Resources\PermissionResource
    {
        $this->authorize('create', Permission::class);

        return new PermissionResource(Permission::create($request->validated()));
    }

    public function show(Permission $permission): \App\Http\Resources\PermissionResource
    {
        $this->authorize('view', $permission);

        return new PermissionResource($permission);
    }

    public function update(PermissionRequest $request, Permission $permission): \App\Http\Resources\PermissionResource
    {
        $this->authorize('update', $permission);

        $permission->update($request->validated());

        return new PermissionResource($permission);
    }

    public function destroy(Permission $permission)
    {
        $this->authorize('delete', $permission);

        $permission->delete();

        return response()->json();
    }
}
