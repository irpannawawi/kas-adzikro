@extends('layouts')
@section('title', 'Adz-Zikro | Jurnal')
@section('header-title', 'Jurnal')

@section('content')
<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Jurnal</h3>
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



    <form action="{{route('jurnal')}}" class="float-right mb-2">
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
        <table class="table table-sm table-bordered " id="dataTable">
          <tr class="bg-dark text-center">
            <th>Tgl</th>
            <th>Ket/Akun</th>
            <th>Debit</th>
            <th>Kredit</th>
          </tr>
          @foreach ($transaksi as $tr)
          <tr>
            <td>{{ $tr->tanggal }}</td>
            <th colspan="3">({{ $tr->keterangan }})</th>
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

