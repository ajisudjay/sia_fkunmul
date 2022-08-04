<?php

namespace App\Controllers;

use App\Models\KoneksiModel;
use App\Models\FakultasModel;
use App\Models\SemesterModel;
use App\Models\KurikulumModel;
use App\Models\MataKuliahModel;
use App\Models\ProgramStudiModel;
use App\Controllers\BaseController;

class MataKuliah extends BaseController
{
    protected $MataKuliahModel;
    protected $KoneksiModel;
    protected $FakultasModel;
    protected $ProgramStudiModel;
    protected $SemesterModel;
    protected $KurikulumModel;

    public function __construct()
    {
        $this->MataKuliahModel = new MataKuliahModel();
        $this->KoneksiModel = new KoneksiModel();
        $this->FakultasModel = new FakultasModel();
        $this->ProgramStudiModel = new ProgramStudiModel();
        $this->SemesterModel = new SemesterModel();
        $this->KurikulumModel = new KurikulumModel();
    }

    public function index()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $data = [
            'title' => 'Mata Kuliah - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Database',
            'header' => 'Mata Kuliah',
            'validation' => \Config\Services::validation(),
            'mataKuliah' => $this->MataKuliahModel->orderBy('mata_kuliah', 'ASC')->get()->getResultArray(),
            'koneksi' => $this->KoneksiModel->koneksi(),
            'fakultas' => $this->FakultasModel->orderBy('fakultas', 'ASC')->get()->getResultArray(),
            'programStudi' => $this->ProgramStudiModel->orderBy('program_studi', 'ASC')->get()->getResultArray(),
            'kurikulum' => $this->KurikulumModel->orderBy('kurikulum', 'DESC')->get()->getResultArray(),
            'semester' => $this->SemesterModel->orderBy('nama_semester', 'ASC')->get()->getResultArray(),
        ];
        return view('mataKuliah/operator-view', $data);
    }

    public function operatorView()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $id_fak = $request->getVar('id_fak');
            $id_ps = $request->getVar('id_ps');
            $id_kurikulum = $request->getVar('id_kurikulum');
            $data = [
                'validation' => \Config\Services::validation(),
                'koneksi' => $this->KoneksiModel->koneksi(),
                'mataKuliah' => $this->MataKuliahModel->where(['id_fak' => $id_fak, 'id_ps' => $id_ps, 'id_kurikulum' => $id_kurikulum])->orderBy('mata_kuliah', 'ASC')->get()->getResultArray(),
                'fakultas' => $this->FakultasModel->orderBy('fakultas', 'ASC')->get()->getResultArray(),
                'programStudi' => $this->ProgramStudiModel->orderBy('program_studi', 'ASC')->get()->getResultArray(),
                'semester' => $this->SemesterModel->orderBy('nama_semester', 'ASC')->get()->getResultArray(),
                'kurikulum' => $this->KurikulumModel->orderBy('kurikulum', 'DESC')->get()->getResultArray(),
                'id_fak' => $id_fak,
                'id_ps' => $id_ps,
                'id_kurikulum' => $id_kurikulum,
            ];
            $msg = [
                'data' => view('mataKuliah/view-data', $data)
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
            $id_fak = $request->getVar('id_fak');
            $id_ps = $request->getVar('id_ps');
            $id_semester = $request->getVar('id_semester');
            $mata_kuliah = $request->getVar('mata_kuliah');
            $sks = $request->getVar('sks');
            $id_paket_semester = $request->getVar('id_paket_semester');
            $acuan_nilai = $request->getVar('acuan_nilai');
            $id_kurikulum = $request->getVar('id_kurikulum');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'mata_kuliah' => [
                    'label' => 'Mata Kuliah',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong'
                    ]
                ],
                'sks' => [
                    'label' => 'SKS',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'id_paket_semester' => [
                    'label' => 'Paket Semester',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'acuan_nilai' => [
                    'label' => 'Acuan Nilai',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'id_semester' => [
                    'label' => 'Semester',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'matakuliah' => $validation->getError('mata_kuliah'),
                        'semester' => $validation->getError('id_semester'),
                        'sks' => $validation->getError('sks'),
                        'id_paket_semester' => $validation->getError('id_paket_semester'),
                        'acuan_nilai' => $validation->getError('acuan_nilai'),
                    ],
                ];
                echo json_encode($msg);
            } else {
                $data = [
                    'id_fak' => $id_fak,
                    'id_ps' => $id_ps,
                    'id_kurikulum' => $id_kurikulum,
                    'id_semester' => $id_semester,
                    'mata_kuliah' => $mata_kuliah,
                    'sks' => $sks,
                    'acuan_nilai' => $acuan_nilai,
                    'paket_semester' => $id_paket_semester,
                ];

                $this->MataKuliahModel->insert($data);

                $data2 = [
                    'validation' => \Config\Services::validation(),
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'mataKuliah' => $this->MataKuliahModel->where(['id_fak' => $id_fak, 'id_ps' => $id_ps, 'id_kurikulum' => $id_kurikulum])->orderBy('mata_kuliah', 'ASC')->get()->getResultArray(),
                    'fakultas' => $this->FakultasModel->orderBy('fakultas', 'ASC')->get()->getResultArray(),
                    'programStudi' => $this->ProgramStudiModel->orderBy('program_studi', 'ASC')->get()->getResultArray(),
                    'semester' => $this->SemesterModel->orderBy('nama_semester', 'ASC')->get()->getResultArray(),
                    'kurikulum' => $this->KurikulumModel->orderBy('kurikulum', 'DESC')->get()->getResultArray(),
                    'id_fak' => $id_fak,
                    'id_ps' => $id_ps,
                    'id_kurikulum' => $id_kurikulum,
                    'sukses' => 'pesanBerhasil',
                    'pesan' => '' . $mata_kuliah . ' Berhasil Ditambahkan !',
                    'mk' => $mata_kuliah,
                    'sks' => $sks,
                    'pkt' => $id_paket_semester,
                    'an' => $acuan_nilai,
                    'smt' => $id_semester
                ];

                $msg = [
                    'sukses' => '' . $mata_kuliah . ' Berhasil Ditambahkan !',
                    'data' => view('mataKuliah/view-data', $data2),
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
            $username = $request->getVar('username');
            $nama = $request->getVar('nama');
            $jk = $request->getVar('jk');
            $role = $request->getVar('role');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                        'is_unique' => 'Username Sudah Terdaftar !'
                    ]
                ],
                'nama' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'role' => [
                    'label' => 'Role',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'jk' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'username' => $validation->getError('username'),
                        'nama' => $validation->getError('nama'),
                        'role' => $validation->getError('role'),
                        'jk' => $validation->getError('jk'),
                    ],
                ];
                echo json_encode($msg);
            } else {
                $data = [
                    'username' => $username,
                    'nama_user' => $nama,
                    'role' => $role,
                    'jk' => $jk,
                ];

                $this->UserModel->update($id, $data);

                $data2 = [
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'user' => $this->UserModel->orderBy('nama_user', 'ASC')->get()->getResultArray(),
                    'dosen' => $this->DosenModel->orderBy('nama_dosen', 'ASC')->get()->getResultArray(),
                    'mahasiswa' => $this->MahasiswaModel->orderBy('nama_mahasiswa', 'ASC')->get()->getResultArray(),
                    'userRole' => $this->UserRoleModel->get()->getResultArray(),
                ];
                $msg = [
                    'sukses' => '' . $nama . ' Berhasil Diedit !',
                    'status' => 'berhasil',
                    'data' => view('user/view-data', $data2)
                ];
                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
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

            $this->UserModel->delete($id);

            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'mataKuliah' => $this->MataKuliahModel->orderBy('mata_kuliah', 'ASC')->get()->getResultArray(),
                'koneksi' => $this->KoneksiModel->koneksi(),
                'fakultas' => $this->FakultasModel->orderBy('fakultas', 'ASC')->get()->getResultArray(),
                'programStudi' => $this->ProgramStudiModel->orderBy('program_studi', 'ASC')->get()->getResultArray(),
                'semester' => $this->SemesterModel->orderBy('tahun_ajaran', 'ASC')->get()->getResultArray()
            ];
            $msg = [
                'sukses' => 'User berhasil dihapus !',
                'data' => view('user/view-data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }
}
