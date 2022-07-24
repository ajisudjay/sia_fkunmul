<!-- tambah modal-->
<div class="modal fade" id="modalInputAktifitas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 80%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Detail Aktifitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body scroll_aktifitas">
                <div class="row">
                    <div class="col-lg-12 col-xl-9">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-lg-10">
                                        <h5><?= $aktifitas['judul'] ?></h5>
                                        <span class="text-muted f-14 m-b-10"><?= date('d-m-Y', strtotime($aktifitas['tanggal'])) ?></span>
                                        <p class="text-muted m-b-0"><?= $aktifitas['kegiatan'] ?></p>
                                        <p class="text-muted m-b-0"><?= $aktifitas['mata_kuliah'] ?></p>
                                        <p class="text-muted m-b-0"><?= $aktifitas['tahun_ajaran'] ?></p>
                                    </div>
                                </div>
                                <hr>
                            </div>
                            <div class="card-block">
                                <h4 class="sub-title">
                                    <span class="fa fa-check-square-o text-c-lite-green"></span> Gambaran Umum
                                </h4>
                                <p><?= $aktifitas['deskripsi'] ?></p>
                                <hr>
                                <?php foreach ($deskripsiaktifitas as $data) :
                                    $id_deskripsi = $data['id'] ?>
                                    <h4 class="sub-title"><span class="fa fa-check-square-o text-c-lite-green"></span> <?= $data['pertanyaan'] ?></h4>
                                    <?php $sql_deskripsi = mysqli_query($koneksi, "SELECT * FROM detailaktifitas WHERE id_deskripsi_aktifitas='$id_deskripsi' AND id_aktifitas='$id_aktifitas'");
                                    while ($item = mysqli_fetch_array($sql_deskripsi)) { ?>
                                        <ul class="job-details-list">
                                            <li>
                                                <?= $item['deskripsi_aktifitas'] ?>
                                            </li>
                                        </ul>
                                    <?php } ?>
                                <?php endforeach ?>
                            </div>
                            <div class="card-footer">
                                <div class="row">

                                </div>
                            </div>
                        </div>
                        <!-- Job description card end -->
                    </div>
                    <!-- Left column end -->
                    <!-- right column start -->
                    <div class="col-lg-12 col-xl-3">
                        <!-- Filter card start -->
                        <div class="card">
                            <div class="card-header">
                                <h5><i class="icofont icofont-user m-r-5 text-warning"></i>Mahasiswa</h5>
                            </div>
                            <div class="card-block">
                                <h5><?= $aktifitas['nama_mahasiswa'] ?></h5>
                                <p class="mt-2 text-muted m-b-0"><?= $aktifitas['program_studi'] ?></p>
                                <hr>
                                <span class="text-muted f-14 m-b-10"><?= $aktifitas['tahun_ajaran'] ?></span>
                            </div>
                        </div>
                        <!-- Filter card end -->
                    </div>
                    <div class="col-lg-12">
                        <!-- Filter card start -->
                        <div class="card">
                            <div class="card-header">
                                <h5><i class="icofont icofont-file m-r-5 text-primary"></i>File Bukti</h5>
                            </div>
                            <div class="card-block">
                                <embed src="<?= base_url('file/aktifitas/' . $aktifitas['file_bukti'] . ''); ?>" type="application/pdf" width="770px" height="500px">
                            </div>
                        </div>
                        <!-- Filter card end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>