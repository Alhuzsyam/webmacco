                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
                    <div class="row">
                        <div class="col-lg-6">
                            <?= $this->session->flashdata('message'); ?>
                            <div class="card">
                                <div class="row no-gutters">
                                    <div class="col-md-5" style="background: #4e73df">
                                        <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="card-img-top h-100" alt="...">
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <h5 class="card-title">Biodata</h5>
                                            <table>
                                                <tr>
                                                    <td><i class="fas fa-fw fa-user-astronaut"></i></td>
                                                    <td><?= $user['name'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fas fa-fw fa-at"></i></td>
                                                    <td><?= $user['email'] ?></td>
                                                </tr>
                                                <tr>
                                                    <td><i class="fas fa-fw fa-calendar-alt"></td>
                                                    <td><?= date('d F Y', $user['date_created']) ?></td>
                                                </tr>
                                            </table>
                                            <a href="<?= base_url('map') ?>" class="btn btn-primary stretched-link mt-3"><i class="fas fa-map-marker-alt"></i> View Map</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->