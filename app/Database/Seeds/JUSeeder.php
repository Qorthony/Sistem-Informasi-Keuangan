<?php

namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class JUSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            [
                'no_transaksi'          => ''.strtotime(Time::now()).'01',
                'tgl_transaksi'         => '2020-9-15',
                'keterangan_transaksi'  => 'Simpan Kas',
                'no_akun'               => '111',
                'debit'                 => 20000000,
                'kredit'                => 0,
                'nip'                   => '11180930000095',
                'created_at'            => Time::now(),
                'updated_at'            => Time::now()
            ],
            [
                'no_transaksi'          => ''.strtotime(Time::now()).'02',
                'tgl_transaksi'         => '2020-9-15',
                'keterangan_transaksi'  => 'Beli Peralatan',
                'no_akun'               => '121',
                'debit'                 => 15000000,
                'kredit'                => 0,
                'nip'                   => '11180930000095',
                'created_at'            => Time::now(),
                'updated_at'            => Time::now()
            ],
            [
                'no_transaksi'          => ''.strtotime(Time::now()).'03',
                'tgl_transaksi'         => '2020-9-15',
                'keterangan_transaksi'  => 'Beli Perlengkapan',
                'no_akun'               => '113',
                'debit'                 => 2500000,
                'kredit'                => 0,
                'nip'                   => '11180930000095',
                'created_at'            => Time::now(),
                'updated_at'            => Time::now()
            ],
            [
                'no_transaksi'          => ''.strtotime(Time::now()).'04',
                'tgl_transaksi'         => '2020-9-15',
                'keterangan_transaksi'  => 'Memasukkan modal pemilik',
                'no_akun'               => '311',
                'debit'                 => 0,
                'kredit'                => 37500000,
                'nip'                   => '11180930000095',
                'created_at'            => Time::now(),
                'updated_at'            => Time::now()
            ],
            [
                'no_transaksi'          => ''.strtotime(Time::now()).'05',
                'tgl_transaksi'         => '2020-9-17',
                'keterangan_transaksi'  => 'Simpan Kas',
                'no_akun'               => '111',
                'debit'                 => 0,
                'kredit'                => 500000,
                'nip'                   => '11180930000095',
                'created_at'            => Time::now(),
                'updated_at'            => Time::now()
            ],
            [
                'no_transaksi'          => ''.strtotime(Time::now()).'06',
                'tgl_transaksi'         => '2020-9-17',
                'keterangan_transaksi'  => 'Utang usaha',
                'no_akun'               => '211',
                'debit'                 => 500000,
                'kredit'                => 0,
                'nip'                   => '11180930000095',
                'created_at'            => Time::now(),
                'updated_at'            => Time::now()
            ],
            [
                'no_transaksi'          => ''.strtotime(Time::now()).'07',
                'tgl_transaksi'         => '2020-10-3',
                'keterangan_transaksi'  => 'Pendapatan jasa',
                'no_akun'               => '411',
                'debit'                 => 0,
                'kredit'                => 25000000,
                'nip'                   => '11180930000095',
                'created_at'            => Time::now(),
                'updated_at'            => Time::now()
            ],
            [
                'no_transaksi'          => ''.strtotime(Time::now()).'08',
                'tgl_transaksi'         => '2020-10-3',
                'keterangan_transaksi'  => 'Simpan kas',
                'no_akun'               => '111',
                'debit'                 => 5000000,
                'kredit'                => 0,
                'nip'                   => '11180930000095',
                'created_at'            => Time::now(),
                'updated_at'            => Time::now()
            ],
            [
                'no_transaksi'          => ''.strtotime(Time::now()).'09',
                'tgl_transaksi'         => '2020-10-3',
                'keterangan_transaksi'  => 'Piutang usaha',
                'no_akun'               => '112',
                'debit'                 => 20000000,
                'kredit'                => 0,
                'nip'                   => '11180930000095',
                'created_at'            => Time::now(),
                'updated_at'            => Time::now()
            ],
            [
                'no_transaksi'          => ''.strtotime(Time::now()).'10',
                'tgl_transaksi'         => '2020-10-15',
                'keterangan_transaksi'  => 'Beban Gaji pegawai',
                'no_akun'               => '511',
                'debit'                 => 2500000,
                'kredit'                => 0,
                'nip'                   => '11180930000095',
                'created_at'            => Time::now(),
                'updated_at'            => Time::now()
            ],
            [
                'no_transaksi'          => ''.strtotime(Time::now()).'11',
                'tgl_transaksi'         => '2020-10-15',
                'keterangan_transaksi'  => 'Simpan Kas',
                'no_akun'               => '111',
                'debit'                 => 0,
                'kredit'                => 2500000,
                'nip'                   => '11180930000095',
                'created_at'            => Time::now(),
                'updated_at'            => Time::now()
            ],
            [
                'no_transaksi'          => ''.strtotime(Time::now()).'12',
                'tgl_transaksi'         => '2020-11-3',
                'keterangan_transaksi'  => 'Piutang',
                'no_akun'               => '112',
                'debit'                 => 7500000,
                'kredit'                => 0,
                'nip'                   => '11180930000095',
                'created_at'            => Time::now(),
                'updated_at'            => Time::now()
            ],
            [
                'no_transaksi'          => ''.strtotime(Time::now()).'13',
                'tgl_transaksi'         => '2020-11-3',
                'keterangan_transaksi'  => 'Pendapatan',
                'no_akun'               => '411',
                'debit'                 => 0,
                'kredit'                => 7500000,
                'nip'                   => '11180930000095',
                'created_at'            => Time::now(),
                'updated_at'            => Time::now()
            ]
        ];

        // Using Query Builder
        $this->db->table('jurnal_umum')->insertBatch($data);
    }
}
