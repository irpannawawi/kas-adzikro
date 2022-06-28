<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Transaksi;

class LaporanController extends Controller
{
    //
    public function jurnal(Request $request)
    {
        if ($request->input('bln')) {
            $bln = $request->input('bln');
            $thn = $request->input('thn');
        }else{
            $bln = date('m');
            $thn = date('Y');
        }

        $data['transaksi'] = Transaksi::where('tanggal', 'like', $thn.'-'.$bln.'-%')->get();
        return view('bendahara.jurnal', $data);
    }

    public function laporan_transaksi(Request $request)
    {
        if ($request->input('bln')) {
            $bln = $request->input('bln');
            $thn = $request->input('thn');
        }else{
            $bln = date('m');
            $thn = date('Y');
        }

        $data['transaksi'] = Transaksi::where('tanggal', 'like', $thn.'-'.$bln.'-%')->get();
        return view('bendahara.laporan_transaksi', $data);

    }
}
