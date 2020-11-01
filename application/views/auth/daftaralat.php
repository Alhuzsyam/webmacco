<div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
    <div class="row">
        <div class="col-md-12">
            <div class="p-5">
                <p class="mytitle">Get started</p>
                <img src="<?= base_url("assets/img/image/macco.png") ?>" alt="Macco" class="logo-size mb-2">
                <?= form_open_multipart('Register/registration') ?>
                <div class="form-group row">
                    <div class="col-sm-6">
                        <input type="hidden" name="lat" id="lat" value="" class="latitude">
                        <input type="hidden" name="long" id="long" value="" class="longitude">

                        <label for="email">Nama *</label>
                        <input type="text" name="nama" id="nama" value="" class="form-control" />
                    </div>
                    <div class="col-sm-6">
                        <label for="email">Email *</label>
                        <input type="email" name="email" id="email" value="" class="form-control" />
                        <span id="emailMsg"></span>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="Jenis isntansi">Jenis Instansi *</label>
                        <select name="jinstansi" class="form-control">
                            <option value="">- Pilih -</option>
                            <?php foreach ($instansi as $i) { ?>
                                <option value="<?= $i['id'] ?>"><?= $i['nama_instansi'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="kota">Negara *</label>
                        <input id="country_selector" name="country_selector" type="text" class="form-control" />
                        <?= form_error('country_selector', ' <small class="text-danger pl-3">', '</small>') ?>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="telp">Telephone *</label>
                        <input type="number" name="telp" id="telp" min="0" class="form-control" />
                    </div>
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label for="telp">Handphone *</label><br>
                        <!-- style="width: 335px;border-radius: 7px;height: 38px;" -->
                        <input type="tel" name="hp" id="tel" min="0" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label for="instansi">Nama Instansi *</label>
                    <input type="text" name="instansi" id="instansi" value="" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="username">Username *</label>
                    <input type="text" name="username" id="username" value="" class="form-control" />
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
                        <input type="text" name="alamat_lengkap" id="map-search" value="" placeholder="Ketik Alamat..." class="form-control" />
                    </div>
                    <div class="col-sm-6">
                        <label for="">Kota</label>
                        <input type="text" name="kota" id="kota" value="" placeholder="Nama Kota..." class="form-control reg-input-city" />
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
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>/assets/lib/country/build/js/countrySelect.js"></script>
<script>
    $(document).ready(function() {
        $("#email").keyup(function() {
            if (validateemail()) {
                $("#email").css("border", "2px solid green");
                $("#emailMsg").html("<lable class='text-success'><span class='fas fa-fw fa-check '></span> Validated</lable>");
            } else {
                $("#email").css("border", "2px solid red");
                $("#emailMsg").html("<lable class='text-danger'><span class='fas fa-fw fa-times '></span> Un Validated</lable>");
            }
        });
    });

    function validateemail() {
        var email = $("#email").val();
        const re = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/
        if (re.test(email)) {
            return true;
        } else {
            return false;
        }
    }
    $("#country_selector").countrySelect({
        // defaultCountry: "jp",
        // onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
        // responsiveDropdown: true,
        preferredCountries: ['id', 'gb', 'us']
    });
</script>
<!-- <script>
    $(document).ready(function() {
        $('#email').change(function() {
            var email = $('#email').val();
            if (email != '') {
                $.ajax({
                    url: "<?//= base_url(); ?>Register/cek_email",
                    method: "POST",
                    data: {
                        email: email
                    },
                    success: function(data) {
                        $('#email_result').html(data);
                        console.log("A");
                    }

                })
            }
        });
    });
</script> -->