<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
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
                                                <?php $sql_item = mysqli_query($koneksi, "SELECT *, users.id as id_user, aktifitas.id as id_aktifitas FROM feedbackaktifitas JOIN users ON users.id=feedbackaktifitas.id_user JOIN aktifitas ON aktifitas.id=feedbackaktifitas.id_aktifitas WHERE feedbackaktifitas.id_aktifitas=$id_aktifitas ORDER BY id_feedback ASC"); ?>
                                                <?php while ($item = mysqli_fetch_array($sql_item)) { ?>
                                                    <div class="media">
                                                        <div class="media-left friend-box">
                                                            <a href="#">
                                                                <img class="media-object img-radius" src="<?= base_url(''); ?>/assets/images/user-profile/<?= $item['foto'] ?>" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="media-body">
                                                            <p class="msg-send"><?= $item['feedback'] ?></p>
                                                            <p><i class="icofont icofont-wall-clock f-12"></i><?= date('d-m-Y h:i:s', strtotime($item['waktu'])) ?></p>
                                                        </div>
                                                    </div>
                                                <?php } ?>

                                                <!-- <div class="media">
                                                    <div class="media-body text-right">
                                                        <p class="msg-reply bg-primary">Aldus PageMaker including versions of Lorem Ipsum.</p>
                                                        <p class="msg-reply bg-primary">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>
                                                        <p><i class="icofont icofont-wall-clock f-12"></i> October 12, 2015 at 9:01 pm</p>
                                                    </div>
                                                    <div class="media-right friend-box">
                                                        <a href="#">
                                                            <img class="media-object img-radius" src="<?= base_url(''); ?>\assets\images\avatar-2.jpg" alt="">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="media">
                                                    <div class="media-left friend-box">
                                                        <a href="#">
                                                            <img class="media-object img-radius" src="<?= base_url(''); ?>\assets\images\avatar-1.jpg" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <p class="msg-send">Aldus PageMaker including versions of Lorem Ipsum.</p>
                                                        <p class="msg-send">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley.</p>
                                                        <p><i class="icofont icofont-wall-clock f-12"></i> October 12, 2015 at 9:15 pm</p>
                                                    </div>
                                                </div> -->
                                            </div>
                                            <hr>
                                            <div class="messages-send">
                                                <div class="form-group">
                                                    <form class="formFeedback" action="<?= base_url('aktifitas/inputMahasiwaFeedback'); ?>" method="post">
                                                        <textarea rows="5" cols="5" class="feedback form-control" name="feedback" placeholder="Tulis Balasan . . ."></textarea>
                                                        <input type="text" name="id_aktifitas" value="<?= $id_aktifitas ?>" id="" hidden>
                                                        <input type="text" name="id_user" value="<?= $id_user ?>" id="" hidden>
                                                        <i style="font-size: 10px;" class="text-danger error_feedback"></i>
                                                        <div class="text-right m-t-20">
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
                                                <?php $sql_aktifitas = mysqli_query($koneksi, "SELECT * FROM aktifitas JOIN mahasiswas ON mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas WHERE id_mahasiswa_aktifitas='$id_mahasiswa'");
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
                <!-- Page body end -->
            </div>
        </div>
        <!-- Warning Section Starts -->
    </div>
</div>

<script>
    $(document).ready(function() {
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
                        Swal.fire({
                            icon: 'success',
                            text: response.sukses,
                            position: 'top-end',
                        });
                        $("#result").html(response.data);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        });
    });
</script>