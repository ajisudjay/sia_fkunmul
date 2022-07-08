<?php

namespace App\Controllers;

use App\Models\KoneksiModel;
use App\Models\AngkatanModel;
use App\Models\MahasiswaModel;
use App\Models\StatusDosenModel;
use App\Models\ProgramStudiModel;
use App\Controllers\BaseController;

class Mahasiswa extends BaseController
{

    protected $MahasiswaModel;
    protected $KoneksiModel;
    protected $ProgramStudiModel;
    protected $StatusDosenModel;
    protected $AngkatanModel;

    public function __construct()
    {
        $this->MahasiswaModel = new MahasiswaModel();
        $this->KoneksiModel = new KoneksiModel();
        $this->ProgramStudiModel = new ProgramStudiModel();
        $this->StatusDosenModel = new StatusDosenModel();
        $this->AngkatanModel = new AngkatanModel();
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
            $status = $request->getVar('status');
            $telepon = $request->getVar('telepon');
            $id_angkatan = $request->getVar('angkatan');

            $data = [
                'nim' => $nim,
                'nama_mahasiswa' => $nama,
                'email' => $email,
                'jk' => $jk,
                'alamat' => $alamat,
                'id_ps' => $id_ps,
                'status' => $status,
                'telepon' => $telepon,
                'angkatan' => $id_angkatan,
            ];

            $this->MahasiswaModel->update($id, $data);

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
            $id = $request->getVar('id');
            $nim = $request->getVar('nim');
            $nama = $request->getVar('nama');
            $email = $request->getVar('email');
            $jk = $request->getVar('jk');
            $alamat = $request->getVar('alamat');
            $id_ps = $request->getVar('ps');
            $status = $request->getVar('status');
            $telepon = $request->getVar('telepon');
            $id_angkatan = $request->getVar('angkatan');
            $data3 = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'mahasiswa' => $this->MahasiswaModel->where(['id_ps' => $id_ps, 'id_angkatan' => $id_angkatan])->orderBy('nim', 'ASC')->get()->getResultArray(),
                'ps' => $this->ProgramStudiModel->where(['id' => $id_ps])->get()->getRowArray(),
                'sd' => $this->StatusDosenModel->where(['nama_status' => 'Mahasiswa'])->get()->getRowArray(),
                'ang' => $this->AngkatanModel->where(['id' => $id_angkatan])->get()->getRowArray(),
            ];
            $cek = $this->MahasiswaModel->where(['nim' => $nim])->get()->getRowArray();
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
                ];

                $this->MahasiswaModel->insert($data);

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

    public function hapus()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            $id = $request->getVar('id');
            $id_ps = $request->getVar('ps');
            $id_angkatan = $request->getVar('angkatan');

            $this->MahasiswaModel->delete($id);

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
}
