<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class StatusDosenSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_status' => 'Dosen FK',
            ],
            [
                'nama_status' => 'Dosen Unmul Luar FK',
            ],
            [
                'nama_status' => 'Dosen Luar Unmul',
            ],
            [
                'nama_status' => 'Mahasiswa',
            ],
        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('statusdosens')->insert($item);
        }
    }
}
