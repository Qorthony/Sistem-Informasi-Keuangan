<?php

namespace App\Controllers;

use App\Models\AkunModel;
use App\Models\JurnalUmumModel;
use CodeIgniter\I18n\Time;

class JurnalUmum extends BaseController
{	
	function __construct()
	{
		helper(['tanggalindo']);
	}
	public function index()
	{
		$keyword = $this->request->getVar('keyword');
		$jurnal_umum = new JurnalUmumModel();
		if ($keyword) {
			$data_jurnal_umum =  $jurnal_umum->like('no_akun', $keyword)
				->orLike('tgl_transaksi', $keyword)
				->orLike('keterangan_transaksi', $keyword)
				->findAll();
			// dd($data_jurnal_umum); 
		} else {
			$data_jurnal_umum = $jurnal_umum->findAll();
		}
		$akuns = new AkunModel();
        $akuns = $akuns->findAll();

		// dd($data_user); 
		return view('data_jurnal_umum', ["data_jurnal_umum" => $data_jurnal_umum,"akuns"=>$akuns]);
	}

	public function add()
	{
		if (!$this->validate([
			'tgl_transaksi'			=> "required",
			'keterangan_transaksi'	=> "required",
			'no_akun'				=> "required|numeric",
			'debit'					=> "required|numeric",
			'kredit'				=> "required|numeric",
		])) {
			return redirect()->to('/jurnal_umum')->with('errors', $this->validator->getErrors());
		}

		$no_transaksi 			= ''.strtotime(Time::now()).$this->request->getPost('akun');
		$keterangan_transaksi 	= $this->request->getPost('keterangan_transaksi');
		$tgl_transaksi 			= $this->request->getPost('tgl_transaksi');
		$no_akun 				= $this->request->getPost('no_akun');
		$debit 					= $this->request->getPost('debit');
		$kredit 				= $this->request->getPost('kredit');
		$nip 					= session('user_id');

		$JU = new JurnalUmumModel();
		$data = [
			'no_transaksi'			=> $no_transaksi,
			'keterangan_transaksi' 	=> $keterangan_transaksi,
			'tgl_transaksi' 		=> $tgl_transaksi,
			'no_akun' 				=> $no_akun,
			'debit'					=> $debit,
			'kredit'				=> $kredit,
			'nip'					=> $nip,
			'created_at'    		=> Time::now(),
			'updated_at'    		=> Time::now()
		];
		// dd($data);
		$JU->insert($data);

		return redirect()->to('/jurnal_umum')->with('success', 'Berhasil menambah Jurnal Umum!');
	}

	public function delete($no_transaksi)
	{
		$jurnal_umum = new JurnalUmumModel();
		$jurnal_umum->delete($no_transaksi);
		return redirect()->to('/jurnal_umum')->with('success', 'Data berhasil dihapus!');
	}

	public function edit($id)
	{
		if (!$this->validate([
			'tgl_transaksi'			=> "required",
			'keterangan_transaksi'	=> "required",
			'no_akun'				=> "required|numeric",
			'debit'					=> "required|numeric",
			'kredit'				=> "required|numeric",
		])) {
			return redirect()->to('/jurnal_umum')->with('errors', $this->validator->getErrors());
		}

		$no_transaksi 			= ''.strtotime(Time::now()).$this->request->getPost('akun');
		$keterangan_transaksi 	= $this->request->getPost('keterangan_transaksi');
		$tgl_transaksi 			= $this->request->getPost('tgl_transaksi');
		$no_akun 				= $this->request->getPost('no_akun');
		$debit 					= $this->request->getPost('debit');
		$kredit 				= $this->request->getPost('kredit');
		$nip 					= session('user_id');

		$jurnal_umum = new JurnalUmumModel;
		$data = [
			'no_transaksi'			=> $no_transaksi,
			'tgl_transaksi'			=> $tgl_transaksi,
			'keterangan_transaksi' 	=> $keterangan_transaksi,
			'no_akun' 				=> $no_akun,
			'debit'					=> $debit,
			'kredit'				=> $kredit,
			'nip'					=> $nip,
			'created_at'    		=> Time::now(),
			'updated_at'    		=> Time::now()
		];

		$jurnal_umum->update($id, $data);

		return redirect()->to('/jurnal_umum')->with('success', 'Berhasil edit Jurnal Umum!');
	}

	//--------------------------------------------------------------------

}
