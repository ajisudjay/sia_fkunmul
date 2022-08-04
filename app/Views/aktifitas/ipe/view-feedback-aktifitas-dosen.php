<!-- tambah modal-->
<div class="modal fade" id="modalViewFeedbackAktifitas" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 80%;" role="document">
        <div class="modal-header"></div>
        <div class="modal-content">
            <div class="modal-body">
                <div class="page-wrapper">
                    <div class="page-body message">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="bg-primary" style="padding: 15px;border-radius:10px">
                                        <span style="font-size:20px">Feedback Aktifitas IPE</span>
                                        <button type="button" onclick="statusFeedback()" class="d-inline btn btn-danger rounded float-right" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-9 col-md-12 messages-content">
                                            <div class="scroll_view">
                                                <div class="viewModal"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 message-left">
                                            <div class="card-block user-box contact-box assign-user">
                                                <div class="card-header bg-light" style="border-radius: 10px;">
                                                    <div class="media">
                                                        <a class="media-left" href="#">
                                                            <img class="media-object img-radius msg-img-h" src="<?= base_url('assets/icon/document.png') ?>" alt="" style="border-radius: 10%; height:50px">
                                                        </a>
                                                        <div class="media-body">
                                                            <div class="txt-white font-weight-bold"><?= word_limiter($aktifitas['judul'], 11) ?></div>
                                                            <p class="mt-2 text-muted m-b-0"><?= $aktifitas['kegiatan'] ?></p>
                                                            <hr>
                                                            <span class="text-muted f-14 m-b-10"><?= $aktifitas['data_kompetensi'] ?></span>
                                                            <span class="text-muted f-14 m-b-10"><?= $aktifitas['sub_kompetensi'] ?></span>
                                                            <span class="text-muted f-14 m-b-10"><?= $aktifitas['tahun_ajaran'] ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="messages-send p-15">
                                    <div class="form-group">
                                        <form class="formFeedback" action="<?= base_url('aktifitas/inputDosenFeedback'); ?>" method="post">
                                            <textarea rows="5" cols="5" class="feedback form-control" name="feedback" placeholder="Tulis Balasan . . ."></textarea>
                                            <input type="text" name="id_aktifitas" value="<?= $id_aktifitas ?>" id="" hidden>
                                            <input type="text" name="id_user" value="<?= $id_user ?>" id="" hidden>
                                            <input type="text" name="id_mahasiswa" value="<?= $id_mahasiswa ?>" id="" hidden>
                                            <i style="font-size: 10px;" class="text-danger error_feedback"></i>
                                            <div class="m-t-20">
                                                <button type="submit" class="btn float-left btnFeedback btn-primary waves-effect waves-light">Kirim</button>
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
    </div>
</div>

<script>
    function statusFeedback() {
        location.reload();
    }
</script>

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