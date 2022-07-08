<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kelas extends Migration
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
                'unsigned' => TRUE
            ],
            'id_ps' => [
                'type' => 'INT',
                'unsigned' => TRUE
            ],
            'id_ta' => [
                'type' => 'INT',
                'unsigned' => TRUE
            ],
            'kelas' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('id_fak', 'fakultas', 'id');
        $this->forge->addForeignKey('id_ps', 'programstudis', 'id');
        $this->forge->addForeignKey('id_ta', 'tahunajarans', 'id');
        $this->forge->createTable('kelas', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('kelas');
    }
}
