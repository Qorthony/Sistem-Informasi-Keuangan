<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Akun extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'no_akun' => [
				'type'		 => 'VARCHAR',
				'constraint' => '20'
			],
			'nama_akun' => [
				'type'		 => 'VARCHAR',
				'constraint' => '100',
			],
			'keterangan' => [
				'type'		 => 'VARCHAR',
				'constraint' => '255',
				'null'		 => true
			],
			'created_at' => [
				'type'			 => 'DATETIME',
				'null'			 => true,
			],
			'updated_at' => [
				'type'			 => 'DATETIME',
				'null'			 => true
			]
		]);
		$this->forge->addKey('no_akun', true);
		$this->forge->createTable('akun');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('akun');
	}
}
