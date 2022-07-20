<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_role' => 'Admin',
            ],
            [
                'user_role' => 'Mahasiswa',
            ],
            [
                'user_role' => 'Dosen',
            ],
            [
                'user_role' => 'Umum',
            ],
            [
                'user_role' => 'Super Admin',
            ],
        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('userroles')->insert($item);
        }
    }
}
