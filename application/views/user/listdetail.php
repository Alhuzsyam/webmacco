                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nama Gedung</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $n = 1;
                                    foreach ($list as $li) : ?>
                                        <tr>
                                            <th scope="row"><?= $n++ ?></th>
                                            <td><?= $li['nama_gedung'] ?></td>
                                            <td><?= substr($li['ket'], 0, 10) . '...' ?></td>
                                            <td>
                                                <a href="<?= base_url('user/detaillist?id=') . $li['id_reader_user'] ?>" class="badge badge-warning">Detail</a>
                                                <a href="" class="badge badge-success">Edit</a>
                                                <a href="<?= base_url('user/deletelist?id=') . $li['id_reader_user'] ?>" class="badge badge-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="<?= base_url('assets/img/profile/') . $detail['foto'] ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title"><?= $detail['nama_gedung'] ?></h5>
                                    <p class="card-text"><?= $detail['ket'] ?></p>
                                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->