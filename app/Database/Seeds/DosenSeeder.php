<?php

namespace App\Database\Seeds;

use App\Models\DosenModel;
use CodeIgniter\Database\Seeder;

class DosenSeeder extends Seeder
{
    public function run()
    {
        $dosen = new DosenModel();
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $dosen->save(
                [
                    'id_fak' => '1',
                    'id_ps' => $faker->numberBetween(1, 3),
                    'nama_dosen' => $faker->name,
                    'nip' => $faker->randomNumber(5, true),
                    'alamat' => $faker->address(),
                    'telepon' => $faker->phoneNumber(),
                    'email' => $faker->email(),
                    'jk' => 'pria',
                    'status' => $faker->numberBetween(1, 3),
                ]
            );
        }
    }
}
