<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DataSeeder extends Seeder
{
    public function run()
    {
        $this->call('FakultasSeeder');
        $this->call('ProgramStudiSeeder');
        $this->call('TahunAjaranSeeder');
        $this->call('UserSedder');
        $this->call('KelasSeeder');
        $this->call('DosenSeeder');
        $this->call('AngkatanSeeder');
        $this->call('MahasiswaSeeder');
        $this->call('StatusDosenSeeder');
        $this->call('UserRoleSeeder');
        $this->call('KurikulumSeeder');
        $this->call('SemesterSeeder');
        $this->call('MataKuliahSeeder');
    }
}
