<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Modul extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'modul' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('moduls', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('moduls');
    }
}
