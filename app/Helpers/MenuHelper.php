<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

class MenuHelper
{
    public static function menu()
    {
        $user = Auth::user();
        return Cache::remember(CacheHelper::KEY_MENU . $user->id, CacheHelper::TIME_MENU, function () {
            return self::getValidatedMenu();
        });
    }

    private static function getValidatedMenu()
    {
        $user = Auth::user();
        $menus = config('template.menu');
        $currentRoute = Route::currentRouteName();

        $validatedMenu = [];
        foreach ($menus as $menu) {
            $menu['is_active'] = 0;

            if (isset($menu['submenu'])) {
                $validatedSubmenu = [];

                foreach ($menu['submenu'] as $submenu) {
                    $submenu['is_active'] = 0;
                    if (isset($submenu['route']) && $submenu['route'] == $currentRoute) {
                        $menu['is_active'] = 1;
                        $submenu['is_active'] = 1;
                    }

                    if (!isset($submenu['route']) || PermissionHelper::isRoutePermitted($submenu['route'], $user)) {
                        $validatedSubmenu[] = $submenu;
                    }
                }

                if (count($validatedSubmenu) > 0) {
                    $menu['submenu'] = $validatedSubmenu;
                    $validatedMenu[] = $menu;
                }
            } else {
                if (isset($menu['route']) && $menu['route'] == $currentRoute) {
                    $menu['is_active'] = 1;
                }

                if (!isset($menu['route']) || PermissionHelper::isRoutePermitted($menu['route'], $user)) {
                    $validatedMenu[] = $menu;
                }
            }
        }

        return $validatedMenu;
    }
}
