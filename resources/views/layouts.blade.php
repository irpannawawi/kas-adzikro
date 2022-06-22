<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title','Adz-Zikro')</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('/')}}AdminLTE/plugins/fontawesome-free/css/all.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('/')}}AdminLTE/dist/css/adminlte.min.css">
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
				<img src="{{ asset('/')}}AdminLTE/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light">Adz-Zikro</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar user (optional) -->
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="{{ asset('/')}}AdminLTE/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a href="#" class="d-block">{{ Str::ucfirst(Auth::user()->level) }}</a>
					</div>
				</div>


				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
          	with font-awesome or any other icon font library -->
          	<li class="nav-item">
          		<a href="dashboard" class="nav-link">
          			<i class="nav-icon fas fa-tachometer-alt"></i>
          			<p>
          				Dashboard
          			</p>
          		</a>
          	</li>
          	<li class="nav-item">
          		<a href="#" class="nav-link">
          			<i class="nav-icon fas fa-copy"></i>
          			<p>
          				Master Data
          				<i class="fas fa-angle-left right"></i>
          			</p>
          		</a>
          		<ul class="nav nav-treeview">
          			<li class="nav-item">
          				<a href="akun" class="nav-link">
          					<i class="far fa-circle nav-icon"></i>
          					<p>Akun</p>
          				</a>
          			</li>
          			<li class="nav-item">
          				<a href="produk" class="nav-link">
          					<i class="far fa-circle nav-icon"></i>
          					<p>Produk</p>
          				</a>
          			</li>
          			<li class="nav-item">
          				<a href="kontak" class="nav-link">
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
          				<a href="/administrator" class="nav-link">
          					<i class="far fa-circle nav-icon"></i>
          					<p>Administrator</p>
          				</a>
          			</li>
          		</ul>
          	</li>
          	<li class="nav-item">
          		<a href="/pemasukan" class="nav-link">
          			<i class="nav-icon fas fa-chart-pie"></i>
          			<p>
          				Pemasukan
          			</p>
          		</a>
          	</li>
          	<li class="nav-item">
          		<a href="pengeluaran" class="nav-link">
          			<i class="nav-icon fas fa-chart-pie"></i>
          			<p>
          				Pengeluaran
          			</p>
          		</a>
          	</li>
          	<li class="nav-item">
          		<a href="#" class="nav-link">
          			<i class="nav-icon fas fa-chart-pie"></i>
          			<p>
          				Laporan
          			</p>
          		</a>
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
		<b>Version</b> 3.2.0
	</div>
	<strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
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
<!-- AdminLTE App -->
<script src="{{ asset('/')}}AdminLTE/dist/js/adminlte.min.js"></script>

</body>
</html>
