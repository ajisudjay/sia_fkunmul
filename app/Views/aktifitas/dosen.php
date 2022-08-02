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
                                    <h4>Aktifitas Mahasiswa Bimbingan</h4>
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
                            <div class="card">
                                <div class="card-block">
                                    <!-- <div class="row">
                                        <div class="col-lg-4">
                                            <div class="card" style="padding: 15px;">
                                                <span class="font-weight-bold text-dark mb-2">Pilih Tahun Ajaran</span>
                                                <select name="id_tahun_ajaran" class="form-control tahun_ajaran">
                                                    <option value="<?= session()->get('session_ta') ?>"><?= session()->get('session_nama_ta') ?></option>
                                                    <?php foreach ($tahunajaran as $data) : ?>
                                                        <option value="<?= $data['id'] ?>"><?= $data['tahun_ajaran'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr> -->
                                    <!-- <div class="bg-transparent border-0" id="result"></div> -->
                                    <div class="bg-transparent border-0" id="result_session"></div>
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
    $(document).ready(function() {
        $.ajax({
            url: '<?= base_url('aktifitas/viewDataDosen') ?>',
            dataType: 'json',
            success: function(response) {
                // $("#result").hide();
                $("#result_session").html(response.data);
            },
            data: {
                id_tahun_ajaran: '<?= session()->get('session_ta') ?>'
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });

    // $('.tahun_ajaran').change(function() {
    //     var id_tahun_ajaran = $(this).val();
    //     $.ajax({
    //         url: '<?= base_url('aktifitas/viewDataDosen') ?>',
    //         dataType: 'json',
    //         type: "post",
    //         data: {
    //             id_tahun_ajaran: id_tahun_ajaran
    //         },
    //         beforeSend: function() {
    //             $('.loader').show();
    //             $('.loader').html('<i class="fa fa-spin fa-spinner text-primary"></i><i class="fa fa-spin fa-spinner text-primary"></i><i class="fa fa-spin fa-spinner text-primary"></i>');
    //         },
    //         complete: function() {
    //             $('.loader').hide();
    //         },
    //         success: function(response) {
    //             $("#result_session").hide();
    //             $("#result").html(response.data).show();
    //         },
    //         error: function(xhr, ajaxOptions, thrownError) {
    //             alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    //         }
    //     });
    // })
</script>
<?= $this->include('layouts/footer/operator') ?>
<?= $this->include('layouts/script/operator') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.2/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.username').select2({
            placeholder: '',
            allowClear: true
        });
    })
</script>