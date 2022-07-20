<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class FeedbackAktifitasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id_aktifitas' => '1',
                'feedback' => 'FeedbackActifitasSeeder FeedbackActifitasSeeder FeedbackActifitasSeeder FeedbackActifitasSeeder FeedbackActifitasSeeder FeedbackActifitasSeeder FeedbackActifitasSeeder FeedbackActifitasSeeder FeedbackActifitasSeeder FeedbackActifitasSeeder FeedbackActifitasSeeder FeedbackActifitasSeeder FeedbackActifitasSeeder FeedbackActifitasSeeder FeedbackActifitasSeeder FeedbackActifitasSeeder FeedbackActifitasSeeder FeedbackActifitasSeeder FeedbackActifitasSeeder',
                'id_user' => '3',
                'status' => 'new',
                'waktu' => '2022-7-22 12:25:32'
            ],
            [
                'id_aktifitas' => '1',
                'feedback' => 'ModulSeeder ModulSeeder ModulSeeder ModulSeeder ModulSeeder ModulSeeder ModulSeeder ModulSeeder ModulSeeder ModulSeeder ModulSeeder ModulSeeder ModulSeeder ModulSeeder ModulSeeder ModulSeeder ModulSeeder ModulSeeder ModulSeeder ModulSeeder ModulSeeder ModulSeeder ModulSeeder ModulSeeder',
                'id_user' => '2',
                'status' => 'new',
                'waktu' => '2022-7-23 12:20:32'
            ],
            [
                'id_aktifitas' => '1',
                'feedback' => 'bagus dan tingkatkan',
                'id_user' => '2',
                'status' => 'new',
                'waktu' => '2022-7-24 12:15:32'
            ],
            [
                'id_aktifitas' => '1',
                'feedback' => 'semangat',
                'id_user' => '2',
                'status' => 'new',
                'waktu' => '2022-7-22 12:23:32'
            ],
            [
                'id_aktifitas' => '2',
                'feedback' => 'Baik pak terimakasih',
                'id_user' => '3',
                'status' => 'new',
                'waktu' => '2022-7-22 12:23:32'
            ],
            [
                'id_aktifitas' => '2',
                'feedback' => 'jangan lupa sarapan',
                'id_user' => '2',
                'status' => 'new',
                'waktu' => '2022-7-22 12:23:32'
            ],
            [
                'id_aktifitas' => '2',
                'feedback' => 'Baik pak terimakasih',
                'id_user' => '3',
                'status' => 'new',
                'waktu' => '2022-7-22 12:23:32'
            ],
            [
                'id_aktifitas' => '2',
                'feedback' => 'jangan lupa sarapan',
                'id_user' => '2',
                'status' => 'new',
                'waktu' => '2022-7-22 12:23:32'
            ],
        ];

        foreach ($data as $item) {
            // insert semua data ke tabel
            $this->db->table('FeedbackAktifitas')->insert($item);
        }
    }
}
