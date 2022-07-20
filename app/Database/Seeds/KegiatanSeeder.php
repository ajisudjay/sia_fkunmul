<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'kegiatan' => 'Kuliah',
            ],
            [
                'id' => '2',
                'kegiatan' => 'DKK',
            ],
            [
                'id' => '3',
                'kegiatan' => 'Praktikum',
            ],
            [
                'id' => '4',
                'kegiatan' => 'Tutor',
            ],
            [
                'id' => '5',
                'kegiatan' => 'Keterampilan Medik',
            ],
            [
                'id' => '6',
                'kegiatan' => 'Belajar Mandiri',
            ],
            [
                'id' => '7',
                'kegiatan' => 'Pleno',
            ],
            [
                'id' => '8',
                'kegiatan' => 'Responsi',
            ],
            [
                'id' => '9',
                'kegiatan' => 'Lainnya',
            ],

        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('kegiatans')->insert($item);
        }
    }
}
