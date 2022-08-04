<?php

namespace App\Controllers;

use App\Models\KoneksiModel;
use App\Models\DeskripsiAktifitasModel;
use App\Controllers\BaseController;

class Desk extends BaseController
{

    protected $KoneksiModel;
    protected $DeskripsiAktifitasModel;
    public function __construct()
    {
        $this->KoneksiModel = new KoneksiModel();
        $this->DeskripsiAktifitasModel = new DeskripsiAktifitasModel();
    }
    public function index()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $data = [
            'title' => 'Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Database',
            'header' => 'Detail Aktifitas',
            'validation' => \Config\Services::validation(),
            'koneksi' => $this->KoneksiModel->koneksi(),
        ];
        return view('desk/index', $data);
    }

    public function viewData()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'desk' => $this->DeskripsiAktifitasModel->orderBy('pertanyaan', 'ASC')->get()->getResultArray(),
            ];
            $msg = [
                'data' => view('desk/view-data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function tambah()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $desk = $request->getVar('desk');
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'desk' => [
                    'label' => 'Detail Aktifitas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'desk' => $validation->getError('desk'),
                    ],
                ];
                echo json_encode($msg);
            } else {
                $data = [
                    'pertanyaan' => $desk,
                ];
                $this->DeskripsiAktifitasModel->insert($data);
                $data2 = [
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'desk' => $this->DeskripsiAktifitasModel->orderBy('pertanyaan', 'ASC')->get()->getResultArray(),
                ];
                $msg = [
                    'sukses' => 'Pertanyaan Berhasil Ditambahkan !',
                    'status' => 'berhasil',
                    'data' => view('desk/view-data', $data2)
                ];
                echo json_encode($msg);
            }
        }
    }

    public function edit()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {

            $id = $request->getVar('id');
            $desk = $request->getVar('desk');
            $jenis = $request->getVar('jenis');
            $tingkat = $request->getVar('tingkat');
            $tanggal = $request->getVar('tanggal');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'desk' => [
                    'label' => 'Detail Aktifitas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'desk' => $validation->getError('desk'),
                    ],
                ];
                echo json_encode($msg);
            } else {
                $data = [
                    'pertanyaan' => $desk,
                ];

                $this->DeskripsiAktifitasModel->update($id, $data);

                $data2 = [
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'desk' => $this->DeskripsiAktifitasModel->orderBy('pertanyaan', 'ASC')->get()->getResultArray(),
                ];
                $msg = [
                    'sukses' => 'Pertanyaan Berhasil Diubah !',
                    'status' => 'berhasil',
                    'data' => view('desk/view-data', $data2)
                ];
                echo json_encode($msg);
            }
        }
    }

    public function hapus($id)
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $this->DeskripsiAktifitasModel->delete($id);

        session()->setFlashdata('pesanHapus', 'Pertanyaan Berhasil Di Hapus !');
        return redirect()->to('/desk');
    }
}
