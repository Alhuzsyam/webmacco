                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
                    <div class="row">
                        <div class="col-lg-12">
                            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>
                            <?= $this->session->flashdata('message'); ?>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Penanggung</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Instansi</th>
                                        <th scope="col">Negara</th>
                                        <th scope="col">Telephone</th>
                                        <th scope="col">Handphone</th>
                                        <th scope="col">Isntansi</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Kota</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $n = 1;
                                    foreach ($ureaders as $us) :
                                    ?>
                                        <tr>
                                            <th scope="row">
                                                <?= $n++ ?>
                                            </th>
                                            <td>
                                                <?= $us['penaggung_jawab'] ?>
                                            </td>
                                            <td>
                                                <?= $us['username'] ?>
                                            </td>
                                            <td>
                                                <?= $us['email'] ?>
                                            </td>
                                            <td>
                                                <?= $us['Jenis_instansi'] ?>
                                            </td>
                                            <td>
                                                <?= $us['negara'] ?>
                                            </td>
                                            <td>
                                                <?= $us['telephone'] ?>
                                            </td>
                                            <td>
                                                <?= $us['hp'] ?>
                                            </td>
                                            <td>
                                                <?= $us['nama_instansi'] ?>
                                            </td>
                                            <td>
                                                <?= $us['alamat'] ?>
                                            </td>
                                            <td>
                                                <?= $us['kota'] ?>
                                            </td>
                                            <td>
                                                <a href="" class="badge badge-success">Edit</a>
                                                <a href="<?= base_url('admin/deletemembers/') . $us['id'] ?>" class="badge badge-danger">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->