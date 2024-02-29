<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Helpers\PermissionHelper;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return view('app.permission.index');
    }
    public function getPermissions(Request $request){
        $roles = Role::where('name', 'like', '%'.$request->search.'%')->pluck('name');
        $response = array();
        foreach ($roles as $role) {
            array_push($response, ['id' => $role, 'text' => $role]);
        }
        return $response;
    }
}
