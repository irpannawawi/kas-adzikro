<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BendaharaController extends Controller
{
    public function index(Request $request){
        return view('bendahara.dashboard');
    }

    
}
