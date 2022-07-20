<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        if ($request->isAJAX()) {
            $username = $request->getPost('username');
            $password = $request->getPost('password');

            $valid = $this->validate([
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|numeric',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                        'numeric' => 'Format Username Salah !'
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong'
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'username' => $validation->getError('username'),
                        'password' => $validation->getError('password'),
                    ],
                ];
                echo json_encode($msg);
            } else {
                $user = $this->UserModel->where('username', $username)->first();
                if ($user < 1) {
                    $msg = [
                        'title' => 'gagallogin',
                        'usernamelogin' => 'Username Tidak Terdaftar',
                    ];
                    echo json_encode($msg);
                } else {
                    $role = $user['role'];
                    $hash_pass = $user['password'];
                    if ($user['username'] === $username && password_verify($password, $hash_pass)) {
                        if ($role == '1') {
                            session()->set('username', $user['username']);
                            session()->set('password', $user['password']);
                            session()->set('foto', $user['foto']);
                            session()->set('nama_user', $user['nama_user']);
                            $msg = [
                                'title' => 'berhasiloperator',
                                'urloperator' => '/auth/operator',
                            ];
                            echo json_encode($msg);
                        } else if ($role == '2') {
                            session()->set('username', $user['username']);
                            session()->set('password', $user['password']);
                            session()->set('foto', $user['foto']);
                            session()->set('nama_user', $user['nama_user']);
                            $msg = [
                                'title' => 'berhasiloperator',
                                'urloperator' => '/auth/mahasiswa',
                            ];
                            echo json_encode($msg);
                        } else if ($role == '3') {
                            session()->set('username', $user['username']);
                            session()->set('password', $user['password']);
                            session()->set('foto', $user['foto']);
                            session()->set('nama_user', $user['nama_user']);
                            $msg = [
                                'title' => 'berhasiloperator',
                                'urloperator' => '/auth/dosen',
                            ];
                            echo json_encode($msg);
                        } else if ($role == '4') {
                            session()->set('username', $user['username']);
                            session()->set('password', $user['password']);
                            session()->set('foto', $user['foto']);
                            session()->set('nama_user', $user['nama_user']);
                            $msg = [
                                'title' => 'berhasiloperator',
                                'urloperator' => '/auth/umum',
                            ];
                            echo json_encode($msg);
                        } else if ($role == '5') {
                            session()->set('username', $user['username']);
                            session()->set('password', $user['password']);
                            session()->set('foto', $user['foto']);
                            session()->set('nama_user', $user['nama_user']);
                            $msg = [
                                'title' => 'berhasiloperator',
                                'urloperator' => '/auth/operator',
                            ];
                            echo json_encode($msg);
                        }
                    } else {
                        $msg = [
                            'title' => 'gagaluser',
                            'usernamegagal' => 'Username dan Password Tidak Sesuai',
                        ];
                        echo json_encode($msg);
                    }
                }
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    function viewRegister()
    {
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
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


            imagettftext($gambar, $font_size, $rotasi, $x_text, $y_text, $white, $font_type, $text_input); //pengaturan text pada gambar

            imagejpeg($gambar, $output);

            $data = [
                'title' => 'Login - Fakultas Kedokteran Universitas Mulawarman',
                'captcha' => $output
            ];

            $msg = [
                'data' => view('auth/view-register', $data),
                'sukses' => 'alhamdulillah'
            ];

            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function captcha()
    {
        return view('auth/captcha');
    }

    public function operator()
    {
        $password = session()->get('password');
        $username = session()->get('username');

        $cek = $this->UserModel->where(['username' => $username, 'password' => $password])->first();
        session()->set('id_user', $cek['id']);
        session()->set('username', $cek['username']);
        session()->set('password', $cek['password']);
        session()->set('role', $cek['role']);
        session()->set('jk', $cek['jk']);
        session()->set('nama_user', $cek['nama_user']);
        session()->setFlashdata('loginBerhasil', 'Login Berhasil');
        return redirect()->to('/operator');
    }

    public function dosen()
    {
        $password = session()->get('password');
        $username = session()->get('username');

        $cek = $this->UserModel->where(['username' => $username, 'password' => $password])->first();
        session()->set('id_user', $cek['id']);
        session()->set('username', $cek['username']);
        session()->set('password', $cek['password']);
        session()->set('role', $cek['role']);
        session()->set('jk', $cek['jk']);
        session()->set('nama_user', $cek['nama_user']);
        session()->setFlashdata('loginBerhasil', 'Login Berhasil');
        return redirect()->to('/dosen');
    }

    public function mahasiswa()
    {
        $password = session()->get('password');
        $username = session()->get('username');

        $cek = $this->UserModel->where(['username' => $username, 'password' => $password])->first();

        session()->set('id_user', $cek['id']);
        session()->set('username', $cek['username']);
        session()->set('password', $cek['password']);
        session()->set('role', $cek['role']);
        session()->set('jk', $cek['jk']);
        session()->set('nama_user', $cek['nama_user']);
        session()->setFlashdata('loginBerhasil', 'Login Berhasil');
        return redirect()->to('/mahasiswa');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        session()->setFlashdata('pesanLogout', 'Berhasil Keluar !');
        return redirect()->to('/');
    }

    public function modalPassword()
    {
        $request = \Config\Services::request();
        $id = $request->getPost('id');
        if ($request->isAJAX()) {
            $data = [
                'user' => $this->UserModel->where('id', $id)->first(),
            ];

            $msg = [
                'sukses' => view('auth/ganti-password', $data),
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function ubahPassword()
    {
        if (session()->get('username') == NULL) {
            return redirect()->to('/');
        }

        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $password_lama = $this->request->getVar('password_lama');
            $password_baru = $this->request->getVar('password_baru');
            $id = $request->getVar('id');

            $cek = $this->UserModel->where('id', $id)->first();

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'password_lama' => [
                    'label' => 'password lama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* {field} Tidak Boleh Kosong',
                    ]
                ],
                'password_baru' => [
                    'label' => 'password baru',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* {field} Tidak Boleh Kosong'
                    ]
                ],
                'konfirmasi_password' => [
                    'label' => 'konfirmasi password',
                    'rules' => 'required|matches[password_baru]',
                    'errors' => [
                        'required' => '* {field} Tidak Boleh Kosong',
                        'matches' => 'Konfirmasi Password Tidak Sesuai'
                    ]
                ],
            ]);

            if (!password_verify($password_lama, $cek['password'])) {
                $msg = [
                    'error' => [
                        'password_lama' => 'password lama tidak sesuai',
                    ],
                ];
                return $this->response->setJSON($msg);
            }

            if (!$valid) {
                $msg = [
                    'error' => [
                        'password_lama' => $validation->getError('password_lama'),
                        'password_baru' => $validation->getError('password_baru'),
                        'konfirmasi_password' => $validation->getError('konfirmasi_password'),
                    ],
                ];
                return $this->response->setJSON($msg);
            } else {

                $data_user = [
                    'password' => password_hash($password_baru, PASSWORD_DEFAULT),
                ];

                $this->UserModel->update($id, $data_user);

                $msg = [
                    'sukses' => 'Password Berhasil Diubah !',
                ];
                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function prosesRegister()
    {

        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $password = $this->request->getVar('password');
            $nama = $this->request->getVar('nama');
            $nim = $this->request->getVar('nim');
            $jk = $this->request->getVar('jk');
            $email = $this->request->getVar('email');

            $cek = $this->UserModel->where('username', $nim)->first();

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* {field} Tidak Boleh Kosong',
                    ]
                ],
                'nim' => [
                    'label' => 'NIM',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* {field} Tidak Boleh Kosong'
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* {field} Tidak Boleh Kosong'
                    ]
                ],
                'jk' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* {field} Tidak Boleh Kosong'
                    ]
                ],
                'konfirmasi_password' => [
                    'label' => 'konfirmasi password',
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => '* {field} Tidak Boleh Kosong',
                        'matches' => 'Konfirmasi Password Tidak Sesuai'
                    ]
                ],
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '* {field} Tidak Boleh Kosong',
                    ]
                ],
            ]);

            if ($cek > 0) {
                $msg = [
                    'error' => [
                        'nim' => '* Username sudah terdaftar !',
                    ],
                ];
                return $this->response->setJSON($msg);
            }

            if (!$valid) {
                $msg = [
                    'error' => [
                        'nim' => $validation->getError('nim'),
                        'nama' => $validation->getError('nama'),
                        'email' => $validation->getError('email'),
                        'jk' => $validation->getError('jk'),
                        'password' => $validation->getError('password'),
                        'konfirmasi_password' => $validation->getError('konfirmasi_password'),
                    ],
                ];
                return $this->response->setJSON($msg);
            } else {
                $msg = [
                    'sukses' => 'Registrasi Berhasil, Mengalihkan ke Halaman Login !',
                    'title' => 'berhasil',
                    'pesan' => 'Registrasi Berhasil, Mengalihkan ke Halaman Login !'
                ];
                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }
}
