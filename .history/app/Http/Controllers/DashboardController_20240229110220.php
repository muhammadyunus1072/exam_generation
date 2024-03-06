<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Helpers\PermissionHelper;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Spatie\Permission\Models\Permission;

class DashboardController extends Controller
{
    private $user;
    public function index()
    {
        // $role = Role::whereName('admin')->first();
        // $role->revokePermissionTo('edit users');
        // $permission = Permission::create(['name' => 'edit users']);
        // $role->givePermissionTo('edit users');
        // if (Role::where('name', 'member')->exists()) {
        //     // If the permission exists, check if the user has permission to view the resource
        //     return 'EX';
        //     // if ($this->user->hasPermissionTo("view $url")) {
        //     //     return true;
        //     // }
        // }
        // return 'NO';
        // return $roles = Role::all()->pluck('name');

        // $url = 'roles_and_permissions';
        
        $this->user = User::find(Auth::id());
        if(!$this->user->hasRole('member')){
            $roles = $this->user->getRoleNames();
            foreach($roles as $role){
                $this->user->removeRole($role);
            }
            $this->user->assignRole($this->role);
        }
        // $this->user->assignRole('admin');
        // $this->user->removeRole('member');
        // $roles = $this->user->getAllPermissions();
        $roles = $this->user->getRoleNames();
        return $roles;
        // if($this->user->hasPermissionTo("view users")){
        //     return 'permitted';
        // }else{
        //     return $deny;
        // }
        // $menus = config('menu.menu');
        // foreach ($menus as $menu) {
        //     if (isset($menu['submenu'])) {
        //         // Handle Header Menu
        //         $isPermitted = false;
        //         foreach ($menu['submenu'] as $submenu) {
        //             $permissionType = $this->convertUrlToPermissionType($submenu);
        //             return $permissionType;
        //             // Fail Convert From Item's URL to Permission Type
        //             if (empty($permissionType)) {
        //                 continue;
        //             }
        //         }
        //         return $isPermitted ? $item : false;
        //     } 
        // }
        // if (Permission::where('name', 'view ' . $url)->exists()) {
        //     // If the permission exists, check if the user has permission to view the resource
        //     if ($this->user->hasPermissionTo("view $url")) {
        //         return true;
        //     } else {
        //         // Handle case where user doesn't have permission
        //         return false;
        //     }
        // }
        // $user = Auth::user();
        // $credentials = ['email' => $user->email];
        // $status = Password::sendResetLink($credentials);
        // if ($status === Password::RESET_LINK_SENT) {
        //     return 'success';
        // } else {
        //     return 'failed';
        // }
        // if ($user) {
        //     return view('layouts.index');
        // }
        // $item = 
        // // [
        //     [
        //         "text" => "Dashboard",
        //         "url" => "dashboard",
        //         "icon" => "fas fa-fw fa-file",
        //     ];
        //     // [
        //     //     "text" => "Pernyataan Piutang",
        //     //     "icon" => "fas fa-fw fa-file-alt",
        //     //     "submenu" => [
        //     //         [
        //     //             "text" => "Surat Pernyataan Piutang",
        //     //             "url" => "surat_pernyataan_piutang",
        //     //             "icon_color" => "success"
        //     //         ],
        //     //         [
        //     //             "text" => "Lampiran Surat Pernyataan Piutang",
        //     //             "url" => "lampiran_surat_pernyataan_piutang",
        //     //             "icon_color" => "primary"
        //     //         ]
        //     //     ]
        //     // ]
        // // ];

        // $this->user = User::find(Auth::id());
        // // return $currentUser;

        // // return PermissionHelper::ALL_ACCESSIBLE;
        // if (isset($item['submenu'])) {
        //     // Handle Header Menu
        //     return "submenu";
        //     $isPermitted = false;
        //     foreach ($item['submenu'] as $submenu) {
        //         $permissionType = $this->convertUrlToPermissionType($submenu);

        //         // Fail Convert From Item's URL to Permission Type
        //         if (empty($permissionType)) {
        //             continue;
        //         }
        //     }
        //     return $isPermitted ? $item : false;
        // } else {
        //     // Handle Menu
        //     $permissionType = $this->convertUrlToPermissionType($item);
            
        //     // Fail Convert From Item's URL to Permission Type
        //     if (empty($permissionType)) {
        //         return false;
        //     }
        //     return $permissionType ? $item : false;
        // }
        // $user = User::find(Auth::id());
        // return $user->getAllPermissions();
        return view('layouts.index');
    }

    private function convertUrlToPermissionType($item)
    {
        if (!isset($item['url'])) {
            return null;
        }

        $url = explode('?', $item['url'])[0];
        
        if (Permission::where('name', 'view ' . $url)->exists()) {
            // If the permission exists, check if the user has permission to view the resource
            if ($this->user->hasPermissionTo("view $url")) {
                return true;
            }
        }

        return null;
    }
}
