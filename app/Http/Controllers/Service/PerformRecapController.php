<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PerformRecapController extends Controller
{
    public function index(Request $request)
    {
        return view('app.service.perform-recap.index', ["objId" => $request->id]);
    }

    public function edit(Request $request)
    {
        return view('app.service.perform-recap.detail', ["objId" => $request->id]);
    }
}
