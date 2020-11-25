<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class AkunSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'no_akun'       => '111',
                'nama_akun'     => 'Kas',
                'keterangan'    => 'tempat mencatat kas perusahaan',
                'created_at'    => Time::now(),
                'updated_at'    => Time::now()
            ],
            [
                'no_akun'       => '211',
                'nama_akun'     => 'utang usaha',
                'keterangan'    => 'tempat mencatat hutang untuk keperluan usaha',
                'created_at'    => Time::now(),
                'updated_at'    => Time::now()
            ],
            [
                'no_akun'       => '311',
                'nama_akun'     => 'modal',
                'keterangan'    => 'tempat mencatat modal',
                'created_at'    => Time::now(),
                'updated_at'    => Time::now()
            ],
            [
                'no_akun'       => '411',
                'nama_akun'     => 'Pendapatan Jasa',
                'keterangan'    => 'tempat mencatat pendapatan dari hasil jasa',
                'created_at'    => Time::now(),
                'updated_at'    => Time::now()
            ],
            [
                'no_akun'       => '511',
                'nama_akun'     => 'Beban',
                'keterangan'    => 'tempat mencatat beban yang ditanggung',
                'created_at'    => Time::now(),
                'updated_at'    => Time::now()
            ]
        ];

        // Using Query Builder
        $this->db->table('akun')->insertBatch($data);
    }
}
