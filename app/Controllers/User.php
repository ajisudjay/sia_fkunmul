<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DosenModel;
use App\Models\KoneksiModel;
use App\Models\UserRoleModel;
use App\Models\MahasiswaModel;
use App\Models\StatusDosenModel;
use App\Controllers\BaseController;

class User extends BaseController
{
    protected $UserModel;
    protected $KoneksiModel;
    protected $DosenModel;
    protected $MahasiswaModel;
    protected $StatusDosenModel;
    protected $UserRoleModel;
    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->KoneksiModel = new KoneksiModel();
        $this->DosenModel = new DosenModel();
        $this->MahasiswaModel = new MahasiswaModel();
        $this->StatusDosenModel = new StatusDosenModel();
        $this->UserRoleModel = new UserRoleModel();
    }
    public function index()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $data = [
            'title' => 'User - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Manajemen User',
            'header' => 'User',
            'validation' => \Config\Services::validation(),
            'user' => $this->UserModel->orderBy('nama_user', 'ASC')->get()->getResultArray(),
            'koneksi' => $this->KoneksiModel->koneksi(),
        ];
        return view('user/operator-view', $data);
    }

    public function viewDataOperator()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'user' => $this->UserModel->orderBy('nama_user', 'ASC')->get()->getResultArray(),
                'dosen' => $this->DosenModel->orderBy('nama_dosen', 'ASC')->get()->getResultArray(),
                'mahasiswa' => $this->MahasiswaModel->orderBy('nama_mahasiswa', 'ASC')->get()->getResultArray(),
                'userRole' => $this->UserRoleModel->get()->getResultArray(),
            ];
            $msg = [
                'data' => view('user/view-data', $data)
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
            $username = $request->getVar('username');
            $nama = $request->getVar('nama');
            $jk = $request->getVar('jk');
            $role = $request->getVar('role');
            $status = $request->getVar('status');
            $password = $request->getVar('password');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'password' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong'
                    ]
                ],
                'konfirmasi_password' => [
                    'label' => 'Konfirmasi Password',
                    'rules' => 'required|matches[password]',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                        'matches' => 'Konfirmasi Password Tidak Sesuai'
                    ]
                ],
                'username' => [
                    'label' => 'Username',
                    'rules' => 'required|is_unique[users.username]',
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
                        'password' => $validation->getError('password'),
                        'konfirmasi_password' => $validation->getError('konfirmasi_password'),
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
                    'status' => $status,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                ];

                $this->UserModel->insert($data);

                $data2 = [
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'user' => $this->UserModel->orderBy('nama_user', 'ASC')->get()->getResultArray(),
                    'dosen' => $this->DosenModel->orderBy('nama_dosen', 'ASC')->get()->getResultArray(),
                    'mahasiswa' => $this->MahasiswaModel->orderBy('nama_mahasiswa', 'ASC')->get()->getResultArray(),
                    'userRole' => $this->UserRoleModel->get()->getResultArray(),
                ];
                $msg = [
                    'sukses' => 'Data mahasiswa Berhasil Ditambahkan !',
                    'status' => 'berhasil',
                    'data' => view('user/view-data', $data2)
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
                'user' => $this->UserModel->orderBy('nama_user', 'ASC')->get()->getResultArray(),
                'dosen' => $this->DosenModel->orderBy('nama_dosen', 'ASC')->get()->getResultArray(),
                'mahasiswa' => $this->MahasiswaModel->orderBy('nama_mahasiswa', 'ASC')->get()->getResultArray(),
                'userRole' => $this->UserRoleModel->get()->getResultArray(),
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

    public function resetPassword()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();

        if ($request->isAJAX()) {

            $id = $request->getVar('id');
            $faker = \Faker\Factory::create();
            $pass = $faker->randomNumber(6, true);

            $data = [
                'password' => password_hash($pass, PASSWORD_DEFAULT),
            ];
            $this->UserModel->update($id, $data);

            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'user' => $this->UserModel->orderBy('nama_user', 'ASC')->get()->getResultArray(),
                'dosen' => $this->DosenModel->orderBy('nama_dosen', 'ASC')->get()->getResultArray(),
                'mahasiswa' => $this->MahasiswaModel->orderBy('nama_mahasiswa', 'ASC')->get()->getResultArray(),
                'userRole' => $this->UserRoleModel->get()->getResultArray(),
                'password' => $pass,
                'id_pass' => $id
            ];
            $msg = [
                'sukses' => 'Password Berhasil Di Reset !',
                'data' => view('user/view-data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }
}
