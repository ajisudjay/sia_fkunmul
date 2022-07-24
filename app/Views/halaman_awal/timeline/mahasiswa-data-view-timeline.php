<div class="tab-pane" id="timeline" style="position: sticky;">
    <div class="row">
        <div class="col-md-12 timeline-dot">
            <?php foreach ($aktifitas as $data) :
                $id_act = $data['id'] ?>
                <div class="social-timelines p-absolute">
                    <div class="row timeline-right p-t-35">
                        <div class="col-2 col-sm-2 col-xl-1">
                            <div class="social-timelines-left">
                                <img class="img-radius timeline-icon" src="<?= base_url(''); ?>\assets\icon\document.png" alt="">
                            </div>
                        </div>
                        <div class="col-10 col-sm-10 col-xl-11 p-l-5">
                            <div class="card">
                                <div class="card-block post-timelines">
                                    <div class="chat-header f-w-600"><?= $data['judul'] ?></div>

                                    <div class="social-time text-muted"><?= date('d-m-Y', strtotime($data['tanggal'])) ?></div>
                                </div>
                                <div class="card-block" style="margin-top:-30px">
                                    <div class="timeline-details">
                                        <p class="text-muted"><?= $data['deskripsi'] ?></p>
                                    </div>
                                </div>
                                <div class="card-block b-b-theme b-t-theme social-msg">
                                    <!-- <a href="#"> <i class="icofont icofont-heart-alt text-muted"></i><span class="b-r-muted">Like (20)</span> </a> -->
                                    <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Balas</span></a>
                                    <!-- <a href="#"> <i class="icofont icofont-share text-muted"></i> <span>Share (10)</span></a> -->
                                </div>
                                <div class="card-block user-box">

                                    <?php $sql = mysqli_query($koneksi, "SELECT COUNT(feedback) as jumlah FROM feedbackaktifitas WHERE id_aktifitas=$id_act "); ?>
                                    <?php while ($data_count = mysqli_fetch_array($sql)) { ?>
                                        <div class="p-b-20"> <span class="f-14"><a href="#">Feedback (<?= $data_count['jumlah'] ?>)</a></span><span class="f-right">Lihat Semua</span></div>
                                    <?php } ?>

                                    <?php $sql_item = mysqli_query($koneksi, "SELECT * FROM feedbackaktifitas JOIN users ON users.id=feedbackaktifitas.id_user WHERE feedbackaktifitas.id_aktifitas=$id_act ORDER BY id_feedback DESC LIMIT 3"); ?>
                                    <?php while ($item = mysqli_fetch_array($sql_item)) { ?>
                                        <div class="media">
                                            <a class="media-left" href="#">
                                                <img class="media-object mt-2 img-radius m-r-20" src="<?= $item['foto'] == null ? base_url('assets/images/auth/no-image.png') : base_url('assets/images/user-profile/' . $item['foto'] . '') ?>" alt="Generic placeholder image">
                                            </a>
                                            <div class="media-body b-b-muted social-client-description">
                                                <div class="chat-header"><?= $item['nama_user'] ?>
                                                    <br>
                                                    <span class="text-muted ml-0">
                                                        <?= date('d-m-Y H:i:s', strtotime($item['waktu'])) ?>
                                                    </span>
                                                </div>
                                                <p class="text-muted"><?= $item['feedback'] ?></p>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="media">
                                        <a class="media-left" href="#">
                                            <img class="media-object img-radius mt-2 m-r-20" src="<?= $user['foto'] == null ? base_url('assets/images/auth/no-image.png') : base_url('assets/images/user-profile/' . $user['foto'] . '') ?>" alt=" Generic placeholder image">
                                        </a>
                                        <div class="media-body">
                                            <form class="formFeedback" action="<?= base_url('feedbackAktifitas/inputMahasiwaBeranda'); ?>" method="post">
                                                <div class="">
                                                    <textarea required rows="5" cols="5" class="feedback form-control" name="feedback" placeholder="Tulis Balasan . . ."></textarea>
                                                    <input type="text" name="id_aktifitas" value="<?= $data['id'] ?>" id="" hidden>
                                                    <input type="text" name="id_user" value="<?= $user['id'] ?>" id="" hidden>
                                                    <!-- <span class="text-danger error_feedback"></span> -->
                                                    <div class="text-right m-t-20">
                                                        <button type="submit" class="btn btnFeedback btn-primary waves-effect waves-light">Kirim</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
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
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
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
                        $(".result-timeline").html(response.data);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        });
    });
</script>