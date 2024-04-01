<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <title>K-Means | Iterasi 1</title>
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
            <h1 class="m-0">Iterasi 1</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Imp. K-Means</li>
              <li class="breadcrumb-item active">Iterasi 1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">

        @include('kmeans.centroid_awal')

        <div class="card card-info card-outline">
            <h4 class="m-0"><center>Iterasi 1</center></h4>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th><center>NIS</center></th>
                        <th><center>Nama</center></th>
                        <th><center>C1</center></th>
                        <th><center>C2</center></th>
                        <th><center>C3</center></th>
                        <th><center>Cluster Terdekat<br>(Jarak Minimum)</center></th>
                        <th><center>Kelompok<br>Data</center></th>
                    </tr>
                    @foreach ($aktivsantri as $item)
                        <tr>
                            <td><center>{{ $item->nis }}</center></td>
                            <td><center>{{ $item->nama }}</center></td>
                            <td><center>{{
                                $hasilC1 = sqrt(pow($item->hasil_ngaji - $aktivsantriterbesar->hasil_ngaji, 2) +
                                pow($item->hasil_piket - $aktivsantriterbesar->hasil_piket, 2) +
                                pow($item->hasil_pelanggaran - $aktivsantriterbesar->hasil_pelanggaran, 2) +
                                pow($item->hasil_bacaan - $aktivsantriterbesar->hasil_bacaan, 2) +
                                pow($item->hasil_makna - $aktivsantriterbesar->hasil_makna, 2))
                            }}</center></td>
                            <td><center>{{
                                $hasilC2 = sqrt(pow($item->hasil_ngaji - $aktivsantritengah->hasil_ngaji, 2) +
                                pow($item->hasil_piket - $aktivsantritengah->hasil_piket, 2) +
                                pow($item->hasil_pelanggaran - $aktivsantritengah->hasil_pelanggaran, 2) +
                                pow($item->hasil_bacaan - $aktivsantritengah->hasil_bacaan, 2) +
                                pow($item->hasil_makna - $aktivsantritengah->hasil_makna, 2))
                            }}</center></td>
                            <td><center>{{
                                $hasilC3 = sqrt(pow($item->hasil_ngaji - $aktivsantriterkecil->hasil_ngaji, 2) +
                                pow($item->hasil_piket - $aktivsantriterkecil->hasil_piket, 2) +
                                pow($item->hasil_pelanggaran - $aktivsantriterkecil->hasil_pelanggaran, 2) +
                                pow($item->hasil_bacaan - $aktivsantriterkecil->hasil_bacaan, 2) +
                                pow($item->hasil_makna - $aktivsantriterkecil->hasil_makna, 2))
                            }}</center></td>
                            <td><center>{{
                                $hasil = min($hasilC1,$hasilC2,$hasilC3);
                            }}</center></td>
                            <td><center>{{ $item->kelompok_sementara }}</center></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <div class="card card-info card-outline">
            <h4 class="m-0"><center>Hasil Iterasi 1</center></h4>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th><center>Ket</center></th>
                        <th><center>C1</center></th>
                        <th><center>C2</center></th>
                        <th><center>C3</center></th>
                    </tr>
                    <tr>
                        <td><center>Jumlah</center></td>
                        <td><center>
                        @php
                            echo $jumlah_dataC1;
                        @endphp
                        </center></td>
                        <td><center>
                        @php
                            echo $jumlah_dataC2;
                        @endphp
                        </center></td>
                        <td><center>
                        @php
                            echo $jumlah_dataC3;
                        @endphp
                        </center></td>
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
