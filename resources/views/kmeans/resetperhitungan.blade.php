<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <title>K-Means | Hasil Iterasi</title>
    @include('template.head')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

<!-- Navbar -->
@include('template.navbar')
<!-- /.navbar -->

<!-- Main Sidebar Container -->
@include('template.sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Reset Iterasi</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Imp. K-Means</li>
            <li class="breadcrumb-item active">Reset Berhasil</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="card card-info card-outline">
            <div class="card-header">
                <h5 class="m-0"><center>PROSES SELESAI</center></h5>
            </div>
            <div class="card-body">
                <center>
                <p class="card-text">
                    @php
                        echo "Perhitungan berhasil direset!";
                    @endphp
                </p>
                </center>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<!-- Main Footer -->
@include('template.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
@include('template.script')
@include('sweetalert::alert')

</body>
</html>
