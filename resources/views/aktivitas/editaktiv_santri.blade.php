<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <title>K-Means | Rekap Aktivitas</title>
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
            <h1 class="m-0">Rekap Aktivitas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Aktivitas Santri</li>
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
                <form action="{{ url('updateaktiv-santri',$santri->id) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <input type="text" id="nis" name="nis" class="form-control" placeholder="Nomer Induk Santri" value="{{ $santri->nis}}">
                    </div>
                    <div class="form-group">
                        <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama Santri" value="{{ $santri->nama}}">
                    </div>
                    <div class="form-group">
                        <input type="text" id="khd_ngaji" name="khd_ngaji" class="form-control" placeholder="% Kehadiran Pengajian" value="{{ $santri->khd_ngaji}}">
                    </div>
                    <div class="form-group">
                        <input type="text" id="khd_piket" name="khd_piket" class="form-control" placeholder="% Kehadiran Piket" value="{{ $santri->khd_piket}}">
                    </div>
                    <div class="form-group">
                        <input type="text" id="poin_pelanggaran" name="poin_pelanggaran" class="form-control" placeholder="Jumlah Poin Pelanggaran" value="{{ $santri->poin_pelanggaran}}">
                    </div>
                    <div class="form-group">
                        {{--<input type="text" id="tingkat_bacaan" name="tingkat_bacaan" class="form-control" placeholder="Tingkat Bacaan" value="{{ $santri->tingkat_bacaan}}">--}}
                        <select class="form-control" style="width: 100%;" name="tingkat_bacaan" id="tingkat_bacaan">
                            <option value="Tahsin" {{ $santri->tingkat_bacaan == 'Tahsin' ? 'selected' : '' }}>Tahsin</option>
                            <option value="4" {{ $santri->tingkat_bacaan == '4' ? 'selected' : '' }}>4</option>
                            <option value="3" {{ $santri->tingkat_bacaan == '3' ? 'selected' : '' }}>3</option>
                            <option value="2" {{ $santri->tingkat_bacaan == '2' ? 'selected' : '' }}>2</option>
                            <option value="1" {{ $santri->tingkat_bacaan == '1' ? 'selected' : '' }}>1</option>
                        </select>
                    </div>
                    <div class="form-group">
                        {{--<input type="text" id="tingkat_makna" name="tingkat_makna" class="form-control" placeholder="Tingkat Makna" value="{{ $santri->tingkat_makna}}">--}}
                        <select class="form-control" style="width: 100%;" name="tingkat_makna" id="tingkat_makna">
                            <option value="Al-Idlafi" {{ $santri->tingkat_bacaan == 'Al-Idlafi' ? 'selected' : '' }}>Al-Idlafi</option>
                            <option value="Al-Sarii" {{ $santri->tingkat_bacaan == 'Al-Sarii' ? 'selected' : '' }}>Al-Sarii'</option>
                            <option value="At-Taanni" {{ $santri->tingkat_bacaan == 'At-Taanni' ? 'selected' : '' }}>At-Taanni</option>
                            <option value="Kitabah" {{ $santri->tingkat_bacaan == 'Kitabah' ? 'selected' : '' }}>Kitabah</option>
                        </select>
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
