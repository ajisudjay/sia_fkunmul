<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $UserModel;

    public function __construct()
    {
        $this->UserModel = new UserModel();
        $this->validation = \Config\Services::validation();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();

        $username = $request->getVar('username');
        $password = $request->getVar('password');

        if (!$this->validate([
            'username' => 'required',
            'password' => 'required',
        ])) {
            return redirect()->to('/')->withInput()->with('validation', $validation);
        }

        $user = $this->UserModel->where('username', $username)->first();

        if ($user > 0) {
            $db_pass = $user['password'];
            $role = $user['role'];

            $cek = $this->UserModel->where(['username' => $username, 'password' => $db_pass])->first();

            if ($cek['username'] === $username && password_verify($password, $cek['password'])) {
                if ($role == '1') {
                    session()->set('username', $user['username']);
                    session()->set('password', $user['password']);
                    return redirect()->to('/auth/operator');
                } else if ($role == '2') {
                    session()->set('username', $user['username']);
                    session()->set('password', $user['password']);
                    return redirect()->to('/auth/mahasiswa');
                } else if ($role == '3') {
                    session()->set('username', $user['username']);
                    session()->set('password', $user['password']);
                    return redirect()->to('/auth/dosen');
                } else if ($role == '4') {
                    session()->set('username', $user['username']);
                    session()->set('password', $user['password']);
                    return redirect()->to('/auth/umum');
                }
            } else {
                session()->setFlashdata('pesanGagal', 'Username dan Password Salah');
                return redirect()->to('/');
            }
        } else {
            session()->setFlashdata('pesanGagal', 'Username dan Password Salah');
            return redirect()->to('/');
        }
    }

    public function operator()
    {
        $password = session()->get('password');
        $username = session()->get('username');

        $cek = $this->UserModel->where(['username' => $username, 'password' => $password])->first();

        session()->set('username', $cek['username']);
        session()->set('password', $cek['password']);
        session()->set('role', $cek['role']);
        session()->set('jk', $cek['jk']);
        session()->set('nama_user', $cek['nama_user']);
        session()->setFlashdata('loginBerhasil', 'Login Berhasil');
        return redirect()->to('/home/operator');
    }

    public function dosen()
    {
        $password = session()->get('password');
        $username = session()->get('username');

        $cek = $this->UserModel->where(['username' => $username, 'password' => $password])->first();

        session()->set('username', $cek['username']);
        session()->set('password', $cek['password']);
        session()->set('role', $cek['role']);
        session()->set('jk', $cek['jk']);
        session()->set('nama_user', $cek['nama_user']);
        session()->setFlashdata('loginBerhasil', 'Login Berhasil');
        return redirect()->to('/home/dosen');
    }

    public function mahasiswa()
    {
        $password = session()->get('password');
        $username = session()->get('username');

        $cek = $this->UserModel->where(['username' => $username, 'password' => $password])->first();

        session()->set('username', $cek['username']);
        session()->set('password', $cek['password']);
        session()->set('role', $cek['role']);
        session()->set('jk', $cek['jk']);
        session()->set('nama_user', $cek['nama_user']);
        session()->setFlashdata('loginBerhasil', 'Login Berhasil');
        return redirect()->to('/mahasiswa');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        session()->setFlashdata('pesanLogout', 'Berhasil Keluar !');
        return redirect()->to('/');
    }
}
