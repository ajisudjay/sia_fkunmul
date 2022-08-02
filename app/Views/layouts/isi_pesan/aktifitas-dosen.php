<?php $sql_aktifitas = mysqli_query($koneksi, "SELECT *, aktifitas.id as id_aktifitas, users.id as id_user FROM aktifitas JOIN mahasiswas ON aktifitas.id_mahasiswa_aktifitas=mahasiswas.id_mahasiswa JOIN users ON mahasiswas.nim=users.username WHERE status_aktifitas='new' AND mahasiswas.id_pa=$id_pa  GROUP BY judul ORDER BY id_aktifitas DESC LIMIT 5"); ?>
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