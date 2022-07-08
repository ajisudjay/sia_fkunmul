<?php

namespace App\Database\Seeds;

use App\Models\MataKuliahModel;
use CodeIgniter\Database\Seeder;

class MataKuliahSeeder extends Seeder
{
    public function run()
    {
        $mataKuliah = new MataKuliahModel();
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 30; $i++) {
            $mataKuliah->save(
                [
                    'id_fak' => '1',
                    'id_ps' => $faker->numberBetween(1, 3),
                    'id_kurikulum' => $faker->numberBetween(1, 3),
                    'id_semester' => $faker->numberBetween(1, 2),
                    'mata_kuliah' => $faker->words(3, true),
                    'sks' => $faker->numberBetween(1, 3),
                    'paket_semester' => $faker->numberBetween(1, 7),
                    'acuan_nilai' => $faker->numberBetween(1, 7),
                    'rps' => '',
                    'presensi' => 'aktif',
                    'status' => '',
                ]
            );
        }
    }
}
