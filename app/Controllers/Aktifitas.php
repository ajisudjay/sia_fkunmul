<?php

namespace App\Controllers;

use App\Models\KoneksiModel;
use App\Models\AktifitasModel;
use App\Models\KegiatanModel;
use App\Models\MataKuliahModel;
use App\Models\DeskripsiAktifitasModel;
use App\Controllers\BaseController;
use App\Models\DetailAktifitasModel;
use App\Models\FeedbackAktifitasModel;
use App\Models\MahasiswaModel;
use App\Models\ProgramStudiModel;
use App\Models\TahunAjaranModel;

class Aktifitas extends BaseController
{

    protected $KoneksiModel;
    protected $AktifitasModel;
    protected $DeskripsiAktifitasModel;
    protected $KegiatanModel;
    protected $MataKuliahModel;
    protected $DetailAktifitasModel;
    protected $MahasiswaModel;
    protected $FeedbackAktifitasModel;
    protected $TahunAjaranModel;
    protected $ProgramStudiModel;

    public function __construct()
    {
        $this->KoneksiModel = new KoneksiModel();
        $this->AktifitasModel = new AktifitasModel();
        $this->DeskripsiAktifitasModel = new DeskripsiAktifitasModel();
        $this->KegiatanModel = new KegiatanModel();
        $this->MataKuliahModel = new MataKuliahModel();
        $this->DetailAktifitasModel = new DetailAktifitasModel();
        $this->MahasiswaModel = new MahasiswaModel();
        $this->FeedbackAktifitasModel = new FeedbackAktifitasModel();
        $this->TahunAjaranModel = new TahunAjaranModel();
        $this->ProgramStudiModel = new ProgramStudiModel();
    }


