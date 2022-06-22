<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PimpinanController extends Controller
{
    public function index(Request $request){
        return view('pimpinan.dashboard');
    }
}
