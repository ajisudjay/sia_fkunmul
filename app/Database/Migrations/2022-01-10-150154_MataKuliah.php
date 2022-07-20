<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MataKuliah extends Migration
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
                'null' => TRUE
            ],
            'id_ps' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
            ],
            'id_kurikulum' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
            ],
            'id_semester' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
            ],
            'mata_kuliah' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'sks' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'paket_semester' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'acuan_nilai' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'rps' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'presensi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('id_ps', 'programstudis', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_fak', 'fakultas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_kurikulum', 'kurikulums', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_semester', 'semesters', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('matakuliahs', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('matakuliahs');
    }
}
