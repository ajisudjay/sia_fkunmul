<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AktifitasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => '1',
                'id_kegiatan' => '1',
                'judul' => 'Kuliah Pengantar',
                'tanggal' => '2022-02-07',
                'id_modul' => '1',
                'id_tahun_ajaran' => '2',
                'id_matakuliahs' => '1',
                'file_bukti' => 'gambar.jpg',
                'deskripsi' => 'sadsadasdasdjba kajbdkjasd kjbasdkbasd kbasdk asdkhbadasd jkbasdj akarena jahds ahsasdh asdoi',
                'id_mahasiswa_aktifitas' => '1',
            ],
            [
                'id' => '2',
                'id_kegiatan' => '3',
                'judul' => 'DKK 1',
                'tanggal' => '2022-02-07',
                'id_modul' => '1',
                'id_tahun_ajaran' => '2',
                'id_matakuliahs' => '2',
                'file_bukti' => 'gambar2.jpg',
                'deskripsi' => 'sadsadasdasdjba kajbdkjasd kjbasdkbasd kbasdk asdkhbadasd jkbasdj akarena jahds ahsasdh asdoi',
                'id_mahasiswa_aktifitas' => '2',
            ],
            [
                'id' => '3',
                'id_kegiatan' => '5',
                'judul' => 'Kejuaraan Karate',
                'tanggal' => '2022-02-08',
                'id_modul' => '3',
                'id_tahun_ajaran' => '2',
                'id_matakuliahs' => '1',
                'file_bukti' => 'gambar3.jpg',
                'deskripsi' => 'sadsadasdasdjba kajbdkjasd kjbasdkbasd kbasdk asdkhbadasd jkbasdj akarena jahds ahsasdh asdoi',
                'id_mahasiswa_aktifitas' => '1',
            ],
        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('aktifitas')->insert($item);
        }
    }
}
