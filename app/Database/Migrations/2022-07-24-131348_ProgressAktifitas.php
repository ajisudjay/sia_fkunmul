<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProgressAktifitas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_progress' => [
                'type' => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'id_aktifitas' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
            ],
            'id_mahasiswa' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
            ],
            'id_dosen' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
            ],
            'progress' => [
                'type' => 'TEXT',
                'constraint' => '50000',
                'null' => TRUE
            ],
            'tanggal' => [
                'type' => 'DATE',
                'null' => TRUE
            ]
        ]);

        $this->forge->addKey('id_progress', TRUE);
        $this->forge->addForeignKey('id_aktifitas', 'aktifitas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_mahasiswa', 'mahasiswas', 'id_mahasiswa', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_dosen', 'dosens', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('progressaktifitas', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('progressaktifitas');
    }
}
