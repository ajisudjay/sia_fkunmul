<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DetailAktifitas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_detail_aktifitas' => [
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
            'id_deskripsi_aktifitas' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
            ],
            'mahasiswa' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
            ],
            'id_tahun_ajaran' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
            ],
            'deskripsi_aktifitas' => [
                'type' => 'TEXT',
                'constraint' => '50000',
                'null' => TRUE
            ],
        ]);

        $this->forge->addKey('id_detail_aktifitas', TRUE);
        $this->forge->addForeignKey('id_aktifitas', 'aktifitas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('mahasiswa', 'mahasiswas', 'id_mahasiswa', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_tahun_ajaran', 'tahunajarans', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_deskripsi_aktifitas', 'deskripsiaktifitas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('detailaktifitas', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('detailaktifitas');
    }
}
