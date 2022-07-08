<?php

namespace App\Database\Seeds;

use App\Models\MahasiswaModel;
use CodeIgniter\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        $mahasiswa = new MahasiswaModel();
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 30; $i++) {
            $mahasiswa->save(
                [
                    'id_fak' => '1',
                    'id_ps' => $faker->numberBetween(1, 3),
                    'id_angkatan' => $faker->numberBetween(1, 4),
                    'nama_mahasiswa' => $faker->name,
                    'nim' => $faker->randomNumber(5, true),
                    'alamat' => $faker->address(),
                    'telepon' => $faker->phoneNumber(),
                    'email' => $faker->email(),
                    'status' => '4',
                    'jk' => 'pria',
                ]
            );
        }
    }
}
