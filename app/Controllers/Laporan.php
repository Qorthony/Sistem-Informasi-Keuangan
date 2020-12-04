<?php

namespace App\Controllers;

use App\Database\Migrations\Akun;
use App\Models\AkunModel;
use App\Models\JPModel;
use App\Models\JUModel;
use CodeIgniter\Database\BaseBuilder;

class Laporan extends BaseController
{
	function __construct()
	{
		helper('tanggalindo');		
	}

	public function index()
	{
		$filter = [
			"start_date" => "",
			"end_date" => "",
			"laporan" => "",
			"mata_uang" => ""
		];

		$data = [];
		if ($this->request->getVar("kategori")) {
			$filter = [
				"start_date" => $this->request->getVar("start"),
				"end_date" => $this->request->getVar("end"),
				"laporan" => $this->request->getVar("kategori"),
				"mata_uang" => $this->request->getVar("mata_uang")
			];
		}

		switch ($filter['laporan']) {
			case 'bb':
				$data = $this->getBB($filter['start_date'], $filter['end_date']);
				break;
			case 'ns':
				# code...
				break;
			case 'lr':
				# code...
				break;

			default:
				# code...
				break;
		}
		return view('laporan', [
			'filter' => $filter,
			'data'	=> $data
		]);
	}

	// Mengambil data Buku besar
	private function getBB($mulai, $selesai, $akun = "")
	{
		$db = db_connect();
		$sql = "SELECT akun.nama_akun,all_jurnal.* FROM 
				(SELECT * FROM jurnal_umum 
		 			UNION ALL
				SELECT * FROM jurnal_penyesuaian
				ORDER BY tgl_transaksi DESC) AS all_jurnal
				INNER JOIN akun ON akun.no_akun=all_jurnal.no_akun
				WHERE all_jurnal.tgl_transaksi BETWEEN :tgl_mulai: AND :tgl_selesai:";

		$result = $db->query($sql, [
			'tgl_mulai' => date('Y-m-j', strtotime($mulai)),
			'tgl_selesai' => date('Y-m-t', strtotime($selesai))
		])
			->getResult('array');
		// dd($result);
		// dd(date('Y-m-j', strtotime($mulai)));
		if (!empty($result)) {
			$result = $this->restructureBB($result);
		}

		return $result;
	}

	private function restructureBB($data)
	{
		$bukubesar = [
			[
				"no_akun" => $data[0]['no_akun'],
				"nama_akun" => $data[0]['nama_akun'],
				"transaksi" => []
			]
		];
		// dd(empty($bukubesar));

		// menambahkan akun ke buku besar
		foreach ($data as $value) {
			$equal = 0;
			foreach ($bukubesar as $item) {
				if ($value['no_akun'] == $item['no_akun']) {
					$equal += 1;
				}
			}

			if ($equal == 0) {
				$correctItem = [
					"no_akun" => $value['no_akun'],
					"nama_akun" => $value['nama_akun'],
					"transaksi" => []
				];
				array_push($bukubesar, $correctItem);
			}
		}

		// menambahkan transaksi ke buku besar

		foreach ($data as $row) {
			foreach ($bukubesar as $key => $item) {
				if ($row['no_akun'] == $item['no_akun']) {

					

					$saldo_normal = $this->hitungSaldo(
										$row['no_akun'], 
										$row['debit'], 
										$row['kredit'], 
										!empty($bukubesar[$key]['transaksi']) ?$bukubesar[$key]['transaksi'][array_key_last($bukubesar[$key]['transaksi'])]['saldo']['debit']:0 , 
										!empty($bukubesar[$key]['transaksi']) ?$bukubesar[$key]['transaksi'][array_key_last($bukubesar[$key]['transaksi'])]['saldo']['kredit']:0);

					$transaksi = [
						"no_transaksi" 			=> $row['no_transaksi'],
						"tgl_transaksi" 		=> $row['tgl_transaksi'],
						"keterangan_transaksi" 	=> $row['keterangan_transaksi'],
						"debit" 				=> $row['debit'],
						"kredit" 				=> $row['kredit'],
						"saldo"					=> $saldo_normal,
					];
					array_push($bukubesar[$key]['transaksi'], $transaksi);
					$bukubesar[$key]['total_saldo']=($saldo_normal['debit']==0)?$saldo_normal['kredit']:$saldo_normal['debit'];
				}
			}
		}


		// dd($bukubesar);
		return $bukubesar;
	}

	private function hitungSaldo($no_akun, $debit, $kredit, $saldo_debit, $saldo_kredit)
	{
		$saldo = [];
		if (substr($no_akun, 0, 1) == 1 || substr($no_akun, 0, 1) == 5) {
			$saldo_normal = $saldo_debit+$debit-$kredit;
			if ($saldo_normal<0) {
				$saldo['debit'] = 0;
				$saldo['kredit'] = abs($saldo_normal);
			}else {
				$saldo['debit'] = $saldo_normal;
				$saldo['kredit'] = 0;
			}
		} else {
			$saldo_normal = $saldo_kredit+$kredit-$debit;
			if ($saldo_normal<0) {
				$saldo['debit'] = abs($saldo_normal);
				$saldo['kredit'] = 0;
			}else {
				$saldo['debit'] = 0;
				$saldo['kredit'] = $saldo_normal;
			}
		}
		return $saldo;
	}




	//--------------------------------------------------------------------

}
