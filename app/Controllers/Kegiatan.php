<?php

namespace App\Controllers;

use App\Models\KoneksiModel;
use App\Models\KegiatanModel;
use App\Controllers\BaseController;

class Kegiatan extends BaseController
{

    protected $KoneksiModel;
    protected $KegiatanModel;
    public function __construct()
    {
        $this->KoneksiModel = new KoneksiModel();
        $this->KegiatanModel = new KegiatanModel();
    }
    public function index()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $data = [
            'title' => 'Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Database',
            'header' => 'Kegiatan',
            'validation' => \Config\Services::validation(),
            'koneksi' => $this->KoneksiModel->koneksi(),
        ];
        return view('kegiatan/index', $data);
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
                'kegiatan' => $this->KegiatanModel->orderBy('kegiatan', 'ASC')->get()->getResultArray(),
            ];
            $msg = [
                'data' => view('kegiatan/view-data', $data)
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
            $kegiatan = $request->getVar('kegiatan');
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'kegiatan' => [
                    'label' => 'Kegiatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'kegiatan' => $validation->getError('kegiatan'),
                    ],
                ];
                echo json_encode($msg);
            } else {
                $data = [
                    'kegiatan' => $kegiatan,
                ];
                $this->KegiatanModel->insert($data);

                $data2 = [
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'kegiatan' => $this->KegiatanModel->orderBy('kegiatan', 'ASC')->get()->getResultArray(),
                ];
                $msg = [
                    'sukses' => 'Data Kegiatan Berhasil Ditambahkan !',
                    'status' => 'berhasil',
                    'data' => view('kegiatan/view-data', $data2)
                ];
                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
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
            $kegiatan = $request->getVar('kegiatan');
            $jenis = $request->getVar('jenis');
            $tingkat = $request->getVar('tingkat');
            $tanggal = $request->getVar('tanggal');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'kegiatan' => [
                    'label' => 'Kegiatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'kegiatan' => $validation->getError('kegiatan'),
                    ],
                ];
                echo json_encode($msg);
            } else {
                $data = [
                    'kegiatan' => $kegiatan,
                ];

                $this->KegiatanModel->update($id, $data);

                $data2 = [
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'kegiatan' => $this->KegiatanModel->orderBy('kegiatan', 'ASC')->get()->getResultArray(),
                ];
                $msg = [
                    'sukses' => 'Kegiatan Berhasil Diubah !',
                    'status' => 'berhasil',
                    'data' => view('kegiatan/view-data', $data2)
                ];
                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function hapus($id)
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $this->KegiatanModel->delete($id);

        session()->setFlashdata('pesanHapus', 'Kegiatan Berhasil Di Hapus !');
        return redirect()->to('/kegiatan');
    }
}
