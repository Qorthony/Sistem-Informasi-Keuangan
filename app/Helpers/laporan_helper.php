<?php
function akunExist($dt, $dicari)
{
    $equal = 0;
    foreach ($dt as $item) {
        if ($dicari == $item['no_akun']) {
            $equal += 1;
        }
    }
    return $equal;
}

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
?>