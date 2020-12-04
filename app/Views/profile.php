<?= $this->extend('layout/app_layout.php') ?>



<!-- Sidebar -->
<?= $this->section('sidebar-menu') ?>
<li class="menu-item-has-children">
    <a href="/"><i class="menu-icon fa fa-laptop"></i>Dashboard</a>
</li>
<li class="menu-item-has-children">
    <a href="/user"> <i class="menu-icon fa fa-cogs"></i>Data User</a>
</li>
<li class="menu-item-has-children">
    <a href="/akun"> <i class="menu-icon fa fa-cogs"></i>Data Akun</a>
</li>
<li class="menu-item-has-children">
    <a href="/jurnal_umum"> <i class="menu-icon fa fa-cogs"></i>Jurnal Umum</a>
</li>
<li class="menu-item-has-children">
    <a href="/laporan"> <i class="menu-icon fa fa-cogs"></i>Laporan</a>
</li>
<?= $this->endSection('sidebar-menu') ?>
<!-- Sidebar -->





<!-- Content -->
<?= $this->section('content') ?>

<!-- Alert -->
<?php if (session('errors')) { ?>
    <?= $this->include("components/alert_error.php") ?>
<?php } ?>

<?php if (session('success')) { ?>
    <?= $this->include("components/alert_success.php") ?>
<?php } ?>
<!-- Alert -->

<h1 class="content-title">Profile User</h1>
<div class="row pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-lg-7">
                        <div class=" text-light pt-2 pb-2 pl-2" style="background-color: #2E5E99;">
                            <h4>Update Profile Anda</h4>
                        </div>
                        <div class="pt-3 pb-3 text-center">
                            <img src="/img/avatar.png" alt="avatar">
                        </div>
                        <div>
                            <form action="/profile/update" method="POST">
                                <div class="form-group row">
                                    <label for="nip" class="col-sm-3 col-form-label">NIP</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nip" class="form-control" id="nip" value="<?= $profile["nip"] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="nama" class="form-control" id="nama" value="<?= $profile["username"] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="Email" name="email" class="form-control" id="email" value="<?= $profile["email"] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="keterangan">
                                            <option value="1" <?= $selected = ($profile["jenis_user"]==1) ? "selected" : "" ; ?> >Admin</option>
                                            <option value="2" <?= $selected = ($profile["jenis_user"]==2) ? "selected" : "" ; ?> >Accounting</option>
                                            <option value="3" <?= $selected = ($profile["jenis_user"]==3) ? "selected" : "" ; ?> >Board</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 text-right">
                                        <button type="submit" class="btn btn-success"> <i data-feather="save"></i> Simpan Data</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <div class="text-light pt-2 pb-2 pl-2" style="background-color: #2E5E99;">
                            <h4>Ganti Password</h4>
                        </div>
                        <div class="pt-3 pb-3">
                            <form action="/profile/changePass" method="POST">
                                <div class="form-group row">
                                    <label for="password_baru" class="col-sm-4 col-form-label">Password Baru</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="password_baru" class="form-control" id="password_baru">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="konfirmasi_password" class="col-sm-4 col-form-label">Konfirmasi Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" name="konfirmasi_password" class="form-control" id="konfirmasi_password">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 text-right">
                                        <button type="submit" class="btn btn-success"> <i data-feather="save"></i> Ganti Password</button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?= $this->endSection('content') ?>

<!-- Script -->
<?= $this->section('script') ?>
<?php if (session('errors')) { ?>
    <script>
        jQuery('#alertError').modal('show')
    </script>
<?php } ?>

<?php if (session('success')) { ?>
    <script>
        jQuery('#alertSuccess').modal('show')
    </script>
<?php } ?>
<?= $this->endSection('script') ?>
<!-- End Script -->