<?php

namespace App\Database\Seeds;

use App\Models\MahasiswaModel;
use CodeIgniter\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_fak' => '1',
                'id_ps' => '1',
                'id_angkatan' => '7',
                'id_pa' => '2',
                'id_pb1' => '1',
                'id_pb2' => '1',
                'nama_mahasiswa' => 'Fulanah Binti Fulan',
                'nim' => '0811015012',
                'alamat' => 'Jl Damanhuri NO 100',
                'telepon' => '0890019239312',
                'email' => 'fulanan@gmail.com',
                'status' => '4',
                'jk' => 'wanita',
            ],
            [
                'id_fak' => '1',
                'id_ps' => '1',
                'id_angkatan' => '7',
                'id_pa' => '3',
                'id_pb1' => '1',
                'id_pb2' => '1',
                'nama_mahasiswa' => 'Fatimah Az zahra',
                'nim' => '0811015013',
                'alamat' => 'Jl pahlawan NO 100',
                'telepon' => '0890019239312',
                'email' => 'Fatimah@gmail.com',
                'status' => '4',
                'jk' => 'wanita',
            ],

        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('mahasiswas')->insert($item);
        }
    }
}
