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
    <title>K-Means | Atribut</title>
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
            <h1 class="m-0">Data Atribut</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Atribut</li>
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
                    <thead>
                        <tr>
                            <th><center>NO</center></th>
                            <th><center>NAMA ATRIBUT</center></th>
                            <th><center>KETERANGAN</center></th>
                            <th><center>NUMERIC</center></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td rowspan="5"><center>1</center></td>
                            <td rowspan="5"><center>Presentasi Kehadiran di Kelas</center></td>
                            <td><center>81-100</center></td>
                            <td><center>1.0</center></td>
                        </tr>
                        <tr>
                            <td><center>61-80</center></td>
                            <td><center>0.8</center></td>
                        </tr>
                        <tr>
                            <td><center>41-60</center></td>
                            <td><center>0.6</center></td>
                        </tr>
                        <tr>
                            <td><center>21-40</center></td>
                            <td><center>0.4</center></td>
                        </tr>
                        <tr>
                            <td><center>1-20</center></td>
                            <td><center>0.2</center></td>
                        </tr>
                        <tr>
                            <td rowspan="5"><center>2</center></td>
                            <td rowspan="5"><center>Presentasi Kehadiran Piket</center></td>
                            <td><center>81-100</center></td>
                            <td><center>1.0</center></td>
                        </tr>
                        <tr>
                            <td><center>61-80</center></td>
                            <td><center>0.8</center></td>
                        </tr>
                        <tr>
                            <td><center>41-60</center></td>
                            <td><center>0.6</center></td>
                        </tr>
                        <tr>
                            <td><center>21-40</center></td>
                            <td><center>0.4</center></td>
                        </tr>
                        <tr>
                            <td><center>1-20</center></td>
                            <td><center>0.2</center></td>
                        </tr>
                        <tr>
                            <td rowspan="5"><center>3</center></td>
                            <td rowspan="5"><center>Jumlah Poin Pelanggaran</center></td>
                            <td><center>1-200</center></td>
                            <td><center>1.0</center></td>
                        </tr>
                        <tr>
                            <td><center>201-400</center></td>
                            <td><center>0.8</center></td>
                        </tr>
                        <tr>
                            <td><center>401-600</center></td>
                            <td><center>0.6</center></td>
                        </tr>
                        <tr>
                            <td><center>601-800</center></td>
                            <td><center>0.4</center></td>
                        </tr>
                        <tr>
                            <td><center>801-1000</center></td>
                            <td><center>0.2</center></td>
                        </tr>
                        <tr>
                            <td rowspan="5"><center>4</center></td>
                            <td rowspan="5"><center>Tingkat Kelas Bacaan Terakhir</center></td>
                            <td><center>Tahsin</center></td>
                            <td><center>1.0</center></td>
                        </tr>
                        <tr>
                            <td><center>4</center></td>
                            <td><center>0.8</center></td>
                        </tr>
                        <tr>
                            <td><center>3</center></td>
                            <td><center>0.6</center></td>
                        </tr>
                        <tr>
                            <td><center>2</center></td>
                            <td><center>0.4</center></td>
                        </tr>
                        <tr>
                            <td><center>1</center></td>
                            <td><center>0.2</center></td>
                        </tr>
                        <tr>
                            <td rowspan="5"><center>5</center></td>
                            <td rowspan="5"><center>Tingkat Kelas Makna Terakhir</center></td>
                            <td><center>Al-Idlafi</center></td>
                            <td><center>1.0</center></td>
                        </tr>
                        <tr>
                            <td><center>Al-Sarii</center></td>
                            <td><center>0.75</center></td>
                        </tr>
                        <tr>
                            <td><center>Al-Taanni</center></td>
                            <td><center>0.5</center></td>
                        </tr>
                        <tr>
                            <td><center>Kitabah</center></td>
                            <td><center>0.25</center></td>
                        </tr>
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
