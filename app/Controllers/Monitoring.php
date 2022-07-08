<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\FakultasModel;
use App\Models\KelasModel;
use App\Models\KoneksiModel;
use App\Models\MataKuliahModel;
use App\Models\MonitoringModel;
use App\Models\ProgramStudiModel;
use App\Models\SemesterModel;
use App\Models\TahunAjaranModel;

class Monitoring extends BaseController
{

    protected $MonitoringModel;
    protected $KoneksiModel;
    protected $FakultasModel;
    protected $ProgramStudiModel;
    protected $TahunAjaranModel;
    protected $SemesterModel;
    protected $MatakuliahModel;
    protected $DosenModel;
    protected $KelasModel;

    public function __construct()
    {
        $this->MonitoringModel = new MonitoringModel();
        $this->KoneksiModel = new KoneksiModel();
        $this->FakultasModel = new FakultasModel();
        $this->ProgramStudiModel = new ProgramStudiModel();
        $this->TahunAjaranModel = new TahunAjaranModel();
        $this->SemesterModel = new SemesterModel();
        $this->MatakuliahModel = new MataKuliahModel();
        $this->DosenModel = new DosenModel();
        $this->KelasModel = new KelasModel();
    }

    public function index()
    {
        //
    }

    public function rekapOperator()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $data = [
            'title' => 'Program Studi - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Monitoring',
            'header' => 'Rekap Monitoring',
            'monitoring' => $this->MonitoringModel->findAll(),
            'koneksi' => $this->KoneksiModel->koneksi(),
            'fakultas' => $this->FakultasModel->orderBy('fakultas', 'ASC')->get()->getResultArray(),
            'programStudi' => $this->ProgramStudiModel->orderBy('program_studi', 'ASC')->get()->getResultArray(),
            'tahunAjaran' => $this->TahunAjaranModel->orderBy('id', 'DESC')->get()->getResultArray(),
        ];
        return view('monitoring/operator', $data);
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
            $id_semester = $request->getVar('id_ta');
            $data = [
                'title' => 'Program Studi - Fakultas Kedokteran Universitas Mulawarman',
                'topHeader' => 'Monitoring',
                'header' => 'Rekap Monitoring',
                'monitoring' => $this->MonitoringModel->viewMonitoringOperator($id_fak, $id_ps, $id_semester),
                'koneksi' => $this->KoneksiModel->koneksi(),
                'fakultas' => $this->FakultasModel->orderBy('fakultas', 'ASC')->get()->getResultArray(),
                'programStudi' => $this->ProgramStudiModel->orderBy('program_studi', 'ASC')->get()->getResultArray(),
                'tahunAjaran' => $this->TahunAjaranModel->orderBy('id', 'DESC')->get()->getResultArray(),
                'id_fak' => $id_fak,
                'id_ps' => $id_ps,
                'id_semester' => $id_semester,
            ];
            $msg = [
                'data' => view('monitoring/operator-view-data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function modalInput()
    {
        $request = \Config\Services::request();
        $id_fak = $request->getPost('id_fak');
        $id_ps = $request->getPost('id_ps');
        $id_semester = $request->getPost('id_semester');
        if ($request->isAJAX()) {
            $data = [
                'id_semester' => $id_semester,
                'fakultas' => $this->FakultasModel->where('id', $id_fak)->first(),
                'ps' => $this->ProgramStudiModel->where('id', $id_ps)->first(),
                'tahun_ajaran' => $this->TahunAjaranModel->where('id', $id_semester)->first(),
                'matakuliah' => $this->MatakuliahModel->findAll(),
                'dosen' => $this->DosenModel->findAll(),
                'kelas' => $this->KelasModel->where(['id_fak' => $id_fak, 'id_ps' => $id_ps, 'id_ta' => $id_semester])->get()->getResultArray(),
            ];

            $msg = [
                'sukses' => view('monitoring/modal/input-data-monitoring', $data),
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function modalView()
    {
        $request = \Config\Services::request();
        $id_fak = $request->getVar('id_fak');
        $id_ps = $request->getVar('id_ps');
        $id_ta = $request->getVar('id_ta');
        $id_kelas = $request->getVar('id_kelas');
        $id_matakuliah = $request->getVar('id_matakuliah');
        if ($request->isAJAX()) {
            $data = [
                'matkul' => $this->MonitoringModel->namaMatakuliahMonitoring($id_fak, $id_ps, $id_ta, $id_kelas, $id_matakuliah),
                'monitoring' => $this->MonitoringModel->viewMonitoringDetailOperator($id_fak, $id_ps, $id_ta, $id_kelas, $id_matakuliah),
                'id_kelas' => $id_kelas,
                'id_ps' => $id_ps,
                'id_matakuliah' => $id_matakuliah,
                'id_fak' => $id_fak,
                'id_ta' => $id_ta,
            ];

            $msg = [
                'sukses' => view('monitoring/modal/view-data-monitoring', $data),
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function modalEdit()
    {
        $request = \Config\Services::request();
        $id = $request->getPost('id');
        if ($request->isAJAX()) {
            $data = [
                'monitoring' => $this->MonitoringModel->viewEdit($id),
                'dosen' => $this->DosenModel->findAll(),
            ];

            $msg = [
                'sukses' => view('monitoring/modal/edit-data-monitoring', $data),
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function prosesInput()
    {
        $request = \Config\Services::request();
        $id_fak = $request->getPost('id_fak');
        $id_ps = $request->getPost('id_ps');
        $id_tahun_ajaran = $request->getPost('id_tahun_ajaran');
        $id_matakuliah = $request->getPost('id_matakuliah');
        $id_dosen = $request->getPost('id_dosen');
        $id_kelas = $request->getPost('id_kelas');
        $pertemuan = $request->getPost('pertemuan');
        $tanggal_rencana = $request->getPost('tanggal_rencana');
        $tanggal_realisasi = $request->getPost('tanggal_realisasi');
        $jam_rencana = $request->getPost('jam_rencana');
        $jam_realisasi = $request->getPost('jam_realisasi');
        $materi = $request->getPost('materi');
        $rps = $request->getPost('rps');

        $slug_matakuliah = $this->MatakuliahModel->where('id', $id_matakuliah)->first();
        $slug_kelas = $this->KelasModel->where('id', $id_kelas)->first();

        if ($request->isAJAX()) {


            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'id_matakuliah' => [
                    'label' => 'Matakuliah',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong'
                    ]
                ],
                'id_dosen' => [
                    'label' => 'Dosen',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'id_kelas' => [
                    'label' => 'Kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'pertemuan' => [
                    'label' => 'Pertemuan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'tanggal_rencana' => [
                    'label' => 'Tanggal Rencana',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'tanggal_realisasi' => [
                    'label' => 'Tanggal Realisasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'jam_rencana' => [
                    'label' => 'Jam Rencana',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'jam_realisasi' => [
                    'label' => 'Jam Realisasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'materi' => [
                    'label' => 'Materi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'rps' => [
                    'label' => 'RPS',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);

            $cek = $this->MonitoringModel->where(['id_ps' => $id_ps, 'id_ta' => $id_tahun_ajaran, 'id_kelas' => $id_kelas, 'id_matakuliah' => $id_matakuliah, 'pertemuan' => $pertemuan])->get()->getRowArray();

            if (!$valid) {
                $msg = [
                    'error' => [
                        'id_matakuliah' => $validation->getError('id_matakuliah'),
                        'id_dosen' => $validation->getError('id_dosen'),
                        'id_kelas' => $validation->getError('id_kelas'),
                        'pertemuan' => $validation->getError('pertemuan'),
                        'tanggal_rencana' => $validation->getError('tanggal_rencana'),
                        'tanggal_realisasi' => $validation->getError('tanggal_realisasi'),
                        'jam_rencana' => $validation->getError('jam_rencana'),
                        'jam_realisasi' => $validation->getError('jam_realisasi'),
                        'materi' => $validation->getError('materi'),
                        'rps' => $validation->getError('rps'),
                    ],
                ];
                return $this->response->setJSON($msg);
            } else if ($cek > 1) {
                $msg = [
                    'error' => [
                        'cek_pertemuan' => 'Pertemuan Sudah Ada !!'
                    ],
                ];
                return $this->response->setJSON($msg);
            } else {
                $data_input = [
                    'id_matakuliah' => $id_matakuliah,
                    'id_fak' => $id_fak,
                    'id_ps' => $id_ps,
                    'id_ta' => $id_tahun_ajaran,
                    'id_kelas' => $id_kelas,
                    'id_dosen' => $id_dosen,
                    'pertemuan' => $pertemuan,
                    'materi' => $materi,
                    'rps' => $rps,
                    'tanggal_rencana' => $tanggal_rencana,
                    'tanggal_realisasi' => $tanggal_realisasi,
                    'jam_rencana' => $jam_rencana,
                    'jam_realisasi' => $jam_realisasi,
                    'jam_realisasi' => $jam_realisasi,
                    'slug_mk' => '' . $slug_kelas['kelas'] . ' - ' . $slug_matakuliah['mata_kuliah'] . '',
                ];

                $this->MonitoringModel->insert($data_input);
            }
            $data_view = [
                'title' => 'Program Studi - Fakultas Kedokteran Universitas Mulawarman',
                'topHeader' => 'Monitoring',
                'header' => 'Rekap Monitoring',
                'monitoring' => $this->MonitoringModel->viewMonitoringOperator($id_fak, $id_ps, $id_tahun_ajaran),
                'koneksi' => $this->KoneksiModel->koneksi(),
                'fakultas' => $this->FakultasModel->orderBy('fakultas', 'ASC')->get()->getResultArray(),
                'programStudi' => $this->ProgramStudiModel->orderBy('program_studi', 'ASC')->get()->getResultArray(),
                'tahunAjaran' => $this->TahunAjaranModel->orderBy('id', 'DESC')->get()->getResultArray(),
                'id_fak' => $id_fak,
                'id_ps' => $id_ps,
                'id_semester' => $id_tahun_ajaran,
            ];
            $msg = [
                'sukses' => 'Monitoring Berhasil Ditambahkan !',
                'data' => view('monitoring/operator-view-data', $data_view)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function prosesEdit()
    {
        $request = \Config\Services::request();
        $id = $request->getPost('id');
        $id_fak = $request->getPost('id_fak');
        $id_ps = $request->getPost('id_ps');
        $id_tahun_ajaran = $request->getPost('id_tahun_ajaran');
        $id_matakuliah = $request->getPost('id_matakuliah');
        $id_dosen = $request->getPost('id_dosen');
        $id_kelas = $request->getPost('id_kelas');
        $pertemuan = $request->getPost('pertemuan');
        $tanggal_rencana = $request->getPost('tanggal_rencana');
        $tanggal_realisasi = $request->getPost('tanggal_realisasi');
        $jam_rencana = $request->getPost('jam_rencana');
        $jam_realisasi = $request->getPost('jam_realisasi');
        $materi = $request->getPost('materi');
        $rps = $request->getPost('rps');

        $slug_matakuliah = $this->MatakuliahModel->where('id', $id_matakuliah)->first();
        $slug_kelas = $this->KelasModel->where('id', $id_kelas)->first();

        if ($request->isAJAX()) {


            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'id_matakuliah' => [
                    'label' => 'Matakuliah',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong'
                    ]
                ],
                'id_dosen' => [
                    'label' => 'Dosen',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'id_kelas' => [
                    'label' => 'Kelas',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'pertemuan' => [
                    'label' => 'Pertemuan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'tanggal_rencana' => [
                    'label' => 'Tanggal Rencana',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'tanggal_realisasi' => [
                    'label' => 'Tanggal Realisasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'jam_rencana' => [
                    'label' => 'Jam Rencana',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'jam_realisasi' => [
                    'label' => 'Jam Realisasi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'materi' => [
                    'label' => 'Materi',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'rps' => [
                    'label' => 'RPS',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);

            $cek = $this->MonitoringModel->where(['id_ps' => $id_ps, 'id_ta' => $id_tahun_ajaran, 'id_kelas' => $id_kelas, 'id_matakuliah' => $id_matakuliah, 'pertemuan' => $pertemuan])->get()->getRowArray();

            if (!$valid) {
                $msg = [
                    'error' => [
                        'id_matakuliah' => $validation->getError('id_matakuliah'),
                        'id_dosen' => $validation->getError('id_dosen'),
                        'id_kelas' => $validation->getError('id_kelas'),
                        'pertemuan' => $validation->getError('pertemuan'),
                        'tanggal_rencana' => $validation->getError('tanggal_rencana'),
                        'tanggal_realisasi' => $validation->getError('tanggal_realisasi'),
                        'jam_rencana' => $validation->getError('jam_rencana'),
                        'jam_realisasi' => $validation->getError('jam_realisasi'),
                        'materi' => $validation->getError('materi'),
                        'rps' => $validation->getError('rps'),
                    ],
                ];
                return $this->response->setJSON($msg);
            } else if ($cek > 1) {
                $msg = [
                    'error' => [
                        'cek_pertemuan' => 'Pertemuan Sudah Ada !!'
                    ],
                ];
                return $this->response->setJSON($msg);
            } else {
                $data_input = [
                    'id_matakuliah' => $id_matakuliah,
                    'id_fak' => $id_fak,
                    'id_ps' => $id_ps,
                    'id_ta' => $id_tahun_ajaran,
                    'id_kelas' => $id_kelas,
                    'id_dosen' => $id_dosen,
                    'pertemuan' => $pertemuan,
                    'materi' => $materi,
                    'rps' => $rps,
                    'tanggal_rencana' => $tanggal_rencana,
                    'tanggal_realisasi' => $tanggal_realisasi,
                    'jam_rencana' => $jam_rencana,
                    'jam_realisasi' => $jam_realisasi,
                    'jam_realisasi' => $jam_realisasi,
                    'slug_mk' => '' . $slug_kelas['kelas'] . ' - ' . $slug_matakuliah['mata_kuliah'] . '',
                ];

                $this->MonitoringModel->edit($id, $data_input);
            }
            $data_view = [
                'matkul' => $this->MonitoringModel->namaMatakuliahMonitoring($id_fak, $id_ps, $id_tahun_ajaran, $id_kelas, $id_matakuliah),
                'monitoring' => $this->MonitoringModel->viewMonitoringDetailOperator($id_fak, $id_ps, $id_tahun_ajaran, $id_kelas, $id_matakuliah),
                'id_kelas' => $id_kelas,
                'id_ps' => $id_ps,
                'id_matakuliah' => $id_matakuliah,
                'id_fak' => $id_fak,
                'id_ta' => $id_tahun_ajaran,
            ];

            $msg = [
                'sukses' => view('monitoring/modal/view-data-monitoring', $data_view),
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }
}
