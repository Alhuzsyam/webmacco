                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <?= $this->session->flashdata('message') ?>
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="<?= base_url('assets/img/image/') . 'addmask.svg' ?>" alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <form action="<?= base_url('admin/addmask') ?>" method="post">
                                <div class="form-group">
                                    <!-- <label for="">Barcode</label> -->
                                    <input type="text" name="barcode" id="" class="form-control" placeholder="Barcode" aria-describedby="helpId">
                                    <?= form_error('barcode', ' <small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Add Tag</label>
                                    <select name="tag" class="form-control" id="exampleFormControlSelect1">
                                        <option>Pilih Tag</option>
                                        <?php foreach ($tag as $t) : ?>
                                            <option value="<?= $t['tag'] ?>"><?= $t['tag'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <?= form_error('tag', ' <small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <button type="submit" class="btn btn-primary">Tambahkan</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->