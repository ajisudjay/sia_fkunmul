<?php

namespace App\Controllers;

use App\Models\AktifitasModel;
use App\Models\KoneksiModel;
use App\Models\UserModel;
use mysqli;

class Home extends BaseController
{

    protected $UserModel;
    protected $AktifitasModel;
    protected $KoneksiModel;

    public function __construct()
    {
        helper('form', 'time');
        $this->UserModel = new UserModel();
        $this->AktifitasModel = new AktifitasModel();
        $this->KoneksiModel = new KoneksiModel();
    }

    public function login()
    {
        $data = [
            'title' => 'Login - Fakultas Kedokteran Universitas Mulawarman',
            'validation' => \Config\Services::validation()
        ];
        return view('auth/login2', $data);
    }

    public function register()
    {
        $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $captcha = substr(str_shuffle($char), 0, 5);
        $output = "textimage.jpg"; // lokasi gambar disimpan
        $x = 150;
        $y = 50;

        $gambar = imagecreate($x, $y); // buat lebar dan tinggi gambar
        //warna
        $black = imagecolorallocate($gambar, 224, 224, 224); // ganti warna background gambar
        $white = imagecolorallocate($gambar, 255, 0, 0);
        // seting data textnya
        $font_size = 20;
        $rotasi = 0;
        $x_text = 35;
        $y_text = 33;
        $font_type = './file/font/Edu_QLD_Beginner/EduQLDBeginner-Bold.ttf';
        $text_input = $captcha;


        $text1 = imagettftext($gambar, $font_size, $rotasi, $x_text, $y_text, $white, $font_type, $text_input); //pengaturan text pada gambar

        imagejpeg($gambar, $output);

        $data = [
            'title' => 'Login - Fakultas Kedokteran Universitas Mulawarman',
            'validation' => \Config\Services::validation(),
            'captcha' => $output
        ];
        return view('auth/register', $data);
    }

    public function operator()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
            'topHeader' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
            'header' => 'Beranda',
        ];

        return view('halaman_awal/operator', $data);
    }

    public function dosen()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '3') {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
            'topHeader' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
            'header' => 'Beranda',
        ];

        return view('halaman_awal/dosen', $data);
    }

    public function mahasiswa()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $nim = session()->get('username');
        $data = [
            'title' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
            'topHeader' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
            'header' => 'Beranda',
            'sqlcount' => $this->AktifitasModel->viewJumlahSubAktifitasHome($nim),
            'sqlkompetensi' => $this->AktifitasModel->viewJumlahAktifitasHome($nim),
        ];

        return view('halaman_awal/mahasiswa', $data);
    }

    public function berandaOperator()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $username = session()->get('username');

        if ($request->isAJAX()) {
            $data = [
                'title' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
                'topHeader' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
                'header' => 'Beranda',
                'user' => $this->UserModel->where('username', $username)->join('userroles', 'userroles.id_role=users.role')->first(),
                'mahasiswa' => $this->UserModel->viewBeranda($username),
            ];

            $msg = [
                'data' => view('halaman_awal/operator-data-view', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function berandaMahasiswa()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $username = session()->get('username');
        $koneksi = $this->KoneksiModel->koneksi();
        $nim = session()->get('username');

        if ($request->isAJAX()) {
            $data = [
                'title' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
                'topHeader' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
                'header' => 'Beranda',
                'user' => $this->UserModel->join('userroles', 'userroles.id_role=users.role')->where('username', $username)->first(),
                'aktifitas' => $this->AktifitasModel->viewTimelineFeedback($username),
                'feedback' => $this->AktifitasModel->viewFeedback(),
                'koneksi' => $koneksi,
                'mahasiswa' => $this->UserModel->viewBeranda($username),
                'sqlcount' => $this->AktifitasModel->viewJumlahSubAktifitasHome($nim),
                'sqlkompetensi' => $this->AktifitasModel->viewJumlahAktifitasHome($nim),

            ];

            $msg = [
                'data' => view('halaman_awal/mahasiswa-data-view', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function berandaDosen()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '3') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $username = session()->get('username');
        $koneksi = $this->KoneksiModel->koneksi();

        if ($request->isAJAX()) {
            $data = [
                'title' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
                'topHeader' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
                'header' => 'Beranda',
                'user' => $this->UserModel->join('userroles', 'userroles.id_role=users.role')->where('username', $username)->first(),
                'dosen' => $this->UserModel->viewBerandaDosen($username),
                'aktifitas' => $this->AktifitasModel->viewTimelineFeedback($username),
                'feedback' => $this->AktifitasModel->viewFeedback(),
                'koneksi' => $this->KoneksiModel->koneksi(),
            ];

            $msg = [
                'data' => view('halaman_awal/dosen-data-view', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function timelineMahasiswa()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $username = session()->get('username');
        $nim = session()->get('username');

        $jumlahsub = null;
        $jumlah = null;

        $sqlcount = $this->AktifitasModel->viewJumlahAktifitasHome($nim);
        foreach ($sqlcount as $datacount) {
            $count = $datacount['jumlah'];
            $jumlah .= "$count" . ",";

            $countsub = $datacount['data_kompetensi'];
            $jumlahsub .= "'$countsub'" . ",";
        }

        $koneksi = $this->KoneksiModel->koneksi();
        if ($request->isAJAX()) {
            $data = [
                'user' => $this->UserModel->where('username', $username)->join('userroles', 'userroles.id_role=users.role')->first(),
                'mahasiswa' => $this->UserModel->viewBeranda($username),
                'aktifitas' => $this->AktifitasModel->viewTimelineFeedback($username),
                'feedback' => $this->AktifitasModel->viewFeedback(),
                'koneksi' => $koneksi,
                'sqlcount' => $this->AktifitasModel->viewJumlahSubAktifitasHome($nim),
                'sqlkompetensi' => $this->AktifitasModel->viewJumlahAktifitasHome($nim),
                'jumlah' => $jumlah,
                'jumlahsub' => $jumlahsub,
            ];

            $msg = [
                'data' => view('halaman_awal/timeline/mahasiswa-data-view-timeline', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function prestasiMahasiswa()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $username = session()->get('username');
        $koneksi = $this->KoneksiModel->koneksi();
        if ($request->isAJAX()) {
            $data = [
                'user' => $this->UserModel->where('username', $username)->join('userroles', 'userroles.id_role=users.role')->first(),
                'mahasiswa' => $this->UserModel->viewBeranda($username),
                'aktifitas' => $this->AktifitasModel->viewTimelineFeedback($username),
                'feedback' => $this->AktifitasModel->viewFeedback(),
                'koneksi' => $koneksi
            ];

            $msg = [
                'data' => view('halaman_awal/prestasi/mahasiswa-data-view-prestasi', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function perkuliahanMahasiswa()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $username = session()->get('username');
        $koneksi = $this->KoneksiModel->koneksi();

        if ($request->isAJAX()) {
            $data = [
                'user' => $this->UserModel->where('username', $username)->join('userroles', 'userroles.id_role=users.role')->first(),
                'mahasiswa' => $this->UserModel->viewBeranda($username),
                'aktifitas' => $this->AktifitasModel->viewTimelineFeedback($username),
                'feedback' => $this->AktifitasModel->viewFeedback(),
                'koneksi' => $koneksi
            ];

            $msg = [
                'data' => view('halaman_awal/perkuliahan/mahasiswa-data-view-perkuliahan', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }
}
