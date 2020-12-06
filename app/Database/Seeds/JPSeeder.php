<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class JPSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'id_penyesuaian'        => ''.strtotime(Time::now()).'01',
                'tgl_penyesuaian'       => '2020-9-24',
                'no_akun'               => '515',
                'keterangan_penyesuaian'=> 'Perlengkapan terpakai',
                'debit'                 => 750000,
                'kredit'                => 0,
                'nip'                   => '11180930000095',
                'created_at'            => Time::now(),
                'updated_at'            => Time::now()
            ],
            [
                'id_penyesuaian'          => ''.strtotime(Time::now()).'02',
                'tgl_penyesuaian'         => '2020-9-24',
                'no_akun'               => '113',
                'keterangan_penyesuaian'=> 'Perlengkapan terpakai',
                'debit'                 => 0,
                'kredit'                => 750000,
                'nip'                   => '11180930000095',
                'created_at'            => Time::now(),
                'updated_at'            => Time::now()
            ],
            [
                'id_penyesuaian'          => ''.strtotime(Time::now()).'03',
                'tgl_penyesuaian'         => '2020-10-24',
                'no_akun'               => '122',
                'keterangan_penyesuaian'=> 'Akumulasi penyusutan peralatan',
                'debit'                 => 0,
                'kredit'                => 750000,
                'nip'                   => '11180930000095',
                'created_at'            => Time::now(),
                'updated_at'            => Time::now()
            ],
            [
                'id_penyesuaian'          => ''.strtotime(Time::now()).'04',
                'tgl_penyesuaian'         => '2020-10-24',
                'no_akun'               => '518',
                'keterangan_penyesuaian'=> 'Beban Penyusunan Peralatan',
                'debit'                 => 750000,
                'kredit'                => 0,
                'nip'                   => '11180930000095',
                'created_at'            => Time::now(),
                'updated_at'            => Time::now()
            ],
            
        ];

        // Using Query Builder
        $this->db->table('jurnal_penyesuaian')->insertBatch($data);
    }
}
