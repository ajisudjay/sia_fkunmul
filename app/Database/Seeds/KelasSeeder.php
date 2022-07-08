<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_fak' => '1',
                'id_ps' => '1',
                'id_ta' => '1',
                'kelas' => '2020 A',
            ],
            [
                'id_fak' => '1',
                'id_ps' => '1',
                'id_ta' => '1',
                'kelas' => '2020 B',
            ],
            [
                'id_fak' => '1',
                'id_ps' => '1',
                'id_ta' => '1',
                'kelas' => '2021 A',
            ],
            [
                'id_fak' => '1',
                'id_ps' => '2',
                'id_ta' => '2',
                'kelas' => '2020 KG A',
            ],
            [
                'id_fak' => '1',
                'id_ps' => '2',
                'id_ta' => '2',
                'kelas' => '2020 KG B',
            ],
            [
                'id_fak' => '1',
                'id_ps' => '2',
                'id_ta' => '2',
                'kelas' => '2021 KG C',
            ],
            [
                'id_fak' => '1',
                'id_ps' => '3',
                'id_ta' => '3',
                'kelas' => '2020 KP A',
            ],
            [
                'id_fak' => '1',
                'id_ps' => '3',
                'id_ta' => '3',
                'kelas' => '2020 KP B',
            ],
            [
                'id_fak' => '1',
                'id_ps' => '3',
                'id_ta' => '3',
                'kelas' => '2021 KP C',
            ],
            [
                'id_fak' => '1',
                'id_ps' => '3',
                'id_ta' => '4',
                'kelas' => '2020 KP A',
            ],
            [
                'id_fak' => '1',
                'id_ps' => '3',
                'id_ta' => '4',
                'kelas' => '2020 KP B',
            ],
            [
                'id_fak' => '1',
                'id_ps' => '3',
                'id_ta' => '4',
                'kelas' => '2021 KP C',
            ],
        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('kelas')->insert($item);
        }
    }
}
