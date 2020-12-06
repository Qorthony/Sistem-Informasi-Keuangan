<?php

function getDataJurnal($mulai, $selesai, $select = "akun.nama_akun,all_jurnal.*")
{
    $sql = "SELECT " . $select . " FROM 
				(SELECT * FROM jurnal_umum 
		 			UNION ALL
				SELECT * FROM jurnal_penyesuaian
				ORDER BY tgl_transaksi DESC) AS all_jurnal
				INNER JOIN akun ON akun.no_akun=all_jurnal.no_akun
				WHERE all_jurnal.tgl_transaksi BETWEEN :tgl_mulai: AND :tgl_selesai:";
    $result = db_connect()->query($sql, [
        'tgl_mulai' => date('Y-m-j', strtotime($mulai)),
        'tgl_selesai' => date('Y-m-t', strtotime($selesai))
    ])->getResult('array');

    return $result;
}

// mengecek apakah akun terdapat dalam array
function akunExist(array $dt, $dicari)
{
    $equal = 0;
    foreach ($dt as $item) {
        if ($dicari == $item['no_akun']) {
            $equal += 1;
        }
    }
    return $equal;
}

// Menghitung saldo
function hitungSaldo($no_akun, $debit, $kredit, $saldo_debit, $saldo_kredit)
{
    $saldo = [];
    if (substr($no_akun, 0, 1) == 1 || substr($no_akun, 0, 1) == 5) {
        $saldo_normal = $saldo_debit + $debit - $kredit;
        if ($saldo_normal < 0) {
            $saldo['debit'] = 0;
            $saldo['kredit'] = abs($saldo_normal);
        } else {
            $saldo['debit'] = $saldo_normal;
            $saldo['kredit'] = 0;
        }
    } else {
        $saldo_normal = $saldo_kredit + $kredit - $debit;
        if ($saldo_normal < 0) {
            $saldo['debit'] = abs($saldo_normal);
            $saldo['kredit'] = 0;
        } else {
            $saldo['debit'] = 0;
            $saldo['kredit'] = $saldo_normal;
        }
    }
    return $saldo;
}

function collectDataLR($data, $tipe)
{
    $items = [];
    $total_items = ["debit" => 0, "kredit" => 0];
    $prefix = "";

    switch ($tipe) {
        case 'pendapatan':
            $prefix = 4;
            break;

        case 'beban':
            $prefix = 5;
            break;

        default:
            # code...
            break;
    }


    // mengumpulkan data items
    foreach ($data as $akun) {
        if (substr($akun['no_akun'], 0, 1) == $prefix) {
            if (akunExist($items, $akun['no_akun'])) {
                continue;
            }

            // menghitung saldo total tiap akun
            $saldo = [];
            foreach ($data as $value) {
                if ($value['no_akun'] == $akun['no_akun']) {
                    $saldo = hitungSaldo(
                        $value['no_akun'],
                        $value['debit'],
                        $value['kredit'],
                        !empty($saldo) ? $saldo['debit'] : 0,
                        !empty($saldo) ? $saldo['kredit'] : 0
                    );
                }
            }

            $akun_items = [
                "no_akun" => $akun['no_akun'],
                "nama_akun" => $akun['nama_akun'],
                "saldo" => $saldo
            ];
            array_push($items, $akun_items);
            $total_items['debit'] += $saldo['debit'];
            $total_items['kredit'] += $saldo['kredit'];
        }
    }

    return ["items" => $items, "total_items" => $total_items];
}
