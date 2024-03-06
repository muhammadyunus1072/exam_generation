<?php

namespace App\Helpers;

use Illuminate\Http\Request;

/*
| Last Update : 2022/12/12
| Update: getAccessFromRequest should not str_contains to all name
|         ex: access 'user_other' will be readed as access 'user'
 */

class PermissionHelper
{
    // ------LIST PERMISSION TYPE------
    public const PERMISSION_TYPE_CREATE = 'create';
    public const PERMISSION_TYPE_READ = 'read';
    public const PERMISSION_TYPE_UPDATE = 'update';
    public const PERMISSION_TYPE_DELETE = 'delete';
    public const PERMISSION_TYPE_ALL = [self::PERMISSION_TYPE_CREATE, self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE, self::PERMISSION_TYPE_DELETE];
    public const PERMISSION_TYPE_ALL_EXCEPT_DELETE = [self::PERMISSION_TYPE_CREATE, self::PERMISSION_TYPE_READ, self::PERMISSION_TYPE_UPDATE];

    // ---- ROUTE NAME ----
    public const ROUTE_NAME_CREATE = ['create', 'store'];
    public const ROUTE_NAME_READ = ['index', 'show', 'edit', 'print', 'get', 'find', 'export'];
    public const ROUTE_NAME_UPDATE = ['edit', 'update', 'approve'];
    public const ROUTE_NAME_DELETE = ['destroy'];
    public const ROUTE_NAME_HISTORY = ['history'];

    // ---- LIST ACCESS ----
    // OPERASIONAL
    public const ACCESS_DASHBOARD = "dashboard";

    public const ALL_ACCESSIBLE = [
        // OPERASIONAL
        self::ACCESS_DASHBOARD => 'Dashboard',
    ];

    public const ALL_ACCESSIBLE_PERMISSION = [
        // OPERASIONAL
        self::ACCESS_DASHBOARD => self::PERMISSION_TYPE_ALL,
    ];

    public static function generatePermissionAll()
    {
        $permissionAll = [];
        foreach (self::ALL_ACCESSIBLE as $access => $name) {
            $permissionAll[$access] = self::PERMISSION_TYPE_ALL;
        }
        $permissionAll = json_encode($permissionAll);

        return $permissionAll;
    }

    public static function generatePermission($arrayPermission)
    {
        $permissions = [];
        foreach ($arrayPermission as $access => $type) {
            $permissionAll[$access] = $type;
        }
        $permissions = json_encode($permissions);

        return $permissions;
    }

    public static function isPermitted($user, $permissionType, $access)
    {
        $jsonPermissions = json_decode($user->permissions);

        if (empty($jsonPermissions->$access)) {
            return false;
        }

        // ---Role Abilites For Spesific Access---
        $permission = $jsonPermissions->$access;

        return !empty($permission) && in_array($permissionType, $permission);
    }

    public static function isRequestPermitted(Request $request)
    {
        $user = $request->user();
        $permissionType = self::getPermissionTypeFromRequest($request);
        $access = self::getAccessFromRequest($request);

        return self::isPermitted($user, $permissionType, $access);
    }

    private static function getAccessFromRequest($request)
    {
        $routeName = explode('.', $request->route()->getName())[0];
        foreach (self::ALL_ACCESSIBLE as $access => $name) {
            if ($routeName == $access) {
                return $access;
            }
        }

        return null;
    }

    private static function getPermissionTypeFromRequest($request)
    {
        $routeName = $request->route()->getName();
        if (self::inArray($routeName, self::ROUTE_NAME_READ)) {
            return self::PERMISSION_TYPE_READ;
        } elseif (self::inArray($routeName, self::ROUTE_NAME_CREATE)) {
            return self::PERMISSION_TYPE_CREATE;
        } elseif (self::inArray($routeName, self::ROUTE_NAME_UPDATE)) {
            return self::PERMISSION_TYPE_UPDATE;
        } elseif (self::inArray($routeName, self::ROUTE_NAME_DELETE)) {
            return self::PERMISSION_TYPE_DELETE;
        }

        return null;
    }

    private static function inArray($needle, $haystack)
    {
        foreach ($haystack as $obj) {
            if (str_contains($needle, $obj)) {
                return true;
            }
        }

        return false;
    }
}
