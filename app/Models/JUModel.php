<?php

namespace App\Models;

use CodeIgniter\Model;

class JUModel extends Model
{
    protected $table = 'jurnal_umum';
    protected $primaryKey = 'no_transaksi';
    protected $allowedFields = ['no_transaksi', 'tgl_transaksi', 'keterangan_transaksi', 'no_akun', 'debit', 'kredit', 'nip', 'created_at', 'updated_at'];
}
