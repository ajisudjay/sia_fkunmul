<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSedder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => '0811015010',
                'nama_user' => 'Dr. dr. Riezfian Raditya Susanto, SKM., M.Kes',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'role' => '1',
                'foto' => 'user1.png',
                'jk' => 'pria'
            ],
            [
                'username' => '0811015011',
                'nama_user' => 'Dr. dr. Rahmad Bachtiar, MPPM',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'role' => '3',
                'foto' => 'user1.png',
                'id_user_ps' => '1',
                'jk' => 'pria'
            ],
            [
                'username' => '0811015012',
                'nama_user' => 'Abdullah bin Fulan',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'role' => '2',
                'foto' => 'user1.png',
                'jk' => 'pria'
            ],
            [
                'username' => '0811015013',
                'nama_user' => 'Fatimah binti Fulan',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'role' => '2',
                'foto' => 'user1.png',
                'jk' => 'wanita'
            ],
            [
                'username' => '0811015020',
                'nama_user' => 'Enny Isnaniah',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'role' => '1',
                'foto' => 'user1.png',
                'id_user_ps' => '1',
                'jk' => 'pria'
            ],
            [
                'username' => '0811015021',
                'nama_user' => 'Albar',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'role' => '1',
                'foto' => 'user1.png',
                'id_user_ps' => '2',
                'jk' => 'pria'
            ],
        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('users')->insert($item);
        }
    }
}
