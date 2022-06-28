<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ asset('vendor/AdminLTE-master/dist/img/masjid-logo.png') }}">
  <title>{{ $title }}</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-master/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-master/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-master/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-master/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-master/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-master/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
  {{-- Select2 --}}
  <link rel="stylesheet" href="{{ asset('vendor/select2-4.1.0-rc.0/dist/css/select2.min.css') }}">
  {{-- Trix Editor --}}
  <link rel="stylesheet" href="{{ asset('vendor/trix-main/dist/trix.css') }}">
  <script src="{{ asset('vendor/trix-main/dist/trix.js') }}"></script>
  
  <!-- Google Font: Source Sans Pro -->
  {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"> --}}
  <!-- Ionicons -->
  {{-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> --}}
  <!-- Tempusdominus Bootstrap 4 -->
  {{-- <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-master/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"> --}}
  <!-- iCheck -->
  {{-- <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-master/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> --}}
  <!-- JQVMap -->
  {{-- <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-master/plugins/jqvmap/jqvmap.min.css') }}"> --}}
  <!-- Daterange picker -->
  {{-- <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-master/plugins/daterangepicker/daterangepicker.css') }}"> --}}
  <!-- summernote -->
  {{-- <link rel="stylesheet" href="{{ asset('vendor/AdminLTE-master/plugins/summernote/summernote-bs4.min.css') }}"> --}}
  
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('vendor/AdminLTE-master/dist/img/masjid-logo.png') }}" alt="AdminLTELogo" height="200" width="200">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#userSettingModal" href="#" role="button">
          <i class="far fa-user-circle"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="{{ asset('vendor/AdminLTE-master/dist/img/masjid-logo.png') }}" alt="Masjid Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Masjid Al Akbar</span>
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if (session()->has('dataUser'))
            <img src="{{ asset('storage/' . session('dataUser')->foto_jamaah) }}" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">@if (session()->has('dataUser'))
              {{ session('dataUser')->nama_jamaah }}
          @endif</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                {{-- <span class="right badge badge-danger">New</span> --}}
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-mosque ml-1"></i>
              <p class="ml-1">
                Profile Masjid
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('struktur-dkm.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Struktur Kepengurusan</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('sejarah-masjid.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sejarah Masjid</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('album.index') }}" class="nav-link">
              <i class="fas fa-images ml-1"></i>
              <p class="ml-2">
                Galeri
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('notulen.index') }}" class="nav-link">
              <i class="fas fa-file-alt ml-1"></i>
              <p class="ml-2">
                Notulen
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-calendar-alt ml-1"></i>
              <p class="ml-2">
                Acara
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('acara.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Jadwal Acara</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('trans-acara.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kas Acara</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-hand-holding-heart ml-1"></i>
              <p class="ml-2">
                ZIS
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Zakat</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Infaq</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Shadaqah</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="{{ route('inventaris.index') }}" class="nav-link">
              <i class="fas fa-boxes ml-1"></i>
              <p class="ml-2">
                Inventaris
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-database ml-1"></i>
              <p class="ml-2">
                Master Data
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('jamaah.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Jama'ah</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('role.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Role</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('users.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            </ul>
          </li>
          {{-- <li class="nav-header">EXAMPLES</li> --}}
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm">
            {{-- page title --}}
            <ol class="breadcrumb float-sm-left">
              <li class="breadcrumb-item"><b>{{ $breadcrumb }}</b></li>
              <li class="breadcrumb-item active"><b>{{ $title }}</b></li>
            </ol>
          </div><!-- /.col -->
          {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">{{ $breadcrumb_parent }}</li>
                <li class="breadcrumb-item active">{{ $title }}</li>
            </ol>
          </div><!-- /.col --> --}}
        </div><!-- /.row -->
        <hr>
        @if ($message = Session::get('successInsert'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

        @if ($message = Session::get('successUpdate'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

        @if ($message = Session::get('successDelete'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

        @if ($message = Session::get('failedDelete'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

        @if ($message = Session::get('duplicateData'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

        <!-- Main row -->
        @yield('content')
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="">Masjid Al Akbar - MAP</a> </strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('vendor/AdminLTE-master/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('vendor/AdminLTE-master/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('vendor/AdminLTE-master/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('vendor/AdminLTE-master/dist/js/adminlte.js') }}"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('vendor/AdminLTE-master/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('vendor/AdminLTE-master/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/AdminLTE-master/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('vendor/AdminLTE-master/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/AdminLTE-master/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('vendor/AdminLTE-master/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('vendor/AdminLTE-master/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('vendor/AdminLTE-master/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('vendor/AdminLTE-master/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('vendor/AdminLTE-master/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('vendor/AdminLTE-master/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('vendor/AdminLTE-master/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
{{-- Select2 --}}
<script src="{{ asset('vendor/select2-4.1.0-rc.0/dist/js/select2.min.js') }}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

{{-- In your Javascript (external .js resource or <script> tag) --}}
<script>
  $(document).ready(function() {
      $('.select2').select2();
  });
</script>


<div class="modal fade" id="userSettingModal" aria-labelledby="userSettingModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="user
            SettingModalLabel">User Setting</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <div class="row text-center">
              <div class="col-sm mb-2">
                <form action="{{ route('auth.logout') }}" method="POST">
                  @csrf
                  
                  <button style="submit" class="btn btn-primary mb-2"><i class="fas fa-sign-out-alt"></i> Logout</button>
                </form>
                
                <a href="" class="btn btn-dark"><i class="fas fa-cog"></i> Pengaturan</a>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery UI 1.11.4 -->
    {{-- <script src="{{ asset('vendor/AdminLTE-master/plugins/jquery-ui/jquery-ui.min.js') }}"></script> --}}
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    {{-- <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script> --}}
    <!-- ChartJS -->
    {{-- <script src="{{ asset('vendor/AdminLTE-master/plugins/chart.js/Chart.min.js') }}"></script> --}}
    <!-- Sparkline -->
    {{-- <script src="{{ asset('vendor/AdminLTE-master/plugins/sparklines/sparkline.js') }}"></script> --}}
    <!-- JQVMap -->
    {{-- <script src="{{ asset('vendor/AdminLTE-master/plugins/jqvmap/jquery.vmap.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendor/AdminLTE-master/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
    <!-- jQuery Knob Chart -->
    {{-- <script src="{{ asset('vendor/AdminLTE-master/plugins/jquery-knob/jquery.knob.min.js') }}"></script> --}}
    <!-- daterangepicker -->
    {{-- <script src="{{ asset('vendor/AdminLTE-master/plugins/moment/moment.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('vendor/AdminLTE-master/plugins/daterangepicker/daterangepicker.js') }}"></script> --}}
    <!-- Tempusdominus Bootstrap 4 -->
    {{-- <script src="{{ asset('vendor/AdminLTE-master/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script> --}}
    <!-- Summernote -->
    {{-- <script src="{{ asset('vendor/AdminLTE-master/plugins/summernote/summernote-bs4.min.js') }}"></script> --}}
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('vendor/AdminLTE-master/dist/js/demo.js') }}"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    {{-- <script src="{{ asset('vendor/AdminLTE-master/dist/js/pages/dashboard.js') }}"></script> --}}
</body>
</html>