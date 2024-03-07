<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PDO;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionHelper
{
    const TYPE_CREATE = "create";
    const TYPE_READ = "read";
    const TYPE_UPDATE = "update";
    const TYPE_DELETE = "delete";
    const TYPE_ALL = [self::TYPE_CREATE, self::TYPE_READ, self::TYPE_UPDATE, self::TYPE_DELETE];

    const ROUTE_TYPE_CREATE = ['create', 'store'];
    const ROUTE_TYPE_READ = ['index', 'show', 'print', 'export', 'find'];
    const ROUTE_TYPE_UPDATE = ['edit', 'update'];
    const ROUTE_TYPE_DELETE = ['destroy'];

    const ACCESS_DASHBOARD = "dashboard";
    const ACCESS_USER = "user";
    const ACCESS_PERMISSION = "permission";
    const ACCESS_ROLE = "role";

    /*
    | Parameters
    | name (string) : Nama dari permission yang akan dibuat
    | types (array) : Array yang berisikan tipe permission
    |                 Contoh: [PermissionHelper::TYPE_CREATE, PermissionHelper::TYPE_READ]
    */
    public static function create($name, $types = [])
    {
        foreach ($types as $type) {
            Permission::create(['name' => "$type $name"]);
        }
    }

    /*
    | Parameters
    | name (string)       : Nama dari role yang akan dibuat
    | permissions (array) : Array yang berisikan tipe permission
    |                       Contoh: [PermissionHelper::ACCESS_DASHBOARD => [PermissionHelper::TYPE_CREATE, PermissionHelper::TYPE_READ]]
    */
    public static function createRole($name, $permissions = [])
    {
        $role = Role::create(['name' => $name]);

        foreach ($permissions as $access => $types) {
            foreach ($types as $type) {
                $role->givePermissionTo("$type $access");
            }
        }
    }

    /*
    | Parameters
    | route_name (string) : Nama Route
    */
    public static function isRoutePermitted($route_name, $user = null)
    {
        // Identifikasi Route
        $exploded_route_names = explode(".", $route_name);
        $access = $exploded_route_names[0];
        $route_type = $exploded_route_names[1];

        if (in_array($route_type, self::ROUTE_TYPE_CREATE)) {
            $type = self::TYPE_CREATE;
        } else if (in_array($route_type, self::ROUTE_TYPE_READ)) {
            $type = self::TYPE_READ;
        } else if (in_array($route_type, self::ROUTE_TYPE_UPDATE)) {
            $type = self::TYPE_UPDATE;
        } else {
            $type = self::TYPE_DELETE;
        }

        // Pemeriksaan Hak Akses
        $user = $user == null ? User::find(Auth::id()) : $user;
        return $user->hasPermissionTo("$type $access");
    }
}
