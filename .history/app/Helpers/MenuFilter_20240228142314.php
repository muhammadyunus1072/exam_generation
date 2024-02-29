<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use JeroenNoten\LaravelAdminLte\Menu\Filters\FilterInterface;

/*
| Last Updated 2022-12-07
| New: Handle Header Menu
 */

class MenuFilter implements FilterInterface
{
    public function coba(){
        return 'ABC';
    }
    public function transform($item)
    {
        $currentUser = Auth::user();

        if (isset($item['submenu'])) {
            // Handle Header Menu
            $isPermitted = false;
            foreach ($item['submenu'] as $submenu) {
                $permissionType = $this->convertUrlToPermissionType($submenu);

                // Fail Convert From Item's URL to Permission Type
                if (empty($permissionType)) {
                    continue;
                }

                $isPermitted = PermissionHelper::isPermitted(
                    $currentUser,
                    PermissionHelper::PERMISSION_TYPE_READ,
                    $permissionType
                );

                if ($isPermitted) {
                    $isShow = true;
                    break;
                }
            }

            return $isPermitted ? $item : false;
        } else {
            // Handle Menu
            $permissionType = $this->convertUrlToPermissionType($item);

            // Fail Convert From Item's URL to Permission Type
            if (empty($permissionType)) {
                return $item;
            }

            $isPermitted = PermissionHelper::isPermitted(
                $currentUser,
                PermissionHelper::PERMISSION_TYPE_READ,
                $permissionType
            );

            return $isPermitted ? $item : false;
        }
    }

    private function convertUrlToPermissionType($item)
    {
        if (!isset($item['url'])) {
            return null;
        }

        $url = explode('?', $item['url'])[0];
        
        if($this->user->hasPermissionTo("view $url")){
            return true;
        }

        return null;
    }
}
