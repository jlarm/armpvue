<?php

namespace Database\Factories;

use App\Models\Dealership;
use App\Models\Store;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    protected $model = Store::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address(),
            'city' => $this->faker->city(),
            'state' => $this->faker->word(),
            'phone' => $this->faker->phoneNumber(),
            'is_main_store' => $this->faker->boolean(),
            'is_active' => $this->faker->boolean(),
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),

            'dealership_id' => Dealership::factory(),
        ];
    }
}
