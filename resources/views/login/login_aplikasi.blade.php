
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>K-Means | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('AdminLte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('AdminLte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLte/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="container-login">
    <!-- login-logo -->
    <img src="{{ asset('AdminLte/dist/img/rulogin.png')}}" alt="Deskripsi Gambar" class="gambar-kiri">
    <!-- /login-logo -->
    <div class="login-box">
    <div class="card">
        <div class="card-body login-card-body">
        <p class="login-box-msg" style="font-size: 20px;">Login to start session</p>

        <form action="{{ route('postlogin')}}" method="post">
            {{ csrf_field() }}
            <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" placeholder="Email">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-envelope"></span>
                </div>
            </div>
            </div>
            <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                <span class="fas fa-lock"></span>
                </div>
            </div>
            </div>
            <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                    Ingat saya
                </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
            </div>
        </form>


        </div>
        <!-- /.login-card-body -->
    </div>
    </div>
    <!-- /.login-box -->
</div>
<!-- jQuery -->
@include('template.script')
</body>
</html>
