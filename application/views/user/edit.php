                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>
                    <div class="row">
                        <div class="col-lg-8">
                            <?= form_open_multipart('user/edit') ?>
                            <div class="form-group">
                                <input type="text" name="email" id="email" class="form-control" placeholder="" aria-describedby="helpId" value="<?= $user['email']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <input type="text" name="name" id="name" class="form-control" placeholder="" aria-describedby="helpId" value="<?= $user['name']; ?>">
                                <?= form_error('name', ' <small class="text-danger pl-0">', '</small>') ?>
                            </div>
                            <div class="fotm-group row">
                                <div class="col-sm-2">
                                    Picture
                                </div>
                                <div class="col-sm-10">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <img src=" <?= base_url('assets/img/profile/') . $user['image']; ?>" class="img-thumbnail">
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" for="image" id="image" name="image">
                                                <label class="custom-file-label" for="customFile">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row justify-content-end mt-2">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                    <a href="<?= base_url('user/lengkapi') ?>" id="lengkapi" class="btn btn-primary">Lengkapi</a>
                                    <input type="hidden" id="role" value="<?= $user['role_id']; ?>">
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->