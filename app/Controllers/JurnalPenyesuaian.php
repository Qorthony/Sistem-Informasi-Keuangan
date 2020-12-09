<?php

namespace App\Controllers;

use App\Models\AkunModel;
use App\Models\JPModel;
use CodeIgniter\I18n\Time;

class JurnalPenyesuaian extends BaseController
{
	function __construct()
	{
		helper(['tanggalindo']);
		
	}
	public function index()
	{
		$jurnal_penyesuaian = new JPModel();
		$data_jurnal_penyesuaian = $jurnal_penyesuaian->findAll();
        
        $akuns = new AkunModel();
        $akuns = $akuns->findAll();

        $data = [
            "data_JP" => $data_jurnal_penyesuaian,
            "akuns"=> $akuns
        ];
		return view('data_jurnal_penyesuaian', $data);
	}

	public function add()
	{
		if (!$this->validate([
			'tanggal'		=> "required",
			'keterangan'	=> "required",
			'akun'			=> "required|numeric",
			'debit'			=> "required|numeric",
			'kredit'		=> "required|numeric"
		])) {
			return redirect()->to('/jurnal_penyesuaian')->with('errors', $this->validator->getErrors());
		}

		$id_penyesuaian 			= ''.strtotime(Time::now()).$this->request->getPost('akun'); 
		$keterangan_penyesuaian 	= $this->request->getPost('keterangan');
		$tgl_penyesuaian 			= $this->request->getPost('tanggal');
		$no_akun 					= $this->request->getPost('akun');
		$debit 						= $this->request->getPost('debit');
		$kredit 					= $this->request->getPost('kredit');
		$nip 						= session('user_id');

		$JP = new JPModel();
		$data = [
			'id_penyesuaian'			=> $id_penyesuaian,
			'keterangan_penyesuaian' 	=> $keterangan_penyesuaian,
			'tgl_penyesuaian' 			=> $tgl_penyesuaian,
			'no_akun' 					=> $no_akun,
			'debit'						=> $debit,
			'kredit'					=> $kredit,
			'nip'						=> $nip,
			'created_at'    			=> Time::now(),
			'updated_at'    			=> Time::now()
		];
		// dd($data);
		$JP->insert($data);

		return redirect()->to('/jurnal_penyesuaian')->with('success', 'Berhasil menambah Jurnal Penyesuaian!');
	}

	public function delete($no_transaksi)
	{
		$jurnal_penyesuaian = new JPModel();
		$jurnal_penyesuaian->delete($no_transaksi);
		return redirect()->to('/jurnal_penyesuaian')->with('success','Data berhasil dihapus!');
	}

	public function edit($id)
	{
		if (!$this->validate([
			'tanggal'		=> "required",
			'keterangan'	=> "required",
			'akun'			=> "required|numeric",
			'debit'			=> "required|numeric",
			'kredit'		=> "required|numeric"
		])) {
			return redirect()->to('/jurnal_penyesuaian')->with('errors', $this->validator->getErrors());
		}


		$id_penyesuaian 			= ''.strtotime(Time::now()).$this->request->getPost('akun'); 
		$keterangan_penyesuaian 	= $this->request->getPost('keterangan');
		$tgl_penyesuaian 			= $this->request->getPost('tanggal');
		$no_akun 					= $this->request->getPost('akun');
		$debit 						= $this->request->getPost('debit');
		$kredit 					= $this->request->getPost('kredit');
		$nip 						= session('user_id');

		$jurnal_penyesuaian= new JPModel();
		$data = [
			'id_penyesuaian'			=> $id_penyesuaian,
			'keterangan_penyesuaian' 	=> $keterangan_penyesuaian,
			'tgl_penyesuaian' 			=> $tgl_penyesuaian,
			'no_akun' 					=> $no_akun,
			'debit'						=> $debit,
			'kredit'					=> $kredit,
			'nip'						=> $nip,
			'created_at'    			=> Time::now(),
			'updated_at'    			=> Time::now()
		];

		$jurnal_penyesuaian->update($id, $data);

		return redirect()->to('/jurnal_penyesuaian')->with('success', 'Berhasil edit Jurnal Penyesuaian!');
	}
	//--------------------------------------------------------------------

}
