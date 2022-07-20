<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ModulSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'modul' => 'Apa yang terjadi ?',
            ],
            [
                'id' => '2',
                'modul' => 'Mengapa hal tersebut terjadi ?',
            ],
            [
                'id' => '3',
                'modul' => 'Deskripsikan hal yang terjadi ?',
            ],
            [
                'id' => '4',
                'modul' => 'Pelajaran apa yang didapatkan ?',
            ],
        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('moduls')->insert($item);
        }
    }
}
