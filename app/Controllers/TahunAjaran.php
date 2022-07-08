<?php

namespace App\Controllers;

use App\Models\KoneksiModel;
use App\Models\TahunAjaranModel;
use App\Controllers\BaseController;

class TahunAjaran extends BaseController
{

    protected $TahunAjaranModel;
    protected $KoneksiModel;

    public function __construct()
    {
        $this->TahunAjaranModel = new TahunAjaranModel();
        $this->KoneksiModel = new KoneksiModel();
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Tahun Ajaran - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'Master Data',
            'header' => 'Tahun Ajaran',
            'validation' => \Config\Services::validation(),
            'tahunAjaran' => $this->TahunAjaranModel->orderBy('id', 'DESC')->get()->getResultArray(),
            'koneksi' => $this->KoneksiModel->koneksi(),
        ];
        return view('tahunAjaran/operator-view', $data);
    }

    public function edit()
    {
        $request = \Config\Services::request();

        $ta = $request->getVar('ta');
        $id = $request->getVar('id');

        $data = [
            'tahun_ajaran' => $ta,
        ];

        $this->TahunAjaranModel->update($id, $data);

        session()->setFlashdata('pesanEdit', 'Tahun Ajaran Berhasil Di Edit !');
        return redirect()->to('/tahunAjaran');
    }

    public function tambah()
    {
        $request = \Config\Services::request();

        $ta = $request->getVar('ta');

        $data = [
            'tahun_ajaran' => $ta,
        ];

        $this->TahunAjaranModel->insert($data);

        session()->setFlashdata('pesanInput', 'Tahun Ajaran Berhasil Di Tambah !');
        return redirect()->to('/tahunAjaran');
    }

    public function hapus($id)
    {
        $this->TahunAjaranModel->delete($id);
        session()->setFlashdata('pesanHapus', 'Tahun Ajaran Berhasil Di Hapus !');
        return redirect()->to('/tahunAjaran');
    }
}
