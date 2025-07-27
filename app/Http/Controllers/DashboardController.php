<?php

namespace App\Http\Controllers;

use Exception;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('Guru')) {
            return redirect()->route('exam.index');
        } else {
            return redirect()->route('perform.index');
        }
    }
}
