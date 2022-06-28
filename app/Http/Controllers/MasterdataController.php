<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kontak;
use App\Models\Prson;
use App\Models\Akun;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MasterdataController extends Controller
{


// controller for produk 
    public function view_produk(Request $request)
    {
        $dataProduk = Produk::get();
        $dataAkun = Akun::get();
        $data = [
            'dataProduk' => $dataProduk,
            'akun' => $dataAkun,
        ];
        return view('bendahara.produk', $data);
    }

    public function store_produk(Request $request)
    {
        $dataProduk = $request->validate([
            'nama_produk' => ['required'],
            'deskripsi' => ['required'],
            'harga' => ['required'],
        ]); 
        $dataProduk['kredit_akun_id'] = $request->input('akun');
        // upload foto 
        if($request->hasFile('foto')){
            $fileName = date('dmYHis').'.jpg';
            $path = $request->foto->storeAs('produk_images', $fileName);
            $dataProduk['foto'] = $fileName;
        }


        Produk::insert($dataProduk);
        return redirect('/produk')->with('msg', 'Berhasil Tambah Produk');
    }

    public function update_produk(Request $request)
    {
        $dataProduk = $request->validate([
            'nama_produk' => ['required'],
            'deskripsi' => ['required'],
            'harga' => ['required'],
            'akun' => ['required']
        ]); 
        $produk = Produk::find($request->input('id_produk'));
        $produk->nama_produk = $dataProduk['nama_produk'];
        $produk->deskripsi = $dataProduk['deskripsi'];
        $produk->harga = $dataProduk['harga'];
        $produk->kredit_akun_id = $dataProduk['akun'];
    
        // upload foto 

        if($request->hasFile('foto')){

            // hapus foto lama
            if($produk->foto != 'produk_default.jpg')
            {
                Storage::delete('produk_files/'.$produk->foto);
            }

            // buat nama file baru
            $fileName = date('dmYHis').'.jpg';

            //upload file
            $path = $request->foto->storeAs('produk_images', $fileName);
            
            // simpan nama file baru ke database
            $produk->foto = $fileName;
        }

        // simpan perubahan
        $produk->save();
        return redirect('/produk')->with('msg', 'Berhasil Edit Produk');

    }


    public function delete_produk(Request $request, $id_produk)
    {
        $produk = Db::table('produk')->where('id_produk', $id_produk)->delete();
        return redirect('/produk')->with('msg-danger', 'Berhasil Hapus Produk');

    }


// =========== controller for kontak ==========================================

    public function view_kontak(Request $request)
    {
        $dataKontak = Kontak::get();
        $data = [
            'dataKontak' => $dataKontak,
        ];
        return view('bendahara.kontak', $data);
    }

    public function store_kontak(Request $request)
    {
        $dataKontak = $request->validate([
            'kode_kontak' => ['required'],
            'nama_kontak' => ['required'],

        ]);
        $dataKontak['email'] = $request->input('email');
        $dataKontak['no_tlp'] = $request->input('no_tlp');
        $dataKontak['alamat'] = $request->input('alamat');

       
        Kontak::insert($dataKontak);
        return redirect('/kontak')->with('msg', 'Berhasil Tambah Kontak');
    }

    public function update_kontak(Request $request)
    {
        $dataKontak = $request->validate([
            'kode_kontak' => ['required'],
            'nama_kontak' => ['required'],

        ]);
        $dataKontak['email'] = $request->input('email');
        $dataKontak['no_tlp'] = $request->input('no_tlp');
        $dataKontak['alamat'] = $request->input('alamat');


        $kontak = Kontak::find($request->input('id_kontak'));

        $kontak->kode_kontak = $dataKontak['kode_kontak'];
        $kontak->nama_kontak = $dataKontak['nama_kontak'];
        $kontak->email = $dataKontak['email'];
        $kontak->no_tlp = $dataKontak['no_tlp'];
        $kontak->alamat = $dataKontak['alamat'];

        // simpan perubahan
        $kontak->save();
        return redirect('/kontak')->with('msg', 'Berhasil Edit Kontak');

    }


    public function delete_kontak(Request $request, $id_kontak)
    {
        $kontak = Db::table('kontak')->where('id_kontak', $id_kontak)->delete();
        return redirect('/kontak')->with('msg-danger', 'Berhasil Hapus Kontak');

    }


// =========== controller for Prson Level ==========================================

    public function view_prson(Request $request)
    {
        $dataPrson = Prson::get();
        $data = [
            'dataPrson' => $dataPrson,
        ];
        return view('bendahara.prsonLevel', $data);
    }

    public function store_prson(Request $request)
    {
        $dataPrson = $request->validate([
            'nama_level' => ['required'],

        ]);

       
        Prson::insert($dataPrson);
        return redirect('/prson_level')->with('msg', 'Berhasil Tambah Level');
    }

    public function update_prson(Request $request)
    {
        $dataPrson = $request->validate([
            'nama_level' => ['required'],
        ]);


        $prson = Prson::find($request->input('id_prson'));

        $prson->nama_level = $dataPrson['nama_level'];

        // simpan perubahan
        $prson->save();
        return redirect('/prson_level')->with('msg', 'Berhasil Edit Level');

    }


    public function delete_prson(Request $request, $id_prson)
    {
        $prson = Db::table('prson_level')->where('id_prson', $id_prson)->delete();
        return redirect('/prson_level')->with('msg-danger', 'Berhasil Hapus Level');

    }


// =========== controller for Akun ==========================================

    public function view_akun(Request $request)
    {
        $dataAkun = Akun::orderBy('kode_akun', 'asc')->get();
        $data = [
            'dataAkun' => $dataAkun,
        ];
        return view('bendahara.akun', $data);
    }

    public function store_akun(Request $request)
    {
        $dataAkun = $request->validate([
            'kode_akun' => ['required'],
            'nama_akun' => ['required'],

        ]);

       
        Akun::insert($dataAkun);
        return redirect('/akun')->with('msg', 'Berhasil Tambah Akun');
    }

    public function update_akun(Request $request)
    {
        $dataAkun = $request->validate([
            'kode_akun' => ['required'],
            'nama_akun' => ['required'],
        ]);


        $akun = Akun::find($request->input('id_akun'));

        $akun->kode_akun = $dataAkun['kode_akun'];
        $akun->nama_akun = $dataAkun['nama_akun'];

        // simpan perubahan
        $akun->save();
        return redirect('/akun')->with('msg', 'Berhasil Edit Akun');

    }


    public function delete_akun(Request $request, $id_akun)
    {
        $prson = Db::table('akun')->where('id_akun', $id_akun)->delete();
        return redirect('/akun')->with('msg-danger', 'Berhasil Hapus Akun');
    }

// =========== controller for Administrator ==========================================

    public function view_administrator(Request $request)
    {
        $dataAdmin = User::get();
        $data = [
            'dataAdmin' => $dataAdmin,
        ];
        return view('bendahara.admin', $data);
    }

    public function store_administrator(Request $request)
    {
        $dataAdmin = $request->validate([
            'nama' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'level' => ['required'],
        ]);

       
        User::insert($dataAdmin);
        return redirect('/administrator')->with('msg', 'Berhasil Tambah Admin');
    }

    public function update_administrator(Request $request)
    {
        $dataAdmin = $request->validate([
            'nama' => ['required'],
            'email' => ['required', 'email'],
        ]);

        $admin = User::find($request->input('id_user'));
        if($request->input('password') !== null){
            if($request->input('password') === $request->input('confirm_password')){
                $admin->password = $request->input('password');
            }else{
                return redirect('administrator')->with('msg-danger', 'Password tidak cocok');
            }
        }
            $admin->nama = $dataAdmin['nama'];
            $admin->email = $dataAdmin['email'];

        // simpan perubahan
        $admin->save();
        return redirect('/administrator')->with('msg', 'Berhasil Edit Admin');

    }


    public function delete_administrator(Request $request, $id_akun)
    {
        $prson = Db::table('users')->where('id_user', $id_akun)->delete();
        return redirect('/administrator')->with('msg-danger', 'Berhasil Hapus Admin');
    }
}
