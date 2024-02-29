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
        $data = Role::all()->pluck('name');
        $response = array();
        foreach ($data->ruangans as $res) {
            array_push($response, ['id' => $res->idrg, 'text' => "$res->idrg | $res->nmruang"]);
        }
        return $response;
    }
}
