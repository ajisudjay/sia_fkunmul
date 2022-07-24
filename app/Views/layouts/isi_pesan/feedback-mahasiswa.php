 <?php $sql_feedbacks = mysqli_query($koneksi, "SELECT *, aktifitas.id as id_akt FROM aktifitas JOIN mahasiswas ON aktifitas.id_mahasiswa_aktifitas=mahasiswas.id_mahasiswa JOIN feedbackaktifitas ON aktifitas.id=feedbackaktifitas.id_aktifitas JOIN users ON mahasiswas.nim=users.username JOIN dosens ON mahasiswas.id_pa=dosens.id  WHERE feedbackaktifitas.status='new' AND penerima='$id_penerima' ORDER BY id_feedback DESC LIMIT 5"); ?>
 <?php while ($dataFeedback = mysqli_fetch_array($sql_feedbacks)) {
        $nim = base64_encode($dataFeedback['nim']);
        $id_ta = base64_encode('@49innqwj//;-' . $dataFeedback['id_tahun_ajaran'] . '') ?>
     <div class="media mb-3">
         <img class="d-flex align-self-center img-radius" src="<?= base_url(''); ?>\assets\images\user-profile\<?= $dataFeedback['foto'] ?>" alt="Generic placeholder image">
         <a onclick="modalFeedback('<?= $dataFeedback['slug_aktifitas'] ?>')">
             <div class=" media-body" style="min-width: 100%;">
                 <h5 class="notification-user"><?= $dataFeedback['judul'] ?></h5>
                 <p class="notification-msg mb-1" style="margin-bottom: -5px;"><?= $dataFeedback['feedback'] ?></p>
                 <span class="notification-time"><?= date('d-m-Y', strtotime($dataFeedback['tanggal'])) ?></span>
             </div>
         </a>
     </div>
 <?php } ?>