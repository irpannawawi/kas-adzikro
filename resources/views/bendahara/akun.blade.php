@extends('layouts')
@section('title', 'Adz-Zikro | Akun')
@section('header-title', 'Akun')

@section('content')
<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Akun</h3>
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
            <th>Kode Akun</th>
            <th>Nama Akun</th>
            <th>Aksi</th>
          </tr>
          </thead>
          @php 
            $n=1;
          @endphp
          @foreach ($dataAkun as $akun)
          <tr>
            <td>{{ $n++ }}</td>
            <td>{{ $akun->kode_akun }}</td>
            <td>{{ $akun->nama_akun }}</td>
            <td class="text-center">
              <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" onclick="fill_edit('{{ $akun->id_akun }}','{{ $akun->kode_akun }}','{{ $akun->nama_akun }}');">Edit</button>
              <a onclick="return confirm('Hapus data akun?')" href="delete_akun/{{ $akun->id_akun }}" class="btn btn-danger btn-sm">Hapus</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Akun</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/add_akun" method="post" enctype="multipart/form-data">
          @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="kodeAkun">Kode Akun</label>
                <input type="text" class="form-control" id="kodeAkun" name="kode_akun" placeholder="Kode Akun" required>
              </div>
              <div class="form-group">
                <label for="namaAkun">Nama Akun</label>
                <input type="text" class="form-control" id="namaAkun" name="nama_akun" placeholder="Nama Akun" required>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Akun</h5>
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

<script>
  function fill_edit(id, kode, nama){
    $('#idAkunEdit').val(id);
    $('#kodeAkunEdit').val(kode);
    $('#namaAkunEdit').val(nama);
  }
</script>