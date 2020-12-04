<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunModel extends Model
{
    protected $table = 'akun';
    protected $primaryKey = 'no_akun';
    protected $allowedFields = ['no_akun','nama_akun','keterangan', 'created_at', 'updated_at'];
}
