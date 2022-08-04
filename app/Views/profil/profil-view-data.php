<!-- Page-body start -->
<div class="page-body">
    <!--profile cover start-->
    <div class="row">
        <div class="col-lg-12">
            <div class="cover-profile">
                <div class="profile-bg-img">
                    <img class="profile-bg-img img-fluid" src="\assets\images\user-profile\bg-img1.jpg" alt="bg-img">
                    <div class="card-block user-info">
                        <div class="col-md-12">
                            <div class="media-left">
                                <a href="#" class="profile-image">
                                    <img class="user-img img-radius" src="\assets\images\user-profile\user-img.jpg" alt="user-img">
                                </a>
                            </div>
                            <div class="media-body row">
                                <div class="col-lg-12">
                                    <div class="user-title">
                                        <h2><?= $mahasiswa['nama_mahasiswa'] ?></h2>
                                        <span class="text-white">NIM . <?= $mahasiswa['nim'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--profile cover end-->
    <div class="row">
        <div class="col-lg-12">
            <!-- tab header start -->
            <div class="tab-header card">
                <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Biodata</a>
                        <div class="slide"></div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#binfo" role="tab">Prestasi</a>
                        <div class="slide"></div>
                    </li>
                </ul>
            </div>
            <!-- tab header end -->
            <!-- tab content start -->
            <div class="tab-content">
                <!-- tab panel personal start -->
                <div class="tab-pane active" id="personal" role="tabpanel">
                    <!-- personal card start -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-header-text">Biodata</h5>
                        </div>
                        <div class="card-block">
                            <div class="view-info">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="general-info">
                                            <div class="row">
                                                <div class="col-lg-12 col-xl-6">
                                                    <div class="table-responsive">
                                                        <table class="table m-0">
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row">NIM</th>
                                                                    <td><?= $mahasiswa['nim'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Nama Lengkap</th>
                                                                    <td><?= $mahasiswa['nama_mahasiswa'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Jenis Kelamin</th>
                                                                    <td><?= $mahasiswa['jk'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Tempat, Tanggal Lahir</th>
                                                                    <td>Samarinda, 1 Januari 2000</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Alamat</th>
                                                                    <td><?= $mahasiswa['alamat'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Nomor Telepon</th>
                                                                    <td><?= $mahasiswa['telepon'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Email</th>
                                                                    <td><?= $mahasiswa['email'] ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- end of table col-lg-6 -->
                                                <div class="col-lg-12 col-xl-6">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <tbody>
                                                                <tr>
                                                                    <th scope="row">Fakultas</th>
                                                                    <td>Fakultas Kedokteran</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Program Studi</th>
                                                                    <td><?= $mahasiswa['program_studi'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Angkatan</th>
                                                                    <td><?= $mahasiswa['angkatan'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Pembimbing Akademik</th>
                                                                    <td><?= $mahasiswa['nama_dosen'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Pembimbing TA I</th>
                                                                    <td><?= $pb1['nama_dosen'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Pembimbing TA II</th>
                                                                    <td><?= $pb2['nama_dosen'] ?></td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Status</th>
                                                                    <td><?= $mahasiswa['status'] ?></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <!-- end of table col-lg-6 -->
                                            </div>
                                            <!-- end of row -->
                                        </div>
                                        <!-- end of general info -->
                                    </div>
                                    <!-- end of col-lg-12 -->
                                </div>
                                <!-- end of row -->
                            </div>
                            <!-- end of view-info -->
                        </div>
                        <!-- end of card-block -->
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-header-text">Description About Me</h5>
                                </div>
                                <div class="card-block user-desc">
                                    <div class="view-desc">
                                        <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?" "On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able To Do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pain.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- personal card end-->
                </div>
                <!-- tab pane personal end -->
                <!-- tab pane info start -->
                <div class="tab-pane" id="binfo" role="tabpanel">
                    <!-- info card start -->
                    <div class="card">
                        <div class="card-block">
                            <div class="row">
                                <?php foreach ($prestasi as $item) : ?>
                                    <?php
                                    if ($item['jenis'] == 'Prestasi') {
                                        $card = "success";
                                    } else if ($item['jenis'] == 'Kelembagaan') {
                                        $card = "warning";
                                    } else {
                                        $card = "info";
                                    }
                                    ?>
                                    <div class="col-md-4">
                                        <div class="card b-l-<?= $card ?> business-info services">
                                            <div class="card-header">
                                                <div class="service-header">
                                                    <h5 class="text-primary"><?= $item['jenis'] . ' - ' . $item['tingkat'] ?></h5>
                                                </div>
                                                <!-- button detail modal -->
                                                <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#modalDetail<?= $item['id'] ?>">
                                                    <span class="fa fa-info text-info"></span>
                                                </button>
                                                <!-- detail modal -->
                                                <div class="modal fade" id="modalDetail<?= $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" style="min-width:30%;" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title text-primary" id="exampleModalLabel"><?= $item['judul'] ?></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row px-12">
                                                                    <div class="col-lg-3">
                                                                        <label class="text-primary">Jenis</label>
                                                                        <p><?= $item['jenis'] ?></p>
                                                                        <hr>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <label class="text-primary">Tingkat</label>
                                                                        <p><?= $item['tingkat'] ?></p>
                                                                        <hr>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <label class="text-primary">Tanggal</label>
                                                                        <p><?= $item['tanggal'] ?></p>
                                                                        <hr>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row px-11">
                                                                    <div class="col-lg-11" align="center">
                                                                        <embed type="application/pdf" src="/file/prestasi/<?= $item['file_bukti'] ?>" width="600" height="400"></embed>
                                                                        <hr>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div align="center" class=" col-sm-12">
                                                    <p class="task-detail"><strong><?= $item['judul'] ?></strong></p>
                                                    <p class="text-muted"><?= $item['tanggal'] ?></p>
                                                </div>
                                                <!-- end of col-sm-8 -->
                                            </div>
                                            <!-- end of row -->
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- info card end -->
            </div>
            <!-- tab pane info end -->
        </div>
        <!-- tab content end -->
    </div>
</div>
</div>
<!-- Page-body end -->