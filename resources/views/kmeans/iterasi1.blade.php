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

        <div class="card card-info card-outline">
            <h4 class="m-0"><center>Centroid Awal</center></h4>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th><center>NIS</center></th>
                        <th><center>Centroid</center></th>
                        <th><center>% Kehadiran<br>Pengajian</center></th>
                        <th><center>% Kehadiran<br>Piket</center></th>
                        <th><center>Poin<br>Pelanggaran</center></th>
                        <th><center>Tingkat<br>Bacaan</center></th>
                        <th><center>Tingkat<br>Makna</center></th>
                        <th><center>Ket.</center></th>
                    </tr>
                    @if($aktivsantriterbesar)
                        <tr>
                            <td><center>{{ $aktivsantriterbesar->nis }}</center></td>
                            {{-- <td><center>{{ $aktivsantriterbesar->nama }}</center></td> --}}
                            <td><center>1</center></td>
                            <td><center>{{ $aktivsantriterbesar->hasil_ngaji }}</center></td>
                            <td><center>{{ $aktivsantriterbesar->hasil_piket }}</center></td>
                            <td><center>{{ $aktivsantriterbesar->hasil_pelanggaran }}</center></td>
                            <td><center>{{ $aktivsantriterbesar->hasil_bacaan }}</center></td>
                            <td><center>{{ $aktivsantriterbesar->hasil_makna }}</center></td>
                            {{-- <td><center>{{ $aktivsantriterbesar->rata }}</center></td> --}}
                            <td><center>Cluster 1</center></td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="8"><center>Tidak ada data dengan rata terbesar.</center></td>
                        </tr>
                    @endif

                    @if($aktivsantritengah)
                        <tr>
                            <td><center>{{ $aktivsantritengah->nis }}</center></td>
                            {{-- <td><center>{{ $aktivsantritengah->nama }}</center></td> --}}
                            <td><center>2</center></td>
                            <td><center>{{ $aktivsantritengah->hasil_ngaji }}</center></td>
                            <td><center>{{ $aktivsantritengah->hasil_piket }}</center></td>
                            <td><center>{{ $aktivsantritengah->hasil_pelanggaran }}</center></td>
                            <td><center>{{ $aktivsantritengah->hasil_bacaan }}</center></td>
                            <td><center>{{ $aktivsantritengah->hasil_makna }}</center></td>
                            {{-- <td><center>{{ $aktivsantritengah->rata }}</center></td> --}}
                            <td><center>Cluster 2</center></td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="8"><center>Tidak ada data dengan rata tidak besar dan tidak kecil.</center></td>
                        </tr>
                    @endif

                    @if($aktivsantriterkecil)
                        <tr>
                            <td><center>{{ $aktivsantriterkecil->nis }}</center></td>
                            {{-- <td><center>{{ $aktivsantriterkecil->nama }}</center></td> --}}
                            <td><center>3</center></td>
                            <td><center>{{ $aktivsantriterkecil->hasil_ngaji }}</center></td>
                            <td><center>{{ $aktivsantriterkecil->hasil_piket }}</center></td>
                            <td><center>{{ $aktivsantriterkecil->hasil_pelanggaran }}</center></td>
                            <td><center>{{ $aktivsantriterkecil->hasil_bacaan }}</center></td>
                            <td><center>{{ $aktivsantriterkecil->hasil_makna }}</center></td>
                            {{-- <td><center>{{ $aktivsantriterkecil->rata }}</center></td> --}}
                            <td><center>Cluster 3</center></td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="8"><center>Tidak ada data dengan rata terkecil.</center></td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>

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
                            <td><center>
                            @php
                                if ($hasil == $hasilC1) {
                                    $kelompok_sementara = 1;
                                } elseif ($hasil == $hasilC2) {
                                    $kelompok_sementara = 2;
                                } elseif ($hasil == $hasilC3) {
                                    $kelompok_sementara = 3;
                                } else {
                                    $kelompok_sementara = 0;
                                }
                                echo $kelompok_sementara;
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
            <h4 class="m-0"><center>Hasil Iterasi 1</center></h4>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th><center>Ket</center></th>
                        <th><center>C1</center></th>
                        <th><center>C2</center></th>
                        <th><center>C3</center></th>
                        <th><center>Total</center></th>
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
                        <td><center>
                        @php
                            $jumlahTotal = $jumlah_dataC1 + $jumlah_dataC2 + $jumlah_dataC3;
                            echo $jumlahTotal;
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
                <p class="card-text">Klik Lanjutkan untuk melanjutkan ke Iterasi Selanjutnya</p>
                <a href="{{ route('iterasi2')}}" class="btn btn-primary">Lanjutkan</a>
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
