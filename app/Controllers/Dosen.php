<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\KoneksiModel;
use App\Models\StatusDosenModel;
use App\Models\ProgramStudiModel;
use App\Controllers\BaseController;
use App\Models\UserModel;

class Dosen extends BaseController
{
    protected $DosenModel;
    protected $KoneksiModel;
    protected $ProgramStudiModel;
    protected $StatusDosenModel;
    protected $UserModel;

    public function __construct()
    {
        $this->DosenModel = new DosenModel();
        $this->KoneksiModel = new KoneksiModel();
        $this->ProgramStudiModel = new ProgramStudiModel();
        $this->StatusDosenModel = new StatusDosenModel();
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $data = [
            'title' => 'Dosen - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Manajemen User',
            'header' => 'Dosen',
            'validation' => \Config\Services::validation(),
            'dosen' => $this->DosenModel->view(),
            'koneksi' => $this->KoneksiModel->koneksi(),
            'programStudi' => $this->ProgramStudiModel->get()->getResultArray(),
            'statusDosen' => $this->StatusDosenModel->get()->getResultArray(),
        ];
        return view('dosen/operator-view', $data);
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
                'dosen' => $this->DosenModel->view(),
                'programStudi' => $this->ProgramStudiModel->get()->getResultArray(),
                'statusDosen' => $this->StatusDosenModel->get()->getResultArray(),
            ];