    // DOSEN ----
    public function dosen()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '3') {
            return redirect()->to('/');
        }
        $data = [
            'title' => 'Aktifitas - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Aktifitas',
            'header' => 'Aktifitas',
            'validation' => \Config\Services::validation(),
            'koneksi' => $this->KoneksiModel->koneksi(),
        ];
        return view('aktifitas/dosen', $data);
    }

    public function viewDosen()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '3') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $id_mahasiswa = $request->getVar('id_mahasiswa');
        $id_tahun_ajaran = $request->getVar('id_tahun_ajaran');

        if ($request->isAJAX()) {
            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
                'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
                'deskripsiaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
                'aktifitas' => $this->AktifitasModel->viewDetailAktifitasSemester($id_mahasiswa, $id_tahun_ajaran),
            ];
            $msg = [
                'data' => view('aktifitas/view-dosen', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function viewDataDosen()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '3') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $username = session()->get('username');

        if ($request->isAJAX()) {
            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
                'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
                'deskripsiaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
                'username' => $username,
            ];
            $msg = [
                'data' => view('aktifitas/view-data-dosen', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function viewDataDetailDosen()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '3') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $id_aktifitas = $request->getVar('id_aktifitas');
        $id_mahasiswa = $request->getVar('id_mahasiswa');
        $id_user =  $request->getVar('id_user');
        if ($request->isAJAX()) {
            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'aktifitas' => $this->AktifitasModel->viewDetailAktifitas($id_aktifitas),
                'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
                'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
                'deskripsiaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
                'id_aktifitas' => $id_aktifitas,
                'id_user' => $id_user,
                'id_mahasiswa' => $id_mahasiswa,
            ];
            $msg = [
                'data' => view('aktifitas/modal/view-item-aktifitas-dosen', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function detailDosen($base_nim)
    {
        if (session()->get('username') == NULL || session()->get('role') !== '3') {
            return redirect()->to('/');
        }
        $nim = base64_decode($base_nim);
        $cek = $this->MahasiswaModel->where('nim', $nim)->first();
        $id_mahasiswa = $cek['id_mahasiswa'];
        $nama_mahasiswa = $cek['nama_mahasiswa'];
        $data_nim = $cek['nim'];

        $data = [
            'title' => 'Aktifitas - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Aktifitas',
            'header' => 'Aktifitas',
            'validation' => \Config\Services::validation(),
            'koneksi' => $this->KoneksiModel->koneksi(),
            'id_mahasiswa' => $id_mahasiswa,
            'nama_mahasiswa' => $nama_mahasiswa,
            'data_nim' => $data_nim,
            'aktifitas' => $this->AktifitasModel->viewDetailAktifitasDosen($id_mahasiswa),
            'programstudi' => $this->ProgramStudiModel->orderBy('id', 'DESC')->get()->getResultArray(),
            'tahunajaran' => $this->TahunAjaranModel->orderBy('id', 'DESC')->get()->getResultArray(),
        ];
        return view('aktifitas/detail-dosen', $data);
    }

    public function modalDetailDosen()
    {
        $request = \Config\Services::request();
        $id_aktifitas = $request->getVar('id_aktifitas');
        $id_mahasiswa = $request->getVar('id_mahasiswa');
        $id_user =  session()->get('id_user');
        if ($request->isAJAX()) {
            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'aktifitas' => $this->AktifitasModel->viewDetailAktifitas($id_aktifitas),
                'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
                'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
                'deskripsiaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
                'id_aktifitas' => $id_aktifitas,
                'id_user' => $id_user,
                'id_mahasiswa' => $id_mahasiswa,
            ];
            $msg = [
                'sukses' => view('aktifitas/modal/view-data-aktifitas-dosen', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function modalDosen()
    {
        $request = \Config\Services::request();
        $id_aktifitas = $request->getVar('id_aktifitas');
        $id_mahasiswa = $request->getVar('id_mahasiswa');
        $id_user =  session()->get('id_user');
        if ($request->isAJAX()) {
            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'aktifitas' => $this->AktifitasModel->viewDetailAktifitas($id_aktifitas),
                'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
                'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
                'deskripsiaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
                'detailaktifitas' => $this->DetailAktifitasModel->where('id_aktifitas', $id_aktifitas)->get()->getResultArray(),
                'id_aktifitas' => $id_aktifitas,
                'id_user' => $id_user,
                'id_mahasiswa' => $id_mahasiswa,
            ];
            $msg = [
                'sukses' => view('aktifitas/modal/view-detail-aktifitas-dosen', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function inputDosenFeedback()
    {

        $request = \Config\Services::request();
        $feedback = $request->getPost('feedback');
        $id_aktifitas = $request->getPost('id_aktifitas');
        $id_user = $request->getPost('id_user');
        $id_mahasiswa = $request->getPost('id_mahasiswa');

        $cek = $this->MahasiswaModel->where('id_mahasiswa', $id_mahasiswa)->first();
        $nama_mahasiswa = $cek['nama_mahasiswa'];
        $data_nim = $cek['nim'];

        if ($request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'feedback' => [
                    'label' => 'Feedback',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* {field} Tidak Boleh Kosong'
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

            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'aktifitas' => $this->AktifitasModel->viewDetailAktifitas($id_aktifitas),
                'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
                'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
                'deskripsiaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
                'id_aktifitas' => $id_aktifitas,
                'id_user' => $id_user,
                'id_mahasiswa' => $id_mahasiswa,
            ];
            $msg = [
                'data' => view('aktifitas/modal/view-item-aktifitas-dosen', $data),
                'sukses' => 'Feedback Berhasil Ditambahkan !'
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function viewBimbinganDosen($slug_aktifitas)
    {
        if (session()->get('username') == NULL || session()->get('role') !== '3') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $id_user =  session()->get('id_user');
        $cek = $this->AktifitasModel->where('slug_aktifitas', $slug_aktifitas)->first();
        $id_aktifitas = $cek['id'];

        $data = [
            'title' => 'Aktifitas - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Aktifitas',
            'header' => 'Aktifitas',
            'validation' => \Config\Services::validation(),
            'koneksi' => $this->KoneksiModel->koneksi(),
            'id_aktifitas' => $id_aktifitas,
            'id_user' => $id_user,
        ];
        return view('aktifitas/detail-bimbingan-dosen', $data);
    }

    // MAHASISWA ----

    public function mahasiswa()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $data = [
            'title' => 'Aktifitas - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Aktifitas',
            'header' => 'Aktifitas',
            'validation' => \Config\Services::validation(),
            'koneksi' => $this->KoneksiModel->koneksi(),
        ];
        return view('aktifitas/mahasiswa', $data);
    }

    public function viewData()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $nim = session()->get('username');
        if ($request->isAJAX()) {
            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
                'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
                'deskripsiaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
                'nim' => $nim
            ];
            $msg = [
                'data' => view('aktifitas/view-data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function modalInput()
    {
        $request = \Config\Services::request();
        $nim = session()->get('username');
        if ($request->isAJAX()) {
            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'aktifitas' => $this->AktifitasModel->viewAktifitas($nim),
                'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
                'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
                'tahunajaran' => $this->TahunAjaranModel->get()->getResultArray(),
                'deskripsiaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
            ];
            $msg = [
                'sukses' => view('aktifitas/modal/input-data-aktifitas', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function tambah()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $username = session()->get('username');
        $ceknim = $this->MahasiswaModel->where('nim', $username)->first();
        $nim = $ceknim['id_mahasiswa'];

        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();

        $judul = $request->getVar('judul');
        $id_modul = $request->getVar('id_modul');
        $kegiatan = $request->getVar('kegiatan');
        $tanggal = $request->getVar('tanggal');
        $deskripsi = $request->getVar('deskripsi');
        $deskripsi_awal = $request->getVar('deskripsi_awal');
        $id_tahun_ajaran = $request->getVar('id_tahun_ajaran');
        $id_deskripsi_aktifitas = $request->getVar('id_deskripsi_aktifitas');
        $file = $request->getFile('file');

        $valid = $this->validate([
            'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,pdf]',
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                ]
            ],
            'id_modul' => [
                'label' => 'Modul',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                ]
            ],
            'kegiatan' => [
                'label' => 'Kegiatan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus di Pilih',
                ]
            ],
            'tanggal' => [
                'label' => 'Tanggal',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                ]
            ],
        ]);
        if (!$valid) {
            session()->setFlashdata('error', $this->validator->listErrors());
            session()->setFlashdata('gagal', 'Gagal Input');
            return redirect()->to('/aktivitas-mahasiswa')->withInput();;
        } else {
            $total = count($deskripsi);
            $newName = $file->getRandomName();
            $file->move('../public/file/aktifitas/', $newName);
            $nama_foto = $newName;
            $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ<>{}[]';
            $slug_aktifitas = substr(str_shuffle($char), 0, 50);

            $data = [
                'judul' => $judul,
                'id_matakuliahs' => $id_modul,
                'id_kegiatan' => $kegiatan,
                'tanggal' => $tanggal,
                'file_bukti' => $nama_foto,
                'id_mahasiswa_aktifitas' => $nim,
                'deskripsi' => $deskripsi_awal,
                'slug_aktifitas' => $slug_aktifitas,
                'id_tahun_ajaran' => $id_tahun_ajaran
            ];

            $this->AktifitasModel->insert($data);

            $cek = $this->AktifitasModel->orderBy('id', 'DESC')->limit(1)->first();
            $id_aktifitas = $cek['id'];

            for ($i = 0; $i < $total; $i++) {
                $data[$i] = array(
                    'id_aktifitas' => $id_aktifitas,
                    'deskripsi_aktifitas' => $deskripsi[$i],
                    'mahasiswa' => $nim,
                    'id_deskripsi_aktifitas' => $id_deskripsi_aktifitas,
                    'id_tahun_ajaran' => $id_tahun_ajaran,
                );
                $this->DetailAktifitasModel->insert($data[$i]);
            }

            session()->setFlashdata('berhasil', 'Berhasil Input');
            return redirect()->to('/aktivitas-mahasiswa');
        }
    }

    public function detailMahasiswa($slug_aktifitas)
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $id_user =  session()->get('id_user');
        $cek = $this->AktifitasModel->where('slug_aktifitas', $slug_aktifitas)->first();
        $id_aktifitas = $cek['id'];

        $data = [
            'title' => 'Aktifitas - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Aktifitas',
            'header' => 'Aktifitas',
            'validation' => \Config\Services::validation(),
            'koneksi' => $this->KoneksiModel->koneksi(),
            'id_aktifitas' => $id_aktifitas,
            'id_user' => $id_user,
        ];
        return view('aktifitas/detail-mahasiswa', $data);
    }

    public function viewDataDetail()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $id_aktifitas = $request->getVar('id_aktifitas');
        $id_user =  session()->get('id_user');

        if ($request->isAJAX()) {
            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
                'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
                'aktifitas' => $this->AktifitasModel->viewDetailAktifitas($id_aktifitas),
                'id_user' => $id_user,
                'id_aktifitas' => $id_aktifitas
            ];
            $msg = [
                'data' => view('aktifitas/view-data-detail-mahasiswa', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function inputMahasiwaFeedback()
    {

        $request = \Config\Services::request();
        $feedback = $request->getPost('feedback');
        $id_aktifitas = $request->getPost('id_aktifitas');
        $id_user = $request->getPost('id_user');

        if ($request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'feedback' => [
                    'label' => 'Feedback',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* {field} Tidak Boleh Kosong'
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

            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
                'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
                'aktifitas' => $this->AktifitasModel->viewDetailAktifitas($id_aktifitas),
                'id_aktifitas' => $id_aktifitas,
                'id_user' => $id_user,
            ];
            $msg = [
                'data' => view('aktifitas/view-data-detail-mahasiswa', $data),
                'sukses' => 'Feedback Berhasil Ditambahkan',
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function edit()
    {
        $nimx = session()->get('username');
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {

            $id = $request->getVar('id');
            $judul = $request->getVar('judul');
            $kegiatan = $request->getVar('kegiatan');
            $modul = $request->getVar('modul');
            $tanggal = $request->getVar('tanggal');
            $matakuliahs = $request->getVar('id_matakuliahs');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'judul' => [
                    'label' => 'Judul',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'kegiatan' => [
                    'label' => 'Kegiatan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'modul' => [
                    'label' => 'Modul',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'tanggal' => [
                    'label' => 'Tanggal',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'judul' => $validation->getError('judul'),
                        'kegiatan' => $validation->getError('kegiatan'),
                        'modul' => $validation->getError('modul'),
                        'tanggal' => $validation->getError('tanggal'),
                    ],
                ];
                echo json_encode($msg);
            } else {
                $data = [
                    'judul' => $judul,
                    'kegiatan' => $kegiatan,
                    'modul' => $modul,
                    'tanggal' => $tanggal,
                    'id_matakuliahs' => $matakuliahs,

                ];

                $this->AktifitasModel->update($id, $data);

                $data2 = [
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'aktifitas' => $this->AktifitasModel->where('nim', $nimx)->orderBy('tanggal', 'DESC')->get()->getResultArray(),
                    'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
                    'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
                    'deskaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
                ];
                $msg = [
                    'sukses' => 'Aktifitas Berhasil Diedit !',
                    'status' => 'berhasil',
                    'data' => view('aktifitas/view-data', $data2)
                ];
                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function isi()
    {
        $nimx = session()->get('username');
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {

            $id = $request->getVar('id');
            $desk = $request->getVar('desk');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'desk' => [
                    'label' => 'Deskripsi',
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
                    'deskripsi' => $desk,
                ];

                $this->AktifitasModel->update($id, $data);

                $data2 = [
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'aktifitas' => $this->AktifitasModel->where('nim', $nimx)->orderBy('tanggal', 'DESC')->get()->getResultArray(),
                    'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
                    'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
                    'deskaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
                ];
                $msg = [
                    'sukses' => 'Aktifitas Berhasil Diisi !',
                    'status' => 'berhasil',
                    'data' => view('aktifitas/view-data', $data2)
                ];
                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function hapus()
    {
        $nimx = session()->get('username');
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();

        if ($request->isAJAX()) {

            $id = $request->getVar('id');

            $this->AktifitasModel->delete($id);

            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'aktifitas' => $this->AktifitasModel->where('nim', $nimx)->orderBy('tanggal', 'DESC')->get()->getResultArray(),
                'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
                'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
                'deskaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
            ];
            $msg = [
                'sukses' => 'Aktifitas berhasil dihapus !',
                'data' => view('aktifitas/view-data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }
}

// public function tambah()
    // {
    //     $nim = session()->get('username');
    //     if (session()->get('username') == NULL || session()->get('role') !== '2') {
    //         return redirect()->to('/');
    //     }
    //     $request = \Config\Services::request();
    //     $validation = \Config\Services::validation();

    //     if ($request->isAJAX()) {
    //         $judul = $request->getVar('judul');
    //         $id_modul = $request->getVar('id_modul');
    //         $kegiatan = $request->getVar('kegiatan');
    //         $tanggal = $request->getVar('tanggal');
    //         $deskripsi = $request->getVar('deskripsi');
    //         $file = $request->getFile('file');

    //         $valid = $this->validate([
    //             'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,jpeg,jpg,png]',
    //             'judul' => [
    //                 'label' => 'Judul',
    //                 'rules' => 'required',
    //                 'errors' => [
    //                     'required' => '{field} Tidak Boleh Kosong',
    //                 ]
    //             ],
    //             'id_modul' => [
    //                 'label' => 'Modul',
    //                 'rules' => 'required',
    //                 'errors' => [
    //                     'required' => '{field} Tidak Boleh Kosong',
    //                 ]
    //             ],
    //             'kegiatan' => [
    //                 'label' => 'Kegiatan',
    //                 'rules' => 'required',
    //                 'errors' => [
    //                     'required' => '{field} Harus di Pilih',
    //                 ]
    //             ],
    //             'tanggal' => [
    //                 'label' => 'Tanggal',
    //                 'rules' => 'required',
    //                 'errors' => [
    //                     'required' => '{field} Tidak Boleh Kosong',
    //                 ]
    //             ],
    //         ]);
    //         if (!$valid) {
    //             $msg = [
    //                 'error' => [
    //                     'judul' => $validation->getError('judul'),
    //                     'id_modul' => $validation->getError('id_modul'),
    //                     'kegiatan' => $validation->getError('kegiatan'),
    //                     'tanggal' => $validation->getError('tanggal'),
    //                     'tanggal' => $validation->getError('tanggal'),
    //                     'file' => $validation->getError('file'),
    //                 ],
    //             ];
    //             echo json_encode($msg);
    //         } else {

    //             $total = count($deskripsi);
    //             $newName = $file->getRandomName();
    //             $file->move('../public/file/aktifitas/', $newName);
    //             $nama_foto = $newName;

    //             $data = [
    //                 'judul' => $judul,
    //                 'id_modul' => $id_modul,
    //                 'kegiatan' => $kegiatan,
    //                 'tanggal' => $tanggal,
    //                 'file_bukti' => $nama_foto,
    //                 'nim' => $nim,
    //             ];

    //             $this->AktifitasModel->insert($data);

    //             $cek = $this->AktifitasModel->orderBy('id', 'DESC')->limit(1)->first();
    //             $id_aktifitas = $cek['id'];

    //             for ($i = 0; $i < $total; $i++) {
    //                 $data[$i] = array(
    //                     'id_aktifitas' => $id_aktifitas,
    //                     'deskripsi_aktifitas' => $deskripsi[$i],
    //                 );
    //                 $this->DetailAktifitas->insert($data[$i]);
    //             }

    //             $data2 = [
    //                 'koneksi' => $this->KoneksiModel->koneksi(),
    //                 'aktifitas' => $this->AktifitasModel->viewAktifitas($nim),
    //                 'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
    //                 'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
    //                 'deskripsiaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
    //             ];
    //             $msg = [
    //                 'sukses' => 'Data Aktifitas Berhasil Ditambahkan !',
    //                 'status' => 'berhasil',
    //                 'data' => view('aktifitas/view-data', $data2)
    //             ];
    //             echo json_encode($msg);
    //         }
    //     } else {
    //         exit('Data Tidak Dapat diproses');
    //     }
    // }