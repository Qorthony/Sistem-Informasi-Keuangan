<div class="card">
    <div class="card card-body">
    <?php if(!empty($data)){ ?>
        <h5>Laporan Laba Rugi</h5>
        <div class="pt-3">
            <button class="btn btn-success" id="download-laporan">Download</button>
        </div>
        <div id="laporan-view" class="pr-3 pl-3">
            <header class="text-center">
                <h1>Laporan Laba Rugi</h1>
                <p>Periode <?= date('j/m/Y', strtotime($filter['start_date'])) . ' - ' . date('t/m/Y', strtotime($filter['end_date']))   ?> </p>
            </header>
            <div class="list-akun">
                <div class="item-akun mb-5">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" style="vertical-align: middle;">Pendapatan</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['pendapatan']['items'] as $pendapatan) {?>
                                <tr>
                                    <td><?= $pendapatan['nama_akun'] ?></td>
                                    <td class="text-right">Rp. <?= number_format($pendapatan['saldo']['kredit']) ?></td>
                                </tr>
                            <?php } ?>
                            <tr class="font-weight-bold">
                                <td>Jumlah Pendapatan</td>
                                <td class="text-right">Rp. <?= number_format($data['pendapatan']['total_items']['kredit']) ?> </td>
                            </tr>
                        </tbody>

                    </table>
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th scope="col" style="vertical-align: middle;">Beban</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['beban']['items'] as $beban) {?>    
                                <tr>
                                    <td> <?= $beban['nama_akun'] ?> </td>
                                    <td class="text-left">Rp. <?= number_format($beban['saldo']['debit']) ?> </td>
                                </tr>
                            <?php } ?>
                            <tr class="font-weight-bold">
                                <td>Jumlah Beban</td>
                                <td class="text-right">Rp. <?= number_format($data['beban']['total_items']['debit']) ?></td>
                            </tr>
                        </tbody>

                    </table>
                    <table class="table table-stripped">
                        <tr>
                            <td class="font-weight-bold">Laba Bersih</td>
                            <td class="font-weight-bold text-right">Rp. <?= number_format($data['laba_bersih']) ?></td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
        <?php }else{ ?>
            <hr>
            <h1 class="text-center text-secondary">Maaf, Laporan belum tersedia!</h1>
            <hr>
        <?php } ?>
    </div>
</div>