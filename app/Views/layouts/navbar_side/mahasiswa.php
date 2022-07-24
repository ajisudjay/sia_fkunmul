<div class="pcoded-main-container">
    <div class="pcoded-wrapper">
        <nav class="pcoded-navbar">
            <div class="pcoded-inner-navbar main-menu">
                <ul class="pcoded-item pcoded-left-item">
                    <li class="<?= $header == 'Beranda' ? 'active' : '' ?>">
                        <a href="/mahasiswa">
                            <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                            <span class="pcoded-mtext">Beranda</span>
                        </a>
                    </li>
                </ul>
                <div class="pcoded-navigatio-lavel">Portofolio</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="<?= $topHeader == 'Aktifitas' ? 'pcoded-trigger' : '' ?> pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="feather icon-calendar"></i></span>
                            <span class="pcoded-mtext">Data</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="<?= $header == 'Aktifitas' ? 'active' : '' ?>">
                                <a href="<?= base_url('/aktivitas-mahasiswa'); ?>">
                                    <span class="pcoded-mtext">Aktivitas</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="pcoded-submenu">
                            <li class="<?= $header == 'Pretasi' ? 'active' : '' ?>">
                                <a href="<?= base_url('/prestasi-mahasiswa'); ?>">
                                    <span class="pcoded-mtext">Prestasi</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="pcoded-navigatio-lavel">Profil</div>
                <ul class="pcoded-item pcoded-left-item">
                    <li class="<?= $topHeader == 'Edit Profil' ? 'pcoded-trigger' : '' ?> pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="feather icon-calendar"></i></span>
                            <span class="pcoded-mtext">Profil</span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li class="<?= $header == 'Edit Profil' ? 'active' : '' ?>">
                                <a href="<?= base_url('/profil-mahasiswa'); ?>">
                                    <span class="pcoded-mtext">Edit Profil</span>
                                </a>
                            </li>
                        </ul>
                        <ul class="pcoded-submenu">
                            <?php $nim = base64_encode(session()->get('username')) ?>
                            <li class="<?= $header == 'Data Diri' ? 'active' : '' ?>">
                                <a href="<?= base_url('/data-diri-mahasiswa/' . $nim . ''); ?>">
                                    <span class="pcoded-mtext">Data Diri</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- <div class="pcoded-navigatio-lavel">Perkuliahan</div>
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
                </ul> -->
            </div>
        </nav>