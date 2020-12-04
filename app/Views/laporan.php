<?= $this->extend("layout/app_layout.php") ?>


<!-- Sidebar -->
<?= $this->section('sidebar-menu') ?>
<li class="menu-item-has-children">
    <a href="/"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
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
<li class="menu-item-has-children active">
    <a href="/laporan"> <i class="menu-icon fa fa-cogs"></i>Laporan</a>
</li>
<?= $this->endSection('sidebar-menu') ?>
<!-- Sidebar -->


<?= $this->section("content") ?>

<!-- Alert -->
<?php if (session('errors')) { ?>
    <?= $this->include("components/alert_error.php") ?>
<?php } ?>

<?php if (session('success')) { ?>
    <?= $this->include("components/alert_success.php") ?>
<?php } ?>
<!-- Alert -->

<h1 class="content-title">Laporan</h1>
<div class="row pt-5">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5>Filter Laporan</h5>
                <form action="/laporan">
                    <div class="d-flex align-items-end pt-3">
                        <div class="form-group mr-3">
                            <label for="start">Periode Mulai</label>
                            <input type="month" name="start" value="<?= CodeIgniter\I18n\Time::now()->getYear() . "-" . CodeIgniter\I18n\Time::now()->getMonth() ?>" max="<?= CodeIgniter\I18n\Time::now()->getYear() . "-" . CodeIgniter\I18n\Time::now()->getMonth() ?>" class="form-control" id="start">
                        </div>
                        <div class="form-group mr-3">
                            <label for="end">Periode Selesai</label>
                            <input type="month" name="end" value="<?= CodeIgniter\I18n\Time::now()->getYear() . "-" . CodeIgniter\I18n\Time::now()->getMonth() ?>" max="<?= CodeIgniter\I18n\Time::now()->getYear() . "-" . CodeIgniter\I18n\Time::now()->getMonth() ?>" class="form-control" id="end">
                        </div>
                        <div class="form-group mr-3">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" class="form-control" id="kategori">
                                <option>...</option>
                                <option value="bb" <?= ($laporan == "bb") ? "selected" : ""; ?>>Laporan Buku Besar</option>
                                <option value="ns" <?= ($laporan == "ns") ? "selected" : ""; ?>>Laporan Neraca</option>
                                <option value="lr" <?= ($laporan == "lr") ? "selected" : ""; ?>>Laporan Laba Rugi</option>
                            </select>
                        </div>
                        <div class="form-group mr-3">
                            <label for="mata_uang">Mata Uang</label>
                            <select class="form-control" name="mata_uang" id="mata_uang">
                                <option value="idr" <?= ($mata_uang == "idr") ? "selected" : ""; ?>>IDR</option>
                                <option value="usd" <?= ($mata_uang == "usd") ? "selected" : ""; ?>>USD</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mb-3">Tampilkan</button>
                    </div>
                </form>
            </div>
        </div>
        <?php if ($laporan == "bb" && $mata_uang == "idr") { ?>
            <?= $this->include("components/laporan/buku_besar.php") ?>
        <?php } elseif ($laporan == "bb" && $mata_uang == "usd") { ?>
            <?= $this->include("components/laporan/buku_besar_en.php") ?>
        <?php } ?>

        <?php if ($laporan == "ns" && $mata_uang == "idr") { ?>
            <?= $this->include("components/laporan/neraca_saldo.php") ?>
        <?php } elseif ($laporan == "ns" && $mata_uang == "usd") { ?>
            <?= $this->include("components/laporan/neraca_saldo_en.php") ?>
        <?php } ?>

        <?php if ($laporan == "lr" && $mata_uang == "idr") { ?>
            <?= $this->include("components/laporan/laba_rugi.php") ?>
        <?php } elseif ($laporan == "lr" && $mata_uang == "usd") { ?>
            <?= $this->include("components/laporan/laba_rugi_en.php") ?>
        <?php } ?>


    </div>
</div>
<?= $this->endSection("content") ?>

<!-- Script -->
<?= $this->section('script') ?>
<script>
    document.getElementById("download-laporan").addEventListener("click", () => {
        const printArea = document.getElementById("laporan-view")
        const initPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0')
        initPrint.document.write('<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">')
        initPrint.document.write(printArea.innerHTML)
        initPrint.document.close()
        initPrint.focus()
        initPrint.print()
        // initPrint.close()
    })
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
<!-- End Script -->