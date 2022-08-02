<?php if ($id_tahun_ajaran != null) { ?>
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
    <button type="button" class="btn btn-primary" onclick="modalInput()" style="border-radius: 5px;">
        <span class="fa fa-plus-circle text-light"> Aktifitas Baru</span>
    </button>
    <!-- VIEW-->
    <div class="dt-responsive table-responsive mt-3">
        <table id="basic-row-reorder" class="table table-striped table-bordered nowrap">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Status</td>
                    <td>Aksi</td>
                    <td>Tanggal</td>
                    <td>Jenis</td>
                    <td>Kompetensi</td>
                    <td>Sub Kompetensi</td>
                    <td>Judul</td>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ?>
                <?php foreach ($aktifitas as $item) :
                    $id = $item['id_aktifitas'];
                    $id_user = session()->get('id_user') ?>
                    <tr>
                        <td style="text-align: center;"><?= $no++ ?></td>
                        <td>
                            <?php $sql_aktifitas_count = mysqli_query($koneksi, "SELECT *, COUNT(feedback) as jumlah FROM feedbackaktifitas WHERE id_aktifitas='$id' AND status='new' AND penerima=$id_user");
                            while ($item_count = mysqli_fetch_array($sql_aktifitas_count)) {
                                if ($item_count['jumlah'] > 0) { ?>
                                    <div class="blink">
                                        <blink>
                                            <span class="badge badge-danger"><?= $item_count['jumlah'] ?> Feedback Baru</span>
                                        </blink>
                                    </div>
                                <?php } else { ?>
                                    <?php $sql_aktifitas_jumlah = mysqli_query($koneksi, "SELECT COUNT(feedback) as jumlah FROM feedbackaktifitas WHERE id_aktifitas='$id'");
                                    while ($item_jumlah = mysqli_fetch_array($sql_aktifitas_jumlah)) { ?>
                                        <span class="badge badge-primary"><?= $item_jumlah['jumlah'] ?> Feedback</span>
                                    <?php } ?>
                                <?php  } ?>
                            <?php  } ?>
                        </td>
                        <td>
                            <button type="button" class="bg-transparent border-0" onclick="modalDetail('<?= $item['slug_aktifitas'] ?>')">
                                <span class="ml-2 icofont icofont-info-circle text-success"></span>
                            </button>
                            <!-- <button type="button" class="bg-transparent border-0" onclick="modalFeedback('<?= $item['slug_aktifitas'] ?>')">
                            <span class="icofont icofont-comment text-info"></span>
                        </button> -->
                            <button type="button" class="bg-transparent border-0" onclick="modalEdit('<?= $item['slug_aktifitas'] ?>')">
                                <span class="icofont icofont-ui-edit text-warning"></span>
                            </button>
                            <a href="<?= base_url('aktifitas/hapusMahasiswa'); ?>" data-file="<?= $item['file_bukti'] ?>" data-id="<?= $item['id_aktifitas'] ?>" class="bg-transparent border-0 btnHapus">
                                <span class="icofont icofont-ui-delete text-danger"></span>
                            </a>
                        </td>
                        <!-- ISI VIEW -->
                        <td><?= date('d-m-Y', strtotime($item['tanggal'])) ?></td>
                        <td><?= $item['jenis'] ?></td>
                        <td><?= $item['data_kompetensi'] ?></td>
                        <td><?= $item['sub_kompetensi'] ?></td>
                        <td><?= $item['judul'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <hr>
    <hr>
    <figure class="highcharts-figure mt-5">
        <div id="container"></div>
        <div class="highcharts-description mt-4">
            <div class="container">
                <?php foreach ($sqlkompetensi as $itemKompetensi) : ?>
                    <table class="mt-3">
                        <tr>
                            <td style="width: 400px;">
                                <p class="alert alert-primary col-lg-4 d-inline" style="margin-bottom:10px"><?= $itemKompetensi['data_kompetensi'] ?></p>
                            </td>
                            <td>
                                <span class="text-primary"><?= $itemKompetensi['jumlah'] ?></span>
                            </td>
                        </tr>
                    </table>
                    <?php foreach ($sqlcount as $dataCount) : ?>
                        <?php if ($dataCount['kompetensi'] == $itemKompetensi['id_kompetensi']) { ?>
                            <table class="mt-3">
                                <tr>
                                    <td style="width: 400px;"><?= $dataCount['sub_kompetensi'] ?></td>
                                    <td><?= $dataCount['jumlah'] ?></td>
                                </tr>
                            </table>
                        <?php } ?>
                    <?php endforeach ?>
                    <hr>
                <?php endforeach ?>
            </div>
        </div>
    </figure>

<?php } ?>
<div class="modalInputView" style="display: none;"></div>
<div class="modalViewData" style="display: none;"></div>
<div class="modalViewEdit" style="display: none;"></div>
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
                    $('#modalDetailAktifitas').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    function modalEdit(slug_aktifitas) {
        $.ajax({
            type: "post",
            url: "<?= base_url('aktifitas/modalEditMahasiswa') ?>",
            dataType: "JSON",
            data: {
                slug_aktifitas: slug_aktifitas
            },
            success: function(response) {
                if (response.sukses) {
                    $('.modalViewEdit').html(response.sukses).show();
                    $('#modalEditAktifitas').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }

    $('.btnHapus').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href')
        const id = $(this).attr('data-id')
        const file_bukti = $(this).attr('data-file')
        Swal.fire({
            title: 'Anda Yakin?',
            text: "Anda akan menghapus aktifitas ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Konfirmasi!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: "<?= base_url('aktifitas/hapusMahasiswa') ?>",
                    dataType: "JSON",
                    data: {
                        id: id,
                        file_bukti: file_bukti
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Aktifitas Berhasil dihapus!',
                            showConfirmButton: false,
                        })
                        setTimeout(function() {
                            if (response.status = 'berhasil') {
                                window.location.reload();
                            }
                        }, 1500);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                    }
                });
            }
        })
    })
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


<script>
    Highcharts.chart('container', {
        title: {
            text: 'Pencapaian Kompetensi'
        },
        xAxis: {
            categories: [<?= $jumlahsub ?>]
        },
        labels: {
            items: [{
                html: '',
                style: {
                    left: '50px',
                    top: '18px',
                    color: ( // theme
                        Highcharts.defaultOptions.title.style &&
                        Highcharts.defaultOptions.title.style.color
                    ) || 'black'
                }
            }]
        },
        series: [{
            type: 'column',
            name: 'Sub Kompetensi',
            data: [<?= $jumlah ?>]
        }, {
            type: 'spline',
            name: 'Progress',
            data: [<?= $jumlah ?>],
            marker: {
                lineWidth: 2,
                lineColor: Highcharts.getOptions().colors[3],
                fillColor: 'white'
            }
        }, ]
    });
</script>