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
                                <img src="<?= base_url('assets/img/image/macco.png') ?>" class="mb-0" style="width: 138px;" alt="">
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="p-5">
                                <div class="text-center">
                                    <p class="mytitle">Login Page</p>
                                </div>
                                <form class="user" method="POST" action="<?= base_url('authentification') ?>">
                                    <div class="form-group">
                                        <label class="mysubtitle" for="">Email</label>
                                        <input type="text" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="" value="<?= set_value('email') ?>">
                                        <?= form_error('email', ' <small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="mysubtitle" for="">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="">
                                        <?= form_error('password', ' <small class="text-danger pl-3">', '</small>') ?>
                                    </div>
                                    <button type="submit" class="btn btn-success  btn-block">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="<?= base_url('Authentification/register'); ?>">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>