<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'nip'          => [
				'type'           => 'VARCHAR',
				'constraint'     => '20',
			],
			'username'       => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'email' => [
				'type'           => 'VARCHAR',
				'constraint'     => '100',
			],
			'password' => [
				'type'			 => 'VARCHAR',
				'constraint'	 => '255'
			],
			'jenis_user' => [
				'type'			 => 'VARCHAR',
				'constraint'	 => '20'
			],
		]);
		$this->forge->addKey('nip', true);
		$this->forge->createTable('user');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('user');
	}
}
