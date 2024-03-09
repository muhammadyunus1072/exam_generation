<?php

namespace App\Http\Controllers\Account;

use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        return view('app.account.role.index');
    }

    public function create()
    {
        return view('app.account.role.detail', ["objId" => null]);
    }

    public function edit(Request $request)
    {
        return view('app.account.role.detail', ["objId" => $request->id]);
    }

    public function getRoles(Request $request)
    {
        $roles = Role::where('name', 'like', '%' . $request->search . '%')->pluck('name');
        $response = array();
        foreach ($roles as $role) {
            array_push($response, ['id' => $role, 'text' => $role]);
        }
        return $response;
    }
}
