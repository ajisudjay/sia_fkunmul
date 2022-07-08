<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TahunAjaranSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'tahun_ajaran' => 'Ganjil 2020/2021',
            ],
            [
                'tahun_ajaran' => 'Genap 2020/2021',
            ],
            [
                'tahun_ajaran' => 'Ganjil 2021/2022',
            ],
            [
                'tahun_ajaran' => 'Genap 2021/2022',
            ],

        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('tahunajarans')->insert($item);
        }
    }
}
