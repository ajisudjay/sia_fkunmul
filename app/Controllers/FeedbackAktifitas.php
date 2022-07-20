<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AktifitasModel;
use App\Models\FeedbackAktifitasModel;
use App\Models\KoneksiModel;
use App\Models\UserModel;

class FeedbackAktifitas extends BaseController
{

    protected $FeedbackAktifitasModel;
    protected $KoneksiModel;
    protected $UserModel;
    protected $AktifitasModel;

    public function __construct()
    {
        $this->FeedbackAktifitasModel = new FeedbackAktifitasModel();
        $this->KoneksiModel = new KoneksiModel();
        $this->UserModel = new UserModel();
        $this->AktifitasModel = new AktifitasModel();
    }

    public function index()
    {
        //
    }

    public function inputMahasiwaBeranda()
    {
        $request = \Config\Services::request();
        $feedback = $request->getPost('feedback');
        $id_aktifitas = $request->getPost('id_aktifitas');
        $id_user = $request->getPost('id_user');
        $username = session()->get('username');
        $koneksi = $this->KoneksiModel->koneksi();

        if ($request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'feedback' => [
                    'label' => 'Feedback',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong'
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'feedback' => $validation->getError('feedback'),
                    ],
                ];
                return $this->response->setJSON($msg);
            } else {
                date_default_timezone_set('Asia/Makassar');
                $data_input = [
                    'feedback' => $feedback,
                    'id_aktifitas' => $id_aktifitas,
                    'id_user' => $id_user,
                    'waktu' => date('Y-m-d h:i:s'),
                    'status' => 'new'
                ];

                $this->FeedbackAktifitasModel->insert($data_input);
            }

            $data_view = [
                'user' => $this->UserModel->where('username', $username)->join('userroles', 'userroles.id_role=users.role')->first(),
                'aktifitas' => $this->AktifitasModel->viewTimelineFeedback($username),
                'feedback' => $this->AktifitasModel->viewFeedback(),
                'koneksi' => $koneksi
            ];

            $msg = [
                'sukses' => 'Feedback Berhasil Ditambahkan',
                'data' => view('halaman_awal/timeline/mahasiswa-data-view-timeline', $data_view)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }
}
