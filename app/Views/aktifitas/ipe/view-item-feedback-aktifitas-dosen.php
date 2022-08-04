<?php $sql_item = mysqli_query($koneksi, "SELECT *, users.id as id_user, aktifitas.id as id_aktifitas FROM feedbackaktifitas JOIN users ON users.id=feedbackaktifitas.id_user JOIN aktifitas ON aktifitas.id=feedbackaktifitas.id_aktifitas WHERE feedbackaktifitas.id_aktifitas='$id_aktifitas' ORDER BY id_feedback ASC"); ?>
<?php while ($item = mysqli_fetch_array($sql_item)) {
    if ($item['id_user'] == session()->get('id_user')) { ?>
        <div class="media" style="margin-bottom: 2px;">
            <div class="media-body text-right">
                <p class="msg-send" style="background-color: #ECE5DD;border-radius:10px"><?= $item['feedback'] ?></p>
                <p><i class="icofont icofont-wall-clock f-12"></i> <?= date('d-m-Y h:i:s', strtotime($item['waktu'])) ?></p>
            </div>
            <div class="media-right friend-box">
                <img class="media-object img-radius" src="<?= base_url(''); ?>/assets/images/user-profile/<?= $item['foto'] ?>" alt="">
            </div>
        </div>
    <?php } else { ?>
        <div class="media" style="margin-bottom: 2px;">
            <div class="media-left friend-box">
                <img class="media-object img-radius" src="<?= base_url(''); ?>/assets/images/user-profile/<?= $item['foto'] ?>" alt="">
            </div>
            <div class="media-body">
                <p class="msg-reply bg-primary" style="border-radius:10px"><?= $item['feedback'] ?></p>
                <p><i class="icofont icofont-wall-clock f-12"></i> <?= date('d-m-Y h:i:s', strtotime($item['waktu'])) ?></p>
            </div>
        </div>
    <?php } ?>
<?php } ?>