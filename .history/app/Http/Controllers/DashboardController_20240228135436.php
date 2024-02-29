<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
        // return config('menu.menu');
        $user = User::find(Auth::id());
        return $user->getAllRoles();
        return view('layouts.index');
    }
}
