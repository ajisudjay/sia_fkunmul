<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProgramStudiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'program_studi' => 'S-1 Kedokteran',
            ],
            [
                'program_studi' => 'S-1 Kedokteran Gigi',
            ],
            [
                'program_studi' => 'D-3 Keperawatan',
            ],

        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('programstudis')->insert($item);
        }
    }
}
