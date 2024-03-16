<?php

namespace App\Http\Controllers\Documentation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentationController extends Controller
{
    public function index()
    {
        return view('app.documentation.index');
    }
    public function show(Request $request)
    {
        $id = $request->id;
        return view('app.documentation.show', compact('id'));
    }
}
