<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return $user->getRoleNames();
        if ($user) {
            return view('layouts.index');
        }

        return view('auth.login');
    }
}
