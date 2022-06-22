@extends('layouts')
@section('title', 'Adz-Zikro | Administrator')
@section('header-title', 'Administrator')

@section('content')
<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Data Administrator</h3>
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
            <th>Nama</th>
            <th>Email</th>
            <th>Level</th>
            <th>Aksi</th>
          </tr>
          @php 
            $n=1;
          @endphp
          @foreach ($dataAdmin as $admin)
          <tr>
            <td>{{ $n++ }}</td>
            <td>{{ $admin->nama }}</td>
            <td>{{ $admin->email }}</td>
            <td>{{ Str::ucfirst($admin->level) }}</td>
            <td class="text-center">
              <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" onclick="fill_edit('{{ $admin->id_user }}','{{ $admin->nama }}','{{ $admin->email }}','{{ $admin->level }}');">Edit</button>
              <a onclick="return confirm('Hapus data admin?')" href="delete_administrator/{{ $admin->id_user }}" class="btn btn-danger btn-sm">Hapus</a>
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
        <form action="/add_administrator" method="post" enctype="multipart/form-data">
          @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="namaAdmin">Nama</label>
                <input type="text" class="form-control" id="namaAdmin" name="nama" placeholder="Nama" required>
              </div>
              <div class="form-group">
                <label for="levelAdmin">Email</label>
                <input type="email" class="form-control" id="levelAdmin" name="email" placeholder="Email" required>
              </div>
              <div class="form-group">
                <label for="namaLevel">Level</label>
                <select name="level" id="level" class="form-control">
                  <option value="bendahara">Bendahara</option>
                  <option value="pimpinan">Pimpinan</option>
                </select>
              </div>
              <div class="form-group">
                <label >Password</label>
                <input type="password" class="form-control" name="password" placeholder="********" required>
              </div>
              <div class="form-group">
                <label >Konformasi Password</label>
                <input type="password" class="form-control" name="confirm_password" placeholder="********" required>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kontak</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/edit_administrator" method="post" enctype="multipart/form-data">
          @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="namaAdminEdit">Nama</label>
                <input type="text" class="form-control" id="namaAdminEdit" name="nama" placeholder="Nama" required>
                <input type="text" id="idAdminEdit" name="id_user" hidden>
              </div>
              <div class="form-group">
                <label for="levelAdminEdit">Email</label>
                <input type="email" class="form-control" id="emailAdminEdit" name="email" placeholder="Email" required>
              </div>
              <div class="form-group">
                <label for="namaLevel">Level</label>
                <input type="text"  id="levelEdit" class="form-control" readonly>
              </div>
              <div class="form-group">
                <label >Password</label>
                <input type="password" class="form-control" name="password" placeholder="********" >
              </div>
              <div class="form-group">
                <label >Konformasi Password</label>
                <input type="password" class="form-control" name="confirm_password" placeholder="********" >
              </div>
              <span>* Password dikosongkan jika tidak ingin merubah</span>
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
  function fill_edit(id, nama, email, level){
    $('#idAdminEdit').val(id);
    $('#namaAdminEdit').val(nama);
    $('#emailAdminEdit').val(email);
    $('#levelEdit').val(level);
  }
</script>