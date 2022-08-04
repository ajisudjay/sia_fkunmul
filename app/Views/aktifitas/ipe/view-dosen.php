<!-- VIEW-->
<div class="dt-responsive table-responsive mt-3">
    <table id="basic-row-reorder" class="table table-striped table-bordered nowrap">
        <thead>
            <tr>
                <td>No</td>
                <td>Status</td>
                <td>Aksi</td>
                <td>Jenis</td>
                <td>NIM</td>
                <td>Angkatan</td>
                <td>Nama</td>
                <td>Program Studi</td>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1 ?>
            <?php foreach ($aktifitas as $item) :
                $id_aktifitas = $item['id_aktifitas'];
                $ta = $item['id_tahun_ajaran'];
                $id_user = session()->get('id_user');
                $nimHash = base64_encode($item['nim']);
                // $id_ta = base64_encode('@49innqwj//;-' . $ta . '');
            ?>
                <tr>
                    <td style="text-align: center;width: 5%;"><?= $no++ ?></td>
                    <td style="width: 10%;">
                        <?php if ($item['status_aktifitas'] == 'new') { ?>
                            <blink>
                                <span class="badge badge-danger"> Aktifitas Baru</span>
                            </blink>
                        <?php } ?>
                        <?php $sql_aktifitas_count = mysqli_query($koneksi, "SELECT *, COUNT(feedback) as jumlah FROM feedbackaktifitas WHERE id_aktifitas='$id_aktifitas' AND status='new' AND penerima=$id_user");
                        while ($item_count = mysqli_fetch_array($sql_aktifitas_count)) {
                            if ($item_count['jumlah'] > 0) { ?>
                                <blink>
                                    <span class="badge badge-danger"><?= $item_count['jumlah'] ?> Feedback Baru</span>
                                </blink>
                            <?php } else { ?>
                                <?php $sql_aktifitas_jumlah = mysqli_query($koneksi, "SELECT COUNT(feedback) as jumlah FROM feedbackaktifitas WHERE id_aktifitas='$id_aktifitas'");
                                while ($item_jumlah = mysqli_fetch_array($sql_aktifitas_jumlah)) { ?>
                                    <span class="badge badge-primary"><?= $item_jumlah['jumlah'] ?> Feedback</span>
                                <?php } ?>
                            <?php  } ?>
                        <?php  } ?>
                    </td>
                    <td style="width: 6%;">
                        <a href="#" class="badge badge-inverse-success" onclick="modalFeedback('<?= $item['id_aktifitas'] ?>')">
                            <span class="font-weight-bold fa fa-comment"> Feedback</span>
                        </a>
                        <a href="#" class="ml-2 badge badge-inverse-info" onclick="modalDetail('<?= $item['id_aktifitas'] ?>')">
                            <span class="text-purple font-weight-bold fa fa-eye"> Detail</span>
                        </a>
                    </td>
                    <!-- ISI VIEW -->
                    <td style="width: 5%;"><?= $item['jenis'] ?></td>
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
    function modalFeedback(id_aktifitas) {
        $.ajax({
            type: "post",
            url: "<?= base_url('aktifitas/ipeModalFeedbackDosen') ?>",
            dataType: "JSON",
            data: {
                id_aktifitas: id_aktifitas,
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
            url: "<?= base_url('aktifitas/ipeModalAktifitasDosen') ?>",
            dataType: "JSON",
            data: {
                id_aktifitas: id_aktifitas,
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