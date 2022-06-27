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
        <table class="table table-sm table-bordered table-striped">
          <tr class="bg-dark text-center">
            <th>No</th>
            <th>Nama</th>
            @if ($transaksi[0]->tipe == 'masuk')
            <th>Barang/Jasa</th>
            @endif
            <th>Keterangan</th>
            <th>Harga</th>
            <th>Tanggal</th>
          </tr>
          @php 
            $n=1;
          @endphp
          @foreach ($transaksi as $tr)
          <tr>
            <td>{{ $n++ }}</td>
            <td>{{ $tr->kontak->nama_kontak }} ({{$tr->prson->nama_level}})</td>
            @if ($transaksi[0]->tipe == 'masuk')
            <td>
              @if ($tr->produk)
                {{ $tr->produk->nama_produk }}
              @endif
            </td>
              @endif
            <td>{{ $tr->keterangan }}</td>
            <td>Rp. {{ number_format($tr->nominal,0,'.',',') }},-</td>
            <td>{{ $tr->tanggal }}</td>
          </tr>
          @endforeach
        </table>



        <h2>Jurnal</h2>
        <table class="table table-sm table-bordered table-striped">
          <tr class="bg-dark text-center">
            <th>Tgl</th>
            <th>Ket/Akun</th>
            <th>Debit</th>
            <th>Kredit</th>
          </tr>
          <tr>
            <td>{{ $transaksi[0]->tanggal }}</td>
            <td >{{ $transaksi[0]->produk!==null?$transaksi[0]->produk->nama_produk:'' }} ({{ $transaksi[0]->keterangan }})</td>
            <td></td>
            <td></td>
          </tr>
          @php 
            $n=1;
          @endphp
          @foreach ($jurnal as $jr)
          <tr>
            <td></td>
            <td>{{ $jr->kode_akun.' '.$jr->akun->nama_akun }}</td>
            <td>{{ $jr->debit<1?'':$jr->debit }}</td>
            <td>{{ $jr->kredit<1?'':$jr->kredit }}</td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection

