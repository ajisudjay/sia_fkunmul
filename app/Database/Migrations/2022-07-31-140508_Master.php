<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Master extends Migration
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
            'id_ta' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('id_ta', 'tahunajarans', 'id', 'cascade', 'cascade');
        $this->forge->createTable('masters', true);
    }

    public function down()
    {
        $this->forge->dropTable('masters');
    }
}
