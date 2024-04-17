<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home')}}" class="brand-link">
    <img src="{{ asset('AdminLte/dist/img/logoPPRU.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Aplikasi K-Means</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar landingpage -->
    <div class="user-panel mt-4 pb-4 mb-4 d-flex">
        <nav>
            <li>
                <a href="{{ route('welcome')}}">
                    <i class="fa-regular fa-newspaper" style="margin-right: 5px;"></i>
                    <span>Landingpage</span>
                </a>
            </li>
        </nav>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('home')}}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                        Santri
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('data-santri')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Data Santri</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('aktiv-santri')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Rekap Aktivitas</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-table"></i>
                    <p>
                        K-Means Clustering
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('atribut')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Atribut</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('preprocessing')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Pre-Processing</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('iterasi1')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Iterasi</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-file"></i>
                    <p>
                        Laporan
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('hasil-santri')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lihat Sesuai Santri</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('hasil-cluster')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Lihat Sesuai Cluster</p>
                        </a>
                    </li>
                </ul>
            </li>

            @if (auth()->user()->level == "admin")
            <li class="nav-item">
                <a href="{{ route('data-user')}}" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    User Management
                </p>
                </a>
            </li>
            @endif
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
