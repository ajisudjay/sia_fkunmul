<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\KoneksiModel;
use App\Models\StatusDosenModel;
use App\Models\ProgramStudiModel;
use App\Controllers\BaseController;

class Dosen extends BaseController
{
    protected $DosenModel;
    protected $KoneksiModel;
    protected $ProgramStudiModel;
    protected $StatusDosenModel;

    public function __construct()
    {
        $this->DosenModel = new DosenModel();
        $this->KoneksiModel = new KoneksiModel();
        $this->ProgramStudiModel = new ProgramStudiModel();
        $this->StatusDosenModel = new StatusDosenModel();
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
            'dosen' => $this->DosenModel->orderBy('nama_dosen', 'ASC')->get()->getResultArray(),
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
                'dosen' => $this->DosenModel->orderBy('nama_dosen', 'ASC')->get()->getResultArray(),
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
                'dosen' => $this->DosenModel->orderBy('nama_dosen', 'ASC')->get()->getResultArray(),
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
                    'status' => $status,
                    'telepon' => $telepon,
                    'id_fak' => '1',
                ];

                $this->DosenModel->insert($data);

                $data3 = [
                    'title' => 'Dosen - Fakultas Kedokteran Universitas Mulawarman',
                    'topHeader' => 'Manajemen User',
                    'header' => 'Dosen',
                    'validation' => \Config\Services::validation(),
                    'dosen' => $this->DosenModel->orderBy('nama_dosen', 'ASC')->get()->getResultArray(),
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

            $data2 = [
                'title' => 'Dosen - Fakultas Kedokteran Universitas Mulawarman',
                'topHeader' => 'Manajemen User',
                'header' => 'Dosen',
                'validation' => \Config\Services::validation(),
                'dosen' => $this->DosenModel->orderBy('nama_dosen', 'ASC')->get()->getResultArray(),
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
            $nama = $request->getVar('nama');

            $this->DosenModel->delete($id);

            $data2 = [
                'title' => 'Dosen - Fakultas Kedokteran Universitas Mulawarman',
                'topHeader' => 'Manajemen User',
                'header' => 'Dosen',
                'validation' => \Config\Services::validation(),
                'dosen' => $this->DosenModel->orderBy('nama_dosen', 'ASC')->get()->getResultArray(),
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
}
