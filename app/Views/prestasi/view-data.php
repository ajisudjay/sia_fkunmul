<?php error_reporting(0) ?>

<hr>
<!-- button tambah modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPrestasimodal">
    <span class="fa fa-plus-circle text-light"> Tambah Prestasi / Kegiatan</span>
</button>

<!-- tambah modal-->
<div class="modal fade" id="tambahPrestasimodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Prestasi / Kegiatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('prestasi/tambah'); ?>" method="post" enctype="multipart/form-data" class="tambahPrestasi">
                    <?php csrf_field() ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="text-primary">Judul</label>
                                <input type="text" name="judul" class="form-control judul" placeholder="Judul">
                                <div class="invalid-feedback errorJudul"></div>
                                <hr>
                            </div>
                            <div class="col-lg-4">
                                <label class="text-primary">Jenis</label>
                                <select class="form-control jenis" name="jenis">
                                    <option value="">Pilih Jenis</option>
                                    <option value="Partisipan">Partisipan</option>
                                    <option value="Kelembagaan">Kelembagaan</option>
                                    <option value="Prestasi">Prestasi</option>
                                </select>
                                <div class="invalid-feedback errorJenis"></div>
                                <hr>
                            </div>

                            <div class="col-lg-4">
                                <label class="text-primary">Tingkat</label>
                                <select class="form-control tingkat" name="tingkat">
                                    <option value="">Pilih Tingkat</option>
                                    <option value="Program Studi">Program Studi</option>
                                    <option value="Jurusan">Jurusan</option>
                                    <option value="Fakultas">Fakultas</option>
                                    <option value="Universitas">Universitas</option>
                                    <option value="Regional">Regional</option>
                                    <option value="Nasional">Nasional</option>
                                    <option value="Internasional">Internasional</option>
                                </select>
                                <div class="invalid-feedback errorTingkat"></div>
                                <hr>
                            </div>

                            <div class="col-lg-4">
                                <label class="text-primary">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control tanggal">
                                <div class="invalid-feedback errorTanggal"></div>
                                <hr>
                            </div>
                            <div class="col-lg-12">
                                <label class="text-primary">File Bukti</label>
                                <input required type="file" name="file" class="form-control file_bukti" accept=".pdf">
                                <div class="invalid-feedback errorFilebukti"></div>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                        <button type="submit" class="btn btn-primary btnSimpan">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- VIEW-->
