<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SubKompetensi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_sub_kompetensi' => [
                'type' => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'kompetensi' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => true,
            ],
            'sub_kompetensi' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id_sub_kompetensi', TRUE);
        $this->forge->addForeignKey('kompetensi', 'kompetensis', 'id_kompetensi', 'CASCADE', 'CASCADE');
        $this->forge->createTable('subkompetensis', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('subkompetensis');
    }
}
