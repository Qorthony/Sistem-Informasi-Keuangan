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
		helper(['tanggalindo', 'laporan', 'converttousd']);
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
				$data = $this->getBB($filter['start_date'], $filter['end_date'], $filter['mata_uang']);
				// dd($data);
				break;
			case 'ns':
				$data = $this->getNS($filter['start_date'], $filter['end_date'], $filter['mata_uang']);
				break;
			case 'lr':
				$data = $this->getLR($filter['start_date'], $filter['end_date'], $filter['mata_uang']);
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

	// Mengambil data laba rugi
	private function getLR($mulai, $selesai, $mata_uang)
	{
		if ($mata_uang == 'usd') {
			$result = getDataJurnal($mulai, $selesai, 'en');
		} else {
			$result = getDataJurnal($mulai, $selesai);
		}

		// dd($result);

		if (!empty($result)) {
			if ($mata_uang == 'usd') {
				$rate = getRate();
				$result = $this->restructureLR($result, $rate);
				$result['rate'] = $rate;
			} else {
				$result = $this->restructureLR($result);
			}
		}


		return $result;
	}

	private function restructureLR($data, $rate = 1)
	{
		$pendapatan = collectDataLR($data, "pendapatan", $rate);

		$beban = collectDataLR($data, "beban", $rate);

		$laba_bersih = ($pendapatan['total_items']['kredit']) - ($beban['total_items']['debit']);

		$labaRugi = [
			"pendapatan" => $pendapatan,
			"beban" => $beban,
			"laba_bersih" => $laba_bersih
		];

		// dd($pendapatan);
		return $labaRugi;
	}

	// mengambil data Neraca Saldo
	private function getNS($mulai, $selesai, $mata_uang)
	{
		if ($mata_uang == 'usd') {
			$result = getDataJurnal($mulai, $selesai, 'en');
		} else {
			$result = getDataJurnal($mulai, $selesai);
		}
		if (!empty($result)) {
			if ($mata_uang == 'usd') {
				$rate = getRate();
				$result = $this->restructureNS($result, $rate);
				$result['rate'] = $rate;
			} else {
				$result = $this->restructureNS($result);
			}
		}
		// dd($result);

		return $result;
	}

	private function restructureNS($data, $rate = 1)
	{
		$akuns = [];
		$jml_debit = 0;
		$jml_kredit = 0;

		foreach ($data as $row) {
			$akun = [];
			$saldo = [];
			if (akunExist($akuns, $row['no_akun'])) {
				continue;
			}
			foreach ($data as $item) {
				if ($item['no_akun'] == $row['no_akun']) {
					$saldo = hitungSaldo(
						$item['no_akun'],
						$item['debit'] / $rate,
						$item['kredit'] / $rate,
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

		// dd($neraca);

		return $neraca;
	}

	// Mengambil data Buku besar
	private function getBB($mulai, $selesai, $mata_uang)
	{
		if ($mata_uang == 'usd') {
			$result = getDataJurnal($mulai, $selesai, 'en');
		} else {
			$result = getDataJurnal($mulai, $selesai);
		}
		if (!empty($result)) {
			if ($mata_uang == 'usd') {
				$rate = getRate();
				$result = [
					"buku_besar"=>$this->restructureBB($result, $rate),
					"rate"=>$rate
				];
			} else {
				$result = [
					"buku_besar"=>$this->restructureBB($result)
				];
			}
			// dd($result);
		}
		
		return $result;
	}

	private function restructureBB($data, $rate=1)
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
						$row['debit']/$rate,
						$row['kredit']/$rate,
						!empty($bukubesar[$key]['transaksi']) ? $bukubesar[$key]['transaksi'][array_key_last($bukubesar[$key]['transaksi'])]['saldo']['debit'] : 0,
						!empty($bukubesar[$key]['transaksi']) ? $bukubesar[$key]['transaksi'][array_key_last($bukubesar[$key]['transaksi'])]['saldo']['kredit'] : 0
					);

					$transaksi = [
						"no_transaksi" 			=> $row['no_transaksi'],
						"tgl_transaksi" 		=> $row['tgl_transaksi'],
						"keterangan_transaksi" 	=> $row['keterangan_transaksi'],
						"debit" 				=> $row['debit']/$rate,
						"kredit" 				=> $row['kredit']/$rate,
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
