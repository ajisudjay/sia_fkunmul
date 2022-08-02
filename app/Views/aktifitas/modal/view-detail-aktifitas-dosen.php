<!-- tambah modal-->
<div class="modal fade modalViewDetail" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 80%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Detail Aktifitas</h5>
                <button type="button" class="btn btn-danger" style="border-radius: 5px;" onclick="statusAktifitas()" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body scroll_aktifitas">
                <div class="card p-4">
                    <div class="row">
                        <div class="col-lg-4">
                            <!-- Filter card start -->
                            <div class="card">
                                <div class="card-header">
                                    <h5><i class="icofont icofont-user m-r-5 text-warning"></i>Mahasiswa</h5>
                                    <hr>
                                </div>
                                <div class="card-block" style="margin-top: -20px;">
                                    <h5><?= $aktifitas['nama_mahasiswa'] ?></h5>
                                    <p class="mt-2 text-muted m-b-0"><?= $aktifitas['program_studi'] ?></p>
                                    <span class="text-muted f-14 m-b-10"><?= $aktifitas['tahun_ajaran'] ?></span>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-lg-10">
                                            <span class="font-weight-bold text-primary">Judul</span>
                                            <p class="text-muted m-b-0"><?= $aktifitas['judul'] ?></p>
                                            <hr>
                                            <span class="font-weight-bold text-primary">Kegiatan</span>
                                            <p class="text-muted m-b-0"><?= $aktifitas['kegiatan'] ?></p>
                                            <hr>
                                            <span class="font-weight-bold text-primary">Kompetensi</span>
                                            <p class="text-muted m-b-0"><?= $aktifitas['data_kompetensi'] ?></p>
                                            <hr>
                                            <span class="font-weight-bold text-primary">Sub Kompetensi</span>
                                            <p class="text-muted m-b-0"><?= $aktifitas['sub_kompetensi'] ?></p>
                                            <hr>
                                            <span class="font-weight-bold text-primary">Kegiatan</span>
                                            <span class="text-muted f-14 m-b-10"><?= date('d-m-Y', strtotime($aktifitas['tanggal'])) ?></span>
                                            <hr>
                                            <span class="font-weight-bold text-primary">Tahun Ajaran</span>
                                            <p class="text-muted m-b-0"><?= $aktifitas['tahun_ajaran'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 message">
                            <div class="card">
                                <div class="card-block">
                                    <label class="font-weight-bold text-danger alert-danger alert" style="margin-bottom: 0px;"> Feedback Aktifitas</label>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-12 messages-content">
                                            <div class="scroll_view_mahasiswa" style="margin-top:-10px">
                                                <div class="viewModal"></div>
                                            </div>
                                            <hr>
                                            <div class="messages-send">
                                                <div class="form-group">
                                                    <div class="alertSukses"></div>
                                                    <form class="formFeedback" action="<?= base_url('aktifitas/inputDosenFeedback'); ?>" method="post">
                                                        <textarea rows="5" cols="5" class="feedback form-control" name="feedback" placeholder="Tulis Balasan . . ."></textarea>
                                                        <input type="text" name="id_aktifitas" value="<?= $id_aktifitas ?>" id="" hidden>
                                                        <input type="text" name="id_user" value="<?= $id_user ?>" id="" hidden>
                                                        <input type="text" name="id_mahasiswa" value="<?= $id_mahasiswa ?>" id="" hidden>
                                                        <i style="font-size: 10px;" class="text-danger error_feedback"></i>
                                                        <div class="m-t-20">
                                                            <button type="submit" class="btn float-right btnFeedback btn-primary waves-effect waves-light">Kirim</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-block">
                                    <h4 class="sub-title">
                                        <span class="fa fa-check-square-o text-c-lite-green"></span> Refleksi Diri
                                    </h4>
                                    <?php foreach ($deskripsiaktifitas as $dataDeskripsiAktifitas) : ?>
                                        <p class="font-weight-bold text-primary"><?= $dataDeskripsiAktifitas['pertanyaan'] ?></p>
                                        <?php foreach ($detailaktifitas as $item) :
                                            if ($item['id_deskripsi_aktifitas'] == $dataDeskripsiAktifitas['id']) { ?>
                                                <p class="text-muted"><?= $item['deskripsi_aktifitas'] ?></p>
                                            <?php } ?>
                                        <?php endforeach ?>
                                    <?php endforeach ?>
                                    <hr>
                                    <!-- <h4 class="sub-title">
                                        <span class="fa fa-check-square-o text-c-lite-green"></span> Progress
                                    </h4>
                                    <div class="isi_pesan_progress"></div>
                                    <div class="view_isi_pesan_progress">
                                        <div class="main-timeline">
                                            <div class="cd-timeline cd-container">
                                                <?php foreach ($progress as $data) : ?>
                                                    <div class="cd-timeline-block">
                                                        <div class="cd-timeline-icon bg-primary">
                                                            <a class="bg-transparent border-0">
                                                                <i class="icofont icofont-ui-file"></i>
                                                            </a>
                                                        </div>
                                                        <div class="cd-timeline-content card_main">
                                                            <div class="pr-3 pt-4 pb-3 pl-3">
                                                                <?= $data['progress'] ?>
                                                            </div>
                                                            <span class="cd-date">
                                                                <i class="icofont icofont-ui-calendar"></i> <span><?= $data['tanggal'] ?></span>
                                                            </span>
                                                            <span class="cd-details"></span>
                                                        </div>
                                                    </div>
                                                <?php endforeach ?>
                                            </div>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5><i class="icofont icofont-file m-r-5 text-primary"></i>File Bukti</h5>
                                </div>
                                <div class="card-block">
                                    <center>
                                        <embed src="<?= base_url('file/aktifitas/' . $aktifitas['file_bukti'] . ''); ?>" type="application/pdf" width="770px" height="500px">
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function statusAktifitas() {
        location.reload();
    }

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
                    $(".alertSukses").html('<div class="alert alert-success">Feedback Berhasil Dikrim !</div>')
                    $(".viewModal").html(response.data);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    });

    window.setTimeout(function() {
        $(".alertSukses").fadeTo(2000, 0).slideUp(2000, function() {
            $(this).remove();
        });
    }, 8000);
</script>