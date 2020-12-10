<?php

namespace App\Controllers;

use App\Models\JurnalUmumModel;
use CodeIgniter\I18n\Time;

class JurnalUmum extends BaseController
{
	public function index()
	{
		$keyword = $this->request->getVar('keyword');
		$jurnal_umum = new JurnalUmumModel();
		if ( $keyword ) {
			$data_jurnal_umum =  $jurnal_umum->like('no_akun',$keyword)
								->orLike('tgl_transaksi', $keyword)
								->orLike('keterangan_transaksi', $keyword)
								->findAll();
								// dd($data_jurnal_umum); 
		}else {
			$data_jurnal_umum = $jurnal_umum->findAll();
		}
		
		// dd($data_user); 
		return view('data_jurnal_umum', ["data_jurnal_umum" => $data_jurnal_umum]);
	}

	public function add()
	{
		if (!$this->validate([
			'no_transaksi'			=> "required|is_unique[jurnal_umum.no_transaksi]|numeric",
			'tgl_transaksi'			=> "required",
			'keterangan_transaksi'	=> "required",
			'no_akun'			=> "required|numeric",
			'debit'			=> "required|numeric",
			'kredit'			=> "required|numeric",
			'nip'			=> "required|numeric",
		])) {
			return redirect()->to('/jurnal_umum')->with('errors', $this->validator->getErrors());
		}

		$no_transaksi = $this->request->getPost('no_transaksi');
		$keterangan_transaksi = $this->request->getPost('keterangan_transaksi');
		$tgl_transaksi = $this->request->getPost('tgl_transaksi');
		$no_akun = $this->request->getPost('no_akun');
		$debit = $this->request->getPost('debit');
		$kredit = $this->request->getPost('kredit');
		$nip = $this->request->getPost('nip');

		$JU = new JUModel;
		$data = [
			'no_transaksi'			=> $no_transaksi,
			'keterangan_transaksi' 	=> $keterangan_transaksi,
			'tgl_transaksi' 	=> $tgl_transaksi,
			'no_akun' 			=> $no_akun,
			'debit'		=> $debit,
			'kredit'		=> $kredit,
			'nip'		=> $nip,
			'created_at'    => Time::now(),
			'updated_at'    => Time::now()
		];
		// dd($data);
		$JU->insert($data);

		return redirect()->to('/jurnal_umum')->with('success', 'Berhasil menambah Jurnal Umum!');
	}

	public function delete($no_transaksi)
	{
		$jurnal_umum = new JurnalUmumModel();
		$jurnal_umum->delete($no_transaksi);
		return redirect()->to('/jurnal_umum')->with('success','Data berhasil dihapus!');
	}

	public function edit($id)
	{
		$no_transaksi = $this->request->getPost('no_transaksi');
		$keterangan_transaksi = $this->request->getPost('keterangan_transaksi');
		$tgl_transaksi = $this->request->getPost('tgl_transaksi');
		$no_akun = $this->request->getPost('no_akun');
		$debit = $this->request->getPost('debit');
		$kredit = $this->request->getPost('kredit');
		$nip = $this->request->getPost('nip');

		if (!$this->validate([
			'no_transaksi'			=> "required|is_unique[jurnal_umum.no_transaksi,no_transaksi,{$no_transaksi}]|numeric",
			'tgl_transaksi'			=> "required",
			'keterangan_transaksi'	=> "required",
			'no_akun'			=> "required|is_unique[JU.no_akun,no_akun,{$no_akun}]|numeric",
			'debit'			=> "required|is_unique[jurnal_umum.debit,debit,{$kredit}]|numeric",
			'kredit'			=> "required|is_unique[jurnal_umum.kredit,kredit,{$kredit}]|numeric",
			'nip'			=> "required|is_unique[jurnal_umum.nip,nip,{$nip}]|numeric",
		])) {
			return redirect()->to('/jurnal_umum')->with('errors', $this->validator->getErrors());
		}


		$jurnal_umum= new JurnalUmumModel;
		$data = [
			'no_transaksi'			=> $no_transaksi,
			'tgl_transaksi'			=> $tgl_transaksi,
			'keterangan_transaksi' 	=> $keterangan_transaksi,
			'no_akun' 			=> $no_akun,
			'debit'		=> $debit,
			'kredit'		=> $kredit,
			'nip'		=> $nip,
			'created_at'    => Time::now(),
			'updated_at'    => Time::now()
		];

		$JU->update($id, $data);

		return redirect()->to('/jurnal_umum')->with('success', 'Berhasil edit Jurnal Umum!');
	}

	// public function profile()
	// {	
	// 	$akun = new AkunModel();
	// 	$profile = $akun->find(session('akun_id'));
	// 	// dd($profile);
	// 	return view('profile',["profile"=>$profile	]);
	// }

	// public function updateProfile()
	// {
	// 	$no_akun	= $this->request->getPost('no_akun');
	// 	$nama_akun 		= $this->request->getPost('nama_akun');
	// 	$keterangan = $this->request->getPost('keterangan');

	// 	if (!$this->validate([
	// 		'no_akun'			=> "required|is_unique[akun.no_akun,no_akun,{$no_akun}]|numeric",
	// 		'nama_akun'  		=> "required|alpha_numeric_space|is_unique[users.akunname,akunname,{$nama_akun}]",
	// 		'keterangan'	=> "required"
	// 	])) {
	// 		return redirect()->to('/profile')->with('errors', $this->validator->getErrors());
	// 	}

	// 	$akun= new AkunModel();
	// 	$data = [
	// 		"no_akun"			=> $no_akun,
	// 		"akunname"		=> $nama_akun,
	// 		"jenis_akun"	=> $keterangan,
	// 	];
	// 	$akun->update(session("akun_id"), $data);

	// 	return redirect()->to('/profile')->with('success', 'Berhasil edit profile!');
	// }

	// public function changePassword()
	// {
	// 	$pw_baru 		= $this->request->getPost("password_baru");

	// 	if (!$this->validate([
	// 		"password_baru"			=> "required",
	// 		"konfirmasi_password"	=> "required|matches[password_baru]"
	// 	])) {
	// 		return redirect()->to('/profile')->with('errors', $this->validator->getErrors());
	// 	}
		
	// 	$akun = new AkunModel();
	// 	$akun->update(session("akun_id"), ["password"=>password_hash($pw_baru, PASSWORD_DEFAULT)]);

	// 	return redirect()->to('/profile')->with('success', 'Berhasil ganti password!');

	// }

	//--------------------------------------------------------------------

}
