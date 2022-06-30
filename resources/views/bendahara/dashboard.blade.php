@extends('layouts')
@section('title', 'Adz-Zikro | Dashboard')
@section('header-title', 'Dashboard')

@section('content')
	<!-- Default box -->
<div class="card">
  <div class="card-header">
    <h3 class="card-title">Dashboard</h3>
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
          	@if (Auth::user()->level == 'bendahara')
  		<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$jumlah_akun}}</h3>

                <p>Akun</p>
              </div>
              <div class="icon">
                <i class="fa fa-wallet"></i>
              </div>
              <a href="{{route('akun')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
  		<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$jumlah_produk}}</h3>

                <p>Produk</p>
              </div>
              <div class="icon">
                <i class="fa fa-box"></i>
              </div>
              <a href="{{route('produk')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
  		<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{$jumlah_kontak}}</h3>

                <p>Kontak</p>
              </div>
              <div class="icon">
                <i class="fa fa-address-book"></i>
              </div>
              <a href="{{route('kontak')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
  		<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
                <h3>{{$jumlah_prson_level}}</h3>

                <p>Prson Level</p>
              </div>
              <div class="icon">
                <i class="fa fa-sitemap"></i>
              </div>
              <a href="prson_level" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endif
  		<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
              <div class="inner">
                <h3>{{$jumlah_administrator}}</h3>

                <p>Administrator</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="{{route('administrator')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
  		<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><small>Rp. {{number_format($jumlah_pemasukan*10, 0, '.', ',')}},-</small></h3>

                <p>Pemasukan</p>
              </div>
              <div class="icon">
                <i class="fa fa-arrow-down"></i>
              </div>
              <a href="{{route('pemasukan')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
  		<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><small>Rp. {{number_format($jumlah_pengeluaran, 0, '.', ',')}},-</small></h3>

                <p>Pengeluaran</p>
              </div>
              <div class="icon">
                <i class="fa fa-arrow-up"></i>
              </div>
              <a href="{{route('pengeluaran')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
  		<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-orange">
              <div class="inner">
                <h3>n/a</h3>

                <p>Laporan Transaksi</p>
              </div>
              <div class="icon">
                <i class="fa fa-exchange"></i>
              </div>
              <a href="{{route('laporan-transaksi')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
  		<div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-purple">
              <div class="inner">
                <h3>n/a</h3>

                <p>Jurnal</p>
              </div>
              <div class="icon">
                <i class="fa fa-scale-balanced"></i>
              </div>
              <a href="{{route('jurnal')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
  	</div>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection