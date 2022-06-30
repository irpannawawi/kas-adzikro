<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Akun;
use App\Models\Produk;
use App\Models\Kontak;
use App\Models\Prson;
use App\Models\User;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;

class BendaharaController extends Controller
{
    public function index(Request $request){
        $data['jumlah_akun'] = Akun::get()->count();
        $data['jumlah_produk'] = Produk::get()->count();
        $data['jumlah_kontak'] = Kontak::get()->count();
        $data['jumlah_prson_level'] = Prson::get()->count();
        $data['jumlah_administrator'] = User::get()->count();
        $data['jumlah_pemasukan'] = Pemasukan::where('tanggal', 'LIKE', date('Y-m').'%')->where('tipe', 'masuk')->get()->sum('nominal');
        $data['jumlah_pengeluaran'] = Pengeluaran::where('tanggal', 'LIKE', date('Y-m').'%')->where('tipe', 'keluar')->get()->sum('nominal');
        return view('bendahara.dashboard', $data);
    }

    
}
