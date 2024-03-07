<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return view('app.permission.index');
    }
    
    public function getPermissions(Request $request){
        $permisions = Permission::where('name', 'like', '%'.$request->search.'%')->pluck('name');
        $response = array();
        foreach ($permisions as $permision) {
            array_push($response, ['id' => $permision, 'text' => $permision]);
        }
        return $response;
    }
}
