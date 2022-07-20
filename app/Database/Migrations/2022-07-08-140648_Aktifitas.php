<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Aktifitas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'judul' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'id_kegiatan' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'id_matakuliahs' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'id_tahun_ajaran' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'id_modul' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'id_mahasiswa_aktifitas' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'file_bukti' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'constraint' => 1000,
                'null' => true,
            ],
            'slug_aktifitas' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],

        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('id_matakuliahs', 'matakuliahs', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_kegiatan', 'kegiatans', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_modul', 'moduls', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_tahun_ajaran', 'tahunajarans', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_mahasiswa_aktifitas', 'mahasiswas', 'id_mahasiswa', 'CASCADE', 'CASCADE');
        $this->forge->createTable('aktifitas', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('aktifitas');
    }
}
