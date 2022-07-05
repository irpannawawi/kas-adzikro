<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title','Adz-Zikro')</title>

	<link rel="apple-touch-icon" sizes="57x57" href="{{asset('/')}}AdminLTE/dist/img/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="{{asset('/')}}AdminLTE/dist/img/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="{{asset('/')}}AdminLTE/dist/img/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="{{asset('/')}}AdminLTE/dist/img/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="{{asset('/')}}AdminLTE/dist/img/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="{{asset('/')}}AdminLTE/dist/img/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="{{asset('/')}}AdminLTE/dist/img/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="{{asset('/')}}AdminLTE/dist/img/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="{{asset('/')}}AdminLTE/dist/img/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="{{asset('/')}}AdminLTE/dist/img/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="{{asset('/')}}AdminLTE/dist/img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="{{asset('/')}}AdminLTE/dist/img/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('/')}}AdminLTE/dist/img/favicon-16x16.png">
	<link rel="manifest" href="{{asset('/')}}AdminLTE/dist/img/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<script src="https://kit.fontawesome.com/c834f34fc1.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="{{ asset('/')}}AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('/')}}AdminLTE/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="{{ asset('/')}}AdminLTE/plugins/jquery-ui/jquery-ui.css">
</head>
<body class="hold-transition sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">

			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<!-- Navbar Search -->
				<li class="nav-item">
					<a class="btn btn-danger btn-sm"  href="logout">
						Keluar
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->

		<!-- Main Sidebar Container -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="/" class="brand-link">
				<img src="{{ asset('/')}}AdminLTE/dist/img/logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light">Adz-Zikro</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="{{ asset('/')}}AdminLTE/dist/img/user.png" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a href="#" class="d-block">{{ Str::ucfirst(Auth::user()->nama) }}</a>
					</div>
				</div>


				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
          	with font-awesome or any other icon font library -->
          	<li class="nav-item">
          		<a href="{{route('dashboard')}}" class="nav-link">
          			<i class="nav-icon fas fa-tachometer-alt text-warning"></i>
          			<p>
          				Dashboard
          			</p>
          		</a>
          	</li>
          	<li class="nav-item">
          		<a href="#" class="nav-link">
          			<i class="nav-icon fa-solid fa-database text-info" ></i>
          			<p>
          				Master Data
          				<i class="fas fa-angle-left right"></i>
          			</p>
          		</a>
          		<ul class="nav nav-treeview">
          	@if (Auth::user()->level == 'bendahara')
          			<li class="nav-item">
          				<a href="{{route('akun')}}" class="nav-link">
          					<i class="far fa-circle nav-icon"></i>
          					<p>Akun</p>
          				</a>
          			</li>
          			<li class="nav-item">
          				<a href="{{route('produk')}}" class="nav-link">
          					<i class="far fa-circle nav-icon"></i>
          					<p>Produk</p>
          				</a>
          			</li>
          			<li class="nav-item">
          				<a href="{{route('kontak')}}" class="nav-link">
          					<i class="far fa-circle nav-icon"></i>
          					<p>Kontak</p>
          				</a>
          			</li>
          			<li class="nav-item">
          				<a href="prson_level" class="nav-link">
          					<i class="far fa-circle nav-icon"></i>
          					<p>Person Level</p>
          				</a>
          			</li>
          			<li class="nav-item">
          				<a href="{{route('profil')}}" class="nav-link">
          					<i class="far fa-circle nav-icon"></i>
          					<p>Profil</p>
          				</a>
          			</li>
          	@endif
          	@if (Auth::user()->level != 'bendahara')

          			<li class="nav-item">
          				<a href="{{route('administrator')}}" class="nav-link">
          					<i class="far fa-circle nav-icon"></i>
          					<p>Administrator</p>
          				</a>
          			</li>
          	@endif
          		</ul>
          	</li>
          	<li class="nav-item">
          		<a href="{{route('pemasukan')}}" class="nav-link">
          			<i class="nav-icon fa-solid fa-circle-down text-success"></i>
          			<p>
          				Pemasukan
          			</p>
          		</a>
          	</li>
          	<li class="nav-item">
          		<a href="{{route('pengeluaran')}}" class="nav-link">
          			<i class="nav-icon fa-solid fa-circle-up text-danger"></i>
          			<p>
          				Pengeluaran
          			</p>
          		</a>
          	</li>
          	<li class="nav-item">
          		<a href="#" class="nav-link">
          			<i class="nav-icon fas fa-copy text-white"></i>
          			<p>
          				Laporan
          				<i class="fas fa-angle-left right"></i>
          			</p>
          		</a>
          		<ul class="nav nav-treeview">
          			<li class="nav-item">
		          		<a href="{{route('laporan-transaksi')}}" class="nav-link">
		          			<i class="nav-icon fa fa-exchange"></i>
		          			<p>
		          				Laporan Transaksi
		          			</p>
		          		</a>
          			</li>
          			<li class="nav-item">
		          		<a href="{{route('jurnal')}}" class="nav-link">
		          			<i class="nav-icon fa fa-scale-balanced"></i>
		          			<p>
		          				Jurnal
		          			</p>
		          		</a>
          			</li>
          		</ul>
          	</li>
          </ul>
      </nav>
      <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>@yield('header-title', 'Default')</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="#">Dashboard</a></li>
						@yield('breadcrumb')
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		@yield('content')
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<footer class="main-footer">
	<div class="float-right d-none d-sm-block">
		<b>Version</b> 1.0.0 - beta
	</div>
	<strong>Copyright &copy; 2022 <a href="https://nawwal.my.id">Nawwal</a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
	<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('/')}}AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/')}}AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="{{ asset('/')}}AdminLTE/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('/')}}AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Fontawesome -->
<link rel="stylesheet" href="{{ asset('/')}}AdminLTE/plugins/fontawesome6/js/all.min.js">
<!-- AdminLTE App -->
<script src="{{ asset('/')}}AdminLTE/dist/js/adminlte.min.js"></script>
<script type="text/javascript">
$(document).ready( function () {
    $('#dataTable').DataTable();
});

</script>

</body>
</html>
