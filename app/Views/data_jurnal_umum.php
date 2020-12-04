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
<li class="menu-item-has-children active">
    <a href="/jurnal_umum"> <i class="menu-icon fa fa-cogs"></i>Jurnal Umum</a>
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

<h1 class="content-title">Kelola Data Jurnal</h1>
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
                            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahJurnalUmum"><i data-feather="plus-circle"></i> Tambah Data</button>
                        </div>
                        <?= $this->include("components/jurnal_umum/modal_tambah_jurnal_umum.php") ?>
                    </div>
                    <thead>
                        <tr>
                            <th scope="col">Tanggal</th>
                            <th scope="col">No Akun</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Debet</th>
                            <th scope="col">Kredit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_jurnal_umum as $key => $x) : ?>
                            <tr>
                                <!-- <th scope="row"><?= $key + 1 ?></th> -->
                                <td><?= $x["tgl_transaksi"] ?> </td>
                                <td><?= $x["no_akun"] ?></td>
                                <td><?= $x["debit"] ?></td>
                                <td><?= $x["kredit"] ?></td>
                                <td><?= $x["keterangan_transaksi"] ?></td>
                                <td>
                                    <button class="btn btn-light" data-toggle="modal" data-target="#editJurnalUmum<?= $key ?>"><i data-feather="edit-2" stroke-width="2"></i></button>
                                    <button class="btn btn-light" data-toggle="modal" data-target="#hapusJurnalUmum<?= $key ?>"><i data-feather="trash-2" stroke-width="2"></i></button>
                                    <!-- Modal Edit User-->
                                    <div class="modal fade" id="editJurnalUmum<?= $key ?>" tabindex="-1" aria-labelledby="editJurnalUmumLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header d-flex">
                                                    <h5 class="modal-title" id="editJurnalUmumLabel">Edit Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="/jurnal_umum/edit/<?= $x["no_transaksi"] ?>" method="POST">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="tanggal">Tanggal</label>
                                                            <input type="date" name="tanggal" class="form-control" id="tgl_transaksi" value="<?= $x["tgl_transaksi"] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="keterangan">Keterangan</label>
                                                            <input type="text" name="keterangan" class="form-control" id="keterangan" value="<?= $x["keterangan_transaksi"] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="no_akun">No Akun</label>
                                                            <input type="text" name="no_akun" class="form-control" id="no_akun" value="<?= $x["no_akun"] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="debit">Debet</label>
                                                            <input type="number" name="debit" class="form-control" id="debit" value="<?= $x["debit"] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="kredit">Kredit</label>
                                                            <input type="number" name="kredit" class="form-control" id="kredit" value="<?= $x["kredit"] ?>">
                                                            </select>
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
                                    <div class="modal fade" id="hapusJurnalUmum<?= $key ?>" tabindex="-1" aria-labelledby="hapusJurnalUmumLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header d-flex" style="background-color: rgba(46,94,153,0.65);">
                                                    <h5 class="modal-title" id="hapusJurnalUmumLabel">Konfirmasi</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-body">Apakah anda yakin menghapus data ini?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="/akun/del/<?= $x["no_transaksi"] ?>" class="btn btn-danger">Hapus</a>
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