<!-- tambah modal-->
<div class="modal fade modalViewDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 80%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Detail Aktifitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Left column start -->
                    <div class="col-lg-12 col-xl-9">
                        <!-- Job description card start -->
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
                                    <div class="col-lg-2">
                                        <button class="btn btn-success mt-2" data-toggle="modal" data-target="#modalBukti" style="border-radius: 5px;">Lihat Bukti</button>
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
                                <h5><i class="icofont icofont-user m-r-5 text-warning"></i>Mahasiswa Bimbingan</h5>
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
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalBukti" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-primary">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">File Bukti</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <embed src="<?= base_url('file/aktifitas/' . $aktifitas['file_bukti'] . ''); ?>" type="application/pdf" width="770px" height="500px">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.ajax({
            url: '<?= base_url('aktifitas/viewDataDetailDosen') ?>',
            dataType: 'json',
            data: {
                id_aktifitas: <?= $id_aktifitas ?>,
                id_user: <?= $id_user ?>,
                id_mahasiswa: <?= $id_mahasiswa ?>,
            },
            success: function(response) {
                $(".viewModal").html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });

    $('.formFeedback').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnFeedback').attr('disable', 'disabled');
                $('.btnFeedback').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.btnFeedback').removeAttr('disable', 'disabled');
                $('.btnFeedback').html('Kirim');
            },
            success: function(response) {
                if (response.error) {
                    if (response.error.feedback) {
                        $('.feedback').addClass('is-invalid');
                        $('.error_feedback').text(response.error.feedback);
                    } else {
                        $('.feedback').removeClass('is_invalid');
                        $('.error_feedback').text('');
                    }
                } else {
                    $(".viewModal").html(response.data);
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: response.sukses
                    })
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    });
</script>