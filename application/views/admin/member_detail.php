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
                                    <!-- <p class="card-text btn btn-warningbadge badge-warning">ID ALAT : <span class=""><//?= $member['id'] ?></span> </p> -->
                                    <!-- <a href="#" class="btn btn-primary">ID Alat <span class="btn btn-warningbadge badge-warning"><?//= $member['id'] ?></span></a> -->
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                        <i class="fab fa-keybase"></i> Check id Alat
                                    </button>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">Instalasi Api</h5>
                                    <code>
                                        <p class="card-text">http://alicestech.com/macco/webmacco/api/macco/scan?tag=tag_variable&id_alat=ID_ALAT</p>
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

                <!-- Modals -->
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <center>
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Id Alat</th>
                                                <th scope="col">Gedung</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $n = 1;
                                            foreach ($alat as $al) : ?>
                                                <tr>
                                                    <th scope="row"><?= $n++ ?></th>
                                                    <td>
                                                        <?= $al['id_reader_user'] ?>
                                                    </td>
                                                    <td>
                                                        <?= $al['nama_gedung'] ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </center>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                            </div>
                        </div>
                    </div>
                </div>