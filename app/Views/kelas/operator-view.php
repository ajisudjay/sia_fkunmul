<?= $this->include('layouts/header/index') ?>
<?= $this->include('layouts/navbar_top/operator') ?>
<?= $this->include('layouts/navbar_side/operator') ?>

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
                                    <h4>MANAJEMEN KELAS</h4>
                                    <span>Fakultas Kedokteran Universitas Mulawarman</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="page-header-breadcrumb">
                                <ul class="breadcrumb-title">
                                    <li class="breadcrumb-item">
                                        <a href="<?= base_url('auth/operator'); ?>"> <i class="feather icon-home"></i> </a>
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
                                <div class="card-header">
                                    <!-- <h5>Manajemen program S</h5>
                                        <span>lorem itaum dolor sit amet, consectetur adipisicing elit</span> -->

                                    <!-- Button trigger modal Tambah Tahun Ajaran-->
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="feather icon-maximize full-card"></i></li>
                                            <li><i class="feather icon-minus minimize-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <?php if (session()->get('pesanEdit')) { ?>
                                        <div class="alert alert-success alert-dismissible fade show flash" role="alert">
                                            <strong>Berhasil !</strong> <?= session()->getFlashdata('pesanEdit') ?>
                                        </div>
                                    <?php } ?>
                                    <?php if (session()->get('pesanHapus')) { ?>
                                        <div class="alert alert-success alert-dismissible fade show flash" role="alert">
                                            <strong>Berhasil !</strong> <?= session()->getFlashdata('pesanHapus') ?>
                                        </div>
                                    <?php } ?>
                                    <?php if (session()->get('pesanInput')) { ?>
                                        <div class="alert alert-success alert-dismissible fade show flash" role="alert">
                                            <strong>Berhasil !</strong> <?= session()->getFlashdata('pesanInput') ?>
                                        </div>
                                    <?php } ?>
                                    <hr>
                                    <form action="<?= base_url('kelas/operatorView'); ?>" method="post" class="formKelas">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <label class="f-w-700">Fakultas</label>
                                                <select name="fakultas" class="form-control" required>
                                                    <?php foreach ($fakultas as $fak) : ?>
                                                        <option value="<?= $fak['id'] ?>"><?= $fak['fakultas'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="f-w-700">Program Studi</label>
                                                <select name="programStudi" class="form-control" required>
                                                    <option></option>
                                                    <?php foreach ($programStudi as $ps) : ?>
                                                        <option value="<?= $ps['id'] ?>"><?= $ps['program_studi'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <label class="f-w-700">Tahun Ajaran</label></label>
                                                <select name="tahunAjaran" class="form-control" required>
                                                    <option></option>
                                                    <?php foreach ($tahunAjaran as $ta) : ?>
                                                        <option value="<?= $ta['id'] ?>"><?= $ta['tahun_ajaran'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary mt-3 btnTampilkan" type="submit">Tampilkan</button>
                                    </form>
                                    <div class="bg-transparent border-0" id="result"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer/operator') ?>
<?= $this->include('layouts/script/operator') ?>
<script>
    function dataKelas() {
        $(".formKelas").submit(function(e) {
            var formObj = $(this);
            var formURL = formObj.attr("action");
            var formData = new FormData(this);
            $.ajax({
                url: formURL,
                type: 'POST',
                data: formData,
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $('.btnTampilkan').attr('disable', 'disabled');
                    $('.btnTampilkan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnTampilkan').removeAttr('disable', 'disabled');
                    $('.btnTampilkan').html('Tampilkan');
                },
                success: function(response) {
                    $("#result").html(response.data);
                },
                error: function(jqXHR, textStatus, errorThrown) {}
            });
            e.preventDefault(); //Prevent Default action.
        });
    }

    $(document).ready(function() {
        dataKelas();
    });
</script>