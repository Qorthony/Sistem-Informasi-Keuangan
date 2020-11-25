<div class="card">
    <div class="card card-body">
        <h5>Laporan Neraca Saldo</h5>
        <div class="pt-3">
            <button class="btn btn-success" id="download-laporan">Download</button>
        </div>
        <div id="laporan-view" class="pr-3 pl-3">
            <header class="text-center">
                <h1>Laporan Neraca Saldo</h1>
                <p>Periode 01-31 oktober</p>
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
                            <?php for ($i=0; $i <5 ; $i++) {?> 
                            <tr>
                                <th scope="row">111</th>
                                <td class="text-left">KAS</td>
                                <td>Rp. 24.840.000</td>
                                <td>-</td>
                            </tr>
                            <?php } ?>
                            <tr class="font-weight-bold">
                                <td colspan="2" class="text-center">JUMLAH</td>
                                <td>Rp. 88.600.000</td>
                                <td>Rp. 88.600.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>