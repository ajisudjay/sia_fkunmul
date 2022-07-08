<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SemesterSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_semester' => 'Ganjil',
            ],
            [
                'nama_semester' => 'Genap',
            ],
        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('semesters')->insert($item);
        }
    }
}
