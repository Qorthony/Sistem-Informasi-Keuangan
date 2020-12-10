<div class="card">
    <div class="card card-body">
        <?php if (!empty($data)) { ?>
            <h5>Laporan Laba Rugi</h5>
            <div class="pt-3">
                <button class="btn btn-success" id="download-laporan">Download</button>
            </div>
            <div id="laporan-view" class="pr-3 pl-3">
                <header class="text-center">
                    <h1>INCOME STATEMENT</h1>
                    <p>Period <?= date('j/m/Y', strtotime($filter['start_date'])) . ' - ' . date('t/m/Y', strtotime($filter['end_date'])) ?> </p>
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
                                <th scope="col" style="vertical-align: middle;">Revenue</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['pendapatan']['items'] as $pendapatan) { ?>
                                <tr>
                                    <td><?= $pendapatan['nama_akun'] ?></td>
                                    <td class="text-right">$ <?= number_format($pendapatan['saldo']['kredit'], 2, '.', '') ?></td>
                                </tr>
                            <?php } ?>
                            <tr class="font-weight-bold">
                                <td>Total Revenue</td>
                                <td class="text-right">$ <?= number_format($data['pendapatan']['total_items']['kredit'], 2, '.', '') ?></td>
                            </tr>
                        </tbody>

                    </table>
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th scope="col" style="vertical-align: middle;">Expense</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['beban']['items'] as $beban) { ?>
                                <tr>
                                    <td> <?= $beban['nama_akun'] ?> </td>
                                    <td class="text-left">$ <?= number_format($beban['saldo']['debit'],2,'.','') ?> </td>
                                </tr>
                            <?php } ?>
                            <tr class="font-weight-bold">
                                <td>Total Expense</td>
                                <td class="text-right">$ <?= number_format($data['beban']['total_items']['debit'],2,'.','') ?></td>
                            </tr>
                        </tbody>

                    </table>
                    <table class="table table-stripped">
                        <tr>
                            <td class="font-weight-bold">Total Profit</td>
                            <td class="font-weight-bold text-right">$ <?= number_format($data['laba_bersih'],2,'.','') ?></td>
                        </tr>

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