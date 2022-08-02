<div class="modal fade" id="modalFeedbackAktifitas" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="min-width:80%" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Feedback Aktifitas</h5>
                <button type="button" onclick="statusAktifitas()" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="page-body message">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <div class="media">
                                        <a class="media-left" href="#">
                                            <img class="media-object img-radius msg-img-h" src="<?= base_url('assets/icon/document.png') ?>" alt="" style="border-radius: 10%; height:50px">
                                        </a>
                                        <div class="media-body">
                                            <div class="txt-white font-weight-bold"><?= $aktifitas['judul'] ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-lg-9 col-md-12 messages-content">
                                            <div class="scroll_view">
                                                <div class="viewModal"></div>
                                            </div>
                                            <hr>
                                            <div class="messages-send">
                                                <div class="form-group">
                                                    <form class="formFeedback" action="<?= base_url('aktifitas/inputMahasiwaFeedback'); ?>" method="post">
                                                        <textarea rows="5" cols="5" class="feedback form-control" name="feedback" placeholder="Tulis Balasan . . ."></textarea>
                                                        <input type="text" name="id_aktifitas" value="<?= $id_aktifitas ?>" id="" hidden>
                                                        <input type="text" name="id_user" value="<?= $id_user ?>" id="" hidden>
                                                        <input type="text" name="id_mahasiswa" value="<?= $id_mahasiswa ?>" id="" hidden>
                                                        <input type="text" name="id_pa" value="<?= $id_pa ?>" id="" hidden>
                                                        <i style="font-size: 10px;" class="text-danger error_feedback"></i>
                                                        <div class="text-right m-t-20">
                                                            <button type="button" class="float-left btn btn-danger" onclick="statusAktifitas()" data-dismiss="modal">Tutup</button>
                                                            <button type="submit" class="btn btnFeedback btn-primary waves-effect waves-light">Kirim</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 message-left">
                                            <div class="card-block user-box contact-box assign-user">
                                                <label class="text-primary">Kegiatan Lainnya</label>
                                                <hr>
                                                <?php $id_mahasiswa = $aktifitas['id_mahasiswa_aktifitas'] ?>
                                                <?php $sql_aktifitas = mysqli_query($koneksi, "SELECT * FROM aktifitas JOIN mahasiswas ON mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas WHERE id_mahasiswa_aktifitas='$id_mahasiswa' ORDER BY id DESC LIMIT 5");
                                                while ($itemOthers = mysqli_fetch_array($sql_aktifitas)) {
                                                    $id = $itemOthers['id'];
                                                    if ($id == $id_aktifitas) {
                                                        $view = 'hidden';
                                                    } else {
                                                        $view = '';
                                                    } ?>
                                                    <div class="media" <?= $view ?>>
                                                        <div class="media-left media-middle photo-table">
                                                            <a href="<?= base_url('/detail-aktifitas-mahasiswa/' . $itemOthers['slug_aktifitas'] . ''); ?>">
                                                                <img class="media-object img-radius" src="<?= base_url('assets/icon/document.png') ?>" alt="Generic placeholder image">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <a href="<?= base_url('/detail-aktifitas-mahasiswa/' . $itemOthers['slug_aktifitas'] . ''); ?>">
                                                                <h6 class="font-weight-bold"><?= word_limiter($itemOthers['judul'], 3) ?></h6>
                                                                <p><?= word_limiter($itemOthers['deskripsi'], 3) ?></p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <br>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Message section end -->
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
            url: '<?= base_url('aktifitas/viewDataDetailMahasiswa') ?>',
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
                        $(".viewModal").html(response.data);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        });
    });
</script>