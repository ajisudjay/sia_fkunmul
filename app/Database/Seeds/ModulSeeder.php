<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ModulSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'modul' => 'Apa yang terjadi ?',
            ],
            [
                'modul' => 'Mengapa hal tersebut terjadi ?',
            ],
            [
                'modul' => 'Hal positif dan perbaikan yang dapat dilakukan',
            ],
        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('moduls')->insert($item);
        }
    }
}
