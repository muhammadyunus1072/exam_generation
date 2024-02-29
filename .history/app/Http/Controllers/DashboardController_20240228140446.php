<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Helpers\PermissionHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class DashboardController extends Controller
{
    public function index()
    {
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
        $item = 
        // [
            [
                "text" => "Lampiran Pasien",
                "url" => "lampiran_tindakan",
                "icon" => "fas fa-fw fa-file",
            ];
            // [
            //     "text" => "Pernyataan Piutang",
            //     "icon" => "fas fa-fw fa-file-alt",
            //     "submenu" => [
            //         [
            //             "text" => "Surat Pernyataan Piutang",
            //             "url" => "surat_pernyataan_piutang",
            //             "icon_color" => "success"
            //         ],
            //         [
            //             "text" => "Lampiran Surat Pernyataan Piutang",
            //             "url" => "lampiran_surat_pernyataan_piutang",
            //             "icon_color" => "primary"
            //         ]
            //     ]
            // ]
        // ];

        $currentUser = Auth::user();

        return PermissionHelper::ALL_ACCESSIBLE;
        if (isset($item['submenu'])) {
            // Handle Header Menu
            return "submenu";
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
            return $isPermitted;
            return $isPermitted ? $item : false;
        } else {
            // Handle Menu
            $permissionType = $this->convertUrlToPermissionType($item);
            return $permissionType;
            // Fail Convert From Item's URL to Permission Type
            if (empty($permissionType)) {
                return $item;
            }

            $isPermitted = PermissionHelper::isPermitted(
                $currentUser,
                PermissionHelper::PERMISSION_TYPE_READ,
                $permissionType
            );
            return PermissionHelper::ALL_ACCESSIBLE;
            return $isPermitted ? $item : false;
        }
        $user = User::find(Auth::id());
        return $user->getAllPermissions();
        return view('layouts.index');
    }

    private function convertUrlToPermissionType($item)
    {
        if (!isset($item['url'])) {
            return null;
        }

        $url = explode('?', $item['url'])[0];
        foreach (PermissionHelper::ALL_ACCESSIBLE as $key => $name) {
            if ($url == $key) {
                return $key;
            }
        }

        return null;
    }
}
