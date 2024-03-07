<?php

namespace Database\Seeders\User;

use App\Helpers\PermissionHelper;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        PermissionHelper::create(PermissionHelper::ACCESS_DASHBOARD, [PermissionHelper::TYPE_READ]);
        PermissionHelper::create(PermissionHelper::ACCESS_USER, PermissionHelper::TYPE_ALL);
        PermissionHelper::create(PermissionHelper::ACCESS_ROLE, PermissionHelper::TYPE_ALL);
        PermissionHelper::create(PermissionHelper::ACCESS_PERMISSION, PermissionHelper::TYPE_ALL);

        // create role
        PermissionHelper::createRole("Admin", [
            PermissionHelper::ACCESS_DASHBOARD => [PermissionHelper::TYPE_READ],
            PermissionHelper::ACCESS_USER => PermissionHelper::TYPE_ALL,
            PermissionHelper::ACCESS_PERMISSION => PermissionHelper::TYPE_ALL,
            PermissionHelper::ACCESS_ROLE => PermissionHelper::TYPE_ALL,
        ]);

        PermissionHelper::createRole("Member", [
            PermissionHelper::ACCESS_DASHBOARD => [PermissionHelper::TYPE_READ]
        ]);
    }
}
