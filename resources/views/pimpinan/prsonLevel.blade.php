@extends('layouts')
@section('title', 'Adz-Zikro | Prson Level')
@section('header-title', 'Prson Level')

@section('content')
<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Prson Level</h3>
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
            <th>Nama Prson Level</th>
            <th>Aksi</th>
          </tr>
          </thead>
          @php 
            $n=1;
          @endphp
          @foreach ($dataPrson as $prson)
          <tr>
            <td>{{ $n++ }}</td>
            <td>{{ $prson->nama_level }}</td>
            <td class="text-center">
              <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" onclick="fill_edit('{{ $prson->id_prson }}','{{ $prson->nama_level }}');">Edit</button>
              <a onclick="return confirm('Hapus data prson?')" href="delete_prson_level/{{ $prson->id_prson }}" class="btn btn-danger btn-sm">Hapus</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Level</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/add_prson_level" method="post" enctype="multipart/form-data">
          @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="namaLevel">Nama Level</label>
                <input type="text" class="form-control" id="namaLevel" name="nama_level" placeholder="Nama Level" required>
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
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Prson Level</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/edit_prson_level" method="post" enctype="multipart/form-data">
          @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="namaLevelEdit">Nama Level</label>
                <input type="text" class="form-control" id="namaLevelEdit" name="nama_level" placeholder="Nama Level" required>
                <input type="text" id="idLevelEdit" name="id_prson" hidden>
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
  function fill_edit(id, nama){
    $('#idLevelEdit').val(id);
    $('#namaLevelEdit').val(nama);
  }
</script>