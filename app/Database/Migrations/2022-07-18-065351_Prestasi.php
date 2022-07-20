<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Prestasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'id_prestasi_mahasiswa' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
            ],
            'jenis' => [
                'type' => 'VARCHAR',
                'constraint' => '225',
                'null' => TRUE
            ],
            'tingkat' => [
                'type' => 'VARCHAR',
                'constraint' => '225',
                'null' => TRUE
            ],
            'tanggal' => [
                'type' => 'DATE',
                'null' => TRUE
            ],
            'judul' => [
                'type' => 'VARCHAR',
                'constraint' => '225',
                'null' => TRUE
            ],
            'file_bukti' => [
                'type' => 'VARCHAR',
                'constraint' => '225',
                'null' => TRUE
            ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('id_prestasi_mahasiswa', 'mahasiswas', 'id_mahasiswa', 'CASCADE', 'CASCADE');
        $this->forge->createTable('prestasis', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('prestasis');
    }
}
