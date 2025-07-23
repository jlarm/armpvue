<?php

namespace App\Http\Controllers;

use App\Domains\Dealership\Models\Dealership;
use App\Http\Requests\DealershipRequest;
use App\Http\Resources\DealershipResource;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Inertia\Inertia;
use Inertia\Response;

class DealershipController extends Controller
{
    use AuthorizesRequests;

    public function index(): Response
    {
        $this->authorize('viewAny', Dealership::class);

        return Inertia::render('Dealerships/Index', [
            'dealerships' => DealershipResource::collection(Dealership::all()),
        ]);
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
