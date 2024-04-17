<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <title>K-Means | Hasil Sesuai Cluster</title>
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
            <h1 class="m-0">Hasil</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Hasil Sesuai Cluster</li>
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
                    <a href="{{ route('cetak-cluster')}}" class="btn btn-success" target="_blank">Cetak Hasil <i class="fa-solid fa-print"></i></a>
                    {{-- <a href="#" class="btn btn-primary" data-Toggle="Model" data-Toggle="#exampleModel">Import</a> --}}
                </div>
            </div>

            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th><center>CLUSTER</center></th>
                        <th><center>NIS</center></th>
                        <th><center>NAMA</center></th>
                        <th><center>JENIS KELAMIN</center></th>
                        <th><center>JENJANG</center></th>
                    </tr>
                    @foreach ($dtsantri as $item)
                    <tr>
                        <td><center>{{ $item->kelompok_hasil }}</center></td>
                        <td><center>{{ $item->nis }}</center></td>
                        <td>{{ $item->nama }}</td>
                        <td><center>{{ $item->jk->jenis_kelamin }}</center></td>
                        <td><center>{{ $item->jenjang->jenjang }}</center></td>
                    </tr>
                    @endforeach
                </table>
            </div>

            <div class="card-footer">
                {{ $dtsantri->links() }}
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
