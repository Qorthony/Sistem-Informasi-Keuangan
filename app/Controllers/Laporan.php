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
		helper(['tanggalindo', 'laporan']);
		$this->db = db_connect();
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
				$data = $this->getNS($filter['start_date'], $filter['end_date']);
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

	// mengambil data Neraca Saldo
	private function getNS($mulai, $selesai)
	{
		$sql = "SELECT akun.nama_akun,all_jurnal.* FROM 
				(SELECT * FROM jurnal_umum 
		 			UNION ALL
				SELECT * FROM jurnal_penyesuaian
				ORDER BY tgl_transaksi DESC) AS all_jurnal
				INNER JOIN akun ON akun.no_akun=all_jurnal.no_akun
				WHERE all_jurnal.tgl_transaksi BETWEEN :tgl_mulai: AND :tgl_selesai:";
		$result = $this->db->query($sql, [
			'tgl_mulai' => date('Y-m-j', strtotime($mulai)),
			'tgl_selesai' => date('Y-m-t', strtotime($selesai))
		])->getResult('array');

		// dd($result);
		if (!empty($result)) {
			$result = $this->restructureNS($result);
		}

		return $result;
	}

	private function restructureNS($data)
	{

		$akuns = [];
		$jml_debit = 0;
		$jml_kredit = 0;

		$duplicate = 0;

		foreach ($data as $key => $row) {
			$akun = [];
			$saldo = [];
			if (akunExist($akuns, $row['no_akun'])) {
				$duplicate += 1;
				continue;
			}
			foreach ($data as $item) {
				if ($item['no_akun'] == $row['no_akun']) {
					$saldo = hitungSaldo(
						$item['no_akun'],
						$item['debit'],
						$item['kredit'],
						!empty($saldo) ? $saldo['debit'] : 0,
						!empty($saldo) ? $saldo['kredit'] : 0
					);
				}
			}

			$akun = [
				"no_akun" => $row['no_akun'],
				"nama_akun" => $row['nama_akun'],
				"saldo" => $saldo
			];

			array_push($akuns, $akun);
			$jml_debit += $saldo['debit'];
			$jml_kredit += $saldo['kredit'];
		}
		// dd($akuns);

		$neraca = [
			"data_akun" => $akuns,
			"jumlah_debit" => $jml_debit,
			"jumlah_kredit" => $jml_kredit
		];

		// dd($neraca,$duplicate);

		return $neraca;
	}

	// Mengambil data Buku besar
	private function getBB($mulai, $selesai)
	{
		$sql = "SELECT akun.nama_akun,all_jurnal.* FROM 
				(SELECT * FROM jurnal_umum 
		 			UNION ALL
				SELECT * FROM jurnal_penyesuaian
				ORDER BY tgl_transaksi DESC) AS all_jurnal
				INNER JOIN akun ON akun.no_akun=all_jurnal.no_akun
				WHERE all_jurnal.tgl_transaksi BETWEEN :tgl_mulai: AND :tgl_selesai:";

		$result = $this->db->query($sql, [
			'tgl_mulai' => date('Y-m-j', strtotime($mulai)),
			'tgl_selesai' => date('Y-m-t', strtotime($selesai))
		])->getResult('array');
		// dd($result);
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

			if (!akunExist($bukubesar, $value['no_akun'])) {
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

					$saldo_normal = hitungSaldo(
						$row['no_akun'],
						$row['debit'],
						$row['kredit'],
						!empty($bukubesar[$key]['transaksi']) ? $bukubesar[$key]['transaksi'][array_key_last($bukubesar[$key]['transaksi'])]['saldo']['debit'] : 0,
						!empty($bukubesar[$key]['transaksi']) ? $bukubesar[$key]['transaksi'][array_key_last($bukubesar[$key]['transaksi'])]['saldo']['kredit'] : 0
					);

					$transaksi = [
						"no_transaksi" 			=> $row['no_transaksi'],
						"tgl_transaksi" 		=> $row['tgl_transaksi'],
						"keterangan_transaksi" 	=> $row['keterangan_transaksi'],
						"debit" 				=> $row['debit'],
						"kredit" 				=> $row['kredit'],
						"saldo"					=> $saldo_normal,
					];
					array_push($bukubesar[$key]['transaksi'], $transaksi);
					$bukubesar[$key]['total_saldo'] = ($saldo_normal['debit'] == 0) ? $saldo_normal['kredit'] : $saldo_normal['debit'];
				}
			}
		}


		// dd($bukubesar);
		return $bukubesar;
	}





	//--------------------------------------------------------------------

}
