<?php

namespace App\Database\Seeds;

use App\Models\DosenModel;
use CodeIgniter\Database\Seeder;

class DosenSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_fak' => '1',
                'id_ps' => '1',
                'nama_dosen' => '',
                'nip' => '',
                'alamat' => '',
                'telepon' => '',
                'email' => '',
                'status_ajar' => 'nonaktif',
                'jk' => '',
            ],
            [
                'id_fak' => '1',
                'id_ps' => '1',
                'nama_dosen' => 'Dr. dr. Rahmad Bachtiar, MPPM',
                'nip' => '0811015011',
                'alamat' => 'Jl Kadrie Oening Samarinda',
                'telepon' => '1231231312312312',
                'email' => 'rb@gmail.com',
                'jk' => 'pria',
                'status_ajar' => 'aktif',
                'id_status_dosen' => '1',
            ],
            [
                'id_fak' => '1',
                'id_ps' => '1',
                'nama_dosen' => 'Dr. Emil Bachtiar',
                'nip' => '0811015021',
                'alamat' => 'Jl Kadrie Oening Samarinda',
                'telepon' => '1231231312312312',
                'email' => 'rb@gmail.com',
                'jk' => 'pria',
                'status_ajar' => 'aktif',
                'id_status_dosen' => '1',
            ],
            [
                'id_fak' => '1',
                'id_ps' => '2',
                'nama_dosen' => 'Dr. Sulis',
                'nip' => '0811015022',
                'alamat' => 'Jl Kadrie Oening Samarinda',
                'telepon' => '1231231312312312',
                'email' => 'rb@gmail.com',
                'jk' => 'pria',
                'status_ajar' => 'aktif',
                'id_status_dosen' => '1',
            ],

        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('dosens')->insert($item);
        }
    }
}
