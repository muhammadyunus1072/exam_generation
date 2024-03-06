<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Helpers\PermissionHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function index()
    {
        return view('layouts.index');
    }
}
