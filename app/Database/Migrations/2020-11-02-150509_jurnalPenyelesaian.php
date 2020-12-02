<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JurnalPenyelesaian extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id_penyesuaian' => [
				'type'			 => 'VARCHAR',
				'constraint'	 => '20'
			],
			'tgl_penyesuaian' => [
				'type'			 => 'DATE',

			],
			'keterangan_penyesuaian' => [
				'type'			 => 'VARCHAR',
				'constraint'	 => '255',
			],
			'no_akun' => [
				'type'			 => 'VARCHAR',
				'constraint'	 => '20'
			],
			'debit' => [
				'type'			 => 'INT'
			],
			'kredit' => [
				'type'			 => 'INT'
			],
			'nip' => [
				'type'			 => 'VARCHAR',
				'constraint'	 => '20'
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
		$this->forge->addKey('id_penyesuaian', true);
		$this->forge->createTable('jurnal_penyesuaian');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('jurnal_penyesuaian');
	}
}
