<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Monitoring extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_monitoring' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'id_matakuliah' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
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
            'id_ta' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
            ],
            'id_kelas' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
            ],
            'id_paket_semester' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
            ],
            'id_dosen' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
            ],
            'pertemuan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'materi' => [
                'type' => 'TEXT',
                'constraint' => 2000,
                'null' => true,
            ],
            'rps' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'tanggal_rencana' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'tanggal_realisasi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'jam_rencana' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'jam_realisasi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'keterangan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'slug_mk' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_monitoring', TRUE);
        $this->forge->addForeignKey('id_ps', 'programstudis', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_matakuliah', 'matakuliahs', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_fak', 'fakultas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_ta', 'tahunajarans', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_kelas', 'kelas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_dosen', 'dosens', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('monitorings', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('monitorings');
    }
}
