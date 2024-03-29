<?php

namespace App\Controllers;

use App\Models\KoneksiModel;
use App\Models\ProgramStudiModel;
use App\Models\KurikulumModel;
use App\Controllers\BaseController;

class Kurikulum extends BaseController
{

    protected $KoneksiModel;
    protected $KurikulumModel;
    protected $ProgramStudiModel;
    public function __construct()
    {
        $this->KoneksiModel = new KoneksiModel();
        $this->KurikulumModel = new KurikulumModel();
        $this->ProgramStudiModel = new ProgramStudiModel();
    }
    public function index()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $data = [
            'title' => 'Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Database',
            'header' => 'Kurikulum',
            'validation' => \Config\Services::validation(),
            'koneksi' => $this->KoneksiModel->koneksi(),
            'programStudi' => $this->ProgramStudiModel->orderBy('program_studi', 'ASC')->get()->getResultArray(),
        ];
        return view('kurikulum/index', $data);
    }

    public function viewData()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            $programStudi = $request->getVar('programStudi');
            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'kurikulum' => $this->KurikulumModel->dataKurikulum($programStudi),
                'programStudi' => $programStudi,
            ];
            $msg = [
                'data' => view('kurikulum/view-data', $data)
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
            $kurikulum = $request->getVar('kurikulum');
            $programStudix = $request->getVar('programStudi');
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'kurikulum' => [
                    'label' => 'Kurikulum',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'kurikulum' => $validation->getError('kurikulum'),
                    ],
                ];
                echo json_encode($msg);
            } else {
                $data = [
                    'kurikulum' => $kurikulum,
                    'id_ps' => $programStudix,
                ];
                $this->KurikulumModel->insert($data);

                $data2 = [
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'kurikulum' => $this->KurikulumModel->dataKurikulum($programStudix),
                    'programStudi' => $programStudix,
                ];
                $msg = [
                    'sukses' => 'Data Kurikulum Berhasil Ditambahkan !',
                    'status' => 'berhasil',
                    'data' => view('kurikulum/view-data', $data2)
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
            $programStudix = $request->getVar('programStudi');
            $kurikulum = $request->getVar('kurikulum');
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'kurikulum' => [
                    'label' => 'Kurikulum',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'kurikulum' => $validation->getError('kurikulum'),
                        'id_ps' => $programStudix,
                    ],
                ];
                echo json_encode($msg);
            } else {
                $data = [
                    'kurikulum' => $kurikulum,
                ];

                $this->KurikulumModel->update($id, $data);

                $data2 = [
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'kurikulum' => $this->KurikulumModel->dataKurikulum($programStudix),
                    'programStudi' => $programStudix,
                ];
                $msg = [
                    'sukses' => 'Kurikulum Berhasil Diedit !',
                    'status' => 'berhasil',
                    'data' => view('kurikulum/view-data', $data2)
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
        $this->KurikulumModel->delete($id);

        session()->setFlashdata('pesanHapus', 'Kurikulum Berhasil Di Hapus !');
        return redirect()->to('/kurikulum');
    }
}
