<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PerformController extends Controller
{
    public function index(Request $request)
    {
        return view('app.service.perform.index', ["kode" => $request->kode ?? null]);
    }
}
