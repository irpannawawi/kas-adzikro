@extends('layouts')
@section('title', 'Adz-Zikro | Profil')
@section('header-title', 'Profil')

@section('content')
<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Profil</h3>
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
      </div>
      <div class="col-12">
                <form action="{{route('update_profil')}}" method="post" enctype="multipart/form-data">
          @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="namaAdminEdit">Nama</label>
                <input type="text" class="form-control" id="namaAdminEdit" name="nama" value="{{$profil[0]->nama}}" required>
                <input type="text" id="idAdminEdit" name="id_user" value="{{$profil[0]->id_user}}" hidden>
              </div>
              <div class="form-group">
                <label for="levelAdminEdit">Email</label>
                <input type="email" class="form-control" id="emailAdminEdit" name="email" value="{{$profil[0]->email}}" required>
              </div>
              <div class="form-group">
                <label for="namaLevel">Level</label>
                <input type="text"  id="levelEdit" class="form-control" readonly value="{{$profil[0]->level}}">
              </div>
              <div class="form-group">
                <label >Password</label>
                <input type="password" class="form-control" name="password" >
              </div>
              <div class="form-group">
                <label >Konformasi Password</label>
                <input type="password" class="form-control" name="confirm_password">
              </div>
              <span>* Password dikosongkan jika tidak ingin merubah</span>


              <div class="form-group my-2">
                <input type="submit" class="form-control btn btn-success" value="Simpan">
              </div>
            </div>
            <!-- /.card-body -->
        </form>
      </div>
    </div>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Administrator</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


            <div class="card-footer">
              <button type="submit" class="btn btn-success">Simpan</button>
              <button class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
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