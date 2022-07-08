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
                'unsigned' => true,
            ],
            'id_ps' => [
                'type' => 'INT',
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
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('id_ps', 'programstudis', 'id');
        $this->forge->addForeignKey('id_fak', 'fakultas', 'id');
        $this->forge->createTable('dosens', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('dosens');
    }
}
