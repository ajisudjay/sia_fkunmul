<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KurikulumSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kurikulum' => '2019',
            ],
            [
                'kurikulum' => '2016',
            ],
            [
                'kurikulum' => '2013',
            ],
        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('kurikulums')->insert($item);
        }
    }
}
