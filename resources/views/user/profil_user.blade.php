<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <title>K-Means | Profil</title>
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
            <h1 class="m-0">Profil</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Profil</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content" style="overflow: hidden;">
        <div class="card card-info card-outline" style="float: left; width: 300px; height: 300px;">
            <img src="{{ asset('AdminLte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image" style="display: block; margin: 15% auto 0; width: 75%; height: 75%; margin-bottom: 5px;">
        </div>
        <div class="card card-info card-outline" style="height: 300px;">
            <div class="card-body">
                <form action="">
                    <div class="form-group">
                        <input type="text" id="name" name="name" class="form-control" placeholder="Nama" value="{{ auth()->user()->name}}">
                    </div>
                    <div class="form-group">
                        <input type="text" id="level" name="level" class="form-control" placeholder="Level" value="{{ auth()->user()->level}}">
                    </div>
                    <div class="form-group">
                        <input type="text" id="email" name="email" class="form-control" placeholder="email" value="{{ auth()->user()->email}}">
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" name="password" class="form-control" placeholder="password" value="{{ auth()->user()->password}}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Ubah Data</button>
                    </div>
                </form>
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

</body>
</html>
