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
        $this->call('UserRoleSeeder');
        $this->call('UserSedder');
        $this->call('KelasSeeder');
        $this->call('AngkatanSeeder');
        $this->call('StatusDosenSeeder');
        $this->call('KurikulumSeeder');
        $this->call('SemesterSeeder');
        $this->call('DosenSeeder');
        $this->call('MahasiswaSeeder');
        $this->call('MataKuliahSeeder');
        $this->call('ModulSeeder');
        $this->call('KegiatanSeeder');
        $this->call('DeskripsiAktifitasSeeder');
        $this->call('AktifitasSeeder');
        $this->call('BimbinganSeeder');
        $this->call('FeedbackAktifitasSeeder');
    }
}
