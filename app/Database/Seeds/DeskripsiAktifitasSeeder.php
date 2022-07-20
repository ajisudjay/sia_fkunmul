<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DeskripsiAktifitasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'pertanyaan' => 'Apa yang telah dilakukan',
            ],
            [
                'pertanyaan' => 'Mengapa hal tersebut dilakukan',
            ],
            [
                'pertanyaan' => 'Apa yang bisa dipelajarin',
            ],
        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('deskripsiaktifitas')->insert($item);
        }
    }
}
