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
        // $user = Auth::user();
        // $credentials = ['email' => $user->email];
        // $status = Password::sendResetLink($credentials);
        // if ($status === Password::RESET_LINK_SENT) {
        //     return 'success';
        // } else {
        //     return 'failed';
        // }
        // if ($user) {
        //     return view('layouts.index');
        // }
        return config('adminlte.');

        return view('layouts.index');
    }
}
