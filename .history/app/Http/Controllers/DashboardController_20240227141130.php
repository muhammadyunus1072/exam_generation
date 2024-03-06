<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class DashboardController extends Controller
{
    public function login()
    {
        $user = Auth::user();
        if ($user) {
            return view('layouts.index');
        }

        return view('auth.login');
    }
}
