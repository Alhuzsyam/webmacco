                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
                    <form action="<?= base_url('User/change') ?>" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <?= $this->session->flashdata('message'); ?>
                                <div class="form-group">
                                    <label for="">Current Password</label>
                                    <input type="password" name="current_password" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                    <?= form_error('current_password', ' <small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <label for="">New Password</label>
                                    <input type="password" name="new_password1" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                    <?= form_error('new_password1', ' <small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <label for="">Repeat New Password</label>
                                    <input type="password" name="new_password2" id="" class="form-control" placeholder="" aria-describedby="helpId">
                                    <?= form_error('new_password2', ' <small class="text-danger pl-3">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary btn-user btn-block">
                                        <i class="fas fa-fw fa-key"></i> Change</i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->