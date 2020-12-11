<?= $this->extend('layout/app_layout.php') ?>


<!-- Sidebar -->
<?= $this->section('sidebar-menu') ?>
<li class="menu-item-has-children">
    <a href="/"><img src="/img/icons/icon-menu-dashboard.png" alt="">Dashboard</a>
</li>
<?php if (session('user_role') == '1') { ?>
    <li class="menu-item-has-children active">
        <a href="/user"> <img src="/img/icons/icon-menu-user.png" alt="">Data User</a>
    </li>
<?php } ?>

<?php if (session('user_role') != '3') { ?>
    <li class="menu-item-has-children">
        <a href="/akun"> <img src="/img/icons/icon-menu-akun.png" alt="">Data Akun</a>
    </li>
<?php } ?>

<?php if (session('user_role') != '3') { ?>
    <li class="menu-item-has-children">
        <a href="/jurnal_umum"> <img src="/img/icons/icon-menu-ju.png" alt="">Jurnal Umum</a>
    </li>
<?php } ?>

<?php if (session('user_role') != '3') { ?>
    <li class="menu-item-has-children">
        <a href="/jurnal_penyesuaian"> <img src="/img/icons/icon-menu-jp.png" alt="">Jurnal Penyesuaian</a>
    </li>
<?php } ?>

<li class="menu-item-has-children">
    <a href="/laporan"> <img src="/img/icons/icon-menu-laporan.png" alt="">Laporan</a>
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
                            <form action="/user" method="get">
                                <input required name="keyword" type="text" class="form-control" placeholder="Cari User">
                            </form>
                        </div>
                        <div class="col text-right">
                            <?php if (isset($_REQUEST['keyword'])) { ?>
                                <a href="/user" class="btn btn-success">Tampilkan Semua</a>
                            <?php } ?>
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
                    <?php if (empty($data_users)) { ?>
                        <tr>
                            <td colspan="6" class="text-center text-secondary">Maaf, Data belum tersedia!</td>
                        <tr>
                        <?php } else { ?>
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
                                                                    <input required type="text" name="nip" class="form-control" id="nip" value="<?= $x["nip"] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nama">Nama</label>
                                                                    <input required type="text" name="nama" class="form-control" id="nama" value="<?= $x["username"] ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="email">Email</label>
                                                                    <input required type="text" name="email" class="form-control" id="email" value="<?= $x["email"] ?>">
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
                                                                    <div class="d-flex">
                                                                        <input required type="text" name="password" class="form-control pw" id="password">
                                                                        <button type="button" class="btn btn-secondary ml-1 generate-pw" id="generate-pw">Generate</button>
                                                                    </div>
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
                        <?php } ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection('content') ?>

<?= $this->section('script') ?>
<script>
  const btnEditGenerate = document.getElementsByClassName("generate-pw")[0];
  const input = document.getElementsByClassName("pw")[0];
  btnEditGenerate.addEventListener("click", () => {
    let pw = generateId(8);
    input.value = pw;
    console.log("selesai!");
  })

  function dec2hex(dec) {
    return dec.toString(16).padStart(2, "0")
  }

  // generateId :: Integer -> String
  function generateId(len) {
    var arr = new Uint8Array((len || 40) / 2)
    window.crypto.getRandomValues(arr)
    return Array.from(arr, dec2hex).join('')
  }
</script>
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