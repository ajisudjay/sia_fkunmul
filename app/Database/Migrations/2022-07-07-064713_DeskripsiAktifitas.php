<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class DeskripsiAktifitas extends Migration
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
            'pertanyaan' => [
                'type' => 'TEXT',
                'null' => TRUE,
                'constraint' => 2000
            ],
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('deskripsiaktifitas', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('deskripsiaktifitas');
    }
}
