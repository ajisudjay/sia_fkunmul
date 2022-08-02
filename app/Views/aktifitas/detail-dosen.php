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
                                        <div class="card" style="padding: 15px;">
                                            <span class="font-weight-bold text-dark mb-1">Pilih Tahun Ajaran</span>
                                            <select name="id_tahun_ajaran" class="form-control tahun_ajaran">
                                                <option value="<?= session()->get('session_ta') ?>"><?= session()->get('session_nama_ta') ?></option>
                                                <option disabled></option>
                                                <?php foreach ($tahunajaran as $data) : ?>
                                                    <option value="<?= $data['id'] ?>"><?= $data['tahun_ajaran'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card" style="padding: 23px;">
                                            <span class="font-weight-bold text-dark">Nama</span>
                                            <span style="font-size: 15px;" class="text-primary font-weight-bold"><?= $nama_mahasiswa ?></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card" style="padding: 23px;">
                                            <span class="font-weight-bold text-dark">NIM</span>
                                            <span style="font-size: 15px;" class="text-primary font-weight-bold"><?= $data_nim ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-block" style="margin-top:-40px">
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
                id_tahun_ajaran: '<?= session()->get('session_ta') ?>',
                id_mahasiswa: '<?= $id_mahasiswa ?>',
            },
            beforeSend: function() {
                $('.loader').show();
                $('.loader').html('<i class="fa fa-spin fa-spinner text-primary"></i><i class="fa fa-spin fa-spinner text-primary"></i><i class="fa fa-spin fa-spinner text-primary"></i>');
            },
            complete: function() {
                $('.loader').hide();
            },
            success: function(response) {
                $(".result").html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });

    $('.tahun_ajaran').change(function() {
        var id_tahun_ajaran = $(this).val();
        $.ajax({
            url: '<?= base_url('aktifitas/viewDosen') ?>',
            dataType: 'json',
            type: "post",
            data: {
                id_tahun_ajaran: id_tahun_ajaran,
                id_mahasiswa: '<?= $id_mahasiswa ?>',
            },
            beforeSend: function() {
                $('.loader').show();
                $('.loader').html('<i class="fa fa-spin fa-spinner text-primary"></i><i class="fa fa-spin fa-spinner text-primary"></i><i class="fa fa-spin fa-spinner text-primary"></i>');
            },
            complete: function() {
                $('.loader').hide();
            },
            success: function(response) {
                // $("#result_session").hide();
                $(".result").html(response.data)
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    })


    function modalFeedback(id_aktifitas) {
        $.ajax({
            type: "post",
            url: "<?= base_url('aktifitas/modalFeedbackDosen') ?>",
            dataType: "JSON",
            data: {
                id_aktifitas: id_aktifitas,
                id_mahasiswa: '<?= $id_mahasiswa ?>'
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
                id_mahasiswa: '<?= $id_mahasiswa ?>'
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

    $('.cariAktifitas').on('keyup', function() {
        var cari = $(this).val();
        $.ajax({
            type: "post",
            url: "<?= base_url('aktifitas/viewSearchDosen') ?>",
            dataType: "JSON",
            data: {
                id_tahun_ajaran: '<?= $id_tahun_ajaran ?>',
                id_mahasiswa: '<?= $id_mahasiswa ?>'
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
    })
</script>