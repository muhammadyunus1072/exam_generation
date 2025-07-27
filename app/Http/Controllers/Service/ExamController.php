<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExamController extends Controller
{
    public function index()
    {
        return view('app.service.exam.index');
    }

    public function create()
    {
        return view('app.service.exam.detail', ["objId" => null]);
    }

    public function edit(Request $request)
    {
        return view('app.service.exam.detail', ["objId" => $request->id]);
    }
}
