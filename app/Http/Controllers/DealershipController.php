<?php

namespace App\Http\Controllers;

use App\Http\Requests\DealershipRequest;
use App\Http\Resources\DealershipResource;
use App\Models\Dealership;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DealershipController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Dealership::class);

        return DealershipResource::collection(Dealership::all());
    }

    public function store(DealershipRequest $request): \App\Http\Resources\DealershipResource
    {
        $this->authorize('create', Dealership::class);

        return new DealershipResource(Dealership::create($request->validated()));
    }

    public function show(Dealership $dealership): \App\Http\Resources\DealershipResource
    {
        $this->authorize('view', $dealership);

        return new DealershipResource($dealership);
    }

    public function update(DealershipRequest $request, Dealership $dealership): \App\Http\Resources\DealershipResource
    {
        $this->authorize('update', $dealership);

        $dealership->update($request->validated());

        return new DealershipResource($dealership);
    }

    public function destroy(Dealership $dealership)
    {
        $this->authorize('delete', $dealership);

        $dealership->delete();

        return response()->json();
    }
}
