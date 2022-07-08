<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mahasiswa extends Migration
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
            'id_fak' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'id_ps' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'id_angkatan' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'nama_mahasiswa' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ],
            'nim' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ],
            'telepon' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'jk' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('id_ps', 'programstudis', 'id');
        $this->forge->addForeignKey('id_fak', 'fakultas', 'id');
        $this->forge->addForeignKey('id_angkatan', 'angkatans', 'id');
        $this->forge->createTable('mahasiswas', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('mahasiswas');
    }
}
