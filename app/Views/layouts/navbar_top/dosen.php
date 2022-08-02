<?php
$model_foto = new \App\Models\UserModel();

$this->KoneksiModel = new \App\Models\KoneksiModel();
$this->DosenModel = new \App\Models\DosenModel();
$koneksi = $this->KoneksiModel->koneksi();

$id_user = session()->get('id_user');

$username = session()->get('username');
$sqlIdUser = $this->DosenModel->where('nip', $username)->first();
$id_dosen = $sqlIdUser['id'];

$foto = $model_foto->where('username', session()->get('username'))->first(); ?>

<body>
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu"></i>
                        </a>
                        <a href="<?= base_url(''); ?>/dosen">
                            <img class="img-fluid d-inline" src="<?= base_url(''); ?>\assets\images\logosiakad.png" width="170px" alt="Theme-Logo">
                        </a>
                        <a class="mobile-options">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left"></ul>
                        <ul class="nav-right">

                            <!-- NOTIF AKTIFITAS BARU -->
                            <?php $sql_jumlah = mysqli_query($koneksi, "SELECT * FROM aktifitas JOIN mahasiswas ON aktifitas.id_mahasiswa_aktifitas=mahasiswas.id_mahasiswa JOIN dosens ON mahasiswas.id_pa=dosens.id WHERE aktifitas.status_aktifitas='new' AND mahasiswas.id_pa='$id_dosen'"); ?>
                            <?php $jumlahAktifitas = mysqli_num_rows($sql_jumlah);
                            if ($jumlahAktifitas > 0) {
                                $view_li_akt = '';
                            } else {
                                $view_li_akt = 'hidden';
                            } ?>
                            <li class="header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle aktifitas_dosen_awal" data-toggle="dropdown">
                                        <i class="icofont icofont-paper"></i>
                                        <?php if ($jumlahAktifitas > 0) { ?>
                                            <span class="badge bg-c-pink"><?= $jumlahAktifitas ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="dropdown-toggle aktifitas_dosen_status d-none" data-toggle="dropdown">
                                        <i class="icofont icofont-paper"></i>
                                        <span class="badge bg-c-pink aktifitas_dosen"></span>
                                    </div>
                                    <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <h6>Aktifitas Mahasiswa</h6>
                                            <label class="label label-danger">Baru</label>
                                        </li>
                                        <li>
                                            <div class="isi_pesan_aktifitas"></div>
                                            <div class="view_isi_pesan_aktifitas">
                                                <?php $sql_aktifitas = mysqli_query($koneksi, "SELECT *, aktifitas.id as id_aktifitas, users.id as id_user FROM aktifitas JOIN mahasiswas ON aktifitas.id_mahasiswa_aktifitas=mahasiswas.id_mahasiswa JOIN users ON mahasiswas.nim=users.username WHERE status_aktifitas='new' AND mahasiswas.id_pa=$id_dosen GROUP BY judul ORDER BY id_aktifitas DESC LIMIT 5"); ?>
                                                <?php while ($dataAktifitas = mysqli_fetch_array($sql_aktifitas)) {
                                                    $nim = base64_encode($dataAktifitas['nim']);
                                                    $id_ta = base64_encode('@49innqwj//;-' . $dataAktifitas['id_tahun_ajaran'] . '') ?>
                                                    <div class="media mb-3">
                                                        <img class="d-flex align-self-center img-radius" src="<?= base_url(''); ?>\assets\images\user-profile\<?= $dataAktifitas['foto'] ?>" alt="Generic placeholder image">
                                                        <a href="<?= base_url('detail-aktifitas-dosen/' . $nim . '/' . $id_ta . ''); ?>">
                                                            <div class="media-body" style="min-width: 100%;">
                                                                <h5 class="notification-user"><?= $dataAktifitas['nama_mahasiswa'] ?></h5>
                                                                <p class="notification-msg mb-1" style="margin-bottom: -5px;"><?= word_limiter($dataAktifitas['judul'], 10) ?></p>
                                                                <span class="notification-time"><?= date('d-m-Y', strtotime($dataAktifitas['tanggal'])) ?></span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>


                            <!-- NOTIF FEEDBACK BARU -->
                            <?php $sql_feedback = mysqli_query($koneksi, "SELECT * FROM aktifitas JOIN mahasiswas ON aktifitas.id_mahasiswa_aktifitas=mahasiswas.id_mahasiswa JOIN feedbackaktifitas ON aktifitas.id=feedbackaktifitas.id_aktifitas WHERE feedbackaktifitas.status='new' AND penerima='$id_user'"); ?>
                            <?php $jumlahFeedback = mysqli_num_rows($sql_feedback);
                            if ($jumlahFeedback > 0) {
                                $view_li_fb = '';
                            } else {
                                $view_li_fb = 'hidden';
                            } ?>
                            <li class="header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle feedback_aktifitas_dosen_awal" data-toggle="dropdown">
                                        <i class="fa fa-comment-o"></i>
                                        <?php if ($jumlahFeedback > 0) { ?>
                                            <span class="badge bg-c-green d-none"><?= $jumlahFeedback ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="dropdown-toggle feedback_aktifitas_dosen_status d-none" data-toggle="dropdown">
                                        <i class="fa fa-comment-o"></i>
                                        <span class="badge bg-c-green feedback_aktifitas_dosen"></span>
                                    </div>
                                    <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <h6>Feedback Aktifitas</h6>
                                            <label class="label label-danger">Baru</label>
                                        </li>
                                        <li>
                                            <div class="isi_pesan_feedback"></div>
                                            <div class="view_isi_pesan_feedback">
                                                <?php $sql_feedbacks = mysqli_query($koneksi, "SELECT *, aktifitas.id as id_akt FROM aktifitas JOIN mahasiswas ON aktifitas.id_mahasiswa_aktifitas=mahasiswas.id_mahasiswa JOIN feedbackaktifitas ON aktifitas.id=feedbackaktifitas.id_aktifitas JOIN users ON mahasiswas.nim=users.username WHERE feedbackaktifitas.status='new' AND penerima='$id_user' GROUP BY feedback ORDER BY id_feedback DESC LIMIT 5"); ?>
                                                <?php while ($dataFeedback = mysqli_fetch_array($sql_feedbacks)) {
                                                    $nim = base64_encode($dataFeedback['nim']);
                                                    $id_ta = base64_encode('@49innqwj//;-' . $dataFeedback['id_tahun_ajaran'] . '') ?>
                                                    <div class="media mb-3">
                                                        <img class="d-flex align-self-center img-radius" src="<?= base_url(''); ?>\assets\images\user-profile\<?= $dataFeedback['foto'] ?>" alt="Generic placeholder image">
                                                        <a href="<?= base_url('detail-aktifitas-dosen/' . $nim . '/' . $id_ta . ''); ?>">
                                                            <div class="media-body" style="min-width: 100%;">
                                                                <h5 class="notification-user"><?= $dataFeedback['nama_mahasiswa'] ?></h5>
                                                                <p class="notification-msg mb-1" style="margin-bottom: -5px;"><?= $dataFeedback['feedback'] ?></p>
                                                                <span class="notification-time"><?= date('d-m-Y', strtotime($dataFeedback['tanggal'])) ?></span>
                                                            </div>
                                                        </a>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <!-- <li class="header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                                        <i class="feather icon-message-square"></i>
                                        <span class="badge bg-c-green">3</span>
                                    </div>
                                </div>
                            </li> -->
                            <li class="user-profile header-notification">
                                <div class="dropdown-primary dropdown">
                                    <div class="dropdown-toggle foto_user_awal" data-toggle="dropdown">
                                        <img src="<?= base_url(''); ?>/assets/images/user-profile/<?= $foto['foto'] ?>" class="foto_user_awal" alt="User-Profile-Image" style="border-radius: 50%; height:35px">
                                        <div class="foto_user d-none"></div>
                                        <span class="nama_user_awal"><?= $foto['nama_user'] ?></span>
                                        <span class="nama_user d-none"></span>
                                        <i class="feather icon-chevron-down"></i>
                                    </div>
                                    <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <li>
                                            <a type="button" class="bg-transparent" onclick="gantiPassword('<?= $foto['id'] ?>')">
                                                <i class="feather icon-user-plus"></i>Ubah Password
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('/profil-dosen'); ?>">
                                                <i class="feather icon-user"></i> Profil
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?= base_url('auth/logout'); ?>">
                                                <i class="feather icon-log-out"></i> Keluar
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Sidebar chat start -->
            <div id="sidebar" class="users p-chat-user showChat">
                <div class="had-container">
                    <div class="card card_main p-fixed users-main">
                        <div class="user-box">
                            <div class="chat-inner-header">
                                <div class="back_chatBox">
                                    <div class="right-icon-control">
                                        <input type="text" class="form-control  search-text" placeholder="Search Friend" id="search-friends">
                                        <div class="form-icon">
                                            <i class="icofont icofont-search"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="main-friend-list">
                                <div class="media userlist-box" data-id="1" data-status="online" data-username="Josephin Doe" data-toggle="tooltip" data-placement="left" title="Josephin Doe">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius img-radius" src="<?= base_url(''); ?>\assets\images\avatar-3.jpg" alt="Generic placeholder image ">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Josephin Doe</div>
                                    </div>
                                </div>
                                <div class="media userlist-box" data-id="2" data-status="online" data-username="Lary Doe" data-toggle="tooltip" data-placement="left" title="Lary Doe">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="<?= base_url(''); ?>\assets\images\avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Lary Doe</div>
                                    </div>
                                </div>
                                <div class="media userlist-box" data-id="3" data-status="online" data-username="Alice" data-toggle="tooltip" data-placement="left" title="Alice">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="<?= base_url(''); ?>\assets\images\avatar-4.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Alice</div>
                                    </div>
                                </div>
                                <div class="media userlist-box" data-id="4" data-status="online" data-username="Alia" data-toggle="tooltip" data-placement="left" title="Alia">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="<?= base_url(''); ?>\assets\images\avatar-3.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Alia</div>
                                    </div>
                                </div>
                                <div class="media userlist-box" data-id="5" data-status="online" data-username="Suzen" data-toggle="tooltip" data-placement="left" title="Suzen">
                                    <a class="media-left" href="#!">
                                        <img class="media-object img-radius" src="<?= base_url(''); ?>\assets\images\avatar-2.jpg" alt="Generic placeholder image">
                                        <div class="live-status bg-success"></div>
                                    </a>
                                    <div class="media-body">
                                        <div class="f-13 chat-header">Suzen</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sidebar inner chat start-->
            <div class="showChat_inner">
                <div class="media chat-inner-header">
                    <a class="back_chatBox">
                        <i class="feather icon-chevron-left"></i> Josephin Doe
                    </a>
                </div>
                <div class="media chat-messages">
                    <a class="media-left photo-table" href="#!">
                        <img class="media-object img-radius img-radius m-t-5" src="<?= base_url(''); ?>\assets\images\avatar-3.jpg" alt="Generic placeholder image">
                    </a>
                    <div class="media-body chat-menu-content">
                        <div class="">
                            <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                </div>
                <div class="media chat-messages">
                    <div class="media-body chat-menu-reply">
                        <div class="">
                            <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                            <p class="chat-time">8:20 a.m.</p>
                        </div>
                    </div>
                    <div class="media-right photo-table">
                        <a href="#!">
                            <img class="media-object img-radius img-radius m-t-5" src="<?= base_url(''); ?>\assets\images\avatar-4.jpg" alt="Generic placeholder image">
                        </a>
                    </div>
                </div>
                <div class="chat-reply-box p-b-20">
                    <div class="right-icon-control">
                        <input type="text" class="form-control search-text" placeholder="Share Your Thoughts">
                        <div class="form-icon">
                            <i class="feather icon-navigation"></i>
                        </div>
                    </div>
                </div>
            </div>