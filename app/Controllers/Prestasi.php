<?php

namespace App\Controllers;

use App\Models\KoneksiModel;
use App\Models\PrestasiModel;
use App\Models\MahasiswaModel;
use App\Controllers\BaseController;
use PHPUnit\Framework\Constraint\IsEmpty;

use function PHPUnit\Framework\isEmpty;

class Prestasi extends BaseController
{

    protected $KoneksiModel;
    protected $PrestasiModel;
    protected $MahasiswaModel;
    public function __construct()
    {
        $this->KoneksiModel = new KoneksiModel();
        $this->PrestasiModel = new PrestasiModel();
        $this->MahasiswaModel = new MahasiswaModel();
    }
    public function index()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $data = [
            'title' => 'E-Portfolio - Fakultas Kedokteran Universitas Mulawarman',
            'topHeader' => 'E-Portfolio',
            'header' => 'Prestasi',
            'validation' => \Config\Services::validation(),
            'koneksi' => $this->KoneksiModel->koneksi(),
        ];
        return view('prestasi/index', $data);
    }

    public function viewData()
    {
        $nimx = session()->get('username');
        $ceknim = $this->MahasiswaModel->where('nim', $nimx)->first();
        $nim = $ceknim['id_mahasiswa'];
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();

        if ($request->isAJAX()) {
            $data = [
                'koneksi' => $this->KoneksiModel->koneksi(),
                'prestasi' => $this->PrestasiModel->where('id_prestasi_mahasiswa', $nim)->orderBy('tanggal', 'DESC')->get()->getResultArray(),

            ];
            $msg = [
                'data' => view('prestasi/view-data', $data)
            ];
            echo json_encode($msg);
        } else {
            exit('Data Tidak Dapat diproses');
        }
    }

    public function tambah()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $username = session()->get('username');
        $ceknim = $this->MahasiswaModel->where('nim', $username)->first();
        $nim = $ceknim['id_mahasiswa'];

        $request = \Config\Services::request();
        $validation = \Config\Services::validation();

        $judul = $request->getVar('judul');
        $jenis = $request->getVar('jenis');
        $tanggal = $request->getVar('tanggal');
        $tingkat = $request->getVar('tingkat');
        $file = $request->getFile('file');

        $valid = $this->validate([
            'file' => 'uploaded[file]|max_size[file,1024]|ext_in[file,pdf]',
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                ]
            ],
            'tanggal' => [
                'label' => 'Tanggal',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong',
                ]
            ],
        ]);
        if (!$valid) {
            session()->setFlashdata('error', $this->validator->listErrors());
            session()->setFlashdata('gagal', 'Gagal Input');
            return redirect()->to('/prestasi-mahasiswa')->withInput();;
        } else {
            $newName = $file->getRandomName();
            $file->move('../public/file/prestasi/', $newName);
            $nama_foto = $newName;

            $data = [
                'judul' => $judul,
                'id_prestasi_mahasiswa' => $nim,
                'jenis' => $jenis,
                'tanggal' => $tanggal,
                'file_bukti' => $nama_foto,
                'tingkat' => $tingkat,
            ];

            $this->PrestasiModel->insert($data);
            session()->setFlashdata('berhasil', 'Berhasil Input');
            return redirect()->to('/prestasi-mahasiswa');
        }
    }

    public function edit()
    {

        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $request = \Config\Services::request();
        $id = $request->getVar('id');
        $filelama = $this->PrestasiModel->where('id', $id)->first();
        $hapusfilelama = $filelama['file_bukti'];
        $judul = $request->getVar('judul');
        $jenis = $request->getVar('jenis');
        $tingkat = $request->getVar('tingkat');
        $tanggal = $request->getVar('tanggal');
        $file = $request->getFile('file');
        $validation = \Config\Services::validation();
        if (!file_exists($_FILES['file']['tmp_name'])) {
            $valid = $this->validate([
                'judul' => [
                    'label' => 'Judul',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'jenis' => [
                    'label' => 'Jenis',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'tingkat' => [
                    'label' => 'Tingkat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'tanggal' => [
                    'label' => 'Tanggal',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'judul' => $validation->getError('judul'),
                        'jenis' => $validation->getError('jenis'),
                        'tingkat' => $validation->getError('tingkat'),
                        'tanggal' => $validation->getError('tanggal'),
                    ],
                ];
                echo json_encode($msg);
            } else {
                $data = [
                    'judul' => $judul,
                    'jenis' => $jenis,
                    'tingkat' => $tingkat,
                    'tanggal' => $tanggal,
                ];

                $this->PrestasiModel->update($id, $data);
                session()->setFlashdata('berhasil', 'Berhasil Ubah');
                return redirect()->to('/prestasi-mahasiswa');
            }
        } else {
            $valid = $this->validate([
                'judul' => [
                    'label' => 'Judul',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'jenis' => [
                    'label' => 'Jenis',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'tingkat' => [
                    'label' => 'Tingkat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
                'tanggal' => [
                    'label' => 'Tanggal',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Tidak Boleh Kosong',
                    ]
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'judul' => $validation->getError('judul'),
                        'jenis' => $validation->getError('jenis'),
                        'tingkat' => $validation->getError('tingkat'),
                        'tanggal' => $validation->getError('tanggal'),
                    ],
                ];
                echo json_encode($msg);
            } else {
                $newName = $file->getRandomName();
                $file->move('../public/file/prestasi/', $newName);
                $nama_foto = $newName;
                unlink('../public/file/prestasi/' . $hapusfilelama);
                $data = [
                    'judul' => $judul,
                    'jenis' => $jenis,
                    'tingkat' => $tingkat,
                    'tanggal' => $tanggal,
                    'file_bukti' => $nama_foto,
                ];

                $this->PrestasiModel->update($id, $data);
                session()->setFlashdata('berhasil', 'Berhasil Ubah');
                return redirect()->to('/prestasi-mahasiswa');
            }
        }
    }

    public function hapus($id)
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }
        $cekfile = $this->PrestasiModel->where('id', $id)->first();
        $namafile = $cekfile['file_bukti'];
        unlink('../public/file/prestasi/' . $namafile);
        $this->PrestasiModel->delete($id);
        session()->setFlashdata('pesanHapus', 'Prestasi Berhasil Di Hapus !');
        return redirect()->to('/prestasi-mahasiswa');
    }
}
