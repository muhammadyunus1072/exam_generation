<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // return $user->email;
        return Password::sendResetLink($user->email);
        if ($user) {
            return view('layouts.index');
        }

        return view('auth.login');
    }
}
