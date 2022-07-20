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
                'unsigned' => TRUE,
                'null' => TRUE
            ],
            'id_ps' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE
            ],
            'id_ta' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE
            ],
            'kelas' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('id_fak', 'fakultas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_ps', 'programstudis', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_ta', 'tahunajarans', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('kelas', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('kelas');
    }
}
