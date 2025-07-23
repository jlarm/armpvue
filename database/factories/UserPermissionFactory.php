<?php

namespace Database\Factories;

use App\Models\UserPermission;
use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserPermissionFactory extends Factory
{
    protected $model = UserPermission::class;

    public function definition(): array
    {
        return [
            'created_at' => CarbonImmutable::now(),
            'updated_at' => CarbonImmutable::now(),
        ];
    }
}
