<?php

namespace App\Models;

use CodeIgniter\Model;

class JPModel extends Model
{
    protected $table = 'jurnal_penyesuaian';
    protected $primaryKey = 'id_penyesuaian';
    protected $allowedFields = ['id_penyesuaian', 'tgl_penyesuaian', 'keterangan_penyesuaian', 'no_akun', 'debit', 'kredit', 'nip', 'created_at', 'updated_at'];
}
