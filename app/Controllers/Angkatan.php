<?php

namespace App\Controllers;

use App\Models\KoneksiModel;
use App\Models\AngkatanModel;
use App\Controllers\BaseController;

class Angkatan extends BaseController
{

    protected $KoneksiModel;
    protected $AngkatanModel;
    public function __construct()
    {
        $this->KoneksiModel = new KoneksiModel();
        $this->AngkatanModel = new AngkatanModel();
    }
    public function index()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $data = [
            'title' => 'Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Database',
            'header' => 'Angkatan',
            'validation' => \Config\Services::validation(),
            'koneksi' => $this->KoneksiModel->koneksi(),
        ];
        return view('angkatan/index', $data);
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
                'angkatan' => $this->AngkatanModel->orderBy('angkatan', 'DESC')->get()->getResultArray(),
            ];
            $msg = [
                'data' => view('angkatan/view-data', $data)
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
            $angkatan = $request->getVar('angkatan');
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'angkatan' => [
                    'label' => 'Angkatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'angkatan' => $validation->getError('angkatan'),
                    ],
                ];
                echo json_encode($msg);
            } else {
                $data = [
                    'angkatan' => $angkatan,
                ];
                $this->AngkatanModel->insert($data);

                $data2 = [
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'angkatan' => $this->AngkatanModel->orderBy('angkatan', 'DESC')->get()->getResultArray(),
                ];
                $msg = [
                    'sukses' => 'Data Angkatan Berhasil Ditambahkan !',
                    'status' => 'berhasil',
                    'data' => view('angkatan/view-data', $data2)
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
            $angkatan = $request->getVar('angkatan');
            $jenis = $request->getVar('jenis');
            $tingkat = $request->getVar('tingkat');
            $tanggal = $request->getVar('tanggal');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'angkatan' => [
                    'label' => 'Angkatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'angkatan' => $validation->getError('angkatan'),
                    ],
                ];
                echo json_encode($msg);
            } else {
                $data = [
                    'angkatan' => $angkatan,
                ];

                $this->AngkatanModel->update($id, $data);

                $data2 = [
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'angkatan' => $this->AngkatanModel->orderBy('angkatan', 'DESC')->get()->getResultArray(),
                ];
                $msg = [
                    'sukses' => 'Angkatan Berhasil Diubah !',
                    'status' => 'berhasil',
                    'data' => view('angkatan/view-data', $data2)
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
        $this->AngkatanModel->delete($id);

        session()->setFlashdata('pesanHapus', 'Angkatan Berhasil Di Hapus !');
        return redirect()->to('/angkatan');
    }
}
