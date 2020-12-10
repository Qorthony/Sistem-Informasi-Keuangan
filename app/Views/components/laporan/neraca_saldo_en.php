<div class="card">
    <div class="card card-body">
        <?php if (!empty($data)) { ?>
            <h5>Laporan Neraca Saldo</h5>
            <div class="pt-3">
                <button class="btn btn-success" id="download-laporan">Download</button>
            </div>
            <div id="laporan-view" class="pr-3 pl-3">
                <header class="text-center">
                    <h1>TRIAL BALANCE</h1>
                    <p>Period <?= date('j/m/Y', strtotime($filter['start_date'])) . ' - ' . date('t/m/Y', strtotime($filter['end_date']))   ?></p>
                </header>
                <div class="row justify-content-end">
                    <div class="col-3">
                        <p>Date : <?= date('d M Y', strtotime("now")) ?> </p>
                        <p>Rate : Rp. <?= number_format($data['rate'],0,',','.')  ?> </p>
                    </div>
                </div>
                <div class="list-akun">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" style="vertical-align: middle;">NO ACCOUNT</th>
                                <th scope="col" style="vertical-align: middle;">ACCOUNT NAME</th>
                                <th scope="col" style="vertical-align: middle;">DEBET</th>
                                <th scope="col" style="vertical-align: middle;">CREDIT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['data_akun'] as $key => $item) { ?>
                                <tr>
                                    <th scope="row"><?= $item['no_akun'] ?></th>
                                    <td class="text-left"><?= $item['nama_akun'] ?></td>
                                    <td>$ <?= number_format($item['saldo']['debit'],2,',','')  ?></td>
                                    <td>$ <?= number_format($item['saldo']['kredit'],2,',','') ?></td>
                                </tr>
                            <?php } ?>
                            <tr class="font-weight-bold">
                                <td colspan="2" class="text-center">TOTAL AMOUNT</td>
                                <td>$ <?= number_format($data['jumlah_debit'],2,',','') ?></td>
                                <td>$ <?= number_format($data['jumlah_kredit'],2,',','') ?></td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        <?php } else { ?>
            <hr>
            <h1 class="text-center text-secondary">Sorry, The report is not available!</h1>
            <hr>
        <?php } ?>
    </div>
</div>