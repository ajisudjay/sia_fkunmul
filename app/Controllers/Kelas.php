<?php

namespace App\Controllers;

use App\Models\KoneksiModel;
use App\Models\KelasModel;
use App\Models\FakultasModel;
use App\Models\ProgramStudiModel;
use App\Models\TahunAjaranModel;
use App\Controllers\BaseController;

class Kelas extends BaseController
{
    protected $KelasModel;
    protected $KoneksiModel;
    protected $FakultasModel;
    protected $ProgramStudiModel;
    protected $TahunAjaranModel;

    public function __construct()
    {
        $this->KelasModel = new KelasModel();
        $this->KoneksiModel = new KoneksiModel();
        $this->FakultasModel = new FakultasModel();
        $this->ProgramStudiModel = new ProgramStudiModel();
        $this->TahunAjaranModel = new TahunAjaranModel();
    }

    public function index()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $data = [
            'title' => 'Kelas - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Master Data',
            'header' => 'Kelas',
            'validation' => \Config\Services::validation(),
            'kelas' => $this->KelasModel->orderBy('kelas', 'ASC')->get()->getResultArray(),
            'koneksi' => $this->KoneksiModel->koneksi(),
            'fakultas' => $this->FakultasModel->orderBy('fakultas', 'ASC')->get()->getResultArray(),
            'programStudi' => $this->ProgramStudiModel->orderBy('program_studi', 'ASC')->get()->getResultArray(),
            'tahunAjaran' => $this->TahunAjaranModel->orderBy('tahun_ajaran', 'ASC')->get()->getResultArray(),
        ];
        return view('kelas/operator-view', $data);
    }

    public function operatorView()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $fakultas = $request->getVar('fakultas');
            $programStudi = $request->getVar('programStudi');
            $tahunAjaran = $request->getVar('tahunAjaran');
            $data = [
                'title' => 'Kelas - Fakultas Kedokteran Universitas Mulawarman',
                'topHeader' => 'Master Data',
                'header' => 'Kelas',
                'validation' => \Config\Services::validation(),
                'kelas' => $this->KelasModel->dataKelas($fakultas, $programStudi, $tahunAjaran),
                'koneksi' => $this->KoneksiModel->koneksi(),
                'fakultas' => $fakultas,
                'programStudi' => $programStudi,
                'tahunAjaran' => $tahunAjaran,
            ];

            $msg = [
                'data' => view('kelas/operator-data-view', $data)
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
            $programStudi = $request->getVar('programStudi');
            $tahunAjaran = $request->getVar('tahunAjaran');
            $fakultas = $request->getVar('fakultas');
            $kelas = $request->getVar('kelas');
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'kelas' => [
                    'label' => 'Nama Kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Kuliah Tidak Boleh Kosong'
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'kelas' => $validation->getError('kelas'),
                    ],
                ];
            } else {
                $data = [
                    'id_fak' => $fakultas,
                    'id_ps' => $programStudi,
                    'id_ta' => $tahunAjaran,
                    'kelas' => $kelas,
                ];

                $this->KelasModel->insert($data);

                $data2 = [
                    'title' => 'Kelas - Fakultas Kedokteran Universitas Mulawarman',
                    'topHeader' => 'Master Data',
                    'header' => 'Kelas',
                    'validation' => \Config\Services::validation(),
                    'kelas' => $this->KelasModel->dataKelas($fakultas, $programStudi, $tahunAjaran),
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'fakultas' => $fakultas,
                    'programStudi' => $programStudi,
                    'tahunAjaran' => $tahunAjaran,
                    'sukses' => 'pesanBerhasil',
                    'namaKelas' => $kelas
                ];
                $msg = [
                    'sukses' => 'Kelas Berhasil Tersimpan',
                    'data' => view('kelas/operator-data-view', $data2)
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
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
            $programStudi = $request->getVar('programStudi');
            $tahunAjaran = $request->getVar('tahunAjaran');
            $fakultas = $request->getVar('fakultas');
            $kelas = $request->getVar('kelas');
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'kelas' => [
                    'label' => 'Nama Kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Kuliah Tidak Boleh Kosong'
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'kelas' => $validation->getError('kelas'),
                    ],
                ];
            } else {
                $data = [
                    'kelas' => $kelas,
                ];

                $this->KelasModel->update($id, $data);

                $data2 = [
                    'title' => 'Kelas - Fakultas Kedokteran Universitas Mulawarman',
                    'topHeader' => 'Master Data',
                    'header' => 'Kelas',
                    'validation' => \Config\Services::validation(),
                    'kelas' => $this->KelasModel->dataKelas($fakultas, $programStudi, $tahunAjaran),
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'fakultas' => $fakultas,
                    'programStudi' => $programStudi,
                    'tahunAjaran' => $tahunAjaran,
                    'sukses' => 'pesanBerhasil',
                    'namaKelas' => $kelas
                ];
                $msg = [
                    'sukses' => 'Kelas Berhasil Diedit',
                    'data' => view('kelas/operator-data-view', $data2)
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function hapus()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            $id = $request->getVar('id');
            $programStudi = $request->getVar('programStudi');
            $tahunAjaran = $request->getVar('tahunAjaran');
            $fakultas = $request->getVar('fakultas');
            $kelas = $request->getVar('kelas');

            $this->KelasModel->delete($id);

            $data2 = [
                'title' => 'Kelas - Fakultas Kedokteran Universitas Mulawarman',
                'topHeader' => 'Master Data',
                'header' => 'Kelas',
                'validation' => \Config\Services::validation(),
                'kelas' => $this->KelasModel->dataKelas($fakultas, $programStudi, $tahunAjaran),
                'koneksi' => $this->KoneksiModel->koneksi(),
                'fakultas' => $fakultas,
                'programStudi' => $programStudi,
                'tahunAjaran' => $tahunAjaran,
                'sukses' => 'pesanBerhasil',
                'namaKelas' => $kelas
            ];
            $msg = [
                'sukses' => '' . $kelas . ' Berhasil Dihapus',
                'data' => view('kelas/operator-data-view', $data2)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }
}
