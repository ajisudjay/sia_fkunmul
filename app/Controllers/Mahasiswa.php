<?php

namespace App\Controllers;

use App\Models\KoneksiModel;
use App\Models\AngkatanModel;
use App\Models\MahasiswaModel;
use App\Models\StatusDosenModel;
use App\Models\ProgramStudiModel;
use App\Controllers\BaseController;
use App\Models\UserModel;

class Mahasiswa extends BaseController
{

    protected $MahasiswaModel;
    protected $KoneksiModel;
    protected $ProgramStudiModel;
    protected $StatusDosenModel;
    protected $AngkatanModel;
    protected $UserModel;

    public function __construct()
    {
        $this->MahasiswaModel = new MahasiswaModel();
        $this->KoneksiModel = new KoneksiModel();
        $this->ProgramStudiModel = new ProgramStudiModel();
        $this->StatusDosenModel = new StatusDosenModel();
        $this->AngkatanModel = new AngkatanModel();
        $this->UserModel = new UserModel();
    }

    public function index()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $data = [
            'title' => 'Mahasiswa - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Manajemen User',
            'header' => 'Mahasiswa',
            'angkatan' => $this->AngkatanModel->orderBy('angkatan', 'DESC')->get()->getResultArray(),
            'programStudi' => $this->ProgramStudiModel->get()->getResultArray(),
        ];
        return view('mahasiswa/operator-view', $data);
    }

    public function viewDataOperator()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $id_ps = $request->getVar('programStudi');
        $id_angkatan = $request->getVar('angkatan');
        if ($request->isAJAX()) {
            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'mahasiswa' => $this->MahasiswaModel->where(['id_ps' => $id_ps, 'id_angkatan' => $id_angkatan])->orderBy('nim', 'ASC')->get()->getResultArray(),
                'ps' => $this->ProgramStudiModel->where(['id' => $id_ps])->get()->getRowArray(),
                'sd' => $this->StatusDosenModel->where(['nama_status' => 'Mahasiswa'])->get()->getRowArray(),
                'ang' => $this->AngkatanModel->where(['id' => $id_angkatan])->get()->getRowArray(),
                'id_ps' => $id_ps,
                'id_angkatan' => $id_angkatan,
            ];
            $msg = [
                'data' => view('mahasiswa/operator-data-view', $data)
            ];
            echo json_encode($msg);
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
            $nim = $request->getVar('nim');
            $nama = $request->getVar('nama');
            $email = $request->getVar('email');
            $jk = $request->getVar('jk');
            $alamat = $request->getVar('alamat');
            $id_ps = $request->getVar('ps');
            $telepon = $request->getVar('telepon');
            $id_angkatan = $request->getVar('angkatan');
            $nim_lama = $request->getVar('nim_lama');

            $data = [
                'nim' => $nim,
                'nama_mahasiswa' => $nama,
                'email' => $email,
                'jk' => $jk,
                'alamat' => $alamat,
                'id_ps' => $id_ps,
                'telepon' => $telepon,
                'id_angkatan' => $id_angkatan,
            ];

            $this->MahasiswaModel->editMahasiswa($data, $id);

            $data_user = [
                'username' => $nim,
                'nama_user' => $nama,
                'jk' => $jk
            ];
            $this->MahasiswaModel->editUser($data_user, $nim_lama);

            $data2 = [
                'title' => 'Mahasiswa - Fakultas Kedokteran Universitas Mulawarman',
                'topHeader' => 'Manajemen User',
                'header' => 'Mahasiswa',
                'koneksi' => $this->KoneksiModel->koneksi(),
                'mahasiswa' => $this->MahasiswaModel->where(['id_ps' => $id_ps, 'id_angkatan' => $id_angkatan])->orderBy('nim', 'ASC')->get()->getResultArray(),
                'ps' => $this->ProgramStudiModel->where(['id' => $id_ps])->get()->getRowArray(),
                'sd' => $this->StatusDosenModel->where(['nama_status' => 'Mahasiswa'])->get()->getRowArray(),
                'ang' => $this->AngkatanModel->where(['id' => $id_angkatan])->get()->getRowArray(),
                'sukses' => 'pesanBerhasil',
                'item' => $nama,
                'itemResponse' => 'Berhasil di Edit !'
            ];
            $msg = [
                'sukses' => 'Data mahasiswa Berhasil Diedit !',
                'data' => view('mahasiswa/operator-data-view', $data2)
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
            $nim = $request->getVar('nim');
            $nama = $request->getVar('nama');
            $email = $request->getVar('email');
            $jk = $request->getVar('jk');
            $alamat = $request->getVar('alamat');
            $id_ps = $request->getVar('id_ps');
            $status = $request->getVar('status');
            $telepon = $request->getVar('telepon');
            $id_angkatan = $request->getVar('id_angkatan');
            $data3 = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'mahasiswa' => $this->MahasiswaModel->where(['id_ps' => $id_ps, 'id_angkatan' => $id_angkatan])->orderBy('nim', 'ASC')->get()->getResultArray(),
                'ps' => $this->ProgramStudiModel->where(['id' => $id_ps])->get()->getRowArray(),
                'sd' => $this->StatusDosenModel->where(['nama_status' => 'Mahasiswa'])->get()->getRowArray(),
                'ang' => $this->AngkatanModel->where(['id' => $id_angkatan])->get()->getRowArray(),
            ];
            $cek = $this->MahasiswaModel->where('nim', $nim)->get()->getRowArray();
            if ($cek > 0) {
                $msg = [
                    'sukses' => '' . $nama . ' Sudah Terdaftar !',
                    'status' => 'gagal',
                    'data' => view('mahasiswa/operator-data-view', $data3)
                ];
                echo json_encode($msg);
            } else {
                $data = [
                    'nim' => $nim,
                    'nama_mahasiswa' => $nama,
                    'email' => $email,
                    'jk' => $jk,
                    'alamat' => $alamat,
                    'id_ps' => $id_ps,
                    'status' => $status,
                    'telepon' => $telepon,
                    'id_angkatan' => $id_angkatan,
                    'id_fak' => '1',
                    'id_pa' => '1',
                ];

                $this->MahasiswaModel->insert($data);

                $data_user = [
                    'username' => $nim,
                    'nama_user' => $nama,
                    'role' => '2',
                    'jk' => $jk,
                    'status' => $status,
                    'password' => password_hash('fkunmul', PASSWORD_DEFAULT),
                ];

                $this->UserModel->insert($data_user);

                $data2 = [
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'mahasiswa' => $this->MahasiswaModel->where(['id_ps' => $id_ps, 'id_angkatan' => $id_angkatan])->orderBy('nim', 'ASC')->get()->getResultArray(),
                    'ps' => $this->ProgramStudiModel->where(['id' => $id_ps])->get()->getRowArray(),
                    'sd' => $this->StatusDosenModel->where(['nama_status' => 'Mahasiswa'])->get()->getRowArray(),
                    'ang' => $this->AngkatanModel->where(['id' => $id_angkatan])->get()->getRowArray(),
                    'sukses' => 'pesanBerhasil',
                    'item' => $nama,
                    'itemResponse' => 'Berhasil di Tambahkan !'
                ];
                $msg = [
                    'sukses' => 'Data mahasiswa Berhasil Ditambahkan !',
                    'status' => 'berhasil',
                    'data' => view('mahasiswa/operator-data-view', $data2)
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
            $id_ps = $request->getVar('id_ps');
            $id_angkatan = $request->getVar('id_angkatan');

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
                    'id_user_ps' => $status,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                ];

                $this->UserModel->insert($data_user);

                $data2 = [
                    'koneksi' => $this->KoneksiModel->koneksi(),
                    'mahasiswa' => $this->MahasiswaModel->where(['id_ps' => $id_ps, 'id_angkatan' => $id_angkatan])->orderBy('nim', 'ASC')->get()->getResultArray(),
                    'ps' => $this->ProgramStudiModel->where(['id' => $id_ps])->get()->getRowArray(),
                    'sd' => $this->StatusDosenModel->where(['nama_status' => 'Mahasiswa'])->get()->getRowArray(),
                    'ang' => $this->AngkatanModel->where(['id' => $id_angkatan])->get()->getRowArray(),
                    'sukses' => 'pesanBerhasil',
                    'item' => $nama_user,
                    'itemResponse' => 'Berhasil di Tambahkan !'
                ];
                $msg = [
                    'sukses' => 'Data mahasiswa Berhasil Ditambahkan !',
                    'status' => 'berhasil',
                    'data' => view('mahasiswa/operator-data-view', $data2)
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
            $id_ps = $request->getVar('ps');
            $nim = $request->getVar('nim');
            $id_angkatan = $request->getVar('angkatan');

            $this->MahasiswaModel->hapusUser($nim);
            $this->MahasiswaModel->hapus($id);

            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'mahasiswa' => $this->MahasiswaModel->where(['id_ps' => $id_ps, 'id_angkatan' => $id_angkatan])->orderBy('nim', 'ASC')->get()->getResultArray(),
                'ps' => $this->ProgramStudiModel->where(['id' => $id_ps])->get()->getRowArray(),
                'sd' => $this->StatusDosenModel->where(['nama_status' => 'Mahasiswa'])->get()->getRowArray(),
                'ang' => $this->AngkatanModel->where(['id' => $id_angkatan])->get()->getRowArray(),
            ];
            $msg = [
                'sukses' => 'mahasiswa berhasil dihapus !',
                'data' => view('mahasiswa/operator-data-view', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Maaf Tidak Dapat Diproses');
        }
    }

    public function prosesExcel()
    {
        $request = \Config\Services::request();
        $id_ps = $request->getVar('id_ps');
        $id_angkatan = $request->getVar('id_angkatan');

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

            $cek = $this->MahasiswaModel->cekNim($data['7']);

            error_reporting(0);

            if ($cek['nim'] == $data['7']) {
                continue;
            }

            $id_fak = $data['0'];
            $id_ps = $data['1'];
            $id_angkatan = $data['2'];
            $id_pa = $data['3'];
            $id_pb1 = $data['4'];
            $id_pb2 = $data['5'];
            $nama_mahasiswa = $data['6'];
            $nim = $data['7'];
            $alamat = $data['8'];
            $telepon = $data['9'];
            $email = $data['10'];
            $jk = $data['11'];
            $status = $data['12'];
            // insert data
            $this->MahasiswaModel->insert([
                'id_fak' => $id_fak,
                'id_ps' => $id_ps,
                'id_angkatan' => $id_angkatan,
                'id_pa' => $id_pa,
                'id_pb1' => $id_pb1,
                'id_pb2' => $id_pb2,
                'nama_mahasiswa' => $nama_mahasiswa,
                'nim' => $nim,
                'alamat' => $alamat,
                'telepon' => $telepon,
                'email' => $email,
                'jk' => $jk,
                'status' => $status,
            ]);
        }

        session()->setFlashdata('pesanBerhasil', 'Data berhasil di Import');
        return redirect()->to('/data-mahasiswa');
    }
}
