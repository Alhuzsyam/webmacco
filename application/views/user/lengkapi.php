                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <?= form_open_multipart('user/lengkapi') ?>
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
                    <div class="row">
                        <div class="col-lg-3 col-sm-4">
                            <img id="blah" src="<?= base_url('assets/img/profile/') . $lengkapi['foto'] ?>" alt="..." class="img-thumbnail">
                            <span class="btn btn-primary btn-file mt-3 mb-3">
                                Chose photo <input type="file" id="imgInp" name="image">
                            </span>
                        </div>
                        <div class="col-lg-8">
                            <input type="hidden" name="lat" id="lat" value="<?= $lengkapi['latitude']; ?>" class="latitude">
                            <input type="hidden" name="long" id="long" value="<?= $lengkapi['longitude']; ?>" class="longitude">
                            <input type="hidden" name="email" id="email" value="<?= $lengkapi['email']; ?>">
                            <div class="form-group">
                                <input type="text" name="instansi" id="instansi" class="form-control" placeholder="instansi" aria-describedby="helpId" value="<?= $lengkapi['nama_instansi']; ?>">
                                <?= form_error('instansi', ' <small class="text-danger pl-0">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <input type="text" name="negara" id="negara" class="form-control" placeholder="negara" aria-describedby="helpId" value="<?= $lengkapi['negara']; ?>">
                                <?= form_error('negara', ' <small class="text-danger pl-0">', '</small>') ?>
                            </div>
                            <div class="fotm-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="text" name="hp" id="hp" class="form-control" placeholder="No HP" aria-describedby="helpId" value="<?= $lengkapi['hp']; ?>">
                                        <?= form_error('hp', ' <small class="text-danger pl-0">', '</small>') ?>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="telephone" id="telephone" class="form-control" placeholder="telephone" aria-describedby="helpId" value="<?= $lengkapi['telephone']; ?>">
                                        <?= form_error('telephone', ' <small class="text-danger pl-0">', '</small>') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-1">
                                <label for="exampleFormControlSelect1">JENIS INSTANSI</label>
                                <select class="form-control" name="jinstansi" id="exampleFormControlSelect1">
                                    <option value="<?= $lengkapi['Jenis_instansi']; ?>"><?= $lengkapi['Jenis_instansi']; ?></option>
                                    <option value="negeri">INSTANSI NEGERI</option>
                                    <option value="swsta">INSTANSI SWASTA</option>
                                </select>
                                <?= form_error('jinstansi', ' <small class="text-danger pl-0">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <input type="text" name="username" id="username" class="form-control" placeholder="username" aria-describedby="helpId" value="<?= $lengkapi['username']; ?>">
                                <?= form_error('username', ' <small class="text-danger pl-0">', '</small>') ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <!-- <label for="">Masukkan Alamat *</label> -->
                                    <input type="text" name="alamat_lengkap" id="map-search" placeholder="Ketik Alamat..." class="form-control" value="<?= $lengkapi['alamat']; ?>" />
                                    <?= form_error('alamat_lengkap', ' <small class="text-danger pl-0">', '</small>') ?>
                                </div>
                                <div class="col-sm-6">
                                    <!-- <label for="">Kota</label> -->
                                    <input type="text" name="kota" id="kota" placeholder="Nama Kota..." class="form-control reg-input-city" value="<?= $lengkapi['kota']; ?>" />
                                    <?= form_error('kota', ' <small class="text-danger pl-0">', '</small>') ?>
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
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->