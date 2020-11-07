                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="<?= base_url('assets/img/profile/') . $member['foto'] ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $member['username'] ?></h5>
                                    <p class="card-text"><?= $member['hp'] ?></p>
                                    <p class="card-text"><?= $member['alamat'] ?></p>
                                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <h5 class="card-header">Member Details</h5>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $member['kota'] ?></h5>
                                    <p class="card-text"><?= $member['nama_instansi'] . ' - ' . $member['telephone'] ?></p>
                                    <p class="card-text btn btn-warningbadge badge-warning">ID ALAT : <span class=""><?= $member['id'] ?></span> </p>
                                    <!-- <a href="#" class="btn btn-primary">ID Alat <span class="btn btn-warningbadge badge-warning"><?= $member['id'] ?></span></a> -->
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Instalasi Api</h5>
                                    <code>
                                        <p class="card-text">http://alicestech.com/webmacco/api/macco/scan?tag=tag_variable&id_alat=ID_ALAT</p>
                                    </code>
                                    <!-- <p class="card-text btn btn-warningbadge badge-warning">ID ALAT : <span class=""><?//= $member['id'] ?></span> </p> -->
                                    <!-- <a href="#" class="btn btn-primary">ID Alat <span class="btn btn-warningbadge badge-warning"><?//= $member['id'] ?></span></a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->