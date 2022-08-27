<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Models\Pengeluaran;
use \App\Models\Pemasukan;
use \App\Models\Kontak;
use \App\Models\Produk;
use \App\Models\Prson;
use \App\Models\Akun;
use \App\Models\Jurnal;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function index(Request $request)
    {
        $data['pemasukan'] = Pengeluaran::where('tipe', 'keluar')->get();
        $data['kontak'] = Kontak::get();
        $data['prson_level'] = Prson::get();
        $data['produk'] = Produk::get();
        $data['akun'] = Akun::get();
        $data['saldo'] = Pemasukan::where('tipe', 'masuk')->sum('nominal') - Pengeluaran::where('tipe', 'keluar')->get()->sum('nominal');

        return view('bendahara.pengeluaran', $data);
    } 

    public function add_pengeluaran(Request $request)
    {
        $dataInput = $request->validate([
            'keterangan' => ['required'],
            'tanggal' => ['required'],
            'dibayar' => ['required']
        ]);
        $transaksi = new Pengeluaran;
        $transaksi->id_produk = null;
        $transaksi->id_kontak = $request->input('id_kontak');
        $transaksi->id_prson = $request->input('id_prson');
        $transaksi->id_user = Auth::user()->id_user;
        $transaksi->keterangan = $dataInput['keterangan'];
        $transaksi->tanggal = $dataInput['tanggal'];
        $transaksi->nominal = $dataInput['dibayar'];
        $transaksi->tipe = 'keluar';
        $transaksi->save();
        $id_transaksi = $transaksi->id_transaksi;

        // insert ke tabel jurnal
        // insert debit
            $dataDebit = [
                'id_transaksi'=>$id_transaksi, 
                'kode_akun'=>$request->input('akun_debit'),
                'debit'=>$request->input('dibayar'),
                'kredit'=>0,
            ];
        // insert kredit
            $dataKredit = [
                'id_transaksi'=>$id_transaksi, 
                'kode_akun'=>$request->input('akun_kredit'),
                'debit'=>0,
                'kredit'=>$request->input('dibayar'),
            ];
            Jurnal::insert([$dataDebit, $dataKredit]);
        return redirect('result_transaksi/'.$id_transaksi)->with('url-back', route('pengeluaran'));
    } 

    public function delete_transaksi(Request $request, $id)
    {
        $jurnal = Jurnal::where('id_transaksi', $id)->delete();
        $pemasukan = Pengeluaran::where('id_transaksi',$id)->delete();
        return redirect('pengeluaran')->with('msg-danger', 'Transaksi Dihapus');

    }
}
