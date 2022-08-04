<?php error_reporting(0) ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-header">
            <!-- button tambah modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahDeskmodal">
                <span class="feather icon-plus text-light"></span>
            </button>
            <div class="card-header-right">
                <ul class="list-unstyled card-option">
                    <li><i class="feather icon-maximize full-card"></i></li>
                    <li><i class="feather icon-minus minimize-card"></i></li>
                </ul>
            </div>
            <br>
            <br>
            <!-- tambah modal-->
            <div class="modal fade" id="tambahDeskmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Tambah Pertanyaan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="<?= base_url('desk/tambah'); ?>" method="post" class="tambahDesk">
                                <?php csrf_field() ?>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label class="text-primary">Pertanyaan</label>
                                            <input type="text" name="desk" class="form-control desk" placeholder="Pertanyaan">
                                            <div class="invalid-feedback errorDesk"></div>
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
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <td style="width: 5%;text-align:center;">No</td>
                            <td colspan="2" style="width: 5%;text-align:center;">Aksi</td>
                            <td style="width: 60%;">Pertanyaan</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1 ?>
                        <?php foreach ($desk as $item) : ?>
                            <?php $id = $item['id'] ?>
                            <?php
                            $sql_edit = mysqli_query($koneksi, "SELECT *, id as idx FROM deskripsiaktifitas WHERE id='$id'");
                            $dataEdit = mysqli_fetch_array($sql_edit);
                            ?>
                            <tr>
                                <td style="text-align: center;"><?= $no++ ?></td>
                                <td style="text-align: center;">

                                    <!-- button edit modal -->
                                    <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#modalEdit<?= $item['id'] ?>">
                                        <span class="feather icon-edit-1 text-primary"></span>
                                    </button>
                                    <!-- edit modal -->
                                    <div class="modal fade" id="modalEdit<?= $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title text-primary" id="exampleModalLongTitle">Ubah Pertanyaan : <?= $dataEdit['pertanyaan'] ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="<?= base_url('desk/edit'); ?>" method="POST" class="formEdit">
                                                    <?php csrf_field() ?>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <input type="text" value="<?= $dataEdit['idx'] ?>" name="id" class="form-control" hidden>
                                                                <label class="text-primary">Pertanyaan</label>
                                                                <input type="text" value="<?= $dataEdit['pertanyaan'] ?>" name="desk" class="form-control deskEdit">
                                                                <div class="invalid-feedback errorDeskEdit"></div>
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
                                </td>
                                <td style="border-left: hidden;">
                                    <!-- button hapus modal-->
                                    <a href="<?= base_url('desk/hapus/' . $item['id']); ?>" class="hapusDesk">
                                        <span class="feather icon-trash-2 text-danger"></span>
                                    </a>
                                </td>
                                <!-- ISI VIEW -->
                                <td><?= $item['pertanyaan'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT AJAX -->
<script>
    $(document).ready(function() {
        // function edit
        $('.formEdit').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnEdit').attr('disable', 'disabled');
                    $('.btnEdit').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnEdit').removeAttr('disable', 'disabled');
                    $('.btnEdit').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.desk) {
                            $('.deskEdit').addClass('is-invalid');
                            $('.errorDeskEdit').html(response.error.desk);
                        } else {
                            $('.deskEdit').removeClass('is-invalid');
                            $('.errorDeskEdit').html('');
                        }

                    } else {
                        if (response.status == 'gagal') {
                            Swal.fire({
                                icon: 'error',
                                title: 'GAGAL',
                                text: response.sukses,
                            })
                        } else if (response.status == 'berhasil') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            });
                        }
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        $('#result').html(response.data);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        });
        //  function tambah
        $('.tambahDesk').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
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
                        if (response.error.desk) {
                            $('.desk').addClass('is-invalid');
                            $('.errorDesk').html(response.error.desk);
                        } else {
                            $('.desk').removeClass('is-invalid');
                            $('.errorDesk').html('');
                        }

                    } else {
                        if (response.status == 'gagal') {
                            Swal.fire({
                                icon: 'error',
                                title: 'GAGAL',
                                text: response.sukses,
                            })
                        } else if (response.status == 'berhasil') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response.sukses,
                            });
                        }
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        $('#result').html(response.data);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        });

        //  function hapus
        $('.hapusDesk').on('click', function(e) {
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