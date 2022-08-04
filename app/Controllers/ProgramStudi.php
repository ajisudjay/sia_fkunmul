<?php

namespace App\Controllers;

use App\Models\KoneksiModel;
use App\Models\ProgramStudiModel;
use App\Controllers\BaseController;


class ProgramStudi extends BaseController
{
    protected $ProgramStudiModel;
    protected $KoneksiModel;

    public function __construct()
    {
        $this->ProgramStudiModel = new ProgramStudiModel();
        $this->KoneksiModel = new KoneksiModel();
    }

    public function index()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $data = [
            'title' => 'Program Studi - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Database',
            'header' => 'Program Studi',
            'validation' => \Config\Services::validation(),
            'programStudi' => $this->ProgramStudiModel->orderBy('program_studi', 'ASC')->get()->getResultArray(),
            'koneksi' => $this->KoneksiModel->koneksi(),
        ];
        return view('programStudi/operator-view', $data);
    }

    public function edit()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();

        $ps = $request->getVar('ps');
        $id = $request->getVar('id');

        $data = [
            'program_studi' => $ps,
        ];

        $this->ProgramStudiModel->update($id, $data);

        session()->setFlashdata('pesanEdit', 'Program Studi Berhasil Di Edit !');
        return redirect()->to('/programStudi');
    }

    public function tambah()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();

        $ps = $request->getVar('ps');

        $data = [
            'program_studi' => $ps,
        ];

        $this->ProgramStudiModel->insert($data);

        session()->setFlashdata('pesanInput', 'Program Studi Berhasil Di Tambah !');
        return redirect()->to('/programStudi');
    }

    public function hapus($id)
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
        $this->ProgramStudiModel->delete($id);

        session()->setFlashdata('pesanHapus', 'Program Studi Berhasil Di Hapus !');
        return redirect()->to('/programStudi');
    }
}
