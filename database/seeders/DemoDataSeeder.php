<?php

namespace Database\Seeders;

use App\Domains\Dealership\Models\Dealership;
use App\Domains\Permission\Models\Permission;
use App\Domains\Store\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        User::where('email', 'jlohr@autorisknow.com')->first();
        $consultant = User::where('email', 'jconsultant@autorisknow.com')->first();
        $employee = User::where('email', 'femployee@dealer.com')->first();

        $dealership = Dealership::create([
            'name' => 'Premium Auto Dealership',
            'address' => '123 Main Street',
            'city' => 'City',
            'state' => 'State',
            'phone' => '(555) 123-4567',
            'created_by' => $consultant->id,
        ]);

        // Create stores
        $mainStore = Store::create([
            'dealership_id' => $dealership->id,
            'name' => 'Main Showroom',
            'address' => '123 Main Street',
            'city' => 'City',
            'state' => 'State',
            'phone' => '(555) 123-4567',
            'is_main_store' => true,
            'is_active' => true,
        ]);

        $serviceStore = Store::create([
            'dealership_id' => $dealership->id,
            'name' => 'Service Center',
            'address' => '125 Main Street',
            'city' => 'City',
            'state' => 'State',
            'phone' => '(555) 123-4568',
            'is_main_store' => false,
            'is_active' => true,
        ]);

        $consultant->dealerships()->attach($dealership->id);

        $employee->dealerships()->attach($dealership->id);
        $employee->stores()->attach([$mainStore->id, $serviceStore->id]);

        $permissions = Permission::all();

        foreach ($permissions as $permission) {
            $employee->permissions()->attach($permission->id, ['store_id' => $mainStore->id]);
            $employee->permissions()->attach($permission->id, ['store_id' => $serviceStore->id]);
        }
    }
}
