<?php

namespace App\Controllers;

use Pusher\Pusher;
use App\Models\UserModel;
use App\Models\DosenModel;
use App\Models\KoneksiModel;
use App\Models\KegiatanModel;
use App\Models\AktifitasModel;
use App\Models\MahasiswaModel;
use App\Models\MataKuliahModel;
use App\Models\TahunAjaranModel;
use App\Models\ProgramStudiModel;
use App\Controllers\BaseController;
use App\Models\DetailAktifitasModel;
use App\Models\FeedbackAktifitasModel;
use App\Models\DeskripsiAktifitasModel;
use App\Models\KompetensiModel;
use App\Models\ProgressAktifitasModel;
use App\Models\SubKompetensiModel;

use function PHPUnit\Framework\isEmpty;

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
    protected $DosenModel;
    protected $UserModel;
    protected $ProgressAktifitasModel;
    protected $KompetensiModel;
    protected $SubKompetensiModel;

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
        $this->DosenModel = new DosenModel();
        $this->UserModel = new UserModel();
        $this->ProgressAktifitasModel = new ProgressAktifitasModel();
        $this->KompetensiModel = new KompetensiModel();
        $this->SubKompetensiModel = new SubKompetensiModel();
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
            'programstudi' => $this->ProgramStudiModel->orderBy('id', 'DESC')->get()->getResultArray(),
            'tahunajaran' => $this->TahunAjaranModel->orderBy('id', 'DESC')->get()->getResultArray(),
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

        if ($id_tahun_ajaran !== '') {
            $query_nama_ta = $this->TahunAjaranModel->where('id', $id_tahun_ajaran)->first();
            $session_nama_ta = $query_nama_ta['tahun_ajaran'];
            session()->set('session_ta', $id_tahun_ajaran);
            session()->set('session_nama_ta', $session_nama_ta);
        }

        $cek = $this->MahasiswaModel->where('id_mahasiswa', $id_mahasiswa)->first();
        $cekNim = $cek['nim'];

        $sqlUser = $this->UserModel->where('username', $cekNim)->first();
        $id_penerima = $sqlUser['id'];

        if ($request->isAJAX()) {
            $data = [
                'id_mahasiswa' => $id_mahasiswa,
                'id_penerima' => $id_penerima,
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

        $cek = $this->DosenModel->where('nip', $username)->first();
        $id_dosen = $cek['id'];

        if ($request->isAJAX()) {
            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
                'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
                'deskripsiaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
                'username' => $username,
                // 'id_tahun_ajaran' => $id_tahun_ajaran,
                'aktifitas' => $this->AktifitasModel->viewDetailDosen($id_dosen),
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
                'progress' => $this->ProgressAktifitasModel->where('id_aktifitas', $id_aktifitas)->orderBy('id_progress', 'DESC')->get()->getResultArray(),
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
        $request = \Config\Services::request();
        $nim = base64_decode($base_nim);
        $cek = $this->MahasiswaModel->where('nim', $nim)->first();
        $id_mahasiswa = $cek['id_mahasiswa'];
        $nama_mahasiswa = $cek['nama_mahasiswa'];
        $data_nim = $cek['nim'];
        $uri_ta = $request->uri->getSegment(3);
        $cek_ta = base64_decode($uri_ta);
        $id_tahun_ajaran = substr($cek_ta, 13);

        $data = [
            'title' => 'Aktifitas - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Aktifitas',
            'header' => 'Aktifitas',
            'koneksi' => $this->KoneksiModel->koneksi(),
            'id_mahasiswa' => $id_mahasiswa,
            'nama_mahasiswa' => $nama_mahasiswa,
            'data_nim' => $data_nim,
            'id_tahun_ajaran' => $id_tahun_ajaran,
            'aktifitas' => $this->AktifitasModel->viewDetailAktifitasDosen($id_mahasiswa),
            'programstudi' => $this->ProgramStudiModel->orderBy('id', 'DESC')->get()->getResultArray(),
            'tahunajaran' => $this->TahunAjaranModel->orderBy('id', 'DESC')->get()->getResultArray(),
        ];
        return view('aktifitas/detail-dosen', $data);
    }

    public function detailNotifDosen($base_nim)
    {
        if (session()->get('username') == NULL || session()->get('role') !== '3') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $nim = base64_decode($base_nim);
        $uri_ta = $request->uri->getSegment(3);
        $cek_ta = base64_decode($uri_ta);
        $id_aktifitas = substr($cek_ta, 13);

        $cek = $this->MahasiswaModel->where('nim', $nim)->first();
        $id_mahasiswa = $cek['id_mahasiswa'];
        $nama_mahasiswa = $cek['nama_mahasiswa'];
        $data_nim = $cek['nim'];
        $id_user = session()->get('id_user');

        $data = [
            'title' => 'Aktifitas - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Aktifitas',
            'header' => 'Aktifitas',
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
        return view('aktifitas/detail-dosen-notif', $data);
    }

    public function modalFeedbackDosen()
    {
        $request = \Config\Services::request();
        $id_aktifitas = $request->getVar('id_aktifitas');
        $id_mahasiswa = $request->getVar('id_mahasiswa');
        $id_user =  session()->get('id_user');
        if ($request->isAJAX()) {
            $data_update = [
                'status' => 'read',
            ];
            $this->FeedbackAktifitasModel->ubah($data_update, $id_aktifitas, $id_user);

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
                'sukses' => view('aktifitas/modal/view-feedback-aktifitas-dosen', $data)
            ];
            require __DIR__ . '/../../vendor/autoload.php';

            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
            );
            $pusher = new Pusher(
                'f3d8b822045da0f51d29',
                'ebdba4f0d29bb0207ec3',
                '1435175',
                $options
            );

            // $sql = $this->FeedbackAktifitasModel->count($id_penerima, $id_aktifitas);

            $data['feedbackdosen'] = '';
            $pusher->trigger('sia-fkunmul', 'modalfeedback', $data);
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function modalAktifitasDosen()
    {
        $request = \Config\Services::request();
        $id_aktifitas = $request->getVar('id_aktifitas');
        $id_mahasiswa = $request->getVar('id_mahasiswa');
        $id_user =  session()->get('id_user');

        if ($request->isAJAX()) {
            $data_update = [
                'status_aktifitas' => 'read',
            ];
            $this->AktifitasModel->update($id_aktifitas, $data_update);

            $data_feedback = [
                'status' => 'read',
            ];
            $this->FeedbackAktifitasModel->ubah($data_feedback, $id_aktifitas, $id_user);

            $data_view = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'aktifitas' => $this->AktifitasModel->viewDetailAktifitas($id_aktifitas),
                'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
                'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
                'deskripsiaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
                'detailaktifitas' => $this->DetailAktifitasModel->where('id_aktifitas', $id_aktifitas)->get()->getResultArray(),
                'id_aktifitas' => $id_aktifitas,
                'id_user' => $id_user,
                'id_mahasiswa' => $id_mahasiswa,
                'progress' => $this->ProgressAktifitasModel->where('id_aktifitas', $id_aktifitas)->orderBy('id_progress', 'DESC')->get()->getResultArray(),
            ];
            $msg = [
                'sukses' => view('aktifitas/modal/view-detail-aktifitas-dosen', $data_view)
            ];
            require __DIR__ . '/../../vendor/autoload.php';

            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
            );
            $pusher = new Pusher(
                'f3d8b822045da0f51d29',
                'ebdba4f0d29bb0207ec3',
                '1435175',
                $options
            );

            // $sql = $this->FeedbackAktifitasModel->count($id_penerima, $id_aktifitas);
            session()->set('id_aktifitas_view_dosen', $id_aktifitas);
            $data['modalaktifitas'] = $id_aktifitas;
            $pusher->trigger('sia-fkunmul', 'modal_aktifitas', $data);
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function modalGrafik()
    {
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $cek = $this->AktifitasModel->join('mahasiswas', 'aktifitas.id_mahasiswa_aktifitas=mahasiswas.id_mahasiswa')->where('id', $id)->first();
        $nim = $cek['nim'];
        $id_mahasiswa = $cek['id_mahasiswa'];
        $id_tahun_ajaran = $cek['id_tahun_ajaran'];

        if ($request->isAJAX()) {
            $jumlahSemester = '';
            $jumlahdata = '';
            $jumlah = null;

            $dataAkt = '';

            $sqlcount1 = $this->AktifitasModel->viewJumlahAktifitasDosen($nim);
            foreach ($sqlcount1 as $datacount) {
                $id_ta = $datacount['id_tahun_ajaran'];

                $count = $datacount['jumlah'];
                $jumlah .= "$count" . ",";

                $countsub = $datacount['tahun_ajaran'];
                $jumlahSemester .= "'$countsub'" . ",";

                $sqlcount = $this->AktifitasModel->viewJumlahAktifitas($nim, $id_ta);
                foreach ($sqlcount as $datacount_akt) {
                    $count_akt = $datacount_akt['jumlah'];
                    $dataAkt .= "$count_akt" . ",";

                    $count_data = $datacount_akt['data_kompetensi'];
                    $jumlahdata .= "'$count_data'" . ",";

                    $array = array(
                        'type' => 'column',
                        'name' => '' . $count_data . '',
                        'data' => [$dataAkt],
                    );
                    $json = json_encode($array);
                }
            }

            if ($request->isAJAX()) {
                $data_view = [
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
                    'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
                    'deskripsiaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
                    'feedbackaktifitas' => $this->FeedbackAktifitasModel->select('*')->selectCount('id_aktifitas', 'jumlah')->get()->getRowArray(),
                    'nim' => $nim,
                    'id_tahun_ajaran' => $id_tahun_ajaran,
                    'aktifitas' => $this->AktifitasModel->viewAktifitas($nim, $id_tahun_ajaran),
                    'jumlah' => $jumlah,
                    'jumlahSemester' => $jumlahSemester,
                    'jumlahdata' => $jumlahdata,
                    'dataAkt' => $dataAkt,
                    'json' => $json,
                    'sqlcount' => $this->AktifitasModel->viewDetailDosenPa($id_mahasiswa),
                    'sqlcount1' => $sqlcount1,
                    'sqlkompetensi' => $this->AktifitasModel->viewJumlahAktifitas($nim, $id_tahun_ajaran),
                ];
                $msg = [
                    'sukses' => view('aktifitas/modal/view-grafik-dosen', $data_view)
                ];
                echo json_encode($msg);
            }
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
        $data_nim = $cek['nim'];

        $sqlUser = $this->UserModel->where('username', $data_nim)->first();
        $id_penerima = $sqlUser['id'];

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
                    'status' => 'new',
                    'penerima' => $id_penerima,
                    'pengirim' => $id_user
                ];

                $this->FeedbackAktifitasModel->insert($data_input);
            }

            $data_item = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'aktifitas' => $this->AktifitasModel->viewDetailAktifitas($id_aktifitas),
                'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
                'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
                'deskripsiaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
                'id_aktifitas' => $id_aktifitas,
                'id_user' => $id_user,
                'id_penerima' => $id_penerima,
                'id_mahasiswa' => $id_mahasiswa,
            ];
            $msg = [
                'data' => view('aktifitas/modal/view-item-aktifitas-dosen', $data_item),
                'sukses' => 'Feedback Berhasil Ditambahkan !'
            ];

            require __DIR__ . '/../../vendor/autoload.php';

            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
            );
            $pusher = new Pusher(
                'f3d8b822045da0f51d29',
                'ebdba4f0d29bb0207ec3',
                '1435175',
                $options
            );

            $sql = $this->FeedbackAktifitasModel->count($id_user, $id_aktifitas);
            $dataNotif = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'id_penerima' => $id_user
            ];

            $sql_mahasiswa = $this->FeedbackAktifitasModel->count($id_penerima, $id_aktifitas);
            $dataNotifMahasiswa = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'id_penerima' => $id_penerima
            ];

            $data['isi_pesan_feedback'] = view('layouts/isi_pesan/feedback-dosen', $dataNotif);
            $data['feedbackdosen'] = $sql['jumlah'];

            $data['isi_pesan_feedback_mahasiswa'] = view('layouts/isi_pesan/feedback-mahasiswa', $dataNotifMahasiswa);
            $data['feedbackmahasiswa'] = $sql_mahasiswa['jumlah'];

            $pusher->trigger('sia-fkunmul', 'feedback', $data);

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
            'programstudi' => $this->ProgramStudiModel->orderBy('id', 'DESC')->get()->getResultArray(),
            'tahunajaran' => $this->TahunAjaranModel->orderBy('id', 'DESC')->get()->getResultArray(),
        ];
        return view('aktifitas/mahasiswa', $data);
    }

    public function viewDataMahasiswa()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $nim = session()->get('username');
        $id_tahun_ajaran = $request->getVar('id_tahun_ajaran');
        if ($id_tahun_ajaran !== '') {
            $query_nama_ta = $this->TahunAjaranModel->where('id', $id_tahun_ajaran)->first();
            $session_nama_ta = $query_nama_ta['tahun_ajaran'];
            session()->set('session_ta', $id_tahun_ajaran);
            session()->set('session_nama_ta', $session_nama_ta);
        }

        $jumlahsub = null;
        $jumlah = null;

        $sqlcount = $this->AktifitasModel->viewJumlahAktifitas($nim, $id_tahun_ajaran);
        foreach ($sqlcount as $datacount) {
            $count = $datacount['jumlah'];
            $jumlah .= "$count" . ",";

            $countsub = $datacount['data_kompetensi'];
            $jumlahsub .= "'$countsub'" . ",";
        }

        if ($request->isAJAX()) {
            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
                'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
                'deskripsiaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
                'feedbackaktifitas' => $this->FeedbackAktifitasModel->select('*')->selectCount('id_aktifitas', 'jumlah')->get()->getRowArray(),
                'nim' => $nim,
                'id_tahun_ajaran' => $id_tahun_ajaran,
                'aktifitas' => $this->AktifitasModel->viewAktifitas($nim, $id_tahun_ajaran),
                'jumlah' => $jumlah,
                'jumlahsub' => $jumlahsub,
                'sqlcount' => $this->AktifitasModel->viewJumlahSubAktifitas($nim, $id_tahun_ajaran),
                'sqlkompetensi' => $this->AktifitasModel->viewJumlahAktifitas($nim, $id_tahun_ajaran),
            ];
            $msg = [
                'data' => view('aktifitas/view-data-mahasiswa', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function viewDataDetailMahasiswa()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
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
                'data' => view('aktifitas/modal/view-item-aktifitas-mahasiswa', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function kompetensi()
    {
        $request = \Config\Services::request();
        $kompetensi = $request->getVar('kompetensi');
        $cekom = $this->KompetensiModel->where('id_kompetensi', $kompetensi)->first();
        $jenis = $cekom['jenis'];

        if ($kompetensi != '') {
            $cek = $this->KompetensiModel->where('id_kompetensi', $kompetensi)->groupBy('jenis')->get()->getRowArray();
            $komp = $cek['jenis'];
        } else {
            $komp = '';
        }

        if ($request->isAJAX()) {
            $data = [
                'kompetensi' => $this->SubKompetensiModel->where('kompetensi', $kompetensi)->get()->getResultArray(),
                'jenis' => $jenis,
            ];
            $msg = [
                'data' => view('aktifitas/dropdown-kompetensi', $data),
                'jenis' => $komp
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function kompetensiEdit()
    {
        $request = \Config\Services::request();
        $kompetensi = $request->getVar('kompetensi');
        $id_sub_kompetensi = $request->getVar('id_sub_kompetensi');
        $sub_kompetensi = $request->getVar('sub_kompetensi');

        $kompetensi = $request->getVar('kompetensi');
        $cekom = $this->KompetensiModel->where('id_kompetensi', $kompetensi)->first();
        $jenis = $cekom['jenis'];

        if ($kompetensi != '') {
            $cek = $this->KompetensiModel->where('id_kompetensi', $kompetensi)->groupBy('jenis')->get()->getRowArray();
            $komp = $cek['jenis'];
        } else {
            $komp = '';
        }

        if ($request->isAJAX()) {
            $data = [
                'kompetensi' => $this->SubKompetensiModel->where('kompetensi', $kompetensi)->get()->getResultArray(),
                'jenis' => $jenis,
                'id_sub_kompetensi' => $id_sub_kompetensi,
                'sub_kompetensi' => $sub_kompetensi,
            ];
            $msg = [
                'data' => view('aktifitas/dropdown-kompetensi-edit', $data),
                'jenis' => $komp
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function modalInputMahasiswa()
    {
        $request = \Config\Services::request();
        $nim = session()->get('username');
        if ($request->isAJAX()) {
            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
                'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
                'tahunajaran' => $this->TahunAjaranModel->orderBy('id', 'DESC')->get()->getResultArray(),
                'deskripsiaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
                'kompetensi' => $this->KompetensiModel->orderBy('id_kompetensi', 'ASC')->findAll(),
            ];
            $msg = [
                'sukses' => view('aktifitas/modal/input-data-aktifitas', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function modalDetailMahasiswa()
    {
        $request = \Config\Services::request();
        $id_user =  session()->get('id_user');

        $slug_aktifitas = $request->getVar('slug_aktifitas');
        $cek_mahasiswa = $this->AktifitasModel->where('slug_aktifitas', $slug_aktifitas)->first();
        $id_aktifitas = $cek_mahasiswa['id'];
        $id_mahasiswa = $cek_mahasiswa['id_mahasiswa_aktifitas'];

        $cek_dosen = $this->MahasiswaModel->where('id_mahasiswa', $id_mahasiswa)->first();
        $id_dosen = $cek_dosen['id_pa'];

        if ($request->isAJAX()) {
            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'id_aktifitas' => $id_aktifitas,
                'id_user' => $id_user,
                'id_mahasiswa' => $id_mahasiswa,
                'id_pa' => $id_dosen,
                'deskripsiaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
                'aktifitas' => $this->AktifitasModel->viewDetailAktifitas($id_aktifitas),
                'progress' => $this->ProgressAktifitasModel->where('id_aktifitas', $id_aktifitas)->orderBy('id_progress', 'DESC')->get()->getResultArray(),
                'detailaktifitas' => $this->DetailAktifitasModel->where('id_aktifitas', $id_aktifitas)->get()->getResultArray(),
            ];
            $msg = [
                'sukses' => view('aktifitas/modal/view-detail-aktifitas-mahasiswa', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function modalEditMahasiswa()
    {
        $request = \Config\Services::request();
        $slug_aktifitas = $request->getVar('slug_aktifitas');
        $cek = $this->AktifitasModel->where('slug_aktifitas', $slug_aktifitas)->first();
        $id_aktifitas = $cek['id'];
        $id_sub_kompetensi = $cek['subkompetensi_aktifitas'];
        $id_kompetensi = $cek['kompetensi_aktifitas'];

        $cek_sub = $this->SubKompetensiModel->where('id_sub_kompetensi', $id_sub_kompetensi)->first();

        if ($cek_sub == null) {
            // $id_aktifitas = '0';
            $id_kompetensi = '';
            $sub_kompetensi = '';
            $id_sub_kompetensi = '';
        } else {
            $sub_kompetensi = $cek_sub['sub_kompetensi'];
        }

        if ($request->isAJAX()) {
            $data = [
                'id_aktifitas' => $id_aktifitas,
                'sub_kompetensi' => $sub_kompetensi,
                'id_sub_kompetensi' => $id_sub_kompetensi,
                'id_kompetensi' => $id_kompetensi,
                'koneksi' => $this->KoneksiModel->koneksi(),
                'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
                'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
                'tahunajaran' => $this->TahunAjaranModel->orderBy('id', 'DESC')->get()->getResultArray(),
                'deskripsiaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
                'kompetensi' => $this->KompetensiModel->orderBy('id_kompetensi', 'ASC')->findAll(),
                'aktifitas' => $this->AktifitasModel->viewDetailAktifitas($id_aktifitas),
                'detailaktifitas' => $this->DetailAktifitasModel->where('id_aktifitas', $id_aktifitas)->get()->getResultArray(),
            ];
            $msg = [
                'sukses' => view('aktifitas/modal/view-edit-aktifitas-mahasiswa', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function modalFeedbackMahasiswa()
    {
        $request = \Config\Services::request();
        $slug_aktifitas = $request->getVar('slug_aktifitas');
        $id_user =  session()->get('id_user');
        $cek = $this->AktifitasModel->JOIN('mahasiswas', 'mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas')->where('slug_aktifitas', $slug_aktifitas)->first();
        $id_aktifitas = $cek['id'];
        $id_mahasiswa = $cek['id_mahasiswa_aktifitas'];
        $id_pa = $cek['id_pa'];

        if ($request->isAJAX()) {
            $data_update = [
                'status' => 'read',
            ];
            $this->FeedbackAktifitasModel->ubah($data_update, $id_aktifitas, $id_user);

            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'id_aktifitas' => $id_aktifitas,
                'id_user' => $id_user,
                'id_mahasiswa' => $id_mahasiswa,
                'id_pa' => $id_pa,
                'deskripsiaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
                'aktifitas' => $this->AktifitasModel->viewDetailAktifitas($id_aktifitas),
            ];
            $msg = [
                'sukses' => view('aktifitas/modal/view-feedback-aktifitas-mahasiswa', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function tambahMahasiswa()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $username = session()->get('username');
        $ceknim = $this->MahasiswaModel->where('nim', $username)->first();
        $nim = $ceknim['id_mahasiswa'];
        $id_pa = $ceknim['id_pa'];

        $request = \Config\Services::request();
        $validation = \Config\Services::validation();

        $kompetensi = $request->getVar('kompetensi');
        $subkompetensi = $request->getVar('subkompetensi');
        $judul = $request->getVar('judul');
        $id_modul = $request->getVar('id_modul');
        $id_matakuliah = $request->getVar('id_matakuliah');
        $kegiatan = $request->getVar('kegiatan');
        $tanggal = $request->getVar('tanggal');
        $deskripsi = $request->getVar('deskripsi');
        $deskripsi_awal = $request->getVar('deskripsi_awal');
        $id_tahun_ajaran = $request->getVar('id_tahun_ajaran');
        $id_deskripsi_aktifitas = $request->getVar('id_deskripsi_aktifitas');
        $file = $request->getFile('file');

        $valid = $this->validate([
            'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,pdf]',
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
                'kompetensi_aktifitas' => $kompetensi,
                'subkompetensi_aktifitas' => $subkompetensi,
                'judul' => $judul,
                'id_matakuliahs' => $id_matakuliah,
                'id_modul' => $id_modul,
                'id_kegiatan' => $kegiatan,
                'tanggal' => $tanggal,
                'file_bukti' => $nama_foto,
                'id_mahasiswa_aktifitas' => $nim,
                'deskripsi' => $deskripsi_awal,
                'slug_aktifitas' => $slug_aktifitas,
                'id_tahun_ajaran' => $id_tahun_ajaran,
                'status_aktifitas' => 'new',
            ];

            $this->AktifitasModel->insert($data);

            $cek = $this->AktifitasModel->orderBy('id', 'DESC')->limit(1)->first();
            $id_aktifitas = $cek['id'];

            for ($i = 0; $i < $total; $i++) {
                $data[$i] = array(
                    'id_aktifitas' => $id_aktifitas,
                    'deskripsi_aktifitas' => $deskripsi[$i],
                    'mahasiswa' => $nim,
                    'id_deskripsi_aktifitas' => $id_deskripsi_aktifitas[$i],
                    'id_tahun_ajaran' => $id_tahun_ajaran,
                );
                $this->DetailAktifitasModel->insert($data[$i]);
            }
            require __DIR__ . '/../../vendor/autoload.php';

            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
            );
            $pusher = new Pusher(
                'f3d8b822045da0f51d29',
                'ebdba4f0d29bb0207ec3',
                '1435175',
                $options
            );

            $sql = $this->AktifitasModel->count($id_pa);
            $dataNotif = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'id_pa' => $id_pa
            ];
            $data['isi_pesan_aktifitas'] = view('layouts/isi_pesan/aktifitas-dosen', $dataNotif);
            $data['aktifitas_dosen'] = $sql['jumlah'];
            $pusher->trigger('sia-fkunmul', 'aktifitas', $data);

            session()->setFlashdata('berhasil', 'Berhasil Input');
            return redirect()->to('/aktivitas-mahasiswa');
        }
    }

    public function editMahasiswa()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $username = session()->get('username');
        $ceknim = $this->MahasiswaModel->where('nim', $username)->first();
        $nim = $ceknim['id_mahasiswa'];

        $request = \Config\Services::request();
        $kompetensi = $request->getVar('kompetensi');
        $subkompetensi = $request->getVar('subkompetensi');
        $judul = $request->getVar('judul');
        $id_modul = $request->getVar('id_modul');
        $id_matakuliah = $request->getVar('id_matakuliah');
        $kegiatan = $request->getVar('kegiatan');
        $tanggal = $request->getVar('tanggal');
        $deskripsi = $request->getVar('deskripsi');
        $deskripsi_awal = $request->getVar('deskripsi_awal');
        $id_tahun_ajaran = $request->getVar('id_tahun_ajaran');
        $id = $request->getVar('id');
        $id_deskripsi_aktifitas = $request->getVar('id_deskripsi_aktifitas');
        $file_lama = $request->getVar('file_lama');
        $id_aktifitas = $request->getVar('id_aktifitas');
        $file = $request->getFile('file');

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
            if (!isEmpty($file)) {
                $newName = $file->getRandomName();
                $file->move('../public/file/aktifitas/', $newName);
                $nama_foto = $newName;
            } else {
                $nama_foto = $file_lama;
            }

            $total = count($id_deskripsi_aktifitas);
            $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ<>{}[]';
            $slug_aktifitas = substr(str_shuffle($char), 0, 50);
            $data = [
                'kompetensi_aktifitas' => $kompetensi,
                'subkompetensi_aktifitas' => $subkompetensi,
                'judul' => $judul,
                'id_matakuliahs' => $id_matakuliah,
                'id_modul' => $id_modul,
                'id_kegiatan' => $kegiatan,
                'tanggal' => $tanggal,
                'file_bukti' => $nama_foto,
                'id_mahasiswa_aktifitas' => $nim,
                'deskripsi' => $deskripsi_awal,
                'slug_aktifitas' => $slug_aktifitas,
                'id_tahun_ajaran' => $id_tahun_ajaran,
            ];

            $this->AktifitasModel->update($id_aktifitas, $data);

            for ($i = 0; $i < $total; $i++) {
                $data[$i] = array(
                    'deskripsi_aktifitas' => $deskripsi[$i],
                    'id_deskripsi_aktifitas' => $id_deskripsi_aktifitas[$i],
                );
                $this->DetailAktifitasModel->update($id[$i], $data[$i]);
            }

            session()->setFlashdata('berhasilEdit', 'Aktifitas Berhasil Di Edit');
            return redirect()->to('/aktivitas-mahasiswa');
        }
    }

    public function tambahProgressMahasiswa()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }

        $request = \Config\Services::request();
        $progress = $request->getVar('progress');
        $id_mahasiswa = $request->getVar('id_mahasiswa');
        $id_dosen = $request->getVar('id_dosen');
        $id_aktifitas = $request->getVar('id_aktifitas');
        $tanggal = $request->getVar('tanggal');
        $id_user = session()->get('id_user');
        if ($request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'progress' => [
                    'label' => 'Progress',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* {field} Tidak Boleh Kosong'
                    ]
                ],
                'tanggal' => [
                    'label' => 'Tanggal',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* {field} Tidak Boleh Kosong'
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'progress' => $validation->getError('progress'),
                        'tanggal' => $validation->getError('tanggal'),
                    ],
                ];
                return $this->response->setJSON($msg);
            } else {
                $data_input = [
                    'id_aktifitas' => $id_aktifitas,
                    'id_mahasiswa' => $id_mahasiswa,
                    'id_dosen' => $id_dosen,
                    'progress' => $progress,
                    'tanggal' => $tanggal
                ];

                $this->ProgressAktifitasModel->insert($data_input);

                $data_input2 = [
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'id_aktifitas' => $id_aktifitas,
                    'id_user' => $id_user,
                    'deskripsiaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
                    'aktifitas' => $this->AktifitasModel->viewDetailAktifitas($id_aktifitas),
                    'progress' => $this->ProgressAktifitasModel->where('id_aktifitas', $id_aktifitas)->orderBy('id_progress', 'DESC')->get()->getResultArray(),

                ];
                $msg = [
                    'sukses' => view('aktifitas/modal/view-detail-aktifitas-mahasiswa', $data_input2),
                    'pesan' => 'Progress Berhasil Ditambahkan !'
                ];

                require __DIR__ . '/../../vendor/autoload.php';

                $options = array(
                    'cluster' => 'ap1',
                    'useTLS' => true
                );
                $pusher = new Pusher(
                    'f3d8b822045da0f51d29',
                    'ebdba4f0d29bb0207ec3',
                    '1435175',
                    $options
                );

                $dataNotif = [
                    'progress' => $this->ProgressAktifitasModel->where('id_aktifitas', $id_aktifitas)->orderBy('id_progress', 'DESC')->get()->getResultArray(),
                ];

                $data['isi_pesan_progress'] = view('aktifitas/progress-mahasiswa', $dataNotif);

                $pusher->trigger('sia-fkunmul', 'progress', $data);
                echo json_encode($msg);
            }
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function hapusMahasiswa()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }

        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $file_bukti = $request->getVar('file_bukti');

        if ($request->isAJAX()) {
            $filepath = '../public/file/aktifitas/' . $file_bukti . '';
            chmod($filepath, 0777);
            unlink($filepath);

            $this->AktifitasModel->delete($id);

            $data = [
                'title' => 'Aktifitas - Fakultas Kedokteran Universitas Mulawarman',
                'topHeader' => 'Aktifitas',
                'header' => 'Aktifitas',
                'programstudi' => $this->ProgramStudiModel->orderBy('id', 'DESC')->get()->getResultArray(),
                'tahunajaran' => $this->TahunAjaranModel->orderBy('id', 'DESC')->get()->getResultArray(),
            ];

            $msg = [
                'data' => 'berhasil',
                'sukses' => 'Berhasil di Hapus !',
                'dataUrl' => view('aktifitas/mahasiswa', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
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
            'deskripsiaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
            'aktifitas' => $this->AktifitasModel->viewDetailAktifitas($id_aktifitas),
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
                'deskripsiaktifitas' => $this->DeskripsiAktifitasModel->get()->getResultArray(),
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
        $id_pa = $request->getPost('id_pa');

        $cek = $this->DosenModel->where('id', $id_pa)->first();
        $data_username = $cek['nip'];

        $sqlUser = $this->UserModel->where('username', $data_username)->first();
        $id_penerima = $sqlUser['id'];

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
                    'status' => 'new',
                    'penerima' => $id_penerima,
                    'pengirim' => $id_user
                ];

                $this->FeedbackAktifitasModel->insert($data_input);
            }

            $data_input = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'kegiatan' => $this->KegiatanModel->get()->getResultArray(),
                'matakuliah' => $this->MataKuliahModel->get()->getResultArray(),
                'aktifitas' => $this->AktifitasModel->viewDetailAktifitas($id_aktifitas),
                'id_aktifitas' => $id_aktifitas,
                'id_user' => $id_user,
            ];
            $msg = [
                'data' => view('aktifitas/modal/view-item-aktifitas-mahasiswa', $data_input),
                'sukses' => 'Feedback Berhasil Ditambahkan',
            ];

            require __DIR__ . '/../../vendor/autoload.php';

            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
            );
            $pusher = new Pusher(
                'f3d8b822045da0f51d29',
                'ebdba4f0d29bb0207ec3',
                '1435175',
                $options
            );

            $sql = $this->FeedbackAktifitasModel->count($id_penerima, $id_aktifitas);
            $dataNotif = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'id_penerima' => $id_penerima
            ];

            $sql_mahasiswa = $this->FeedbackAktifitasModel->count($id_user, $id_aktifitas);
            $dataNotifMahasiswa = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'id_penerima' => $id_user
            ];

            $data['isi_pesan_feedback'] = view('layouts/isi_pesan/feedback-dosen', $dataNotif);
            $data['feedbackdosen'] = $sql['jumlah'];

            $data['isi_pesan_feedback_mahasiswa'] = view('layouts/isi_pesan/feedback-mahasiswa', $dataNotifMahasiswa);
            $data['feedbackmahasiswa'] = $sql_mahasiswa['jumlah'];

            $pusher->trigger('sia-fkunmul', 'feedback', $data);
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }
}
