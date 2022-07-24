<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::login');
$routes->get('/register', 'Home::register');
$routes->get('/prosesRegister', 'Auth::prosesRegister');
$routes->get('/captcha', 'Auth::captcha');


$routes->get('/programStudi', 'ProgramStudi::index');
$routes->get('/tahunAjaran', 'TahunAjaran::index');
$routes->get('/kelas', 'Kelas::index');
$routes->get('/fakultas', 'Fakultas::index');
$routes->get('/user', 'User::index');
$routes->get('/mataKuliah', 'MataKuliah::index');
$routes->get('/data-dosen', 'Dosen::index');
$routes->get('/data-mahasiswa', 'Mahasiswa::index');
$routes->get('/bimbingan-akademik', 'Bimbingan::index');

$routes->get('/mahasiswa', 'Home::mahasiswa');
$routes->get('/dosen', 'Home::dosen');
$routes->get('/operator', 'Home::operator');

$routes->get('/rekap-monitoring', 'Monitoring::rekapOperator');
$routes->get('/profil-mahasiswa', 'Profil::editMahasiswa');
$routes->get('/profil-dosen', 'Profil::editDosen');
$routes->get('/profil-operator', 'Profil::editOperator');

$routes->get('/aktivitas-mahasiswa', 'Aktifitas::mahasiswa');
$routes->get('/prestasi-mahasiswa', 'Prestasi::index');
$routes->get('/aktivitas-dosen', 'Aktifitas::dosen');
$routes->get('/detail-aktifitas-mahasiswa/(:any)', 'Aktifitas::detailMahasiswa/$1');
$routes->get('/detail-aktifitas-dosen/(:any)', 'Aktifitas::detailDosen/$1');
$routes->get('/detail-bimbingan-dosen/(:any)', 'Aktifitas::viewBimbinganDosen/$1');
$routes->get('/data-diri-mahasiswa/(:any)', 'Profil::viewDataDiriMahasiswa/$1');

$routes->get('/detail-notif-dosen/(:any)', 'Aktifitas::detailNotifDosen/$1');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
