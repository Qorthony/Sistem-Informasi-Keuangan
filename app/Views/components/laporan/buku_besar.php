<div class="card">
    <div class="card card-body">
    <?php if(!empty($data)){ ?>
        <h5>Laporan Buku Besar</h5>
        <form>
            <div class="row pt-4">
                <div class="col-12 col-md-4">
                    <select name="akun" class="form-control" id="akun">
                        <option value="semua">Semua</option>
                        <?php foreach ($data['buku_besar'] as $akun) : ?>
                            <option value="<?= str_replace(" ", "-", $akun['nama_akun']) ?>"><?= $akun['nama_akun'] ?></option>
                        <?php endforeach; ?>

                    </select>
                </div>
            </div>
        </form>
        <div class="pt-3">
            <button class="btn btn-success" id="download-laporan">Download</button>
        </div>
        <div id="laporan-view" class="pr-3 pl-3">
            <header class="text-center">
                <h1>Laporan Buku Besar</h1>
                <p>Periode <?= date('j/m/Y', strtotime($filter['start_date'])) . ' - ' . date('t/m/Y', strtotime($filter['end_date']))   ?></p>
            </header>
            <div class="list-akun">
                <?php foreach ($data['buku_besar'] as $akun) : ?>
                    <div class="item-akun mb-5" id="<?= str_replace(" ", "-", $akun['nama_akun']) ?>" style="display: none;">
                        <div class="row">
                            <div class="col text-left">Akun : <?= $akun['nama_akun'] ?> </div>
                            <div class="col text-right">No Akun : <?= $akun['no_akun'] ?> </div>
                        </div>
                        <table class="table table-striped">
                            <thead class="text-center">
                                <tr>
                                    <th scope="col" rowspan="2" style="vertical-align: middle;">TANGGAL</th>
                                    <th scope="col" rowspan="2" style="vertical-align: middle;">KETERANGAN</th>
                                    <th scope="col" rowspan="2" style="vertical-align: middle;">DEBET</th>
                                    <th scope="col" rowspan="2" style="vertical-align: middle;">KREDIT</th>
                                    <th scope="col" colspan="2" style="border-bottom:none;">SALDO</th>
                                </tr>
                                <tr>
                                    <td scope="col">DEBET</td>
                                    <td scope="col">KREDIT</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($akun['transaksi'] as $item) : ?>
                                    <tr>
                                        <th scope="row"> <?= tanggal_in_bahasa($item['tgl_transaksi']) ?></th>
                                        <td class="<?= ($item['debit'] == '0') ? 'text-right' : 'text-left'; ?> "> <?= $item['keterangan_transaksi'] ?> </td>
                                        <td> Rp. <?= number_format($item['debit']) ?> </td>
                                        <td> Rp. <?= number_format($item['kredit']) ?> </td>
                                        <td> Rp. <?= number_format($item['saldo']['debit']) ?></td>
                                        <td> Rp. <?= number_format($item['saldo']['kredit']) ?></td>
                                    </tr>
                                <?php endforeach; ?>

                                <tr class="font-weight-bold">
                                    <td colspan="4" class="text-center">JUMLAH</td>
                                    <td>Rp. <?= number_format($akun['total_saldo']) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php }else{ ?>
            <hr>
            <h1 class="text-center text-secondary">Maaf, Laporan belum tersedia!</h1>
            <hr>
        <?php } ?>
    </div>
</div>

<?php if(!empty($data)){ ?>
<script>
    const akunSelector = document.getElementById("akun");
    let opsi_akun = [
        <?php foreach ($data['buku_besar'] as $akun) : ?>
            <?= "'" . str_replace(" ", "-", $akun['nama_akun']) . "'," ?>
        <?php endforeach; ?>
    ]

    window.addEventListener('DOMContentLoaded', (event) => {
        console.log("DOM fully loaded");
        showAllAkun()
    })

    akunSelector.addEventListener("change", () => {
        if (opsi_akun.includes(akunSelector.value, 0)) {
            console.log(akunSelector.value);
            showOneAkun(akunSelector.value)
        }else{
            showAllAkun()
        }
    })


    const hideAkun =()=>{
        opsi_akun.forEach((opsi)=>{
            document.getElementById(opsi).style.display="none";
        })
    }

    const showOneAkun=(akun)=>{
        hideAkun()
        document.getElementById(akun).style.display="block";
    }

    const showAllAkun=()=>{
        opsi_akun.forEach((opsi)=>{
            document.getElementById(opsi).style.display="block";
        })
    } 
</script>
<?php }?>