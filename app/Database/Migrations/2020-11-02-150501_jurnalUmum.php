<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class JurnalUmum extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'no_transaksi' => [
				'type'			 => 'VARCHAR',
				'constraint'	 => '20'
			],
			'tgl_transaksi' => [
				'type'			 => 'DATE',

			],
			'keterangan_transaksi' => [
				'type'			 => 'VARCHAR',
				'constraint'	 => '100'
			],
			'no_akun' => [
				'type'			 => 'VARCHAR',
				'constraint'	 => '20'
			],
			'debit' => [
				'type'			 => 'INT',
			],
			'kredit' => [
				'type'			 => 'INT',
			],
			'nip' => [
				'type'			 => 'VARCHAR',
				'constraint'	 => '20'
			]
		]);
		$this->forge->addKey('no_transaksi', true);
		$this->forge->createTable('jurnal_umum');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('jurnal_umum');
	}
}
