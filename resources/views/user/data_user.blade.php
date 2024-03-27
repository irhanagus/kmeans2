<?php
    $no = 0;
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <title>AdminLTE 3 | Starter</title>
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
            <h1 class="m-0">Data Pengguna</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Pengguna</li>
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
                <div class="card-tools">
                    <a href="{{ route('tambah-user')}}" class="btn btn-success">Tambah User <i class="fas fa-plus-square"></i></a>
                    {{-- <a href="#" class="btn btn-primary" data-Toggle="Model" data-Toggle="#exampleModel">Import</a> --}}
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th><center>NO</center></th>
                        <th><center>NAMA</center></th>
                        <th><center>LEVEL</center></th>
                        <th><center>EMAIL</center></th>
                        <th><center>AKSI</center></th>
                    </tr>
                    @foreach ($dtuser as $item)
                    <tr>
                        <td><center><?php echo ++$no; ?>.</center></td>
                        <td>{{ $item->name }}</td>
                        <td><center>{{ $item->level }}</center></td>
                        <td><center>{{ $item->email }}</center></td>
                        <td><center>
                            <a href="{{ url('edit-user',$item->id) }}"><i class="nav-icon fas fa-edit"></i> </a> | <a href="#"> <i class="fa-solid fa-trash" style="color: red"></i></a>
                            </center>
                        </td>
                    </tr>
                    @endforeach
                </table>
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
