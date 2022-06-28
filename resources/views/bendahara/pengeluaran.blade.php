@extends('layouts')
@section('title', 'Adz-Zikro | Pengeluaran')
@section('header-title', 'Pengeluaran')

@section('content')
<!-- Default box -->
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Data Pengeluaran</h3>
		<div class="card-tools">
			<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
				<i class="fas fa-minus"></i>
			</button>
			<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
				<i class="fas fa-times"></i>
			</button>
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
        @if (Auth::user()->level == 'bendahara')
        <button class="btn btn-primary btn-sm mb-2 float-right" data-toggle="modal" data-target="#addModal">Tambah Data</button>
        @endif
        <table class="table table-sm table-bordered table-striped text-sm" id="dataTable">
         <thead>
         <tr class="bg-dark text-center">
          <th>No</th>
          <th>Keterangan</th>
          <th>Nama</th>
          <th>Email</th>
          <th>No. Tlp</th>
          <th>Alamat</th>
          <th>Jumlah</th>
        @if (Auth::user()->level == 'bendahara')
          <th>Aksi</th>
          @endif
        </tr>
         </thead>
        @php 
        $n=1;
        @endphp
        @foreach ($pemasukan as $p)
        <tr>
          <td><a href="{{route('result_transaksi', ['id'=>$p->id_transaksi])}}" class="link">{{ $n++ }}</a></td>
          <td>{{ $p->keterangan }}</td>
          <td>{{ $p->kontak->nama_kontak }}</td>
          <td>{{ $p->kontak->email }}</td>
          <td>{{ $p->kontak->no_tlp }}</td>
          <td>{{ $p->kontak->alamat }}</td>
          <td class="text-right" nowrap>Rp. {{ number_format($p->nominal, 0, '.', ',') }},-</td>
        @if (Auth::user()->level == 'bendahara')
          <td class="text-center">
            <!-- <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" onclick="fill_edit('{{ $p->id_kontak }}','{{ $p->kode_kontak }}','{{ $p->nama_kontak }}', '{{ $p->email }}', '{{ $p->no_tlp }}', '{{ $p->alamat }}');">Edit</button> -->
            <a onclick="return confirm('Hapus data kontak?')" href="{{ route('delete_pengeluaran', ['id'=>$p->id_transaksi]) }}" class="btn btn-danger btn-sm">Hapus</a>
          </td>
          @endif
        </tr>
        @endforeach
      </table>
    </div>
  </div>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->


<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Pengeluaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/add_pengeluaran" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
              <div class="form-group">
                <label for="namaAkun">Kontak</label>
                <select name="id_kontak" class="form-control">
                	@foreach ($kontak as $k)
                  <option value="{{ $k->id_kontak }}">{{ $k->nama_kontak }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="namaAkun">Prson level</label>
                <select name="id_prson" class="form-control">
                	@foreach ($prson_level as $prson)
                  <option value="{{ $prson->id_prson }}">{{ $prson->nama_level }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="namaAkun">Keterangan</label>
                <textarea name="keterangan" class="form-control" required></textarea>
              </div>
              <div class="form-group">
                <label for="namaAkun">Tanggal</label>
                <input type="date" name="tanggal" class="form-control">
              </div>
              <div class="form-group">
                <label for="namaAkun">Dibayar</label>
                <input onkeyup="kalkulasi()" type="number" name="dibayar" id="dibayar" class="form-control" required>
              </div>
              <div class="row">
              	<div class="col-6">
                 <div class="form-group">
                  <label for="namaAkun">Akun Debit</label>
                  <select name="akun_debit" id="akun" class="form-control">
                    @foreach ($akun as $a )
                    <option value="{{$a->kode_akun}}">{{$a->nama_akun}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-6">
               <div class="form-group">
                <label for="namaAkun">Akun Kredit</label>
                 <select name="akun_kredit" id="akun" class="form-control">
                  @foreach ($akun as $a )
                  <option value="{{$a->kode_akun}}">{{$a->nama_akun}}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <p id="kurangWarning"></p>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-success">Simpan</button>
          <button class="btn btn-danger" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Pengeluaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/edit_akun" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="kodeAkunEdit">Kode Akun</label>
              <input type="text" class="form-control" id="kodeAkunEdit" name="kode_akun" placeholder="Kode Akun" required>
              <input type="text" id="idAkunEdit" name="id_akun" hidden>
            </div>
            <div class="form-group">
              <label for="namaAkunEdit">Nama Akun</label>
              <input type="text" class="form-control" id="namaAkunEdit" name="nama_akun" placeholder="Nama Akun" required>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button type="submit" class="btn btn-success">Simpan</button>
            <button class="btn btn-danger" data-dismiss="modal">Batal</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

<script>
  function fill_edit(id, kode, nama){
    $('#idAkunEdit').val(id);
    $('#kodeAkunEdit').val(kode);
    $('#namaAkunEdit').val(nama);
  }

  function fill_nominal()
  {
  	let produk_id = $('#produk').val();
  	let url = "{{ route('get-produk') }}"
  	$.post(url, {'id': produk_id, "_token": "{{ csrf_token() }}"}, function(data){
  		// data = JSON.parse(data)
  		// console.log(data.data[0].harga)
  		$('#harga').val(data.data[0].harga);
  		kalkulasi()
  	});
  }

  function kalkulasi(){
  	// jika yang dibayarkan kurang dari harga
  	let harga = parseInt($('#harga').val());
  	let dibayar = parseInt($('#dibayar').val());
  	console.log({harga:harga, dibayar:dibayar})
  	if(dibayar < harga )
  	{
  		// pilih tambahkan ke piutang
  		$("#kurangWarning").html('jumlah pembayaran kurang dari harga sebesar Rp. '+(harga-dibayar)+" akan ditambahkan ke akun piutang")
  	}else{
  		$("#kurangWarning").html('')
  	}
  }
</script>