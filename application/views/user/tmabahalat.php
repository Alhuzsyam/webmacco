                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
                    <?= form_open_multipart('user/device') ?>
                    <div class="row">
                        <div class="col-md-3">
                            <!-- <img src="<?//= base_url('assets/img/profile/') . 'device.svg' ?>" alt="..." class="img-thumbnail"> -->
                            <?= $this->session->flashdata('message'); ?>
                            <input type="hidden" name="id" value="<?= $alat['id'] ?>">
                            <div class="card" style="width: 18rem;">
                                <img class="card-img-top" src="<?= base_url('assets/img/profile/') . 'device.svg' ?>" alt="Card image cap">
                                <div class="card-body">
                                    <h5 class="card-title">Tambah Kan Reader</h5>
                                    <p class="card-text">Isikan nama lokasi dan keterangan tempat anda dengan jelas, hal ini agar memudahkan petugas pada saat melakukan perbaikan<br>Terimakasih !!</p>
                                    <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <!-- <label for="">Nama Gedung</label> -->
                                <input type="text" name="gedung" id="" class="form-control" placeholder="Nama Gedung" aria-describedby="helpId">
                                <?= form_error('gedung', ' <small class="text-danger pl-0">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    <small id="helpId" class="text-muted">Foto Pemasangan Alat</small>
                                    <?//= form_error('image', ' <small class="text-danger pl-0">', '</small>') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- <div class="row"> -->
                                <label for="">Keterangan</label>
                                <textarea name="ket" id="" class="form-control" cols="30" rows="9"></textarea>
                                <?= form_error('ket', ' <small class="text-danger pl-0">', '</small>') ?>
                                <!-- </div> -->
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>

                        </div>
                    </div>
                    </form>
                </div>
                <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->