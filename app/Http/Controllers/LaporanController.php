<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Transaksi;

class LaporanController extends Controller
{
    //
    public function jurnal(Request $request)
    {
        $data = [
            'transaksi' => Transaksi::get(),
        ];
        return view('bendahara.jurnal', $data);
    }
}
