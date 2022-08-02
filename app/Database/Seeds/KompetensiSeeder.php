<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class KompetensiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kompetensi' => 'Personal dan Profesional',
                'jenis' => 'regular'
            ],
            [
                'kompetensi' => 'Intelektual, Analitis dan Kreatif',
                'jenis' => 'regular'
            ],
            [
                'kompetensi' => 'Teknis',
                'jenis' => 'regular'
            ],
            [
                'kompetensi' => 'value/ethic for interprofessional practice',
                'jenis' => 'ipe'
            ],
            [
                'kompetensi' => 'role/responsibilities',
                'jenis' => 'ipe'
            ],
            [
                'kompetensi' => 'komunikasi interprofesional ',
                'jenis' => 'ipe'
            ],
            [
                'kompetensi' => 'Tim dan kerjasama tim',
                'jenis' => 'ipe'
            ],

        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('kompetensis')->insert($item);
        }
    }
}
