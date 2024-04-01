<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <title>K-Means | Pre-Processing</title>
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
            <h1 class="m-0">Pre-Processing</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Imp. K-Means</li>
              <li class="breadcrumb-item active">Pre-Processing</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="card card-info card-outline">

            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th><center>NIS</center></th>
                        <th><center>Nama</center></th>
                        <th><center>% Kehadiran<br>Pengajian</center></th>
                        <th><center>% Kehadiran<br>Piket</center></th>
                        <th><center>Poin<br>Pelanggaran</center></th>
                        <th><center>Tingkat<br>Bacaan</center></th>
                        <th><center>Tingkat<br>Makna</center></th>
                    </tr>
                    @foreach ($aktivsantri as $item)
                    <tr>
                        <td><center>{{ $item->nis }}</center></td>
                        <td><center>{{ $item->nama }}</center></td>
                        <td><center>{{ $item->hasil_ngaji }}</center></td>
                        <td><center>{{ $item->hasil_piket }}</center></td>
                        <td><center>{{ $item->hasil_pelanggaran }}</center></td>
                        <td><center>{{ $item->hasil_bacaan }}</center></td>
                        <td><center>{{ $item->hasil_makna }}</center></td>
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
