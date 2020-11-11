<?php

namespace App\Controllers;

use App\Models\UserModel;

class Login extends BaseController
{
	public function form()
	{
		return view('login');
	}

	public function login()
	{
		$session 	= session();
		$model 		= new UserModel();
		$email 		= $this->request->getVar('email');
		$password 	= $this->request->getVar('password');
		$data 		= $model->where('email', $email)
			->orWhere('nip', $email)
			->orWhere('username', $email)
			->first();

		if ($data) {
			$pass = $data['password'];
			$verify_pass = password_verify($password, $pass);

			if ($verify_pass) {
				// echo "<h1>Berhasil login</h1>";
				$ses_data = [
					'user_id'	=> $data['nip'],
					'user_name'	=> $data['username'],
					'user_email' => $data['email'],
					'logged_in'	=> TRUE
				];

				$session->set($ses_data);
				return redirect()->to('/dashboard');
			} else {
				// echo "<h1>Password salah</h1>";
				$session->setFlashdata('msg', 'Password salah!');
				return redirect()->to('/login');
			}
		} else {
			// echo "<h1>Email salah</h1>";
			$session->setFlashdata('msg', 'Email salah!');
			return redirect()->to('/login');
		}
	}

	public function logout()
	{
		$session = session();
		$session->destroy();
		return redirect()->to('/login');
	}

	//--------------------------------------------------------------------

}
