<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class User extends BaseController
{
	public function index()
	{
		$user = new UserModel();
		$data_user = $user->findAll();
		// dd($data_user); 
		return view('data_user', ["data_users" => $data_user]);
	}

	public function add()
	{
		if (!$this->validate([
			'nip'			=> "required|is_unique[users.nip]|numeric",
			'email' 		=> "required|is_unique[users.email]|valid_email",
			'nama'  		=> 'required|alpha_numeric_space|is_unique[users.username]',
			'keterangan'	=> "required"
		])) {
			return redirect()->to('/user')->with('errors', $this->validator->getErrors());
		}

		$nip 		= $this->request->getPost('nip');
		$nama 		= $this->request->getPost('nama');
		$email 		= $this->request->getPost('email');
		$keterangan = $this->request->getPost('keterangan');

		$user = new UserModel;
		$data = [
			'nip' 			=> $nip,
			'username'		=> $nama,
			'email'			=> $email,
			'password'		=> password_hash('punya' . $nama, PASSWORD_DEFAULT),
			'jenis_user' 	=> $keterangan,
			'created_at'    => Time::now(),
			'updated_at'    => Time::now()
		];
		// dd($data);
		$user->insert($data);

		return redirect()->to('/user')->with('success', 'Berhasil menambah user!');
	}

	public function delete($nip)
	{
		$user = new UserModel();
		$user->delete($nip);
		return redirect()->to('/user')->with('success','Data berhasil dihapus!');
	}

	public function edit($id)
	{
		$nip 		= $this->request->getPost('nip');
		$nama 		= $this->request->getPost('nama');
		$email 		= $this->request->getPost('email');
		$keterangan = $this->request->getPost('keterangan');

		if (!$this->validate([
			'nip'			=> "required|is_unique[users.nip,nip,{$nip}]|numeric",
			'email' 		=> "required|is_unique[users.email,email,{$email}]|valid_email",
			'nama'  		=> "required|alpha_numeric_space|is_unique[users.username,username,{$nama}]",
			'keterangan'	=> "required"
		])) {
			return redirect()->to('/user')->with('errors', $this->validator->getErrors());
		}


		$user = new UserModel;
		$data = [
			'nip' 			=> $nip,
			'username'		=> $nama,
			'email'			=> $email,
			'password'		=> password_hash('punya' . $nama, PASSWORD_DEFAULT),
			'jenis_user' 	=> $keterangan,
			'created_at'    => Time::now(),
			'updated_at'    => Time::now()
		];

		$user->update($id, $data);

		return redirect()->to('/user')->with('success', 'Berhasil edit user!');
	}

	public function profile()
	{	
		$user = new UserModel();
		$profile = $user->find(session('user_id'));
		// dd($profile);
		return view('profile',["profile"=>$profile	]);
	}

	public function updateProfile()
	{
		$nip 		= $this->request->getPost('nip');
		$nama 		= $this->request->getPost('nama');
		$email 		= $this->request->getPost('email');
		$keterangan = $this->request->getPost('keterangan');

		if (!$this->validate([
			'nip'			=> "required|is_unique[users.nip,nip,{$nip}]|numeric",
			'email' 		=> "required|is_unique[users.email,email,{$email}]|valid_email",
			'nama'  		=> "required|alpha_numeric_space|is_unique[users.username,username,{$nama}]",
			'keterangan'	=> "required"
		])) {
			return redirect()->to('/profile')->with('errors', $this->validator->getErrors());
		}

		$user = new UserModel();
		$data = [
			"nip"			=> $nip,
			"username"		=> $nama,
			"email"			=> $email,
			"jenis_user"	=> $keterangan,
		];
		$user->update(session("user_id"), $data);

		return redirect()->to('/profile')->with('success', 'Berhasil edit profile!');
	}

	public function changePassword()
	{
		$pw_baru 		= $this->request->getPost("password_baru");

		if (!$this->validate([
			"password_baru"			=> "required",
			"konfirmasi_password"	=> "required|matches[password_baru]"
		])) {
			return redirect()->to('/profile')->with('errors', $this->validator->getErrors());
		}
		
		$user = new UserModel();
		$user->update(session("user_id"), ["password"=>password_hash($pw_baru, PASSWORD_DEFAULT)]);

		return redirect()->to('/profile')->with('success', 'Berhasil ganti password!');

	}

	//--------------------------------------------------------------------

}
