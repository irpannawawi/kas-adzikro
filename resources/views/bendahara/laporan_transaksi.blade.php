@extends('layouts')
@section('title', 'Adz-Zikro | Laporan Transaksi')
@section('header-title', 'Laporan Transaksi')

@section('content')
<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Laporan Transaksi</h3>
    <div class="card-tools">
      <button class="btn btn-primary btn-sm mx-3" data-toggle="modal" data-target="#modal-print"><i class="fa fa-print"></i> Cetak</button>
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



        <h2>Laporan Transaksi</h2>

      <form action="{{route('laporan-transaksi')}}" class="float-right mb-2">
        @csrf
        <div class="input-group mb-3">
          <select name="bln" id="" class="form-control">
            <option value="01" {{date('m')=='01'?'selected':''}}>Jan</option>
            <option value="02" {{date('m')=='02'?'selected':''}}>Feb</option>
            <option value="03" {{date('m')=='03'?'selected':''}}>Mar</option>
            <option value="04" {{date('m')=='04'?'selected':''}}>Apr</option>
            <option value="05" {{date('m')=='05'?'selected':''}}>Mei</option>
            <option value="06" {{date('m')=='06'?'selected':''}}>Jun</option>
            <option value="07" {{date('m')=='07'?'selected':''}}>Jul</option>
            <option value="08" {{date('m')=='08'?'selected':''}}>Agu</option>
            <option value="09" {{date('m')=='09'?'selected':''}}>Sep</option>
            <option value="10" {{date('m')=='10'?'selected':''}}>Okt</option>
            <option value="11" {{date('m')=='11'?'selected':''}}>Nov</option>
            <option value="12" {{date('m')=='12'?'selected':''}}>Des</option>
          </select>
          <input type="text" class="form-control" value="{{date('Y')}}" name="thn" >
          <div class="input-group-append">
                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i></button>
          </div>
        </div>
      </form>
        <table class="table table-sm table-bordered table-striped">
          <tr class="bg-dark text-center">
            <th>No</th>
            <th>Nama</th>
            <th>Barang/Jasa</th>
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
            <td>
              @if ($tr->produk)
                {{ $tr->produk->nama_produk }}
              @endif
            </td>
            <td>{{ $tr->keterangan }}</td>
            <td class="{{$tr->tipe=='masuk'?'text-success':'text-danger text-right'}}">Rp. {{ number_format($tr->nominal,0,'.',',') }},-</td>
            <td class="text-center">{{ $tr->tanggal }}</td>
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
<!-- Modal -->
<div class="modal fade" id="modal-print" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-borderless">
          <tr>
              <th nowrap>Harian</th>
          </tr>
            <tr>
                <td class="form-inline">
                    <form action="{{route('print-laporan-transaksi')}}">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="tipe" value="harian" hidden>
                            <select name="tgl" class="form-control">
                                @for ($n=1; $n<32; $n++)
                                <option value="{{$n}}" @if ($n == date('d')) selected @endif>{{$n}}</option>
                                @endfor
                            </select>
                            <select name="bln" class="form-control">
                                @foreach (['01'=>'Jan', '02'=>'Feb', '03'=>'Mar', '04'=>'Apr', '05'=>'Mei', '06'=>'Jun', '07'=>'Jul', '08'=>'Agu', '09'=>'Sep', '10'=>'Okt', '11'=>'Nov', '12'=>'Des'] as $key  => $value)
                                <option 
                                @if ($key == date('m')) 
                                selected 
                                @endif
                                value="{{$key}}" 
                                >{{$value}}</option>
                                @endforeach
                            </select>
                            <input type="number" class="form-control" name="thn" value="{{date('Y')}}">
                          <div class="input-group-append">
                            <button class="input-group-text btn btn-info" type="submit">Print</button>
                          </div>
                        </div>  
                    </form>
                </td>
            </tr>
            <tr>
                <th nowrap>Bulanan</th>
            </tr>
            <tr>
                <td class="form-inline">
                    <form action="{{route('print-laporan-transaksi')}}">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="tipe" value="bulanan" hidden>                            <select name="bln" class="form-control">
                                @foreach (['01'=>'Jan', '02'=>'Feb', '03'=>'Mar', '04'=>'Apr', '05'=>'Mei', '06'=>'Jun', '07'=>'Jul', '08'=>'Agu', '09'=>'Sep', '10'=>'Okt', '11'=>'Nov', '12'=>'Des'] as $key  => $value)
                                <option 
                                @if ($key == date('m')) 
                                selected 
                                @endif
                                value="{{$key}}" 
                                >{{$value}}</option>
                                @endforeach
                            </select>
                            <input type="number" class="form-control" name="thn" value="{{date('Y')}}">
                          <div class="input-group-append">
                            <button class="input-group-text btn btn-info" type="submit">Print</button>
                          </div>
                        </div>  
                    </form>
                </td>
            </tr>
        </table>
      </div>
    </div>
  </div>
</div>
