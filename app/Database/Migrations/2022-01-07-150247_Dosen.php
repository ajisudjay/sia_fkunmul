<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Dosen extends Migration
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
                'null' => true,
                'unsigned' => true,
            ],
            'id_ps' => [
                'type' => 'INT',
                'null' => true,
                'unsigned' => true,
            ],
            'id_status_dosen' => [
                'type' => 'INT',
                'null' => true,
                'unsigned' => true,
            ],
            'nama_dosen' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ],
            'nip' => [
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
                'type' => 'ENUM',
                'constraint' => ['pria', 'wanita'],
                'default' => 'pria',
            ],
            'status_ajar' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('id_ps', 'programstudis', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_fak', 'fakultas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_status_dosen', 'statusdosens', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('dosens', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('dosens');
    }
}
