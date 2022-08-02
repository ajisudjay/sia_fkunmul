<!-- VIEW-->
<div class="dt-responsive table-responsive mt-3">
    <table id="basic-row-reorder" class="table table-striped table-bordered nowrap">
        <thead>
            <tr>
                <td>No</td>
                <td>Aksi</td>
                <td>NIM</td>
                <td>Angkatan</td>
                <td>Nama</td>
                <td>Program Studi</td>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1 ?>
            <?php foreach ($aktifitas as $item) :
                $id = $item['id_aktifitas'];
                $nimHash = base64_encode($item['nim']);
                // $id_ta = base64_encode('@49innqwj//;-' . $id_tahun_ajaran . '')
            ?>
                <tr>
                    <td style="text-align: center;width: 5%;"><?= $no++ ?></td>
                    <td style="width: 6%;">
                        <a href="<?= base_url('/detail-aktifitas-dosen/' . $nimHash . ''); ?>" class="badge badge-inverse-info">
                            <span class="icofont icofont-info-circle" style="font-size: 11px;font-weight:bold; text-align:center"> Detail</span>
                        </a>
                        <a href="#" class="badge badge-inverse-warning">
                            <span class="icofont icofont-chart-bar-graph ml-2" style="font-size: 11px;font-weight:bold; text-align:center" onclick="modalGrafik('<?= $id ?>')"> Rekap</span>
                        </a>
                    </td>
                    <!-- ISI VIEW -->
                    <td style="width: 10%;"><?= $item['nim'] ?></td>
                    <td style="width: 5%;"><?= $item['angkatan'] ?></td>
                    <td><?= $item['nama_mahasiswa'] ?></td>
                    <td><?= $item['program_studi'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<div class="modalInputView" style="display: none;"></div>
<div class="modalViewData" style="display: none;"></div>
<div class="modalDetailGrafik" style="display: none;"></div>
<!-- SCRIPT AJAX -->
<script>
    function modalInput() {
        $.ajax({
            type: "post",
            url: "<?= base_url('aktifitas/modalInput') ?>",
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

    function modalGrafik(id) {
        $.ajax({
            type: "post",
            url: "<?= base_url('aktifitas/modalGrafik') ?>",
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(response) {
                if (response.sukses) {
                    $('.modalDetailGrafik').html(response.sukses).show();
                    $('#modalGrafikAktifitas').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    $(document).ready(function() {
        $('.modalView').submit(function(e) {
            e.preventDefault(e);
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        $('.modalViewData').html(response.sukses).show();
                        $('#modalView').modal('show');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        })
    })
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