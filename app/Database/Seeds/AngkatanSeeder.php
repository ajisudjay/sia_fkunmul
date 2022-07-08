<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AngkatanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'angkatan' => '2015',
            ],
            [
                'angkatan' => '2016',
            ],
            [
                'angkatan' => '2017',
            ],
            [
                'angkatan' => '2018',
            ],
            [
                'angkatan' => '2019',
            ],
            [
                'angkatan' => '2020',
            ],
            [
                'angkatan' => '2021',
            ],
        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('angkatans')->insert($item);
        }
    }
}
