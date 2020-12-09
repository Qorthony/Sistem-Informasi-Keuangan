<?= $this->extend('layout/app_layout.php') ?>


<!-- Sidebar -->
<?= $this->section('sidebar-menu') ?>
<li class="menu-item-has-children">
    <a href="/"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
</li>
<li class="menu-item-has-children active">
    <a href="/user"> <i class="menu-icon fa fa-cogs"></i>Data User</a>
</li>
<li class="menu-item-has-children">
    <a href="/akun"> <i class="menu-icon fa fa-cogs"></i>Data Akun</a>
</li>
<li class="menu-item-has-children">
    <a href="/jurnal_umum"> <i class="menu-icon fa fa-cogs"></i>Jurnal Umum</a>
</li>
<li class="menu-item-has-children">
    <a href="/jurnal_penyesuaian"> <i class="menu-icon fa fa-cogs"></i>Jurnal Penyesuaian</a>
</li>
<li class="menu-item-has-children">
    <a href="/laporan"> <i class="menu-icon fa fa-cogs"></i>Laporan</a>
</li>
<?= $this->endSection('sidebar-menu') ?>
<!-- End Sidebar -->



<!-- Content -->
<?= $this->section('content') ?>

<?php if (session('errors')) { ?>
    <?= $this->include("components/alert_error.php") ?>
<?php } ?>

<?php if (session('success')) { ?>
    <?= $this->include("components/alert_success.php") ?>
<?php } ?>

<h1 class="content-title">Kelola Data User</h1>
<div class="row pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped">
                    <div class="row pb-3 pt-2">
                        <div class="col-3">
                            <input type="text" class="form-control">
                        </div>
                        <div class="col text-right">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahUser"><i data-feather="plus-circle"></i> Tambah Data</button>
                        </div>
                        <?= $this->include("components/user/modal_tambah_user.php") ?>
                    </div>
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIP</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_users as $key => $x) : ?>
                            <tr>
                                <th scope="row"><?= $key + 1 ?></th>
                                <td> <?= $x["nip"] ?> </td>
                                <td><?= $x["username"] ?></td>
                                <td><?= $x["email"] ?></td>
                                <td><?= $x["jenis_user"] ?></td>
                                <td>
                                    <button class="btn btn-light" data-toggle="modal" data-target="#editUser<?= $key ?>"><i data-feather="edit-2" stroke-width="2"></i></button>
                                    <button class="btn btn-light" data-toggle="modal" data-target="#hapusUser<?= $key ?>"><i data-feather="trash-2" stroke-width="2"></i></button>
                                    <!-- Modal Edit User-->
                                    <div class="modal fade" id="editUser<?= $key ?>" tabindex="-1" aria-labelledby="editUserLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header d-flex">
                                                    <h5 class="modal-title" id="editUserLabel">Edit Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="/user/edit/<?= $x["nip"] ?>" method="POST">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="nip">NIP</label>
                                                            <input type="text" name="nip" class="form-control" id="nip" value="<?= $x["nip"] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama">Nama</label>
                                                            <input type="text" name="nama" class="form-control" id="nama" value="<?= $x["username"] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="text" name="email" class="form-control" id="email" value="<?= $x["email"] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="keterangan">Keterangan</label>
                                                            <select name="keterangan" class="form-control" id="keterangan">
                                                                <?php switch ($x["jenis_user"]) {
                                                                    case 1: ?>
                                                                        <option value="1" selected>Admin</option>
                                                                        <option value="2">Accounting</option>
                                                                        <option value="3">Board</option>
                                                                    <?php
                                                                        break;
                                                                    case 2: ?>
                                                                        <option value="1">Admin</option>
                                                                        <option value="2" selected>Accounting</option>
                                                                        <option value="3">Board</option>
                                                                    <?php
                                                                        break;
                                                                    case 3: ?>
                                                                        <option value="1">Admin</option>
                                                                        <option value="2">Accounting</option>
                                                                        <option value="3" selected>Board</option>
                                                                <?php
                                                                        break;

                                                                    default:
                                                                        # code...
                                                                        break;
                                                                } ?>

                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="password">Password</label>
                                                            <input type="text" name="nama" class="form-control" id="password" value="<?= $x["username"] ?>">
                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-success">Ubah</button>
                                                        <button type="button" class="btn btn-light" data-dismiss="modal">Keluar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal Edit User -->
                                    <!-- Modal Hapus User -->
                                    <div class="modal fade" id="hapusUser<?= $key ?>" tabindex="-1" aria-labelledby="hapusUserLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header d-flex" style="background-color: rgba(46,94,153,0.65);">
                                                    <h5 class="modal-title" id="hapusUserLabel">Konfirmasi</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-body">Apakah anda yakin menghapus data ini?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="/user/del/<?= $x["nip"] ?>" class="btn btn-danger">Hapus</a>
                                                    <button type="button" class="btn btn-light" data-dismiss="modal">Tidak</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Modal hapus user -->
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content') ?>

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