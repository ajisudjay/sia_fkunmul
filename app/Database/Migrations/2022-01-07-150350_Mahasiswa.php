<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Mahasiswa extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_mahasiswa' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'id_fak' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
            ],
            'id_ps' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
            ],
            'id_angkatan' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
            ],
            'id_pa' => [
                'type' => 'INT',
                'null' => TRUE,
                'unsigned' => true,
            ],
            'id_pb1' => [
                'type' => 'INT',
                'null' => TRUE,
                'unsigned' => true,
            ],
            'id_pb2' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
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

        $this->forge->addKey('id_mahasiswa', TRUE);
        $this->forge->addForeignKey('id_ps', 'programstudis', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_fak', 'fakultas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_angkatan', 'angkatans', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_pa', 'dosens', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_pb1', 'dosens', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_pb2', 'dosens', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('mahasiswas', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('mahasiswas');
    }
}
