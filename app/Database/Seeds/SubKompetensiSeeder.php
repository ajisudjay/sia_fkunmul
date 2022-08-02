<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SubKompetensiSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'kompetensi' => '1',
                'sub_kompetensi' => 'Profesionalitas yang Luhur'
            ],
            [
                'kompetensi' => '1',
                'sub_kompetensi' => 'Mawas Diri dan Pengembangan Diri'
            ],
            [
                'kompetensi' => '1',
                'sub_kompetensi' => 'Kolaborasi dan kerjasama'
            ],
            [
                'kompetensi' => '1',
                'sub_kompetensi' => 'Keselamatan Pasien dan Mutu Pelayanan'
            ],
            [
                'kompetensi' => '2',
                'sub_kompetensi' => 'Literasi Sains'
            ],
            [
                'kompetensi' => '2',
                'sub_kompetensi' => 'Literasi Teknologi'
            ],
            [
                'kompetensi' => '3',
                'sub_kompetensi' => 'Pengelolaan Masalah Kesehatan dan Sumber Daya'
            ],
            [
                'kompetensi' => '3',
                'sub_kompetensi' => 'Keterampilan Klinis'
            ],
            [
                'kompetensi' => '3',
                'sub_kompetensi' => 'Komunikasi efektif'
            ],
        ];

        foreach ($data as $item) {
            $this->db->table('subkompetensis')->insert($item);
        }
    }
}
