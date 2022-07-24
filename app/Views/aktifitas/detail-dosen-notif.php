<?= $this->include('layouts/header/index') ?>
<?= $this->include('layouts/navbar_top/dosen') ?>
<?= $this->include('layouts/navbar_side/dosen') ?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <!-- Left column start -->
                                    <div class="col-lg-12 col-xl-9">
                                        <!-- Job description card start -->
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-lg-10">
                                                        <h5 style="font-size: 20px;"><?= $aktifitas['judul'] ?></h5>
                                                        <span class="text-muted f-14 m-b-10"><?= date('d-m-Y', strtotime($aktifitas['tanggal'])) ?></span>
                                                        <p class="text-muted m-b-0"><?= $aktifitas['kegiatan'] ?></p>
                                                        <p class="text-muted m-b-0"><?= $aktifitas['mata_kuliah'] ?></p>
                                                        <p class="text-muted m-b-0"><?= $aktifitas['tahun_ajaran'] ?></p>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="card-block">
                                                <h4 class="sub-title">
                                                    <span class="fa fa-check-square-o text-success"></span> Gambaran Umum
                                                </h4>
                                                <p><?= $aktifitas['deskripsi'] ?></p>
                                                <hr>
                                                <?php foreach ($deskripsiaktifitas as $data) :
                                                    $id_deskripsi = $data['id'] ?>
                                                    <h4 class="sub-title"><span class="fa fa-check-square-o text-success"></span> <?= $data['pertanyaan'] ?></h4>
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
                                    <div class="col-lg-12">
                                        <!-- Filter card start -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h5><i class="icofont icofont-file m-r-5 text-primary"></i>File Bukti</h5>
                                            </div>
                                            <div class="card-block">
                                                <embed src="<?= base_url('file/aktifitas/' . $aktifitas['file_bukti'] . ''); ?>" type="application/pdf" width="770px" height="500px">
                                            </div>
                                        </div>
                                        <!-- Filter card end -->
                                    </div>
                                </div>
                            </div>
                            <div class="card-block" style="margin-top:-30px">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modalViewData" style="display: none;"></div>
<div class="modalViewFeedback" style="display: none;"></div>
<script>
    $('.tahun_ajaran').change(function() {
        var id_tahun_ajaran = $(this).val();
        $.ajax({
            url: '<?= base_url('aktifitas/viewDosen') ?>',
            dataType: 'json',
            type: "post",
            data: {
                id_mahasiswa: <?= $id_mahasiswa ?>,
                id_tahun_ajaran: id_tahun_ajaran
            },
            beforeSend: function() {
                $('.loader').show();
                $('.loader').html('<i class="fa fa-spin fa-spinner text-primary"></i><i class="fa fa-spin fa-spinner text-primary"></i><i class="fa fa-spin fa-spinner text-primary"></i>');
            },
            complete: function() {
                $('.loader').hide();
            },
            success: function(response) {
                $(".aktivitasView").html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    })

    function modalFeedback(id_aktifitas) {
        $.ajax({
            type: "post",
            url: "<?= base_url('aktifitas/modalDetailDosen') ?>",
            dataType: "JSON",
            data: {
                id_aktifitas: id_aktifitas,
                id_mahasiswa: <?= $id_mahasiswa ?>
            },
            success: function(response) {
                if (response.sukses) {
                    $('.modalViewFeedback').html(response.sukses).show();
                    $('#modalViewFeedbackAktifitas').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function modalDetail(id_aktifitas) {
        $.ajax({
            type: "post",
            url: "<?= base_url('aktifitas/modalDosen') ?>",
            dataType: "JSON",
            data: {
                id_aktifitas: id_aktifitas,
                id_mahasiswa: <?= $id_mahasiswa ?>
            },
            success: function(response) {
                if (response.sukses) {
                    $('.modalViewData').html(response.sukses).show();
                    $('.modalViewDetail').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>

<?= $this->include('layouts/footer/operator') ?>
<?= $this->include('layouts/script/operator') ?>