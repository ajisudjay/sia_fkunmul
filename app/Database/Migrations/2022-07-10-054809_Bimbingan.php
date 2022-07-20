<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bimbingan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true
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
            ]
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('id_mahasiswa', 'mahasiswas', 'id_mahasiswa', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_dosen', 'dosens', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('bimbingans', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('bimbingans');
    }
}
