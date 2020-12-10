<?= $this->extend('layout/app_layout.php') ?>



<!-- Menu Sidebar -->
<?= $this->section('sidebar-menu') ?>
<li class="menu-item-has-children active">
    <a href="/"> <img src="/img/icons/icon-menu-dashboard.png" alt=""> Dashboard</a>
</li>
<?php if (session('user_role')=='1') { ?>
<li class="menu-item-has-children">
    <a href="/user"> <img src="/img/icons/icon-menu-user.png"> Data User</a>
</li>
<?php } ?>

<?php if (session('user_role')!='3') { ?>
<li class="menu-item-has-children">
    <a href="/akun"> <img src="/img/icons/icon-menu-akun.png"> Data Akun</a>
</li>
<?php } ?>

<?php if (session('user_role')!='3') { ?>
<li class="menu-item-has-children">
    <a href="/jurnal_umum"> <img src="/img/icons/icon-menu-ju.png"> Jurnal Umum</a>
</li>
<?php } ?>

<?php if (session('user_role')!='3') { ?>
<li class="menu-item-has-children">
    <a href="/jurnal_penyesuaian"> <img src="/img/icons/icon-menu-jp.png"> Jurnal Penyesuaian</a>
</li>
<?php } ?>

<li class="menu-item-has-children">
    <a href="/laporan"> <img src="/img/icons/icon-menu-laporan.png"> Laporan</a>
</li>
<?= $this->endSection('sidebar-menu') ?>
<!-- End Menu Sidebar -->




<!-- Content -->
<?= $this->section('content') ?>
<h1 class="content-title">Dashboard</h1>
<div class="row pt-5">
    <!-- Pendapatan Hari Ini -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body widget-dashboard">
                <small>Pendapatan Hari ini</small>
                <div class="d-flex pt-2">
                    <img src="/img/icons/icon-widget-1.png" alt="widget-1">
                    <h5>Rp. <?= ($pendapatanHariIni['kredit'] == null) ? '0' : number_format($pendapatanHariIni['kredit']) ?> </h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Pengeluaran Hari ini -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body widget-dashboard">
                <small>Pengeluaran Hari ini</small>
                <div class="d-flex pt-2">
                    <img src="/img/icons/icon-widget-2.png" alt="widget-1">
                    <h5>Rp. <?= ($pengeluaranHariIni['debit'] == null) ? '0' : number_format($pengeluaranHariIni['debit']) ?></h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Pendapatan Bulan ini -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body widget-dashboard">
                <small>Pendapatan Bulan ini</small>
                <div class="d-flex pt-2">
                    <img src="/img/icons/icon-widget-3.png" alt="widget-1">
                    <h5>Rp. <?= ($pendapatanBulanIni['kredit'] == null) ? '0' : number_format($pendapatanBulanIni['kredit']) ?></h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Pengeluaran bulan ini -->
    <div class="col-12 col-sm-6 col-lg-3">
        <div class="card">
            <div class="card-body widget-dashboard">
                <small>Pengeluaran Bulan ini</small>
                <div class="d-flex pt-2">
                    <img src="/img/icons/icon-widget-4.png" alt="widget-1">
                    <h5>Rp. <?= ($pengeluaranBulanIni['debit'] == null) ? '0' : number_format($pengeluaranBulanIni['debit']) ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row pt-5">
    <div class="col-12 col-sm-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="mb-3">Pendapatan Bulanan </h4>
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content') ?>

<?= $this->section('script') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js" integrity="sha512-SuxO9djzjML6b9w9/I07IWnLnQhgyYVSpHZx0JV97kGBfTIsUYlWflyuW4ypnvhBrslz1yJ3R+S14fdCWmSmSA==" crossorigin="anonymous"></script>
<script>
    var ctx = document.getElementById("lineChart");
    ctx.height = 150;
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?php foreach ($grafikBulanan['bulan'] as $bulan) {
                            echo "'$bulan',";
                        } ?>],
            datasets: [{
                    label: "Pendapatan",
                    borderColor: "rgba(0,0,0,.09)",
                    borderWidth: "1",
                    backgroundColor: "rgba(0,0,0,.07)",
                    data: [<?php foreach ($grafikBulanan['pendapatan'] as $pdt) {
                                echo "$pdt,";
                            } ?>]
                },
                {
                    label: "Pengeluaran",
                    borderColor: "rgba(0, 194, 146, 0.9)",
                    borderWidth: "1",
                    backgroundColor: "rgba(0, 194, 146, 0.5)",
                    pointHighlightStroke: "rgba(26,179,148,1)",
                    data: [<?php foreach ($grafikBulanan['pengeluaran'] as $plrn) {
                                echo "$plrn,";
                            } ?>]
                }
            ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            }

        }
    });
</script>
<?= $this->endSection('script') ?>