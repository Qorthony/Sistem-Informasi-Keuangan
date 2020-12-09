<?php

namespace App\Controllers;

use App\Models\JUModel;
use CodeIgniter\I18n\Time;

class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

	public function dashboard()
	{
		$JU = new JUModel();
		$pendapatanHariIni = $JU->selectSum('kredit')
			->like('no_akun', '4', 'after')
			->where('tgl_transaksi', date('Y-m-d', strtotime(Time::now())))
			->first();

		$pengeluaranHariIni = $JU->selectSum('debit')
			->like('no_akun', '5', 'after')
			->where('tgl_transaksi', date('Y-m-d', strtotime(Time::now())))
			->first();

		$pendapatanBulanIni = $JU->selectSum('kredit')
			->like('no_akun', '4', 'after')
			->where('tgl_transaksi >', date('Y-m-', strtotime(Time::now())) . '1')
			->where('tgl_transaksi <', date('Y-m-t', strtotime(Time::now())))
			->first();

		$pengeluaranBulanIni = $JU->selectSum('debit')
			->like('no_akun', '5', 'after')
			->where('tgl_transaksi >', date('Y-m-', strtotime(Time::now())) . '1')
			->where('tgl_transaksi <', date('Y-m-t', strtotime(Time::now())))
			->first();



		$grafikBulanan = [
			"bulan" => $this->getSixMonthAgo(),
			"pendapatan" => $this->getGrafik6BulanTerakhir('pendapatan'),
			"pengeluaran" => $this->getGrafik6BulanTerakhir('pengeluaran')
		];

		// dd($pendapatanBulanIni);
		$data = [
			"pendapatanHariIni"		=> $pendapatanHariIni,
			"pengeluaranHariIni"	=> $pengeluaranHariIni,
			"pendapatanBulanIni"	=> $pendapatanBulanIni,
			"pengeluaranBulanIni"	=> $pengeluaranBulanIni,
			"grafikBulanan"			=> $grafikBulanan
		];
		// dd($grafikBulanan);
		return view('dashboard', $data);
	}

	private function getSixMonthAgo()
	{
		$month = [];
		$startdate = strtotime("6 month ago");
		$enddate = strtotime("+7 months", $startdate);

		while ($startdate < $enddate) {
			array_push($month, date("F", $startdate));
			$startdate = strtotime("+1 month", $startdate);
		}
		return $month;
	}

	private function getGrafik6BulanTerakhir($tipe)
	{
		$JU = new JUModel();
		$kolom = '';
		$prefix = '';
		switch ($tipe) {
			case 'pendapatan':
				$kolom = 'kredit';
				$prefix = '4';
				break;
			case 'pengeluaran':
				$kolom = 'debit';
				$prefix = '5';
				break;

			default:
				# code...
				break;
		}

		$data = [];
		$startdate = strtotime("6 month ago");
		$enddate = strtotime("+7 months", $startdate);
		while ($startdate < $enddate) {
			$dataPerBulan = $JU->selectSum($kolom)
				->like('no_akun', $prefix , 'after')
				->where('tgl_transaksi >', date('Y-m-', $startdate) . '1')
				->where('tgl_transaksi <', date('Y-m-t', $startdate))
				->first();
			$dataPerBulan = $dataPerBulan[$kolom] == null ? '0' : $dataPerBulan[$kolom];
			array_push($data, $dataPerBulan);
			$startdate = strtotime("+1 month", $startdate);
		}
		return $data;
	}

	//--------------------------------------------------------------------

}
