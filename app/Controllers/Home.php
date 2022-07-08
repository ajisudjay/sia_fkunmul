<?php

namespace App\Controllers;

class Home extends BaseController
{

    public function __construct()
    {
        helper('form', 'time');
    }

    public function login()
    {
        $data = [
            'title' => 'Login - Fakultas Kedokteran Universitas Mulawarman',
            'validation' => \Config\Services::validation()
        ];
        return view('auth/login', $data);
    }

    public function operator()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '1') {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
            'topHeader' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
            'header' => 'Beranda',
        ];

        return view('halaman_awal/operator', $data);
    }

    public function dosen()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '3') {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
            'header' => 'Beranda',
        ];

        return view('halaman_awal/dosen', $data);
    }

    public function mahasiswa()
    {
        if (session()->get('username') == NULL || session()->get('role') !== '2') {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
            'topHeader' => 'Beranda | Siakad - Fakultas Kedokteran UNMUL',
            'header' => 'Beranda',
        ];

        return view('halaman_awal/mahasiswa', $data);
    }
}
