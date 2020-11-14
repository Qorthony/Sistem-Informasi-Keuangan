<?php namespace App\Models;
 
use CodeIgniter\Model;
 
class UserModel extends Model{
    protected $table = 'users';
    protected $primaryKey = 'nip';
    protected $allowedFields = ['nip','username','email','password','jenis_user','created_at','updated_at'];
}