<div class="dt-responsive table-responsive mt-3">
    <table id="basic-row-reorder" class="table table-striped table-bordered nowrap">
        <thead>
            <tr>
                <td style="max-width: 5%;">No</td>
                <td style="width: 10%;">Aksi</td>
                <td style="max-width: 20%;">Jenis</td>
                <td style="max-width: 50%;">Judul</td>
                <td style="max-width: 10%;">Tanggal</td>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1 ?>
            <?php foreach ($prestasi as $item) : ?>
                <?php $id = $item['id'] ?>

                <tr>
                    <td style="text-align: center;"><?= $no++ ?></td>
                    <td>

                        <!-- button detail modal -->
                        <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#modalDetail<?= $item['id'] ?>">
                            <span class="fa fa-info text-info"></span>
                        </button>

                        <!-- detail modal-->
                        <div class="modal fade" id="modalDetail<?= $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" style="min-width:60%;" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary" id="exampleModalLabel"><?= $item['judul'] ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row px-12">
                                            <div class="col-lg-3">
                                                <label class="text-primary">Jenis</label>
                                                <p><?= $item['jenis'] ?></p>
                                                <hr>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="text-primary">Tingkat</label>
                                                <p><?= $item['tingkat'] ?></p>
                                                <hr>
                                            </div>
                                            <div class="col-lg-3">
                                                <label class="text-primary">Tanggal</label>
                                                <p><?= $item['tanggal'] ?></p>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row px-11">
                                            <div class="col-lg-11" align="center">
                                                <embed type="application/pdf" src="file/prestasi/<?= $item['file_bukti'] ?>" width="600" height="400"></embed>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        |
                        <!-- button edit modal -->
                        <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#modalEdit<?= $item['id'] ?>">
                            <span class="fa fa-edit text-primary"></span>
                        </button>
                        <!-- edit modal -->
                        <div class="modal fade" id="modalEdit<?= $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary" id="exampleModalLongTitle">Edit : <?= $item['judul'] ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?= base_url('prestasi/edit'); ?>" method="POST" enctype="multipart/form-data" class="formEdit">
                                        <?php csrf_field() ?>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <input type="text" value="<?= $item['idx'] ?>" name="id" class="form-control" hidden>
                                                    <label class="text-primary">Judul</label>
                                                    <input type="text" value="<?= $item['judul'] ?>" name="judul" class="form-control judulEdit">
                                                    <div class="invalid-feedback errorJudulEdit"></div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label class="text-primary mt-2">Jenis</label>
                                                    <select style="height:20px ;" class="form-control jenisEdit" name="jenis"="112px">
                                                        <option value="<?= $item['jenis'] ?>"><?= $item['jenis'] ?></option>
                                                        <option value="Partisipan">Partisipan</option>
                                                        <option value="Kelembagaan">Kelembagaan</option>
                                                        <option value="Prestasi">Prestasi</option>
                                                    </select>
                                                    <div class="invalid-feedback errorJenisEdit"></div>
                                                </div>

                                                <div class="col-lg-3 ">
                                                    <label class="text-primary mt-2">Tingkat</label>
                                                    <select style="height:20px ;" class="form-control tingkatEdit" name="tingkat">
                                                        <option value="<?= $item['tingkat'] ?>"><?= $item['tingkat'] ?></option>
                                                        <option value="">Pilih Tingkat</option>
                                                        <option value="Program Studi">Program Studi</option>
                                                        <option value="Jurusan">Jurusan</option>
                                                        <option value="Fakultas">Fakultas</option>
                                                        <option value="Universitas">Universitas</option>
                                                        <option value="Regional">Regional</option>
                                                        <option value="Nasional">Nasional</option>
                                                        <option value="Internasional">Internasional</option>
                                                    </select>
                                                    <div class="invalid-feedback errorTingkatEdit"></div>
                                                </div>

                                                <div class="col-lg-3 ">
                                                    <label class="text-primary mt-2">Tanggal</label>
                                                    <input type="date" value="<?= $item['tanggal'] ?>" name="tanggal" class="form-control tanggalEdit">
                                                    <div class="invalid-feedback errorTanggalEdit"></div>

                                                </div>
                                                <div class="col-lg-3 ">
                                                    <label class="text-primary mt-2">File Bukti</label>
                                                    <input type="file" name="file" class="form-control file_bukti" accept=".pdf">
                                                    <div class="invalid-feedback errorFilebukti"></div>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                                            <button type="submit" class="btn btn-primary btnEdit">Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        |
                        <!-- button hapus modal-->
                        <a href="<?= base_url('prestasi/hapus/' . $item['id']); ?>" class="hapusPrestasi">
                            <span class="feather icon-trash-2 text-danger"></span>
                        </a>
                    </td>

                    <!-- ISI VIEW -->
                    <td><?= $item['jenis'] ?></td>
                    <td><?= $item['judul'] ?></td>
                    <td><?= $item['tanggal'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<!-- SCRIPT AJAX -->
<script>
    $(document).ready(function() {

        // function previewIMG
        function previewImg() {
            const gambar = document.querySelector('#file');
            const gambarLabel = document.querySelector('.custom-file-label');
            const imgPreview = document.querySelector('.img-preview');

            gambarLabel.textContent = gambar.files[0].name;

            const fileGambar = new FileReader();
            fileGambar.readAsDataURL(gambar.files[0]);

            fileGambar.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }

        // function edit
        $('.formEdit').click(function() {
            var jenis = $('#jenis').val();
            var tanggal = $('#tanggal').val();
            var judul = $('#judul').val();
            var tingkat = $('#tingkat').val();
            var files = $('#file')[0].files;
            var fd = new FormData();

            fd.append('file', files[0]);
            fd.append('jenis', jenis);
            fd.append('tanggal', tanggal);
            fd.append('judul', judul);
            fd.append('tingkat', tingkat);

            $.ajax({
                type: "post",
                url: '<?= base_url('prestasi/edit') ?>',
                data: fd,
                dataType: "json",
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.btnSimpan').attr('disable', 'disabled');
                    $('.btnSimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnSimpan').removeAttr('disable', 'disabled');
                    $('.btnSimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.judul) {
                            $('.judul').addClass('is-invalid');
                            $('.errorJudul').html(response.error.judul);
                        } else {
                            $('.judul').removeClass('is-invalid');
                            $('.errorJudul').html('');
                        }
                        if (response.error.tanggal) {
                            $('.tanggal').addClass('is-invalid');
                            $('.errorTanggal').html(response.error.tanggal);
                        } else {
                            $('.tanggal').removeClass('is-invalid');
                            $('.errorTanggal').html('');
                        }
                        if (response.error.file) {
                            $('.file').addClass('is-invalid');
                            $('.errorfile').html(response.error.file);
                        } else {
                            $('.file').removeClass('is-invalid');
                            $('.errorfile').html('');
                        }
                    } else {
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        $('#result').html(response.data);
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        });

        //tambah 

        $('.tambahPrestasi').click(function() {
            var jenis = $('#jenis').val();
            var tanggal = $('#tanggal').val();
            var judul = $('#judul').val();
            var tingkat = $('#tingkat').val();
            var files = $('#file')[0].files;
            var fd = new FormData();

            fd.append('file', files[0]);
            fd.append('jenis', jenis);
            fd.append('tanggal', tanggal);
            fd.append('judul', judul);
            fd.append('tingkat', tingkat);

            $.ajax({
                type: "post",
                url: '<?= base_url('prestasi/tambah') ?>',
                data: fd,
                dataType: "json",
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('.btnSimpan').attr('disable', 'disabled');
                    $('.btnSimpan').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnSimpan').removeAttr('disable', 'disabled');
                    $('.btnSimpan').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.judul) {
                            $('.judul').addClass('is-invalid');
                            $('.errorJudul').html(response.error.judul);
                        } else {
                            $('.judul').removeClass('is-invalid');
                            $('.errorJudul').html('');
                        }
                        if (response.error.id_modul) {
                            $('.id_modul').addClass('is-invalid');
                            $('.errorid_modul').html(response.error.id_modul);
                        } else {
                            $('.id_modul').removeClass('is-invalid');
                            $('.errorid_modul').html('');
                        }
                        if (response.error.tanggal) {
                            $('.tanggal').addClass('is-invalid');
                            $('.errorTanggal').html(response.error.tanggal);
                        } else {
                            $('.tanggal').removeClass('is-invalid');
                            $('.errorTanggal').html('');
                        }
                        if (response.error.kegiatan) {
                            $('.kegiatan').addClass('is-invalid');
                            $('.errorKegiatan').html(response.error.kegiatan);
                        } else {
                            $('.kegiatan').removeClass('is-invalid');
                            $('.errorKegiatan').html('');
                        }
                        if (response.error.file) {
                            $('.file').addClass('is-invalid');
                            $('.errorfile').html(response.error.file);
                        } else {
                            $('.file').removeClass('is-invalid');
                            $('.errorfile').html('');
                        }
                    } else {
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        $('#result').html(response.data);
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        });

        //  function hapus
        $('.hapusPrestasi').on('click', function(e) {
            e.preventDefault();
            const href = $(this).attr('href')
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Data Akan Dihapus!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Hapus!'
            }).then((result) => {
                if (result.value) {
                    document.location.href = href;
                }
            });
        });
        window.setTimeout(function() {
            $(".flashAjax").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 5000);
    });
</script>

<!-- Select 2 js -->
<script type="text/javascript" src="<?= base_url(''); ?>\bower_components\select2\js\select2.full.min.js"></script>
<!-- Multiselect js -->
<script type="text/javascript" src="<?= base_url(''); ?>\bower_components\bootstrap-multiselect\js\bootstrap-multiselect.js"></script>
<script type="text/javascript" src="<?= base_url(''); ?>\bower_components\multiselect\js\jquery.multi-select.js"></script>
<script type="text/javascript" src="<?= base_url(''); ?>\assets\js\jquery.quicksearch.js"></script>
<script type="text/javascript" src="<?= base_url(''); ?>\assets\pages\advance-elements\select2-custom.js"></script>


<script src="<?= base_url(''); ?>\bower_components\datatables.net\js\jquery.dataTables.min.js">
</script>
<script src="<?= base_url(''); ?>\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js">
</script>
<script src="<?= base_url(''); ?>\assets\pages\data-table\extensions\row-reorder\js\dataTables.rowReorder.min.js">
</script>
<script src="<?= base_url(''); ?>\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(''); ?>\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js">
</script>
<script src="<?= base_url(''); ?>\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js">
</script>
<!-- Custom js -->
<script src="<?= base_url(''); ?>\assets\pages\data-table\extensions\row-reorder\js\row-reorder-custom.js"></script>