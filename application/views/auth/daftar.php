<div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
    <div class="row">
        <div class="col-md-12">
            <div class="p-5">
                <p class="mytitle">Get started</p>
                <img src="<?= base_url("assets/img/image/macco.png") ?>" alt="Macco" class="logo-size mb-2">
                <!-- <form  action="<?//= base_url("Authentification/registration") ?>" method="POST"> -->
                <?= form_open_multipart('Register/registration') ?>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input type="hidden" name="lat" id="lat" value="" class="form-control latitude">
                        <input type="hidden" name="long" id="long" value="" class="form-control longitude">

                        <label for="email">Nama *</label>
                        <input type="text" name="nama" id="nama" value="<?= set_value('nama') ?>" class="form-control" />
                        <?= form_error('nama', ' <small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="col-sm-6">
                        <label for="email">Email *</label>
                        <input type="email" name="email" id="email" value="<?= set_value('email') ?>" class="form-control" />
                        <?= form_error('email', ' <small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="Jenis isntansi">Jenis Instansi *</label>
                        <select name="jinstansi" class="form-control" <?= set_value('jinstansi') ?>>
                            <option value="">- Pilih -</option>
                            <?php foreach ($instansi as $i) { ?>
                                <option value="<?= $i['id'] ?>"><?= $i['nama_instansi'] ?></option>
                            <?php } ?>
                        </select>
                        <?= form_error('jinstansi', ' <small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="kota">Negara *</label>
                        <input id="country_selector" name="country_selector" type="text" class="form-control" value="<?= set_value('country_selector') ?>" />
                        <?= form_error('country_selector', ' <small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="telp">Telephone *</label>
                        <input type="number" name="telp" id="telp" min="0" value="<?= set_value('telp') ?>" class="form-control" />
                        <?= form_error('telp', ' <small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="telp">Handphone *</label><br>
                        <!-- style="width: 335px;border-radius: 7px;height: 38px;" -->
                        <input type="tel" name="hp" id="tel" min="0" value="<?= set_value('hp') ?>" class="form-control">
                        <?= form_error('hp', ' <small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="instansi">Nama Instansi *</label>
                    <input type="text" name="instansi" id="instansi" value="<?= set_value('instansi') ?>" class="form-control" />
                    <?= form_error('instansi', ' <small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                    <label for="username">Username *</label>
                    <input type="text" name="username" id="username" value="<?= set_value('username') ?>" class="form-control" />
                    <?= form_error('username', ' <small class="text-danger pl-3">', '</small>') ?>
                </div>
                <div class="form-group">
                    <label for="foto">Foto Alat *</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" onchange="loadFile(event)" class="custom-file-input" id="foto" name="foto" />
                            <label class="custom-file-label" for="foto">Pilih File</label>
                            <?= form_error('foto', ' <small class="text-danger pl-3">', '</small>') ?>
                        </div>
                    </div>
                    <br />
                    <!-- image preview -->
                    <img id="output" class="img-fluid" />
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="">Masukkan Alamat *</label>
                        <input type="text" name="alamat_lengkap" id="map-search" value="<?= set_value('alamat_lengkap') ?>" placeholder="Ketik Alamat..." class="form-control" />
                        <?= form_error('alamat_lengkap', ' <small class="text-danger pl-3">', '</small>') ?>
                    </div>
                    <div class="col-sm-6">
                        <label for="">Kota</label>
                        <input type="text" name="kota" id="kota" value="<?= set_value('kota') ?>" placeholder="Nama Kota..." class="form-control reg-input-city" />
                        <?= form_error('kota', ' <small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="form-group">
                    <div id="map-canvas" class="form-control" style="height: 300px"></div>
                    <br>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">

                        <button type="button" class="form-control btn btn-primary btn-user btn-block" onclick="showPosition();"><i class="fas fa-map-marker-alt"></i> Pilih Lokasi Saat ini</button>
                    </div>

                    <div class="col-sm-6">
                        <button type="submit" class="form-control btn btn-primary btn-user btn-block">
                            <i class="fa fa-paper-plane"></i> Daftar!</i></button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Load jQuery from CDN so can run demo immediately -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="<?= base_url() ?>/assets/lib/country/build/js/countrySelect.js"></script>
<script>
    $("#country_selector").countrySelect({
        // defaultCountry: "jp",
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // responsiveDropdown: true,
        preferredCountries: ['id', 'gb', 'us']
    });
</script>