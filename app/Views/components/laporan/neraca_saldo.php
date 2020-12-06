<div class="card">
    <div class="card card-body">
        <?php if(!empty($data)){ ?>
        <h5>Laporan Neraca Saldo</h5>
        <div class="pt-3">
            <button class="btn btn-success" id="download-laporan">Download</button>
        </div>
        <div id="laporan-view" class="pr-3 pl-3">
            <header class="text-center">
                <h1>Laporan Neraca Saldo</h1>
                <p>Periode <?= date('j/m/Y', strtotime($filter['start_date'])) . ' - ' . date('t/m/Y', strtotime($filter['end_date']))   ?></p>
            </header>
            <div class="list-akun">
                <div class="item-akun mb-5">
                    
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" style="vertical-align: middle;">NO AKUN</th>
                                <th scope="col" style="vertical-align: middle;">NAMA AKUN</th>
                                <th scope="col" style="vertical-align: middle;">DEBET</th>
                                <th scope="col" style="vertical-align: middle;">KREDIT</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['data_akun'] as $key => $item) {?> 
                            <tr>
                                <th scope="row"><?= $item['no_akun'] ?></th>
                                <td class="text-left"> <?= $item['nama_akun'] ?> </td>
                                <td>Rp. <?= number_format($item['saldo']['debit'])  ?> </td>
                                <td>Rp. <?= number_format($item['saldo']['kredit']) ?></td>
                            </tr>
                            <?php } ?>
                            <tr class="font-weight-bold">
                                <td colspan="2" class="text-center">JUMLAH</td>
                                <td>Rp. <?= number_format($data['jumlah_debit']) ?></td>
                                <td>Rp. <?= number_format($data['jumlah_kredit']) ?></td>
                            </tr>
                        </tbody>
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