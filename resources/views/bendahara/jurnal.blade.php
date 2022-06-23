@extends('layouts')
@section('title', 'Adz-Zikro | Transaksi')
@section('header-title', 'Transaksi')

@section('content')
<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Transaksi</h3>
    <div class="card-tools">
    <a href="{{ session('url-back')?session('url-back'):url()->previous() }}" class="btn btn-default btn-sm float-right">Kembali</a>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif
        @if (session('msg-danger'))
            <div class="alert alert-danger">
                {{ session('msg-danger') }}
            </div>
        @endif



        <h2>Jurnal</h2>
        <table class="table table-sm table-bordered ">
          <tr class="bg-dark text-center">
            <th>Tgl</th>
            <th>Ket/Akun</th>
            <th>Debit</th>
            <th>Kredit</th>
          </tr>
          @foreach ($transaksi as $tr)
          <tr>
            <td>{{ $transaksi[0]->tanggal }}</td>
            <th colspan="3">{{ $transaksi[0]->produk!==null?$transaksi[0]->produk->nama_produk:'' }} ({{ $transaksi[0]->keterangan }})</th>
          </tr>
            @foreach ($tr->jurnal as $jr)
            <tr>
              <td></td>
              <td style="padding-left: 30px;">{{ $jr->kode_akun.' '.$jr->akun->nama_akun }}</td>
              <td class="text-right">{{ $jr->debit<1?'':'Rp. '.number_format($jr->debit,0,'.',',').',-' }}</td>
              <td class="text-right">{{ $jr->kredit<1?'':'Rp. '.number_format($jr->kredit,0,'.',',').',-' }}</td>
            </tr>
            @endforeach
          @endforeach
          
          
        </table>
      </div>
    </div>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection

