<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FakultasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'fakultas' => 'Kedokteran',
            ],
        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('fakultas')->insert($item);
        }
    }
}
