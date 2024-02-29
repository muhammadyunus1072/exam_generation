<?php

namespace App\Helpers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

/*
| Last Updated 2022-12-07
| New: Handle Header Menu
 */

class MenuFilter
{
    private $user;

    public function coba(){
        return 'ABC';
    }
    public function transform($item)
    {
        $this->user = User::find(Auth::id());

        if (isset($item['submenu'])) {
            // Handle Header Menu
            $isPermitted = false;
            foreach ($item['submenu'] as $submenu) {
                $permissionType = $this->convertUrlToPermissionType($submenu);

                // Fail Convert From Item's URL to Permission Type
                if (empty($permissionType)) {
                    continue;
                }
            }
            return $isPermitted ? $item : false;
        } else {
            // Handle Menu
            $permissionType = $this->convertUrlToPermissionType($item);
            
            // Fail Convert From Item's URL to Permission Type
            if (empty($permissionType)) {
                return false;
            }
            return $permissionType ? $item : false;
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
