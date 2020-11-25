<div class="card">
    <div class="card card-body">
        <h5>Laporan Neraca Saldo</h5>
        <div class="pt-3">
            <button class="btn btn-success" id="download-laporan">Download</button>
        </div>
        <div id="laporan-view" class="pr-3 pl-3">
            <header class="text-center">
                <h1>TRIAL BALANCE</h1>
                <p>Period 01 - 31 October 2020</p>
            </header>
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
                            <?php for ($i=0; $i <5 ; $i++) {?> 
                            <tr>
                                <th scope="row">111</th>
                                <td class="text-left">KAS</td>
                                <td>$ 24.840.000</td>
                                <td>-</td>
                            </tr>
                            <?php } ?>
                            <tr class="font-weight-bold">
                                <td colspan="2" class="text-center">TOTAL AMOUNT</td>
                                <td>$ 88.600.000</td>
                                <td>$ 88.600.000</td>
                            </tr>
                        </tbody>
                    </table>

            </div>
        </div>
    </div>
</div>