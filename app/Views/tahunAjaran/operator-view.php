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
                                    <h4>Tahun Ajaran</h4>
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
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahtahunAjaran">
                                        <span class="feather icon-plus text-light"></span>
                                    </button>

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
                                            <div class="flash-data2" data-flashdata=2></div>
                                        </div>
                                    <?php } ?>
                                    <?php if (session()->get('pesanHapus')) { ?>
                                        <div class="alert alert-success alert-dismissible fade show flash" role="alert">
                                            <strong>Berhasil !</strong> <?= session()->getFlashdata('pesanHapus') ?>
                                            <div class="flash-data3" data-flashdata=3></div>
                                        </div>
                                    <?php } ?>
                                    <?php if (session()->get('pesanInput')) { ?>
                                        <div class="alert alert-success alert-dismissible fade show flash" role="alert">
                                            <strong>Berhasil !</strong> <?= session()->getFlashdata('pesanInput') ?>
                                            <div class="flash-data1" data-flashdata=1></div>
                                        </div>
                                    <?php } ?>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered">
                                            <tr>
                                                <td style="width: 20px;">NO</td>
                                                <td style="width: 70px;" align="center">Aksi</td>
                                                <td>Tahun Ajaran</td>
                                            </tr>
                                            <?php $no = 1 ?>
                                            <?php foreach ($tahunAjaran as $item) { ?>
                                                <tr>
                                                    <td align="center"><?= $no++ ?></td>
                                                    <td>
                                                        <!-- Button trigger modal Edit Tahun Ajaran -->
                                                        <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#edittahunAjaran<?= $id = $item['id'] ?>">
                                                            <span class="feather icon-edit-1 text-primary"></span>
                                                        </button>
                                                        <!-- Modal Edit Tahun Ajaran-->
                                                        <div class="modal fade" id="edittahunAjaran<?= $id = $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Edit Tahun Ajaran</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <form action="<?= base_url('tahunAjaran/edit'); ?>" method="post">
                                                                        <?= csrf_field() ?>
                                                                        <div class="modal-body">
                                                                            <?php
                                                                            $sql_ta = mysqli_query($koneksi, "SELECT * FROM tahunajarans WHERE id='$id'");
                                                                            $edit = mysqli_fetch_array($sql_ta) ?>
                                                                            <label>Tahun Ajaran</label>
                                                                            <input type="text" name="ta" class="form-control" value="<?= $edit['tahun_ajaran'] ?>">
                                                                            <input type="text" name="id" value="<?= $edit['id'] ?>" hidden>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div> |
                                                        <!-- Button trigger modal Hapus Tahun Ajaran -->
                                                        <a href="<?= base_url('tahunAjaran/Hapus/' . $item['id'] . ''); ?>" class="btn-del">
                                                            <span class="feather icon-trash-2 text-danger"></span>
                                                        </a>
                                                    </td>
                                                    <td><?= $item['tahun_ajaran'] ?></td>
                                                </tr>
                                            <?php } ?>
                                        </table>
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
<!-- Modal Tambah Tahun Ajaran-->

<div class="modal fade" id="tambahtahunAjaran" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Tahun Ajaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('tahunAjaran/tambah'); ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <label>Tahun Ajaran</label>
                    <input type="text" name="ta" class="form-control" placeholder="Tulis Tahun Ajaran" autofocus>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->include('layouts/footer/operator') ?>
<?= $this->include('layouts/script/operator') ?>