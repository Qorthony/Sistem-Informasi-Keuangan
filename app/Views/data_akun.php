<?= $this->extend('layout/app_layout.php') ?>


<!-- Sidebar -->
<?= $this->section('sidebar-menu') ?>
<li class="menu-item-has-children">
    <a href="/"><i class="menu-icon fa fa-laptop"></i>Dashboard</a>
</li>
<li class="menu-item-has-children">
    <a href="/user"> <i class="menu-icon fa fa-cogs"></i>Data User</a>
</li>
<li class="menu-item-has-children active">
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

<h1 class="content-title">Kelola Data Akun</h1>
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
                            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahAkun"><i data-feather="plus-circle"></i> Tambah Data</button>
                        </div>
                        <?= $this->include("components/akun/modal_tambah_akun.php") ?>
                    </div>
                    <thead>
                        <tr>
                            <th scope="col">No Akun</th>
                            <th scope="col">Nama Akun</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data_akun as $key => $x) : ?>
                            <tr>
                                <!-- <th scope="row"><?= $key + 1 ?></th> -->
                                <td> <?= $x["no_akun"] ?> </td>
                                <td><?= $x["nama_akun"] ?></td>
                                <td><?= $x["keterangan"] ?></td>
                                <td>
                                    <button class="btn btn-light" data-toggle="modal" data-target="#editAkun<?= $key ?>"><i data-feather="edit-2" stroke-width="2"></i></button>
                                    <button class="btn btn-light" data-toggle="modal" data-target="#hapusAkun<?= $key ?>"><i data-feather="trash-2" stroke-width="2"></i></button>
                                    <!-- Modal Edit User-->
                                    <div class="modal fade" id="editAkun<?= $key ?>" tabindex="-1" aria-labelledby="editAkunLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header d-flex">
                                                    <h5 class="modal-title" id="editAkunLabel">Edit Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="/akun/edit/<?= $x["no_akun"] ?>" method="POST">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="no_akun">No Akun</label>
                                                            <input type="text" name="no_akun" class="form-control" id="no_akun" value="<?= $x["no_akun"] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nama_akun">Nama Akun</label>
                                                            <input type="text" name="nama_akun" class="form-control" id="nama_akun" value="<?= $x["nama_akun"] ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="keterangan">Keterangan</label>
                                                            <input type="text" name="keterangan" class="form-control" id="keterangan" value="<?= $x["keterangan"] ?>">
                                                            <!-- <select name="keterangan" class="form-control" id="keterangan"> -->
                                                                <!-- <?php switch ($x["keterangan"]) {
                                                                    case 1: ?>
                                                                        <option value="1" selected>Kas</option>
                                                                        <option value="2">Piutang Usaha</option>
                                                                        <option value="3">Perlengkapan</option>
                                                                        <option value="4">Peralatan</option>
                                                                        <option value="5">Akumulasi Penyusutan Peralatan</option>
                                                                        <option value="6">Utang Usaha</option>
                                                                        <option value="7">Modal</option>
                                                                        <option value="8">Pendapatan Jasa</option>
                                                                        <option value="9">Beban</option>
                                                                        <option value="10">Beban Perlengkapan</option>
                                                                        <option value="11">Beban Penyusutan Peralatan</option>
                                                                    <?php
                                                                        break;
                                                                    case 2: ?>
                                                                        <option value="1">Kas</option>
                                                                        <option value="2" selected>Piutang Usaha</option>
                                                                        <option value="3">Perlengkapan Usaha</option>
                                                                        <option value="4">Peralatan Usaha</option>
                                                                        <option value="5">Akumulasi Peralatan</option>
                                                                        <option value="6">Utang Usaha</option>
                                                                        <option value="7">Modal</option>
                                                                        <option value="8">Pendapatan Jasa</option>
                                                                        <option value="9">Beban</option>
                                                                        <option value="10">Beban Perlengkapan</option>
                                                                        <option value="11">Beban Penyusutan Peralatan</option>
                                                                    <?php
                                                                        break;
                                                                    case 3: ?>
                                                                        <option value="1">Kas</option>
                                                                        <option value="2">Piutang Usaha</option>
                                                                        <option value="3" selected>Perlengkapan Usaha</option>
                                                                        <option value="4">Peralatan Usaha</option>
                                                                        <option value="5">Akumulasi Peralatan</option>
                                                                        <option value="6">Utang Usaha</option>
                                                                        <option value="7">Modal</option>
                                                                        <option value="8">Pendapatan Jasa</option>
                                                                        <option value="9">Beban</option>
                                                                        <option value="10">Beban Perlengkapan</option>
                                                                        <option value="11">Beban Penyusutan Peralatan</option>
                                                                    <?php
                                                                        break;
                                                                    case 4: ?>
                                                                        <option value="1">Kas</option>
                                                                        <option value="2">Piutang Usaha</option>
                                                                        <option value="3">Perlengkapan Usaha</option>
                                                                        <option value="4" selected>Peralatan Usaha</option>
                                                                        <option value="5">Akumulasi Peralatan</option>
                                                                        <option value="6">Utang Usaha</option>
                                                                        <option value="7">Modal</option>
                                                                        <option value="8">Pendapatan Jasa</option>
                                                                        <option value="9">Beban</option>
                                                                        <option value="10">Beban Perlengkapan</option>
                                                                        <option value="11">Beban Penyusutan Peralatan</option>
                                                                    <?php
                                                                        break;
                                                                    case 5: ?>
                                                                        <option value="1">Kas</option>
                                                                        <option value="2">Piutang Usaha</option>
                                                                        <option value="3">Perlengkapan Usaha</option>
                                                                        <option value="4">Peralatan Usaha</option>
                                                                        <option value="5" selected>Akumulasi Peralatan</option>
                                                                        <option value="6">Utang Usaha</option>
                                                                        <option value="7">Modal</option>
                                                                        <option value="8">Pendapatan Jasa</option>
                                                                        <option value="9">Beban</option>
                                                                        <option value="10">Beban Perlengkapan</option>
                                                                        <option value="11">Beban Penyusutan Peralatan</option>
                                                                    <?php
                                                                        break;
                                                                    case 6: ?>
                                                                        <option value="1">Kas</option>
                                                                        <option value="2">Piutang Usaha</option>
                                                                        <option value="3">Perlengkapan Usaha</option>
                                                                        <option value="4">Peralatan Usaha</option>
                                                                        <option value="5">Akumulasi Peralatan</option>
                                                                        <option value="6" selected>Utang Usaha</option>
                                                                        <option value="7">Modal</option>
                                                                        <option value="8">Pendapatan Jasa</option>
                                                                        <option value="9">Beban</option>
                                                                        <option value="10">Beban Perlengkapan</option>
                                                                        <option value="11">Beban Penyusutan Peralatan</option>
                                                                    <?php
                                                                        break;
                                                                    case 7: ?>
                                                                        <option value="1">Kas</option>
                                                                        <option value="2">Piutang Usaha</option>
                                                                        <option value="3">Perlengkapan Usaha</option>
                                                                        <option value="4">Peralatan Usaha</option>
                                                                        <option value="5">Akumulasi Peralatan</option>
                                                                        <option value="6">Utang Usaha</option>
                                                                        <option value="7" selected>Modal</option>
                                                                        <option value="8">Pendapatan Jasa</option>
                                                                        <option value="9">Beban</option>
                                                                        <option value="10">Beban Perlengkapan</option>
                                                                        <option value="11">Beban Penyusutan Peralatan</option>
                                                                    <?php
                                                                        break;
                                                                    case 8: ?>
                                                                        <option value="1">Kas</option>
                                                                        <option value="2">Piutang Usaha</option>
                                                                        <option value="3">Perlengkapan Usaha</option>
                                                                        <option value="4">Peralatan Usaha</option>
                                                                        <option value="5">Akumulasi Peralatan</option>
                                                                        <option value="6">Utang Usaha</option>
                                                                        <option value="7">Modal</option>
                                                                        <option value="8" selected>Pendapatan Jasa</option>
                                                                        <option value="9">Beban</option>
                                                                        <option value="10">Beban Perlengkapan</option>
                                                                        <option value="11">Beban Penyusutan Peralatan</option>
                                                                    <?php
                                                                        break;
                                                                    case 9: ?>
                                                                        <option value="1">Kas</option>
                                                                        <option value="2">Piutang Usaha</option>
                                                                        <option value="3">Perlengkapan Usaha</option>
                                                                        <option value="4">Peralatan Usaha</option>
                                                                        <option value="5">Akumulasi Peralatan</option>
                                                                        <option value="6">Utang Usaha</option>
                                                                        <option value="7">Modal</option>
                                                                        <option value="8">Pendapatan Jasa</option>
                                                                        <option value="9" selected>Beban</option>
                                                                        <option value="10">Beban Perlengkapan</option>
                                                                        <option value="11">Beban Penyusutan Peralatan</option>
                                                                    <?php
                                                                        break;
                                                                    case 10: ?>
                                                                        <option value="1">Kas</option>
                                                                        <option value="2">Piutang Usaha</option>
                                                                        <option value="3">Perlengkapan Usaha</option>
                                                                        <option value="4">Peralatan Usaha</option>
                                                                        <option value="5">Akumulasi Peralatan</option>
                                                                        <option value="6">Utang Usaha</option>
                                                                        <option value="7">Modal</option>
                                                                        <option value="8">Pendapatan Jasa</option>
                                                                        <option value="9">Beban</option>
                                                                        <option value="10" selected>Beban Perlengkapan</option>
                                                                        <option value="11">Beban Penyusutan Peralatan</option>
                                                                    <?php
                                                                        break;
                                                                    case 11: ?>
                                                                        <option value="1">Kas</option>
                                                                        <option value="2">Piutang Usaha</option>
                                                                        <option value="3">Perlengkapan Usaha</option>
                                                                        <option value="4">Peralatan Usaha</option>
                                                                        <option value="5">Akumulasi Peralatan</option>
                                                                        <option value="6">Utang Usaha</option>
                                                                        <option value="7">Modal</option>
                                                                        <option value="8">Pendapatan Jasa</option>
                                                                        <option value="9">Beban</option>
                                                                        <option value="10">Beban Perlengkapan</option>
                                                                        <option value="11" selected>Beban Penyusutan Peralatan</option>
                                                                    <?php
                                                                        break;

                                                                    default:
                                                                        # code...
                                                                        break;
                                                                } ?> -->

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
                                    <div class="modal fade" id="hapusAkun<?= $key ?>" tabindex="-1" aria-labelledby="hapusAkunLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header d-flex" style="background-color: rgba(46,94,153,0.65);">
                                                    <h5 class="modal-title" id="hapusAkunLabel">Konfirmasi</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-body">Apakah anda yakin menghapus data ini?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="/akun/del/<?= $x["no_akun"] ?>" class="btn btn-danger">Hapus</a>
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