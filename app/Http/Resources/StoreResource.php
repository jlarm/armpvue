<?php

namespace App\Http\Resources;

use App\Domains\Store\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Store */
class StoreResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'phone' => $this->phone,
            'is_main_store' => $this->is_main_store,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'dealership_id' => $this->dealership_id,

            'Dealerships' => new DealershipResource($this->whenLoaded('dealership')),
        ];
    }
}
