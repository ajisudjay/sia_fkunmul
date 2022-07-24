<hr>
<!-- button tambah modal -->
<?php if (!empty(session()->getFlashdata('error'))) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h4>Periksa Entrian Form</h4>
        </hr />
        <?php echo session()->getFlashdata('error'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<button type="button" class="btn btn-primary" onclick="modalInput()">
    <span class=" fa fa-plus-circle text-light"> Aktifitas Baru</span>
</button>

<!-- VIEW-->
<div class="dt-responsive table-responsive mt-3">
    <table id="basic-row-reorder" class="table table-striped table-bordered nowrap">
        <thead>
            <tr>
                <td>No</td>
                <td>Status</td>
                <td>Aksi</td>
                <td>Modul</td>
                <td>Tanggal</td>
                <td>Matakuliah</td>
                <td>Kegiatan</td>
                <td>Judul</td>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1 ?>
            <?php $sql_aktifitas = mysqli_query($koneksi, "SELECT *, aktifitas.id as id_aktifitas FROM aktifitas JOIN kegiatans ON kegiatans.id=aktifitas.id_kegiatan JOIN matakuliahs ON matakuliahs.id=aktifitas.id_matakuliahs JOIN mahasiswas ON mahasiswas.id_mahasiswa=aktifitas.id_mahasiswa_aktifitas WHERE mahasiswas.nim='$nim' ORDER BY id_aktifitas DESC");
            while ($item = mysqli_fetch_array($sql_aktifitas)) {
                $id = $item['id_aktifitas'];
                $id_user = session()->get('id_user') ?>
                <tr>
                    <td style="text-align: center;"><?= $no++ ?></td>
                    <td>
                        <?php if ($feedbackaktifitas['id_aktifitas'] == $id && $feedbackaktifitas['penerima'] == $id_user) { ?>
                            <div class="blink">
                                <blink>
                                    <span class="badge badge-danger">Feedback Baru</span>
                                </blink>
                            </div>
                        <?php } ?>
                    </td>
                    <td>
                        <button type="button" class="bg-transparent border-0" onclick="modalDetail('<?= $item['slug_aktifitas'] ?>')">
                            <span class="ml-2 fa fa-info text-warning"></span>
                        </button>
                        <button type="button" class="bg-transparent border-0" onclick="modalFeedback('<?= $item['slug_aktifitas'] ?>')">
                            <span class="fa fa-comments text-info"></span>
                        </button>

                    </td>
                    <!-- ISI VIEW -->
                    <td style="text-align: center;"><?= $item['id_modul'] ?></td>
                    <td><?= date('d-m-Y', strtotime($item['tanggal'])) ?></td>
                    <td><?= $item['mata_kuliah'] ?></td>
                    <td><?= $item['kegiatan'] ?></td>
                    <td><?= $item['judul'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<div class="modalInputView" style="display: none;"></div>
<div class="modalViewData" style="display: none;"></div>
<!-- <div class="modalViewFeedback" style="display: none;"></div> -->
<!-- SCRIPT AJAX -->
<script>
    function modalInput() {
        $.ajax({
            type: "post",
            url: "<?= base_url('aktifitas/modalInputMahasiswa') ?>",
            dataType: "JSON",
            success: function(response) {
                if (response.sukses) {
                    $('.modalInputView').html(response.sukses).show();
                    $('#modalInputAktifitas').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function modalDetail(slug_aktifitas) {
        $.ajax({
            type: "post",
            url: "<?= base_url('aktifitas/modalDetailMahasiswa') ?>",
            dataType: "JSON",
            data: {
                slug_aktifitas: slug_aktifitas
            },
            success: function(response) {
                if (response.sukses) {
                    $('.modalViewData').html(response.sukses).show();
                    $('#modalInputAktifitas').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    // function modalFeedback(slug_aktifitas) {
    //     $.ajax({
    //         type: "post",
    //         url: "<?= base_url('aktifitas/modalFeedbackMahasiswa') ?>",
    //         dataType: "JSON",
    //         data: {
    //             slug_aktifitas: slug_aktifitas
    //         },
    //         success: function(response) {
    //             if (response.sukses) {
    //                 $('.modalViewFeedback').html(response.sukses).show();
    //                 $('#modalFeedbackAktifitas').modal('show');
    //             }
    //         },
    //         error: function(xhr, ajaxOptions, thrownError) {
    //             alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    //         }
    //     });
    // }
    //percobaan upload
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
                        if (response.error.judul) {
                            $('.judulEdit').addClass('is-invalid');
                            $('.errorJudulEdit').html(response.error.judul);
                        } else {
                            $('.judulEdit').removeClass('is-invalid');
                            $('.errorJudulEdit').html('');
                        }

                        if (response.error.modul) {
                            $('.modulEdit').addClass('is-invalid');
                            $('.errorModulEdit').html(response.error.modul);
                        } else {
                            $('.modulEdit').removeClass('is-invalid');
                            $('.errorModulEdit').html('');
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
        $('.tambahAktifitas').click(function(e) {
            e.preventDefault();

            var id_modul = $('#id_modul').val();
            var kegiatan = $('#kegiatan').val();
            var tanggal = $('#tanggal').val();
            var judul = $('#judul').val();
            var files = $('#file')[0].files;
            var fd = new FormData();

            fd.append('file', files[0]);
            fd.append('id_modul', id_modul);
            fd.append('kegiatan', kegiatan);
            fd.append('tanggal', tanggal);
            fd.append('judul', judul);

            $.ajax({
                type: "post",
                url: '<?= base_url('aktifitas/tambah') ?>',
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
                        if (response.error.file_bukti) {
                            $('.file_bukti').addClass('is-invalid');
                            $('.errorFile_bukti').html(response.error.file_bukti);
                        } else {
                            $('.file_bukti').removeClass('is-invalid');
                            $('.errorFile_bukti').html('');
                        }
                    } else {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.sukses,
                        });
                    }
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $('#result').html(response.data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        });

        //  function isi 
        $('.formIsi').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnIsi').attr('disable', 'disabled');
                    $('.btnIsi').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnIsi').removeAttr('disable', 'disabled');
                    $('.btnIsi').html('Simpan');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.desk) {
                            $('.deskIsi').addClass('is-invalid');
                            $('.errorDeskIsi').html(response.error.desk);
                        } else {
                            $('.deskIsi').removeClass('is-invalid');
                            $('.errorDeskIsi').html('');
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
        $('.hapusUser').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnHapus').attr('disable', 'disabled');
                    $('.btnHapus').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnHapus').removeAttr('disable', 'disabled');
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'berhasil',
                        text: response.sukses,
                    });
                    $("#result").html(response.data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
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