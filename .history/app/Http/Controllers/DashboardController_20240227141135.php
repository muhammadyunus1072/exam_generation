<?php

namespace App\Http\Controllers;

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
