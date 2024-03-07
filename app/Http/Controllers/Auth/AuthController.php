<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function index()
    {
        return view('app.auth.login');
    }

    public function login()
    {
        return view('app.auth.login');
    }

    public function register()
    {
        return view('app.auth.register');
    }

    public function forgot_password()
    {
        return view('app.auth.forgot-password');
    }

    public function reset_password(Request $request)
    {
        return view('app.auth.reset-password', ['token' => $request->token]);
    }

    public function email_verification(Request $request)
    {
        return view('app.auth.email-verification', ['email' => $request->email]);
    }

    public function email_verification_verify(Request $request)
    {
        $user = User::find($request->id);
        if (!hash_equals(sha1($user->getEmailForVerification()), (string) $request->hash)) {
            return redirect()->route('login');
        }

        $user->email_verified_at = Carbon::now();
        $user->save();

        Auth::loginUsingId($user->id);

        return redirect()->route('dashboard.index');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
