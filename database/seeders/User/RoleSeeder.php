<?php

namespace Database\Seeders\User;

use App\Helpers\PermissionHelper;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create(['name' => "Guru"]);
        foreach (PermissionHelper::ACCESS_TYPE_ALL as $access => $types) {
            foreach ($types as $type) {
                $role->givePermissionTo(PermissionHelper::transform($access, $type));
            }
        }
        $role = Role::create(['name' => "Murid"]);
        foreach (PermissionHelper::TYPE_ALL as $type) {
            $role->givePermissionTo(PermissionHelper::transform(PermissionHelper::ACCESS_PERFORM, $type));
        }
    }
}
