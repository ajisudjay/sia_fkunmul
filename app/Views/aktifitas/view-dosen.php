<div class="main-timeline">
    <div class="cd-timeline cd-container">
        <?php foreach ($aktifitas as $item) :
            $id_aktifitas = $item['id_aktifitas'] ?>
            <div class="cd-timeline-block">
                <div class="cd-timeline-icon bg-primary">
                    <a type="button" class="bg-transparent border-0" onclick="modalDetail('<?= $item['id_aktifitas'] ?>')">
                        <i class="icofont icofont-ui-file"></i>
                    </a>
                </div>
                <div class="cd-timeline-content card_main">
                    <div class="pr-3 pt-2 pb-3 pl-3">
                        <p class="font-weight-bold" style="font-size: 16px;"><?= $item['judul'] ?></p>
                        <span class="text-c-lite-green">[ <?= $item['kegiatan'] ?> ]</span>
                        <hr>
                        <p class=""><?= word_limiter($item['deskripsi'], 15) ?></p>
                        <button type="" class="d-inline bg-transparent border-0" onclick="modalFeedback('<?= $item['id_aktifitas'] ?>')">
                            <?php $sql = mysqli_query($koneksi, "SELECT COUNT(feedback) as jumlah FROM feedbackaktifitas WHERE id_aktifitas=$id_aktifitas "); ?>
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