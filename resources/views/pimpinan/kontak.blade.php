@extends('layouts')
@section('title', 'Adz-Zikro | Kontak')
@section('header-title', 'Kontak')

@section('content')
<!-- Default box -->
<div class="card">
	<div class="card-header">
		<h3 class="card-title">Data Kontak</h3>
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
				<table class="table table-sm table-bordered table-striped" id="dataTable">
          <thead>
					<tr class="bg-dark text-center">
						<th>No</th>
						<th>Kode Kontak</th>
						<th>Nama</th>
						<th>Email</th>
            <th>No. Tlp</th>
						<th>Alamat</th>
						<th>Aksi</th>
					</tr>
          </thead>
          @php 
            $n=1;
          @endphp
          @foreach ($dataKontak as $kontak)
          <tr>
            <td>{{ $n++ }}</td>
            <td>{{ $kontak->kode_kontak }}</td>
            <td>{{ $kontak->nama_kontak }}</td>
            <td>{{ $kontak->email }}</td>
            <td>{{ $kontak->no_tlp }}</td>
            <td>{{ $kontak->alamat }}</td>
            <td class="text-center">
              <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" onclick="fill_edit('{{ $kontak->id_kontak }}','{{ $kontak->kode_kontak }}','{{ $kontak->nama_kontak }}', '{{ $kontak->email }}', '{{ $kontak->no_tlp }}', '{{ $kontak->alamat }}');">Edit</button>
              <a onclick="return confirm('Hapus data kontak?')" href="delete_kontak/{{ $kontak->id_kontak }}" class="btn btn-danger btn-sm">Hapus</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kontak</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/add_kontak" method="post" enctype="multipart/form-data">
        	@csrf
            <div class="card-body">
              <div class="form-group">
                <label for="kodeKontak">Kode Kontak</label>
                <input type="text" class="form-control" id="kodeKontak" name="kode_kontak" placeholder="Kode Kontak" required>
              </div>
              <div class="form-group">
                <label for="namaKontak">Nama Kontak</label>
                <input type="text" class="form-control" id="namaKontak" name="nama_kontak" placeholder="Nama Kontak" required>
              </div>
              <div class="form-group">
                <label for="emailKontak">Email</label>
                <input type="text" class="form-control" id="emailKontak" name="email" placeholder="contoh@contoh.com" required>
              </div>
              <div class="form-group">
                <label for="noTlpKontak">No. Tlp</label>
                <input type="text" class="form-control" id="noTlpKontak" name="no_tlp" placeholder="08xxxxxxxxxx" required>
              </div>
              <div class="form-group">
                <label for="alamatKontak">Alamat</label>
                <input type="text" class="form-control" id="alamatKontak" name="alamat" placeholder="Alamat" required>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Kontak</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/edit_kontak" method="post" enctype="multipart/form-data">
          @csrf
            <div class="form-group">
                <label for="kodeKontakEdit">Kode Kontak</label>
                <input type="text" class="form-control" id="kodeKontakEdit" name="kode_kontak" placeholder="Kode Kontak" required>
                <input type="text" name="id_kontak" id="idKontakEdit" hidden>
              </div>
              <div class="form-group">
                <label for="namaKontakEdit">Nama Kontak</label>
                <input type="text" class="form-control" id="namaKontakEdit" name="nama_kontak" placeholder="Nama Kontak" required>
              </div>
              <div class="form-group">
                <label for="emailKontakEdit">Email</label>
                <input type="text" class="form-control" id="emailKontakEdit" name="email" placeholder="contoh@contoh.com" required>
              </div>
              <div class="form-group">
                <label for="noTlpKontakEdit">No. Tlp</label>
                <input type="text" class="form-control" id="noTlpKontakEdit" name="no_tlp" placeholder="08xxxxxxxxxx" required>
              </div>
              <div class="form-group">
                <label for="alamatKontakEdit">Alamat</label>
                <input type="text" class="form-control" id="alamatKontakEdit" name="alamat" placeholder="Alamat" required>
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
  function fill_edit(id, kode, nama, email, tlp, alamat){
    $('#idKontakEdit').val(id);
    $('#kodeKontakEdit').val(kode);
    $('#namaKontakEdit').val(nama);
    $('#emailKontakEdit').val(email);
    $('#noTlpKontakEdit').val(tlp);
    $('#alamatKontakEdit').val(alamat);
    console.log(id, kode, nama, email, tlp, alamat)
  }
</script>