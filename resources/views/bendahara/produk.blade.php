@extends('layouts')
@section('title', 'Adz-Zikro | Produk')
@section('header-title', 'Produk')

@section('content')
<!-- Default box -->
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Data Produk</h3>
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
        <button class="btn btn-primary btn-sm mb-2 float-right" data-toggle="modal" data-target="#addModal">Tambah Data</button>
        <table class="table table-sm table-bordered table-striped">
         <tr class="bg-dark text-center">
          <th>No</th>
          <th>Nama Produk</th>
          <th>Deskripsi</th>
          <th>Foto</th>
          <th>Harga</th>
          <th>Akun</th>
          <th>Aksi</th>
        </tr>
        @php 
        $n=1;
        @endphp
        @foreach ($dataProduk as $produk)
        <tr>
          <td>{{ $n++ }}</td>
          <td>{{ $produk->nama_produk }}</td>
          <td>{{ $produk->deskripsi }}</td>
          <td class="text-center"><img width="100" class="img img-responsive mx-auto" src="{{ asset('produk_files/').'/'.$produk->foto }}" alt="foto produk" ></td>
          <td class="text-right">Rp. {{ number_format($produk->harga, 0, ',','.') }},-</td>
          <td class="text-left">{{ $produk->akun->kode_akun }} - {{ $produk->akun->nama_akun }}</td>
          <td class="text-center">
            <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" onclick="fill_edit('{{ $produk->id_produk }}','{{ $produk->nama_produk }}','{{ $produk->deskripsi }}', '{{ $produk->harga }}');">Edit</button>
            <a onclick="return confirm('Hapus data produk?')" href="delete_produk/{{ $produk->id_produk }}" class="btn btn-danger btn-sm">Hapus</a>
          </td>
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
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/add_produk" method="post" enctype="multipart/form-data">
        	@csrf
          <div class="card-body">
            <div class="form-group">
              <label for="namaProduk">Nama Produk</label>
              <input type="text" class="form-control" id="namaProduk" name="nama_produk" placeholder="Nama Produk" required>
            </div>
            <div class="form-group">
              <label for="Deskripsi">Deskripsi</label>
              <textarea class="form-control" name="deskripsi" id="deskripsiProduk" required></textarea>
            </div>
            <div class="form-group">
              <label for="fotoProduk">Foto</label>
              <div class="input-group">
                <input type="file" class="form-control" name="foto" id="fotoProduk">
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="hargaProdukEdit">Harga</label>
                  <div class="input-group">
                    <input type="number" class="form-control" name="harga" id="hargaProduk" required>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="hargaProdukEdit">Akun</label>
                  <div class="input-group">
                    <select name="akun" id="akun" class="form-control">
                      @foreach ($akun as $ak)
                      <option value="{{$ak->kode_akun }}">{{ $ak->kode_akun }} {{ $ak->nama_akun }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
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

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/edit_produk" method="post" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="namaProdukEdit">Nama Produk</label>
              <input type="text" class="form-control" id="namaProdukEdit" name="nama_produk" placeholder="Nama Produk"  required>
              <input type="text" id="idProdukEdit" name="id_produk" hidden>
            </div>
            <div class="form-group">
              <label for="deskripsiProdukEdit">Deskripsi</label>
              <textarea class="form-control" name="deskripsi" id="deskripsiProdukEdit" required></textarea>
            </div>
            <div class="form-group">
              <label for="fotoProdukEdit">Foto</label>
              <div class="input-group">
                <input type="file" class="form-control" name="foto" id="fotoProdukEdit">
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="hargaProdukEdit">Harga</label>
                  <div class="input-group">
                    <input type="number" class="form-control" name="harga" id="hargaProdukEdit" required>
                  </div>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="hargaProdukEdit">Akun</label>
                  <div class="input-group">
                    <select name="akun" id="akun">
                      @foreach ($akun as $ak)
                      <option value="{{$ak->kode_akun }}">{{ $ak->kode_akun }} {{ $ak->nama_akun }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
              </div>
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

<script>
  function fill_edit(id, nama, deskripsi, harga){
    $('#idProdukEdit').val(id);
    $('#namaProdukEdit').val(nama);
    $('#deskripsiProdukEdit').val(deskripsi);
    $('#hargaProdukEdit').val(parseInt(harga));
  }
</script>