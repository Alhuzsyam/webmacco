<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-lg-7 mt-5">
            <div class="card o-hidden border-0 shadow-lg my-5 ">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-md-5 bgc">
                            <div class="p-5">
                                <!-- <img src="<//?= base_url('assets/img/image/macco.png') ?>" class="mb-5" style="width: 138px;" alt=""> -->
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="p-5">
                                <div class="text-center mb-3">
                                    <span class="mytitle"><?= $title ?></span>
                                    <span class="mysubtitle"> <?= $this->session->userdata('reset_email') ?></span>
                                </div>

                                <form class="user" method="POST" action="<?= base_url('authentification/changePassword') ?>">
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="password1" name="password1" aria-describedby="emailHelp" placeholder="New Password" value="<?= set_value('email') ?>">
                                        <?= form_error('password1', ' <small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control" id="password2" name="password2" aria-describedby="emailHelp" placeholder="Repeat Password" value="<?= set_value('email') ?>">
                                        <?= form_error('password2', ' <small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                    <button type="submit" class="btn btn-success  btn-block">
                                        Change password
                                    </button>
                                </form>
                                <hr>
                                <!-- <div class="text-center">
                                    <a class="small" href="<?//= base_url('Authentification/'); ?>">Back to login</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>