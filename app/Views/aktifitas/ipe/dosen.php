<?= $this->include('layouts/header/index') ?>
<?= $this->include('layouts/navbar_top/dosen') ?>
<?= $this->include('layouts/navbar_side/dosen') ?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <!-- Page-header start -->
                <div class="page-header">
                    <div class="row align-items-end">
                        <div class="col-lg-8">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <h4>Daftar Bimbingan IPE</h4>
                                    <span>Fakultas Kedokteran Universitas Mulawarman</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="<?= base_url('auth/mahasiswa'); ?>"> <i class="feather icon-home"></i> </a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#!"><?= $topHeader ?></a> </li>
                                    <li class="breadcrumb-item"><a href="#!"><?= $header ?></a> </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Page-header end -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card p-3">
                                <div class="card-header">
                                    <span class="font-weight-bold text-dark mb-1">Pilih Tahun Ajaran</span>
                                    <select name="id_tahun_ajaran" class="form-control tahun_ajaran col-lg-4">
                                        <option value="<?= session()->get('session_ta') ?>"><?= session()->get('session_nama_ta') ?></option>
                                        <option disabled></option>
                                        <?php foreach ($tahunajaran as $data) : ?>
                                            <option value="<?= $data['id'] ?>"><?= $data['tahun_ajaran'] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <hr>
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
</div>
<div class="modalViewData" style="display: none;"></div>
<div class="modalViewFeedback" style="display: none;"></div>

<?= $this->include('layouts/footer/operator') ?>
<?= $this->include('layouts/script/operator') ?>
<script>
    $(document).ready(function() {
        $.ajax({
            url: '<?= base_url('aktifitas/ipeViewSessionDosen') ?>',
            dataType: 'json',
            data: {
                id_tahun_ajaran: '<?= session()->get('session_ta') ?>',
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
            url: '<?= base_url('aktifitas/ipeViewDosen') ?>',
            dataType: 'json',
            type: "post",
            data: {
                id_tahun_ajaran: id_tahun_ajaran,
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

    $('.cariAktifitas').on('keyup', function() {
        var cari = $(this).val();
        $.ajax({
            type: "post",
            url: "<?= base_url('aktifitas/ipe/viewSearchDosen') ?>",
            dataType: "JSON",
            data: {},
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