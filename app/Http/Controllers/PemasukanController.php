<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Models\Pemasukan;
use \App\Models\Kontak;
use \App\Models\Produk;
use \App\Models\Prson;
use \App\Models\Akun;
use \App\Models\Jurnal;
use Illuminate\Support\Facades\Auth;

class PemasukanController extends Controller
{
    public function index(Request $request)
    {
        $data['pemasukan'] = Pemasukan::where('tipe', 'masuk')->get();
        $data['kontak'] = Kontak::get();
        $data['prson_level'] = Prson::get();
        $data['produk'] = Produk::get();
        $data['akun'] = Akun::get();
        return view('bendahara.pemasukan', $data);
    } 

    public function get_produk(Request $request)
    {
        $id = $request->input('id');
        $produk = Produk::where('id_produk', $id)->get();
        return response()->json(['status'=>'ok', 'id'=>$id, 'data'=>$produk]);
    }

    public function add_pemasukan(Request $request)
    {
       // insert ke tabel transaksi
        $dataInput = $request->validate([
            'id_produk' => ['required'],
            'id_kontak' => ['required'],
            'id_prson' => ['required'],
            'keterangan' => ['required'],
            'tanggal' => ['required']
        ]);
        $transaksi = new Pemasukan;
        $transaksi->id_produk = $dataInput['id_produk'];
        $transaksi->id_kontak = $dataInput['id_kontak'];
        $transaksi->id_user = Auth::user()->id_user;
        $transaksi->id_prson = $dataInput['id_prson'];
        $transaksi->keterangan = $dataInput['keterangan'];
        $transaksi->tanggal = $dataInput['tanggal'];
        $transaksi->nominal = $request->input('harga');
        $transaksi->tipe = 'masuk';
        $transaksi->save();
        $id_transaksi = $transaksi->id_transaksi;

        // insert ke tabel jurnal
        // id_transaksi    id_akun nominal
        if($request->input('dibayar') < $request->input('harga') )
        {
            // insert debit
                $dataDebit = [
                    'id_transaksi'=>$id_transaksi, 
                    'kode_akun'=>$request->input('akun'),
                    'debit'=>$request->input('harga'),
                    'kredit'=>0,
                ];
            // insert kredit
                $produk = Produk::find($transaksi->id_produk)->get();

                $dataKredit = [
                    'id_transaksi'=>$id_transaksi, 
                    'kode_akun'=>$produk[0]->kredit_akun_id,
                    'kredit'=>$request->input('dibayar'),
                    'debit'=>0,
                ];
                $dataDebitPiutang = [
                    'id_transaksi'=>$id_transaksi, 
                    'kode_akun'=>'200-10',
                    'debit'=>$request->input('harga')-$request->input('dibayar'),
                    'kredit'=>0,
                ];
            // insert debit piutang
                Jurnal::insert([0=>$dataDebit, 1=>$dataKredit, 2=>$dataDebitPiutang]);
        }else{

            // insert debit
                $dataDebit = [
                    'id_transaksi'=>$id_transaksi, 
                    'kode_akun'=>$request->input('akun'),
                    'debit'=>$request->input('harga'),
                    'kredit'=>0,
                ];
            // insert kredit
                $produk = Produk::where('id_produk', $transaksi->id_produk)->get();
                $dataKredit = [
                    'id_transaksi'=>$id_transaksi, 
                    'kode_akun'=>$produk[0]->kredit_akun_id,
                    'debit'=>0,
                    'kredit'=>$request->input('dibayar'),
                ];
                Jurnal::insert([$dataDebit, $dataKredit]);
        }
        return redirect('result_transaksi/'.$id_transaksi)->with('url-back', route('pemasukan'));
    }

    public function result_transaksi(Request $request, $id)
    {
        $data = [
            'transaksi' => Pemasukan::where('id_transaksi', $id)->get(),
            'jurnal' => Jurnal::where('id_transaksi', $id)->get(),
        ];
        return view('bendahara.transaksi', $data);
    }
}
