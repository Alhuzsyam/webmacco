<body class="page-top">
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars" style="color:#f0835d;"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- <div class="topbar-divider d-none d-sm-block"></div> -->
                    <li class="nav-item dropdown no-arrow">
                        <img src="<?= base_url('assets/img/image/macco.png') ?>" style="width: 120px;" alt="" srcset="">
                    </li>

                </ul>
                <ul class="navbar-nav ml-auto">
                    <!-- <div class="topbar-divider d-none d-sm-block"></div> -->
                    <li class="nav-item dropdown no-arrow">
                        <h3 class=" ">
                            <a class="mysubtitle" href="<?= base_url('authentification') ?>"><?= $map['nama_instansi'] ?></a>
                        </h3>
                    </li>

                </ul>


            </nav>
        </div>
    </div>
    <div id="map"></div>