            $msg = [
                'data' => view('dosen/view-data', $data)
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
            $nip = $request->getVar('nip');
            $nama = $request->getVar('nama');
            $email = $request->getVar('email');
            $jk = $request->getVar('jk');
            $alamat = $request->getVar('alamat');
            $ps = $request->getVar('ps');
            $status = $request->getVar('status');
            $telepon = $request->getVar('telepon');

            $data2 = [
                'title' => 'Dosen - Fakultas Kedokteran Universitas Mulawarman',
                'topHeader' => 'Manajemen User',
                'header' => 'Dosen',
                'validation' => \Config\Services::validation(),
                'dosen' => $this->DosenModel->view(),
                'koneksi' => $this->KoneksiModel->koneksi(),
                'sukses' => 'pesanEdit',
                'programStudi' => $this->ProgramStudiModel->get()->getResultArray(),
                'statusDosen' => $this->StatusDosenModel->get()->getResultArray(),
            ];

            $cek = $this->DosenModel->where(['nip' => $nip])->get()->getRowArray();
            if ($cek > 0) {
                $msg = [
                    'sukses' => '' . $nama . ' Sudah Terdaftar !',
                    'data' => view('dosen/view-data', $data2)
                ];
                echo json_encode($msg);
            } else {
                $data = [
                    'nip' => $nip,
                    'nama_dosen' => $nama,
                    'email' => $email,
                    'jk' => $jk,
                    'alamat' => $alamat,
                    'id_ps' => $ps,
                    'id_status_dosen' => $status,
                    'telepon' => $telepon,
                    'id_fak' => '1',
                    'status_ajar' => 'aktif'
                ];

                $this->DosenModel->insert($data);

                $data_user = [
                    'username' => $nip,
                    'nama_user' => $nama,
                    'role' => '3',
                    'jk' => $jk,
                    'id_user_ps' => $status,
                    'password' => password_hash('dosenfkunmul', PASSWORD_DEFAULT),
                ];

                $this->UserModel->insert($data_user);

                $data3 = [
                    'title' => 'Dosen - Fakultas Kedokteran Universitas Mulawarman',
                    'topHeader' => 'Manajemen User',
                    'header' => 'Dosen',
                    'validation' => \Config\Services::validation(),
                    'dosen' => $this->DosenModel->view(),
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'sukses' => 'pesanEdit',
                    'programStudi' => $this->ProgramStudiModel->get()->getResultArray(),
                    'statusDosen' => $this->StatusDosenModel->get()->getResultArray(),
                ];
                $msg = [
                    'sukses' => 'Data Dosen Berhasil Ditambahkan !',
                    'data' => view('dosen/view-data', $data3)
                ];
                echo json_encode($msg);
            }
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function tambahUser()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }

        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $username = $request->getVar('username');
            $nama_user = $request->getVar('nama_user');
            $jk = $request->getVar('jk');
            $status = $request->getVar('status');
            $password = $request->getVar('password');

            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'password' => [
                    'label' => 'Password',
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
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'password' => $validation->getError('password'),
                        'konfirmasi_password' => $validation->getError('konfirmasi_password'),
                    ],
                ];
                return $this->response->setJSON($msg);
            } else {

                $data_user = [
                    'username' => $username,
                    'nama_user' => $nama_user,
                    'role' => '3',
                    'jk' => $jk,
                    'foto' => 'user1.png',
                    'id_user_ps' => $status,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                ];

                $this->UserModel->insert($data_user);

                $data3 = [
                    'title' => 'Dosen - Fakultas Kedokteran Universitas Mulawarman',
                    'topHeader' => 'Manajemen User',
                    'header' => 'Dosen',
                    'validation' => \Config\Services::validation(),
                    'dosen' => $this->DosenModel->view(),
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'sukses' => 'pesanEdit',
                    'programStudi' => $this->ProgramStudiModel->get()->getResultArray(),
                    'statusDosen' => $this->StatusDosenModel->get()->getResultArray(),
                ];
                $msg = [
                    'sukses' => 'Data User Berhasil Ditambahkan !',
                    'data' => view('dosen/view-data', $data3)
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
            $nip = $request->getVar('nip');
            $nama = $request->getVar('nama');
            $email = $request->getVar('email');
            $jk = $request->getVar('jk');
            $alamat = $request->getVar('alamat');
            $ps = $request->getVar('ps');
            $status = $request->getVar('status');
            $telepon = $request->getVar('telepon');
            $nip_lama = $request->getVar('nip_lama');

            $data = [
                'nip' => $nip,
                'nama_dosen' => $nama,
                'email' => $email,
                'jk' => $jk,
                'alamat' => $alamat,
                'id_ps' => $ps,
                'status' => $status,
                'telepon' => $telepon,
            ];

            $this->DosenModel->update($id, $data);

            $data_user = [
                'username' => $nip,
                'nama_user' => $nama,
                'jk' => $jk
            ];
            $this->DosenModel->editUser($data_user, $nip_lama);


            $data2 = [
                'title' => 'Dosen - Fakultas Kedokteran Universitas Mulawarman',
                'topHeader' => 'Manajemen User',
                'header' => 'Dosen',
                'validation' => \Config\Services::validation(),
                'dosen' => $this->DosenModel->view(),
                'koneksi' => $this->KoneksiModel->koneksi(),
                'sukses' => 'pesanEdit',
                'programStudi' => $this->ProgramStudiModel->get()->getResultArray(),
                'statusDosen' => $this->StatusDosenModel->get()->getResultArray(),
            ];
            $msg = [
                'sukses' => 'Data Dosen Berhasil Diedit !',
                'data' => view('dosen/view-data', $data2)
            ];

            echo json_encode($msg);
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
            $nip = $request->getVar('nip');

            $this->DosenModel->delete($id);
            $this->DosenModel->hapusUser($nip);

            $data2 = [
                'title' => 'Dosen - Fakultas Kedokteran Universitas Mulawarman',
                'topHeader' => 'Manajemen User',
                'header' => 'Dosen',
                'validation' => \Config\Services::validation(),
                'dosen' => $this->DosenModel->view(),
                'koneksi' => $this->KoneksiModel->koneksi(),
                'sukses' => 'pesanEdit',
                'programStudi' => $this->ProgramStudiModel->get()->getResultArray(),
                'statusDosen' => $this->StatusDosenModel->get()->getResultArray(),
            ];
            $msg = [
                'sukses' => 'Dosen berhasil dihapus !',
                'data' => view('dosen/view-data', $data2)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function import()
    {
        $request = \Config\Services::request();
        $csv = $request->getVar();
        if ($csv) {
            $fileName = $_FILES["csv"]["tmp_name"];

            if ($_FILES['csv']['size'] > 0) {
                $file = fopen($fileName, "r");

                $model = new \App\Models\DosenModel();

                $builder = $model->builder();

                $data = array();

                while (!feof($file)) {
                    $column = fgetcsv($file, 150, ";");
                    $id_fak = $column[0];
                    $id_ps = $column[1];
                    $nama_dosen = $column[2];
                    $nip = $column[3];
                    $alamat = $column[4];
                    $telepon = $column[5];
                    $email = $column[6];
                    $jk = $column[7];
                    $status = $column[8];

                    $row = [
                        'id_fak' => $id_fak,
                        'id_ps' => $id_ps,
                        'nama_dosen' => $nama_dosen,
                        'nip' => $nip,
                        'alamat' => $alamat,
                        'telepon' => $telepon,
                        'email' => $email,
                        'jk' => $jk,
                        'status' => $status,
                    ];

                    array_push($data, $row);
                }

                $builder->insertBatch($data);
                fclose($file);
            }
            session()->setFlashData('pesanBerhasil', 'Data Berhasil Ditambahkan !');
            return redirect()->to('/data-dosen');
        }
        session()->setFlashData('pesanGagal', 'Data Gagal Ditambahkan');
        return redirect()->to('/data-dosen');
    }

    public function prosesExcel()
    {
        $request = \Config\Services::request();
        $file = $this->request->getFile('fileexcel');
        $ext = $file->getClientExtension();
        require __DIR__ . '/../../vendor/autoload.php';

        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }

        $spreadsheet = $render->load($file);

        $sheet = $spreadsheet->getActiveSheet()->toArray();

        foreach ($sheet as $idx => $data) {
            //skip index 1 karena title excel
            if ($idx == 0) {
                continue;
            }

            $cek = $this->DosenModel->cekNip($data['4']);

            error_reporting(0);

            if ($cek['nip'] == $data['4']) {
                continue;
            }

            $id_fak = $data[0];
            $id_ps = $data[1];
            $id_status_dosen = $data[2];
            $nama_dosen = $data[3];
            $nip = $data[4];
            $alamat = $data[5];
            $telepon = $data[6];
            $email = $data[7];
            $jk = $data[8];
            $status_ajar = $data[9];

            // insert data
            $this->DosenModel->insert([
                'id_fak' => $id_fak,
                'id_ps' => $id_ps,
                'id_status_dosen' => $id_status_dosen,
                'nama_dosen' => $nama_dosen,
                'nip' => $nip,
                'alamat' => $alamat,
                'telepon' => $telepon,
                'email' => $email,
                'jk' => $jk,
                'status_ajar' => $status_ajar
            ]);
        }
        session()->setFlashData('pesanBerhasil', 'Data Berhasil Ditambahkan !');
        return redirect()->to('/data-dosen');
    }
}
