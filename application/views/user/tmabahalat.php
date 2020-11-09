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
                                    <p class="card-text">Isikan nama lokasi dan keterangan tempat anda dengan jelas, hal ini agar memudahkan petugas pada saat melakukan perbaikan.
                                        <b>Setelah anda memilih lokasi saat ini, geser marker map untuk memperjelas lokasi</b><br>Terimakasih !!</p>
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
                                <textarea name="ket" id="" class="form-control" cols="10" rows="2"></textarea>
                                <?= form_error('ket', ' <small class="text-danger pl-0">', '</small>') ?>
                                <!-- </div> -->
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input type="text" name="alamat_lengkap" id="map-search" placeholder="Ketik Alamat..." class="form-control" value="" />
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="kota" id="kota" placeholder="Nama Kota..." class="form-control reg-input-city" value="" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div id="map-canvas" class="form-control" style="height: 300px"></div>
                                <br>
                            </div>
                            <div class="row mb-5">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <button type="button" class="form-control btn btn-primary btn-user btn-block" onclick="showPosition();"><i class="fas fa-map-marker-alt"></i> Pilih Lokasi Saat ini</button>
                                </div>
                                <div class="col-sm-6">
                                    <button type="submit" class="form-control btn btn-primary btn-user btn-block">
                                        <i class="fa fa-paper-plane"></i> Simpan</i></button>
                                </div>
                            </div>

                        </div>
                    </div>


                    <input type="hidden" name="lat" id="lat" value="" class="latitude">
                    <input type="hidden" name="long" id="long" value="" class="longitude">
                    </form>
                </div>
                <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->