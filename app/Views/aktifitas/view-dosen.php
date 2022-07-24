<div class="main-timeline">
    <div class="cd-timeline cd-container">
        <?php foreach ($aktifitas as $item) :
            $id_aktifitas = $item['id_aktifitas'];
            $id_user = session()->get('id_user'); ?>
            <div class="cd-timeline-block">
                <div class="cd-timeline-icon bg-primary">
                    <a class="bg-transparent border-0" onclick="modalDetail('<?= $item['id_aktifitas'] ?>')">
                        <i class="icofont icofont-ui-file"></i>
                    </a>
                </div>
                <div class="cd-timeline-content card_main">
                    <div class="pr-3 pt-4 pb-3 pl-3">

                        <a onclick="modalDetail('<?= $item['id_aktifitas'] ?>')">
                            <p class="font-weight-bold" style="font-size: 16px;"><?= $item['judul'] ?></p>
                            <span class="text-c-lite-green">[ <?= $item['kegiatan'] ?> ]</span>
                            <!-- status aktifitas -->
                            <?php if ($item['status_aktifitas'] == 'new') { ?>
                                <blink class="">
                                    <span class="ml-3 bagde badge-danger rounded px-2 py-1">
                                        Aktifitas Baru
                                    </span>
                                </blink>
                            <?php } ?>
                            <!-- <blink class="aktifitas_dosen_status d-none">
                                <span class="ml-3 bagde badge-danger aktifitas_dosen rounded px-2 py-1">
                                    Aktifitas Baru
                                </span>
                            </blink> -->
                            <!-- feedback -->
                            <?php $sql_feedback = mysqli_query($koneksi, "SELECT *, COUNT(feedback) as jumlah FROM feedbackaktifitas WHERE id_aktifitas=$id_aktifitas AND status='new' AND penerima=$id_user") ?>
                            <?php while ($status_feedback = mysqli_fetch_array($sql_feedback)) {
                                if ($status_feedback['jumlah'] > 0) { ?>
                                    <blink class="">
                                        <span class="ml-3 bagde badge-success rounded px-2 py-1">
                                            <?= $status_feedback['jumlah'] ?> Feedback Baru
                                        </span>
                                    </blink>
                                <?php } ?>
                            <?php } ?>
                            <!-- <blink class="feedback_aktifitas_dosen_status d-none">
                                <span class="ml-3 feedback_aktifitas_dosen bagde badge-success rounded px-2 py-1"></span>
                                <span class="bagde badge-success rounded px-2 py-1">Feedback Baru</span>
                            </blink> -->
                            <hr>
                            <p class=""><?= word_limiter($item['deskripsi'], 15) ?></p>
                        </a>
                        <button type="" class="d-inline bg-transparent border-0" onclick="modalFeedback('<?= $item['id_aktifitas'] ?>')">
                            <?php $sql = mysqli_query($koneksi, "SELECT COUNT(feedback) as jumlah FROM feedbackaktifitas WHERE id_aktifitas=$id_aktifitas"); ?>
                            <?php while ($data_count = mysqli_fetch_array($sql)) { ?>
                                <span class="mt-2 fa fa-comment text-c-orenge"></span>
                                <span class="text-c-orenge" style="font-size: 12px;font-weight:bold"><?= $data_count['jumlah'] ?> Feedback [ Berikan Komentar ]</span>
                            <?php } ?>
                        </button>
                        <button class="d-inline mt-2 float-right bg-transparent border-0" onclick="modalDetail('<?= $item['id_aktifitas'] ?>')">
                            <span class="text-purple fa fa-eye" style="font-size: 12px;font-weight:bold"> Detail</span>
                        </button>
                    </div>
                    <span class="cd-date">
                        <i class="icofont icofont-ui-calendar"></i> <span><?= date('d-m-Y', strtotime($item['tanggal'])) ?></span>
                    </span>
                    <span class="cd-details"><?= $item['mata_kuliah'] ?></span>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>