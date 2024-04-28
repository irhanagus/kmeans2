<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <title>K-Means | Iterasi 2</title>
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
            <h1 class="m-0">Iterasi 2</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Imp. K-Means</li>
              <li class="breadcrumb-item active">Iterasi 2</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">

        <div class="card card-info card-outline">
            <h4 class="m-0"><center>Centroid Baru</center></h4>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th><center>Penentuan Pusat<br>Cluster Baru</center></th>
                        <th><center>% Kehadiran<br>Pengajian</center></th>
                        <th><center>% Kehadiran<br>Piket</center></th>
                        <th><center>Poin<br>Pelanggaran</center></th>
                        <th><center>Tingkat<br>Bacaan</center></th>
                        <th><center>Tingkat<br>Makna</center></th>
                        <th><center>Ket.</center></th>
                    </tr>
                    <tr>
                        <td><center>Centroid baru yang ke-1 (Cluster 1)</center></td>
                        <td><center>{{ $rata_rata_ngaji1 }}</center></td>
                        <td><center>{{ $rata_rata_piket1 }}</center></td>
                        <td><center>{{ $rata_rata_pelanggaran1 }}</center></td>
                        <td><center>{{ $rata_rata_bacaan1 }}</center></td>
                        <td><center>{{ $rata_rata_makna1 }}</center></td>
                        <td><center>Cluster 1</center></td>
                    </tr>
                    <tr>
                        <td><center>Centroid baru yang ke-2 (Cluster 2)</center></td>
                        <td><center>{{ $rata_rata_ngaji2 }}</center></td>
                        <td><center>{{ $rata_rata_piket2 }}</center></td>
                        <td><center>{{ $rata_rata_pelanggaran2 }}</center></td>
                        <td><center>{{ $rata_rata_bacaan2 }}</center></td>
                        <td><center>{{ $rata_rata_makna2 }}</center></td>
                        <td><center>Cluster 2</center></td>
                    </tr>
                    <tr>
                        <td><center>Centroid baru yang ke-3 (Cluster 3)</center></td>
                        <td><center>{{ $rata_rata_ngaji3 }}</center></td>
                        <td><center>{{ $rata_rata_piket3 }}</center></td>
                        <td><center>{{ $rata_rata_pelanggaran3 }}</center></td>
                        <td><center>{{ $rata_rata_bacaan3 }}</center></td>
                        <td><center>{{ $rata_rata_makna3 }}</center></td>
                        <td><center>Cluster 3</center></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="card card-info card-outline">
            <h4 class="m-0"><center>Iterasi 2</center></h4>
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
                    @foreach ($aktivsantri as $santri)
                        <tr>
                            <td><center>{{ $santri->nis }}</center></td>
                            <td><center>{{ $santri->nama }}</center></td>
                            <td><center>{{
                                $hasilC1 = sqrt(pow($santri->hasil_ngaji - $rata_rata_ngaji1, 2) +
                                                pow($santri->hasil_piket - $rata_rata_piket1, 2) +
                                                pow($santri->hasil_pelanggaran - $rata_rata_pelanggaran1, 2) +
                                                pow($santri->hasil_bacaan - $rata_rata_bacaan1, 2) +
                                                pow($santri->hasil_makna - $rata_rata_makna1, 2));
                            }}</center></td>
                            <td><center>{{
                                $hasilC2 = sqrt(pow($santri->hasil_ngaji - $rata_rata_ngaji2, 2) +
                                                pow($santri->hasil_piket - $rata_rata_piket2, 2) +
                                                pow($santri->hasil_pelanggaran - $rata_rata_pelanggaran2, 2) +
                                                pow($santri->hasil_bacaan - $rata_rata_bacaan2, 2) +
                                                pow($santri->hasil_makna - $rata_rata_makna2, 2));
                            }}</center></td>
                            <td><center>{{
                                $hasilC3 = sqrt(pow($santri->hasil_ngaji - $rata_rata_ngaji3, 2) +
                                                pow($santri->hasil_piket - $rata_rata_piket3, 2) +
                                                pow($santri->hasil_pelanggaran - $rata_rata_pelanggaran3, 2) +
                                                pow($santri->hasil_bacaan - $rata_rata_bacaan3, 2) +
                                                pow($santri->hasil_makna - $rata_rata_makna3, 2));
                            }}</center></td>
                            <td><center>{{
                                $hasil = min($hasilC1,$hasilC2,$hasilC3);
                            }}</center></td>
                            <td><center>
                            @php
                                if ($hasil == $hasilC1) {
                                    $kelompok_hasil = 1;
                                } elseif ($hasil == $hasilC2) {
                                    $kelompok_hasil = 2;
                                } elseif ($hasil == $hasilC3) {
                                    $kelompok_hasil = 3;
                                } else {
                                    $kelompok_hasil = 0;
                                }
                                echo $kelompok_hasil;
                            @endphp
                            </center></td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="card-footer">
                {{ $aktivsantri->links() }}
            </div>
        </div>

        <div class="card card-info card-outline">
            <h4 class="m-0"><center>Hasil Iterasi Sekarang</center></h4>
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
                            echo $jumlah_dataC1_sekarang;
                        @endphp
                        </center></td>
                        <td><center>
                        @php
                            echo $jumlah_dataC2_sekarang;
                        @endphp
                        </center></td>
                        <td><center>
                        @php
                            echo $jumlah_dataC3_sekarang;
                        @endphp
                        </center></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card card-info card-outline">
            <h4 class="m-0"><center>Hasil Iterasi Sebelumnya</center></h4>
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
                            echo $jumlah_dataC1_sebelumnya;
                        @endphp
                        </center></td>
                        <td><center>
                        @php
                            echo $jumlah_dataC2_sebelumnya;
                        @endphp
                        </center></td>
                        <td><center>
                        @php
                            echo $jumlah_dataC3_sebelumnya;
                        @endphp
                        </center></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="card card-info card-outline">
            <div class="card-header">
                <h5 class="m-0">-</h5>
            </div>
            <div class="card-body">
                <center>
                <p class="card-text">Klik Lanjutkan untuk melanjutkan ke Iterasi Selanjutnya Hingga Selesai</p>
                <a href="{{ route('iterasi-akhir')}}" class="btn btn-primary">Lanjutkan</a>
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
