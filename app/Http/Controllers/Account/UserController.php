<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('app.account.user.index');
    }
}
