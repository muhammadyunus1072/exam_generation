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

class UserController extends Controller
{
    public function index()
    {
        return view('app.user.index');
    }

    public function getRoles(Request $request){
        return $request->all();
        $roles = Role::all()->pluck('name');
        $response = array();
        foreach ($roles as $role) {
            array_push($response, ['id' => $role, 'text' => $role]);
        }
        return $response;
    }
}
