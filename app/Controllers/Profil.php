<?php

namespace App\Controllers;

use Pusher\Pusher;
use App\Models\UserModel;
use App\Models\DosenModel;
use App\Models\MahasiswaModel;
use App\Controllers\BaseController;
use App\Models\AktifitasModel;
use App\Models\KoneksiModel;

class Profil extends BaseController
{

    protected $MahasiswaModel;
    protected $UserModel;
    protected $DosenModel;
    protected $AktifitasModel;
    protected $KoneksiModel;

    public function __construct()
    {
        $this->MahasiswaModel = new MahasiswaModel();
        $this->UserModel = new UserModel();
        $this->DosenModel = new DosenModel();
        $this->AktifitasModel = new AktifitasModel();
        $this->KoneksiModel = new KoneksiModel();
    }

    // MAHASISWA

    public function editMahasiswa()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $data = [
            'title' => 'Edit Profil - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Edit Profil',
            'header' => 'Edit Profil',
        ];
        return view('profil/mahasiswa', $data);
    }

    public function viewMahasiswa()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $username =  session()->get('username');
        if ($request->isAJAX()) {
            $data = [
                'mahasiswa' => $this->MahasiswaModel->join('users', 'users.username=mahasiswas.nim')->where('mahasiswas.nim', $username)->first(),
            ];
            $msg = [
                'data' => view('profil/mahasiswa-view-data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function prosesEditMahasiswa()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $nama = $request->getVar('nama');
            $email = $request->getVar('email');
            $telepon = $request->getVar('telepon');
            $alamat = $request->getVar('alamat');
            $nim = $request->getVar('nim');
            $username =  session()->get('username');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong'
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'telepon' => [
                    'label' => 'Telepon',
                    'rules' => 'required|is_unique[users.username]',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                        'is_unique' => 'Username Sudah Terdaftar !'
                    ]
                ],
                'alamat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'email' => $validation->getError('email'),
                        'telepon' => $validation->getError('telepon'),
                        'alamat' => $validation->getError('alamat'),
                        'file' => $validation->getError('file'),
                    ],
                ];
                echo json_encode($msg);
            } else {

                $data = [
                    'nama_mahasiswa' => $nama,
                    'alamat' => $alamat,
                    'telepon' => $telepon,
                    'email' => $email,
                ];

                $this->MahasiswaModel->edit($data, $nim);

                $data_user = [
                    'nama_user' => $nama,
                ];

                $this->MahasiswaModel->editUser($data_user, $nim);

                $data_page = [
                    'mahasiswa' => $this->MahasiswaModel->join('users', 'users.username=mahasiswas.nim')->where('mahasiswas.nim', $username)->first(),
                ];
                $msg = [
                    'data' => view('profil/mahasiswa-view-data', $data_page),
                    'sukses' => 'Data Berhasil Di Edit',
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

                $sql = $this->MahasiswaModel->join('users', 'users.username=mahasiswas.nim')->where('mahasiswas.nim', $username)->first();

                $data['nama'] = $sql['nama_user'];
                $pusher->trigger('sia-fkunmul', 'my-event', $data);
                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function prosesEditFotoMahasiswa()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $nim = $request->getVar('nim');
            $file = $this->request->getFile('file');
            $username =  session()->get('username');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,jpeg,jpg,png]',
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'file' => $validation->getError('file'),
                    ],
                ];
                echo json_encode($msg);
            } else {

                $newName = $file->getRandomName();
                $file->move('../public/assets/images/user-profile', $newName);
                $nama_foto = $newName;

                $data_user = [
                    'foto' => $nama_foto
                ];

                $this->MahasiswaModel->editUser($data_user, $nim);

                $data_page = [
                    'mahasiswa' => $this->MahasiswaModel->join('users', 'users.username=mahasiswas.nim')->where('mahasiswas.nim', $username)->first(),
                ];
                $msg = [
                    'data' => view('profil/mahasiswa-view-data', $data_page),
                    'sukses' => 'Foto Berhasil Di Ubah',
                ];
                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function viewDataDiriMahasiswa()
    {
    }

    // AKHIR MAHASISWA

    // DOSEN

    public function editDosen()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '3') {
            return redirect()->to('/');
        }
        $data = [
            'title' => 'Mahasiswa - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Manajemen User',
            'header' => 'Edit Profil',
        ];
        return view('profil/dosen', $data);
    }

    public function viewDosen()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '3') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $username =  session()->get('username');

        if ($request->isAJAX()) {
            $data = [
                'dosen' => $this->DosenModel->join('users', 'users.username=dosens.nip')->where('dosens.nip', $username)->first(),
            ];
            $msg = [
                'data' => view('profil/dosen-view-data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function prosesEditDosen()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '3') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $nama = $request->getVar('nama');
            $email = $request->getVar('email');
            $telepon = $request->getVar('telepon');
            $alamat = $request->getVar('alamat');
            $nip = $request->getVar('nip');
            $username =  session()->get('username');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong'
                    ]
                ],
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'telepon' => [
                    'label' => 'Telepon',
                    'rules' => 'required|is_unique[users.username]',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                        'is_unique' => 'Username Sudah Terdaftar !'
                    ]
                ],
                'alamat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'email' => $validation->getError('email'),
                        'telepon' => $validation->getError('telepon'),
                        'alamat' => $validation->getError('alamat'),
                        'file' => $validation->getError('file'),
                    ],
                ];
                echo json_encode($msg);
            } else {

                $data = [
                    'nama_dosen' => $nama,
                    'alamat' => $alamat,
                    'telepon' => $telepon,
                    'email' => $email,
                ];

                $this->DosenModel->edit($data, $nip);

                $data_user = [
                    'nama_user' => $nama,
                ];

                $this->DosenModel->editUser($data_user, $nip);

                $data_page = [
                    'dosen' => $this->DosenModel->join('users', 'users.username=dosens.nip')->where('dosens.nip', $username)->first(),
                ];
                $msg = [
                    'data' => view('profil/dosen-view-data', $data_page),
                    'sukses' => 'Data Berhasil Di Edit',
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

                $sql = $this->DosenModel->join('users', 'users.username=dosens.nip')->where('dosens.nip', $username)->first();

                $data['nama'] = $sql['nama_user'];
                $pusher->trigger('sia-fkunmul', 'my-event', $data);
                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function prosesEditFotoDosen()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '3') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $nip = $request->getVar('nip');
            $file = $this->request->getFile('file');
            $username =  session()->get('username');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,jpeg,jpg,png]',
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'file' => $validation->getError('file'),
                    ],
                ];
                echo json_encode($msg);
            } else {

                $newName = $file->getRandomName();
                $file->move('../public/assets/images/user-profile', $newName);
                $nama_foto = $newName;

                $data_user = [
                    'foto' => $nama_foto
                ];

                $this->DosenModel->editUser($data_user, $nip);

                $data_page = [
                    'dosen' => $this->DosenModel->join('users', 'users.username=dosens.nip')->where('dosens.nip', $username)->first(),
                ];
                $msg = [
                    'data' => view('profil/dosen-view-data', $data_page),
                    'sukses' => 'Foto Berhasil Di Ubah',
                ];
                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    // AKHIR DOSEN

    // OPERATOR

    public function editOperator()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $data = [
            'title' => 'Mahasiswa - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Manajemen User',
            'header' => 'Edit Profil',
        ];
        return view('profil/operator', $data);
    }

    public function viewOperator()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $username =  session()->get('username');

        if ($request->isAJAX()) {
            $data = [
                'user' => $this->UserModel->where('username', $username)->first(),
            ];
            $msg = [
                'data' => view('profil/operator-view-data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function prosesEditOperator()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $nama = $request->getVar('nama');
            $username = $request->getVar('username');
            $id = $request->getVar('id');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong'
                    ]
                ],
                'username' => [
                    'label' => 'username',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                        'username' => $validation->getError('username'),
                    ],
                ];
                echo json_encode($msg);
            } else {

                $data_user = [
                    'nama_user' => $nama,
                    'username' => $username
                ];

                $this->UserModel->update($id, $data_user);

                $data_page = [
                    'user' => $this->UserModel->where('id', $id)->first(),
                ];
                $msg = [
                    'data' => view('profil/operator-view-data', $data_page)
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

                $sql = $this->UserModel->where('id', $id)->first();

                $data['nama'] = $sql['nama_user'];
                $pusher->trigger('sia-fkunmul', 'my-event', $data);
                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function prosesEditFotoOperator()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $id = $request->getVar('id');
            $file = $this->request->getFile('file');
            $username = $request->getVar('username');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,jpeg,jpg,png]',
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'file' => $validation->getError('file'),
                    ],
                ];
                echo json_encode($msg);
            } else {

                $newName = $file->getRandomName();
                $file->move('../public/assets/images/user-profile', $newName);
                $nama_foto = $newName;

                $data_user = [
                    'foto' => $nama_foto
                ];

                $this->UserModel->update($id, $data_user);

                $data_page = [
                    'user' => $this->UserModel->where('id', $id)->first(),
                ];
                $msg = [
                    'data' => view('profil/operator-view-data', $data_page),
                    'sukses' => 'Foto Berhasil Di Ubah',
                ];
                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function prosesEditFotoCoverOperator()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $id = $request->getVar('id');
            $file = $this->request->getFile('file');
            $username = session()->get('username');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,jpeg,jpg,png]',
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'file' => $validation->getError('file'),
                    ],
                ];
                echo json_encode($msg);
            } else {

                $newName = $file->getRandomName();
                $file->move('../public/assets/images/user-profile', $newName);
                $nama_foto = $newName;

                $data_user = [
                    'foto_cover' => $nama_foto
                ];

                $this->UserModel->update($id, $data_user);

                $data_page = [
                    'title' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
                    'topHeader' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
                    'header' => 'Beranda',
                    'user' => $this->UserModel->join('userroles', 'userroles.id_role=users.role')->where('id', $id)->first(),
                ];

                $msg = [
                    'data' => view('halaman_awal/operator-data-view', $data_page),
                    'sukses' => 'Cover Berhasil Di Ubah',
                ];

                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function prosesEditFotoOperatorBeranda()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $id = $request->getVar('id');
            $file = $this->request->getFile('file');
            $username = session()->get('username');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,jpeg,jpg,png]',
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'file' => $validation->getError('file'),
                    ],
                ];
                echo json_encode($msg);
            } else {

                $newName = $file->getRandomName();
                $file->move('../public/assets/images/user-profile', $newName);
                $nama_foto = $newName;

                $data_user = [
                    'foto' => $nama_foto
                ];

                $this->UserModel->update($id, $data_user);

                $data_page = [
                    'title' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
                    'topHeader' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
                    'header' => 'Beranda',
                    'user' => $this->UserModel->join('userroles', 'userroles.id_role=users.role')->where('id', $id)->first(),
                ];

                $msg = [
                    'data' => view('halaman_awal/operator-data-view', $data_page),
                    'sukses' => 'Cover Berhasil Di Ubah',
                ];

                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function prosesEditFotoCoverMahasiswa()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $id = $request->getVar('id');
            $file = $this->request->getFile('file');
            $username = session()->get('username');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,jpeg,jpg,png]',
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'file' => $validation->getError('file'),
                    ],
                ];
                echo json_encode($msg);
            } else {

                $newName = $file->getRandomName();
                $file->move('../public/assets/images/user-profile', $newName);
                $nama_foto = $newName;

                $data_user = [
                    'foto_cover' => $nama_foto
                ];

                $this->UserModel->update($id, $data_user);

                $data_page = [
                    'title' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
                    'topHeader' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
                    'header' => 'Beranda',
                    'user' => $this->UserModel->join('userroles', 'userroles.id_role=users.role')->where('username', $username)->first(),
                    'aktifitas' => $this->AktifitasModel->viewTimelineFeedback($username),
                    'feedback' => $this->AktifitasModel->viewFeedback(),
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'mahasiswa' => $this->UserModel->viewBeranda($username),
                ];

                $msg = [
                    'data' => view('halaman_awal/mahasiswa-data-view', $data_page),
                    'sukses' => 'Cover Berhasil Di Ubah',
                ];

                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function prosesEditFotoMahasiswaBeranda()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $id = $request->getVar('id');
            $file = $this->request->getFile('file');
            $username = session()->get('username');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,jpeg,jpg,png]',
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'file' => $validation->getError('file'),
                    ],
                ];
                echo json_encode($msg);
            } else {

                $newName = $file->getRandomName();
                $file->move('../public/assets/images/user-profile', $newName);
                $nama_foto = $newName;

                $data_user = [
                    'foto' => $nama_foto
                ];

                $this->UserModel->update($id, $data_user);

                $data_page = [
                    'title' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
                    'topHeader' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
                    'header' => 'Beranda',
                    'user' => $this->UserModel->join('userroles', 'userroles.id_role=users.role')->where('username', $username)->first(),
                    'aktifitas' => $this->AktifitasModel->viewTimelineFeedback($username),
                    'feedback' => $this->AktifitasModel->viewFeedback(),
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'mahasiswa' => $this->UserModel->viewBeranda($username),
                ];

                $msg = [
                    'data' => view('halaman_awal/mahasiswa-data-view', $data_page),
                    'sukses' => 'Cover Berhasil Di Ubah',
                ];

                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function prosesEditFotoCoverDosen()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '3') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $id = $request->getVar('id');
            $file = $this->request->getFile('file');
            $username = session()->get('username');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,jpeg,jpg,png]',
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'file' => $validation->getError('file'),
                    ],
                ];
                echo json_encode($msg);
            } else {

                $newName = $file->getRandomName();
                $file->move('../public/assets/images/user-profile', $newName);
                $nama_foto = $newName;

                $data_user = [
                    'foto_cover' => $nama_foto
                ];

                $this->UserModel->update($id, $data_user);

                $data_page = [
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
                    'data' => view('halaman_awal/dosen-data-view', $data_page),
                    'sukses' => 'Cover Berhasil Di Ubah',
                ];

                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function prosesEditFotoDosenBeranda()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '3') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $id = $request->getVar('id');
            $file = $this->request->getFile('file');
            $username = session()->get('username');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,jpeg,jpg,png]',
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'file' => $validation->getError('file'),
                    ],
                ];
                echo json_encode($msg);
            } else {

                $newName = $file->getRandomName();
                $file->move('../public/assets/images/user-profile', $newName);
                $nama_foto = $newName;

                $data_user = [
                    'foto' => $nama_foto
                ];

                $this->UserModel->update($id, $data_user);

                $data_page = [
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
                    'data' => view('halaman_awal/dosen-data-view', $data_page),
                    'sukses' => 'Cover Berhasil Di Ubah',
                ];

                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }
}
