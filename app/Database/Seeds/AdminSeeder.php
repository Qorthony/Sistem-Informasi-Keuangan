<?php namespace App\Database\Seeds;

use CodeIgniter\I18n\Time;

class AdminSeeder extends \CodeIgniter\Database\Seeder
{
        public function run()
        {
                $data = [
                        'nip'           => '11180930000095',
                        'username'      => 'Admin',
                        'email'         => 'darth@theempire.com',
                        'password'      => password_hash('ayohitung123', PASSWORD_DEFAULT),
                        'jenis_user'    => "1",
                        'created_at'    => Time::now(),
                        'updated_at'    => Time::now()
                ];

                // Using Query Builder
                $this->db->table('users')->insert($data);
        }
}