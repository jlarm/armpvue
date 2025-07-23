<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'scans',
                'display_name' => 'Access Scans',
                'description' => 'Can access and manage scans module',
            ],
            [
                'name' => 'audits',
                'display_name' => 'Access Audits',
                'description' => 'Can access and manage audits module',
            ],
            [
                'name' => 'vendors',
                'display_name' => 'Access Vendors',
                'description' => 'Can access and manage vendors module',
            ],
            [
                'name' => 'courses',
                'display_name' => 'Access Courses',
                'description' => 'Can access and manage courses module',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission['name']],
                $permission
            );
        }
    }
}
