<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Angkatan extends Migration
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
            'angkatan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('angkatans', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('angkatans');
    }
}
