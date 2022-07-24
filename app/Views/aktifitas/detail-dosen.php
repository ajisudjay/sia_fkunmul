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
                                    <div class="col-lg-4">
                                        <div class="card" style="padding: 20px;">
                                            <span class="font-weight-bold text-dark">Tahun Ajaran</span>
                                            <span style="font-size: 15px;" class="text-primary font-weight-bold"><?= session()->get('session_nama_ta') ?></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card" style="padding: 20px;">
                                            <span class="font-weight-bold text-dark">Nama</span>
                                            <span style="font-size: 15px;" class="text-primary font-weight-bold"><?= $nama_mahasiswa ?></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card" style="padding: 20px;">
                                            <span class="font-weight-bold text-dark">NIM</span>
                                            <span style="font-size: 15px;" class="text-primary font-weight-bold"><?= $data_nim ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-block" style="margin-top:-30px">
                                <div class="result"></div>
                                <div class="loader" style="display: none;"></div>
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

<?= $this->include('layouts/footer/operator') ?>
<?= $this->include('layouts/script/operator') ?>
<script>
    $(document).ready(function() {
        $.ajax({
            url: '<?= base_url('aktifitas/viewDosen') ?>',
            dataType: 'json',
            data: {
                id_tahun_ajaran: <?= $id_tahun_ajaran ?>,
                id_mahasiswa: <?= $id_mahasiswa ?>
            },
            success: function(response) {
                $(".result").html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });

    function modalFeedback(id_aktifitas) {
        $.ajax({
            type: "post",
            url: "<?= base_url('aktifitas/modalFeedbackDosen') ?>",
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
            url: "<?= base_url('aktifitas/modalAktifitasDosen') ?>",
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