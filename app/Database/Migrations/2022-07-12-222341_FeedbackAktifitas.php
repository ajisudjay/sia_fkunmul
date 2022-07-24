<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class FeedbackAktifitas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_feedback' => [
                'type' => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'id_aktifitas' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
            ],
            'id_user' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
            ],
            'penerima' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
            ],
            'pengirim' => [
                'type' => 'INT',
                'unsigned' => true,
                'null' => TRUE
            ],
            'feedback' => [
                'type' => 'TEXT',
                'constraint' => '20000',
                'null' => TRUE
            ],
            'waktu' => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE
            ],
        ]);

        $this->forge->addKey('id_feedback', TRUE);
        $this->forge->addForeignKey('id_user', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('penerima', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pengirim', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_aktifitas', 'aktifitas', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('feedbackaktifitas', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('feedbackaktifitas');
    }
}
