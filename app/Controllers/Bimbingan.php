<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AngkatanModel;
use App\Models\BimbinganModel;
use App\Models\DosenModel;
use App\Models\ProgramStudiModel;

class Bimbingan extends BaseController
{

    protected $AngkatanModel;
    protected $ProgramStudiModel;
    protected $BimbinganModel;
    protected $DosenModel;

    public function __construct()
    {
        $this->AngkatanModel = new AngkatanModel();
        $this->ProgramStudiModel = new ProgramStudiModel();
        $this->BimbinganModel = new BimbinganModel();
        $this->DosenModel = new DosenModel();
    }

    public function index()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $data = [
            'title' => 'Bimbingan Akademik - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Perkuliahan',
            'header' => 'Bimbingan Akademik',
            'angkatan' => $this->AngkatanModel->orderBy('angkatan', 'DESC')->get()->getResultArray(),
            'programStudi' => $this->ProgramStudiModel->get()->getResultArray(),
        ];
        return view('bimbingan/operator-view', $data);
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
                'bimbingan' => $this->BimbinganModel->viewData($id_ps, $id_angkatan),
                'dataDosen' => $this->BimbinganModel->viewDataJoinDosen($id_ps, $id_angkatan),
                'id_ps' => $id_ps
            ];
            $msg = [
                'data' => view('bimbingan/operator-data-view', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function modalEdit()
    {

        $request = \Config\Services::request();
        $id = $request->getPost('id');
        $id_ps = $request->getPost('id_ps');

        if ($request->isAJAX()) {
            $data = [
                'mahasiswa' => $this->BimbinganModel->viewDataDetail($id),
                'dosen' => $this->DosenModel->orderBy('nama_dosen', 'ASC')->findAll(),
                'id_ps' => $id_ps,
            ];
            $msg = [
                'data' => view('bimbingan/modal/edit-bimbingan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function prosesEdit()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $id = $request->getVar('id');
            $id_pa = $request->getVar('id_pa');
            $id_ps = $request->getVar('id_ps');
            $id_angkatan = $request->getVar('id_angkatan');

            $data = [
                'id_pa' => $id_pa,
            ];

            $this->BimbinganModel->edit($data, $id);

            $data = [
                'bimbingan' => $this->BimbinganModel->viewData($id_ps, $id_angkatan),
            ];
            $msg = [
                'data' => view('bimbingan/operator-data-view', $data),
                'sukses' => 'Data berhasil Diubah !'
            ];

            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    // IPE //

    public function ipe()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $data = [
            'title' => 'Bimbingan Akademik - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'IPE',
            'header' => 'Bimbingan Akademik',
            'angkatan' => $this->AngkatanModel->orderBy('angkatan', 'DESC')->get()->getResultArray(),
            'programStudi' => $this->ProgramStudiModel->get()->getResultArray(),
        ];
        return view('bimbingan/ipe-operator-view', $data);
    }

    public function ipeViewDataOperator()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $id_ps = $request->getVar('programStudi');
        $id_angkatan = $request->getVar('angkatan');
        if ($request->isAJAX()) {
            $data = [
                'bimbingan' => $this->BimbinganModel->ipeViewData($id_ps, $id_angkatan),
                'dataDosen' => $this->BimbinganModel->ipeViewDataJoinDosen($id_ps, $id_angkatan),
                'id_ps' => $id_ps
            ];
            $msg = [
                'data' => view('bimbingan/ipe-operator-data-view', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function ipeModalEdit()
    {

        $request = \Config\Services::request();
        $id = $request->getPost('id');
        $id_ps = $request->getPost('id_ps');

        if ($request->isAJAX()) {
            $data = [
                'mahasiswa' => $this->BimbinganModel->viewDataDetail($id),
                'dosen' => $this->DosenModel->orderBy('nama_dosen', 'ASC')->findAll(),
                'id_ps' => $id_ps,
            ];
            $msg = [
                'data' => view('bimbingan/modal/edit-bimbingan', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function ipeProsesEdit()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        if ($request->isAJAX()) {
            $id = $request->getVar('id');
            $id_pa = $request->getVar('id_pa');
            $id_ps = $request->getVar('id_ps');
            $id_angkatan = $request->getVar('id_angkatan');

            $data = [
                'id_pa' => $id_pa,
            ];

            $this->BimbinganModel->edit($data, $id);

            $data = [
                'bimbingan' => $this->BimbinganModel->viewData($id_ps, $id_angkatan),
            ];
            $msg = [
                'data' => view('bimbingan/operator-data-view', $data),
                'sukses' => 'Data berhasil Diubah !'
            ];

            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    // DOSEN

    public function BimbinganDosen()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '3') {
            return redirect()->to('/');
        }
        $data = [
            'title' => 'Bimbingan Akademik - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Perkuliahan',
            'header' => 'Bimbingan Akademik',
            'angkatan' => $this->AngkatanModel->orderBy('angkatan', 'DESC')->get()->getResultArray(),
            'programStudi' => $this->ProgramStudiModel->get()->getResultArray(),
        ];
        return view('bimbingan/dosen-view', $data);
    }

    public function viewDataDosen()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '3') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $username = session()->get('username');
        $cekid_dosen = $this->DosenModel->where('nip', $username)->first();
        $id_dosen = $cekid_dosen['id'];
        $id_ps = $request->getVar('programStudi');
        $id_angkatan = $request->getVar('angkatan');
        if ($request->isAJAX()) {
            $data = [
                'bimbingan' => $this->BimbinganModel->viewData($id_ps, $id_angkatan),
                'dataDosen' => $this->BimbinganModel->viewDataBimbinganDosen($id_ps, $id_angkatan, $id_dosen),
                'id_ps' => $id_ps
            ];
            $msg = [
                'data' => view('bimbingan/dosen-data-view', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }
}
