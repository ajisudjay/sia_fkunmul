<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar">
            <div class="pcoded-inner-navbar main-menu">
                <ul class="pcoded-item pcoded-left-item">
                    <li class="<?= $header == 'Beranda' ? 'active' : '' ?>">
                        <a href="/operator">
                            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                            <span class="pcoded-mtext">Beranda</span>
                        </a>
                    </li>
                </ul>
                <div class="pcoded-navigatio-lavel">Perkuliahan</div>
                <ul class="pcoded-item pcoded-left-item">
                    <!-- <li class="<?= $topHeader == 'Jadwal' ? 'pcoded-trigger' : '' ?> pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="feather icon-calendar"></i></span>
                            <span class="pcoded-mtext">Jadwal</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="<?= $header == 'Jadwal Kuliah' ? 'active' : '' ?>">
                                <a href="">
                                    <span class="pcoded-mtext">Jadwal Kuliah</span>
                                </a>
                            </li>
                            <li class="<?= $header == 'Jadwal Uas' ? 'active' : '' ?>">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-mtext">Jadwal Uas</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="<?= $topHeader == 'Monitoring' ? 'pcoded-trigger' : '' ?> pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="feather icon-book"></i></span>
                            <span class="pcoded-mtext">Monitoring</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="<?= $header == 'Rekap Monitoring' ? 'active' : '' ?>">
                                <a href="<?= base_url('rekap-monitoring'); ?>">
                                    <span class="pcoded-mtext">Rekap Monitoring</span>
                                </a>
                            </li>
                            <li class="<?= $header == 'Evaluasi Monitoring' ? 'active' : '' ?>">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-mtext">Evaluasi Monitoring</span>
                                </a>
                            </li>
                        </ul>
                    </li> -->
                    <li class="<?= $topHeader == 'Perkuliahan' ? 'active' : '' ?>">
                        <a href="<?= base_url('bimbingan-akademik'); ?>">
                            <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                            <span class="pcoded-mtext">Bimbingan Akademik</span>
                        </a>
                    </li>
                    <li class="<?= $topHeader == 'IPE' ? 'active' : '' ?>">
                        <a href="<?= base_url('bimbingan-ipe'); ?>">
                            <span class="pcoded-micon"><i class="feather icon-user"></i></span>
                            <span class="pcoded-mtext">Bimbingan IPE</span>
                        </a>
                    </li>
                </ul>
                <div class="pcoded-navigatio-lavel">Database</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="<?= $topHeader == 'Database' ? 'pcoded-trigger' : '' ?> pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="feather icon-box"></i></span>
                            <span class="pcoded-mtext">Data</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <!-- <li class="<?= $header == 'Fakultas' ? 'active' : '' ?>">
                                <a href="<?= base_url('fakultas'); ?>">
                                    <span class="pcoded-mtext">Fakultas</span>
                                </a>
                            </li> -->
                            <li class="<?= $header == 'Kurikulum' ? 'active' : '' ?>">
                                <a href="<?= base_url('kurikulum'); ?>">
                                    <span class="pcoded-mtext">Kurikulum</span>
                                </a>
                            </li>
                            <li class="<?= $header == 'Kelas' ? 'active' : '' ?>">
                                <a href="<?= base_url('kelas'); ?>">
                                    <span class="pcoded-mtext">Kelas</span>
                                </a>
                            </li>
                            <li class="<?= $header == 'Mata Kuliah' ? 'active' : '' ?>">
                                <a href="<?= base_url('mataKuliah'); ?>">
                                    <span class="pcoded-mtext">Mata Kuliah</span>
                                </a>
                            </li>
                            <li class="<?= $header == 'Program Studi' ? 'active' : '' ?>">
                                <a href="<?= base_url('programStudi'); ?>">
                                    <span class="pcoded-mtext">Program Studi</span>
                                </a>
                            </li>
                            <li class="<?= $header == 'Tahun Ajaran' ? 'active' : '' ?>">
                                <a href="<?= base_url('tahunAjaran'); ?>">
                                    <span class="pcoded-mtext">Tahun Ajaran</span>
                                </a>
                            </li>
                            <li class="<?= $header == 'Angkatan' ? 'active' : '' ?>">
                                <a href="<?= base_url('angkatan'); ?>">
                                    <span class="pcoded-mtext">Angkatan</span>
                                </a>
                            </li>
                            <li class="<?= $header == 'Kegiatan' ? 'active' : '' ?>">
                                <a href="<?= base_url('kegiatan'); ?>">
                                    <span class="pcoded-mtext">Kegiatan</span>
                                </a>
                            </li>
                            <li class="<?= $header == 'Detail Aktifitas' ? 'active' : '' ?>">
                                <a href="<?= base_url('desk'); ?>">
                                    <span class="pcoded-mtext">Detail Aktifitas</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="pcoded-navigatio-lavel">User</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="<?= $topHeader == 'Manajemen User' ? 'pcoded-trigger' : '' ?> pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="feather icon-box"></i></span>
                            <span class="pcoded-mtext">Manajemen User</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="<?= $header == 'Dosen' ? 'active' : '' ?>">
                                <a href="<?= base_url('data-dosen'); ?>">
                                    <span class="pcoded-mtext">Dosen</span>
                                </a>
                            </li>
                            <li class="<?= $header == 'Mahasiswa' ? 'active' : '' ?>">
                                <a href="<?= base_url('data-mahasiswa'); ?>">
                                    <span class="pcoded-mtext">Mahasiswa</span>
                                </a>
                            </li>
                            <li class="<?= $header == 'User' ? 'active' : '' ?>">
                                <a href="<?= base_url('user'); ?>">
                                    <span class="pcoded-mtext">User</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>