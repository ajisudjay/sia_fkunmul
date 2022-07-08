<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StatusDosen extends Migration
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
            'nama_status' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('statusdosens', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('statusdosens');
    }
}
