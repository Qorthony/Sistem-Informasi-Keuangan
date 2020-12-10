<?php

namespace App\Controllers;

use App\Models\AkunModel;
use CodeIgniter\I18n\Time;

class Akun extends BaseController
{
	public function index()
	{
		$keyword = $this->request->getVar('keyword');
		$akun = new AkunModel();
		if ( $keyword ) {
			$data_akun =  $akun->like('no_akun',$keyword)
								->orLike('nama_akun', $keyword)
								->findAll();
								// dd($data_akun); 
		}else {
			$data_akun = $akun->findAll();
		}
		
		// dd($data_user); 
		return view('data_akun', ["data_akun" => $data_akun]);
	}

	public function add()
	{
		if (!$this->validate([
			'no_akun'			=> "required|is_unique[akun.no_akun]|numeric",
			'nama_akun'  		=> 'required|alpha_numeric_space|is_unique[akun.nama_akun]',
			'keterangan'		=> "required"
		])) {
			return redirect()->to('/akun')->with('errors', $this->validator->getErrors());
		}

		$no_akun = $this->request->getPost('no_akun');
		$nama_akun 		= $this->request->getPost('nama_akun');
		$keterangan = $this->request->getPost('keterangan');

		$akun = new AkunModel;
		$data = [
			'no_akun' 			=> $no_akun,
			'nama_akun'		=> $nama_akun,
			'keterangan' 	=> $keterangan,
			'created_at'    => Time::now(),
			'updated_at'    => Time::now()
		];
		// dd($data);
		$akun->insert($data);

		return redirect()->to('/akun')->with('success', 'Berhasil menambah akun!');
	}

	public function delete($no_akun)
	{
		$akun = new AkunModel();
		$akun->delete($no_akun);
		return redirect()->to('/akun')->with('success','Data berhasil dihapus!');
	}

	public function edit($id)
	{
		$no_akun  = $this->request->getPost('no_akun');
		$nama_akun	= $this->request->getPost('nama_akun');
		$keterangan = $this->request->getPost('keterangan');

		if (!$this->validate([
			'no_akun'			=> "required|is_unique[akun.no_akun,no_akun,{$no_akun}]|numeric",
			'nama_akun'  		=> "required|alpha_numeric_space|is_unique[akun.nama_akun,nama_akun,{$nama_akun}]",
			'keterangan'	=> "required"
		])) {
			return redirect()->to('/akun')->with('errors', $this->validator->getErrors());
		}


		$akun = new AkunModel;
		$data = [
			'no_akun' 			=> $no_akun,
			'nama_akun'		=> $nama_akun,
			'keterangan' 	=> $keterangan,
			'created_at'    => Time::now(),
			'updated_at'    => Time::now()
		];

		$akun->update($id, $data);

		return redirect()->to('/akun')->with('success', 'Berhasil edit akun!');
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
