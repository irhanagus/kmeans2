<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>K-Means</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{ asset('landingpage/assets/favicon.ico') }}" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('landingpage/css/styles.css')}}" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top" ><img src="{{ asset('landingpage/assets/img/logoPPRU3.png') }}" alt="..." /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                @if (Route::has('login'))
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    @auth
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="{{ url('/home') }}">HOME</a></li>
                    </ul>
                @else
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="{{ url('/login') }}">LOGIN</a></li>
                    </ul>
                    @endauth
                </div>
                @endif
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Welcome to Aplikasi</div>
                <div class="masthead-heading text-uppercase">Implementasi K-Means Clustering<br>dalam Pengelompokan Santri<br>Berdasarkan Aktivitas Pembelajaran</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="#services">Learn More</a>
            </div>
        </header>
        <!-- Services-->
        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">K-Means Clustering?</h2>
                    <h3 class="section-subheading text-muted">K-Means adalah suatu metode penganalisaan data atau metode data mining yang melakukan proses pemodelan tanpa supervisi (unsupervised). Algoritma K-Means masuk ke dalam penerapan data mining Clustering yang dapat digunakan untuk mengelompokkan data menjadi beberapa kelompok. Kelompok-kelompok yang dibentuk ini memiliki kriteria yang telah ditentukan, lalu data-data yang sesuai dengan kelompoknya dikumpulkan menjadi satu cluster. Titik pusat atau Centroid adalah hal yang dimiliki oleh setiap cluster.</h3>
                </div>
            </div>
        </section>
        <!-- About-->
        <section class="page-section" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Tahapan Algoritma K-Means Clustering</h2>
                    <h3 class="section-subheading text-muted">Adapun tahapan algoritma K-Means sebagai berikut:</h3>
                </div>
                <ul class="timeline">
                    <li>
                        <div class="timeline-image">
                            <h1><br>1<br></h1>
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading"><br>Pertama</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Memilih berapa (k) Cluster yang diharapkan dalam dataset.</p></div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><h1><br>2</h1></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading"><br>Kedua</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Pilih centroid secara acak dari data sesuai dengan jumlah cluster.</p></div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image"><h1><br>3</h1></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading">Ketiga</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">Menghitung jarak terpendek di setiap objek dengan centroid dengan rumus:</p>
                                <img src="{{ asset('landingpage/assets/img/kmean1.jpg')}}">
                                <p class="text-muted">Koordinat obyek adalah x dan y, koordinat centroid adalah s dan t, dan banyaknya objek adalah i.</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image"><h1><br>4</h1></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading"><br>Keempat</h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted">Menghitung ulang titik Cluster dengan keanggotaan Cluster terbaru. Rata-rata seluruh data yang ada dalam cluster merupakan pusat cluster.</p></div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image"><h1><br>5</h1></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4 class="subheading">Kelima</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">Cluster baru (Centroid baru) digunakan untuk menghitung ulang setiap objek. Tahap ini merupakan pembukaan awal iterasi baru. Jika cluster masih memiliki anggota yang berpindah, maka kembali ke langkah c jika anggota cluster tidak berpindah cluster lagi.</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>
                                Proses
                                <br />
                                Clustering
                                <br />
                                Selesai
                            </h4>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Copyright &copy; 2024 riyadhululum.com</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="link-dark text-decoration-none me-3" href="#!">Ponpes Riyadhul Ulum UB</a>
                    </div>
                </div>
            </div>
        </footer>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('landingpage/js/scripts.js')}}"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
