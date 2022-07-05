<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

    public function profil(Request $request)
    {
        $data['profil'] = User::find(Auth::user()->id_user)->get();
        return view('bendahara.profil', $data);
    }
    public function update_profil(Request $request)
    {
        $dataProfil = $request->validate([
            'nama' => ['required'],
            'email' => ['required', 'email'],
        ]);

        $user = User::find($request->input('id_user'));
        if($request->input('password') !== null){
            if($request->input('password') === $request->input('confirm_password')){
                $user->password = Hash::make($request->input('password'));
            }else{
                return redirect()->route('profil')->with('msg-danger', 'Password tidak cocok');
            }
        }
            $user->nama = $dataProfil['nama'];
            $user->email = $dataProfil['email'];

        // simpan perubahan
        $user->save();
        return redirect()->route('profil')->with('msg', 'berhasil update profil');
    }
    
}
