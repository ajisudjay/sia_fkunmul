<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar">
            <div class="pcoded-inner-navbar main-menu">
                <ul class="pcoded-item pcoded-left-item">
                    <li class="<?= $header == 'Beranda' ? 'active' : '' ?>">
                        <a href="/home/operator">
                            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                            <span class="pcoded-mtext">Beranda</span>
                        </a>
                    </li>
                </ul>
                <div class="pcoded-navigatio-lavel">Perkuliahan</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="<?= $topHeader == 'Jadwal' ? 'pcoded-trigger' : '' ?> pcoded-hasmenu">
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
                            <span class="pcoded-micon"><i class="feather icon-calendar"></i></span>
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
                    </li>
                </ul>
                <div class="pcoded-navigatio-lavel">Data</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="<?= $topHeader == 'Master Data' ? 'pcoded-trigger' : '' ?> pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="feather icon-box"></i></span>
                            <span class="pcoded-mtext">Master Data</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="<?= $header == 'Fakultas' ? 'active' : '' ?>">
                                <a href="<?= base_url('fakultas'); ?>">
                                    <span class="pcoded-mtext">Fakultas</span>
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
                                <a href="<?= base_url('dosen'); ?>">
                                    <span class="pcoded-mtext">Dosen</span>
                                </a>
                            </li>
                            <li class="<?= $header == 'Mahasiswa' ? 'active' : '' ?>">
                                <a href="<?= base_url('mahasiswa'); ?>">
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