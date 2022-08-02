<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Kompetensi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_kompetensi' => [
                'type' => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'kompetensi' => [
                'type' => 'VARCHAR',
                'constraint' => 1000,
                'null' => true,
            ],
            'jenis' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_kompetensi', TRUE);
        $this->forge->createTable('kompetensis', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('kompetensis');
    }
}
