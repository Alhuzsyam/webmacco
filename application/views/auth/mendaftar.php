<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                <div class="col-lg-4 bgc2">

                </div>
                <div class="col-lg-8">
                    <div class="p-5">
                        <div class="mytitle text-left" style="color:#1cc88a;">HELLO</div>
                        <div class="mytitle text-left">Regist Your Account</div><br>
                        <form class="user" method="POST" action="<?= base_url('authentification/register'); ?>">
                            <div class="form-group">
                                <label class="mysubtitle" for="">Name</label>
                                <input type="text" class="form-control " id="name" placeholder="" name="name" value="<?= set_value('name') ?>">
                                <?= form_error('name', ' <small class="text-danger pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label class="mysubtitle" for="">Email</label>
                                <input type="text" class="form-control " id="email" placeholder="" name="email" value="<?= set_value('email') ?>">
                                <?= form_error('email', ' <small class="text-danger pl-3">', '</small>') ?>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label class="mysubtitle" for="">Password</label>
                                    <input type="password" class="form-control" id="password1" placeholder="" name="password1">
                                    <?= form_error('password1', ' <small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <div class="col-sm-6">
                                    <label class="mysubtitle" for="">Repeat password</label>
                                    <input type="password" class="form-control" id="pasword2" name="password2" placeholder="">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">
                                Register Account
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('authentification'); ?>">Already have an account? Login!</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>