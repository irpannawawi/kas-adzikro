<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;

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
    public function print_laporan_transaksi(Request $request)
    {
        if ($request->input('tipe') == 'harian') {
            $tgl = $request->input('tgl');
            $bln = $request->input('bln');
            $thn = $request->input('thn');

            $data['tgl'] = $date = $thn.'-'.$bln.'-'.$tgl;
        }else{
            $bln = $request->input('bln');
            $thn = $request->input('thn');

            $date = $thn.'-'.$bln;

            $bulan = [
                'Januari'   => '01',
                'Februari'  => '02',
                'Maret'     => '03',
                'April'     => '04',
                'Mei'       => '05',
                'Juni'      => '06',
                'Juli'      => '07',
                'Agustus'   => '08',
                'September' => '09',
                'Oktober'   => '10',
                'November'  => '11', 
                'Desember'  => '12',
            ];
            $data['tgl'] = array_search($request->input('bln'), $bulan).' '.$request->input('thn');
        }

        if($request->input('tipe_transaksi') == 'masuk'){
            $data['transaksi'] = Transaksi::where('tanggal', 'like', '%'.$date.'%')->where('tipe', 'masuk')->get();
            $data['title'] = "Laporan Pemasukan";
        }else if($request->input('tipe_transaksi') == 'keluar'){
            $data['transaksi'] = Transaksi::where('tanggal', 'like', '%'.$date.'%')->where('tipe', 'keluar')->get();
            $data['title'] = "Laporan Pengeluaran";
        }else{
            $data['transaksi'] = Transaksi::where('tanggal', 'like', '%'.$date.'%')->get();
        }
        $pdf = PDF::loadView('pdf.laporan_transaksi', $data)->setPaper('a4', 'potrait');
        return $pdf->stream();

    }

    public function print_jurnal(Request $request)
    {
        if ($request->input('tipe') == 'harian') {
            $tgl = $request->input('tgl');
            $bln = $request->input('bln');
            $thn = $request->input('thn');

            $data['tgl'] = $date = $thn.'-'.$bln.'-'.$tgl;
        }else{
            $bln = $request->input('bln');
            $thn = $request->input('thn');

            $date = $thn.'-'.$bln;

            $bulan = [
                'Januari'   => '01',
                'Februari'  => '02',
                'Maret'     => '03',
                'April'     => '04',
                'Mei'       => '05',
                'Juni'      => '06',
                'Juli'      => '07',
                'Agustus'   => '08',
                'September' => '09',
                'Oktober'   => '10',
                'November'  => '11', 
                'Desember'  => '12',
            ];
            $data['tgl'] = array_search($request->input('bln'), $bulan).' '.$request->input('thn');
        }
        $data['transaksi'] = Transaksi::where('tanggal', 'like', $date.'%')->get();
        $pdf = PDF::loadView('pdf.jurnal', $data)->setPaper('a4', 'potrait');
        return $pdf->stream();
    }
}
