<hr>
<!-- Button trigger modal -->
<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter" onclick="modalInput()">
    Input Monitoring
</button>
<hr>
<div class="table-responsive">
    <table class="table">
        <tr style="font-weight: bold;font-size:15px;font-style: italic;">
            <td>No</td>
            <td>Matakuliah</td>
            <td>Kelas</td>
            <td>Aksi</td>
            <td>Keterangan</td>
        </tr>
        <?php $no = 1 ?>
        <?php foreach ($monitoring as $dataMonitoring) : ?>
            <tr>
                <td style="width: 10px;"><?= $no++ ?></td>
                <td><?= $dataMonitoring['mata_kuliah'] ?></td>
                <td><?= $dataMonitoring['kelas'] ?></td>
                <td>
                    <form action="<?= base_url('monitoring/modalView'); ?>" method="post" class="modalView d-inline">
                        <button type="submit" class="bg-transparent border-0">
                            <span class=" icofont icofont-file-text text-primary"></span>
                        </button>
                        <input hidden type="text" value="<?= $dataMonitoring['id_kelas'] ?>" name="id_kelas">
                        <input hidden type="text" value="<?= $dataMonitoring['id_matakuliah'] ?>" name="id_matakuliah">
                        <input hidden type="text" value="<?= $id_ps ?>" name="id_ps">
                        <input hidden type="text" value="<?= $id_semester ?>" name="id_ta">
                        <input hidden type="text" value="<?= $id_fak ?>" name="id_fak">
                    </form>
                    <span class="icofont icofont-printer text-warning"></span>
                </td>
                <td>Keterangan</td>
            </tr>
        <?php endforeach ?>
    </table>
</div>
<div class="modalInputView" style="display: none;"></div>
<div class="modalViewData" style="display: none;"></div>

<script>
    function modalInput() {
        $.ajax({
            type: "post",
            url: "<?= base_url('monitoring/modalInput') ?>",
            dataType: "JSON",
            data: {
                id_fak: <?php echo $id_fak ?>,
                id_ps: <?php echo $id_ps ?>,
                id_semester: <?php echo $id_semester ?>
            },
            success: function(response) {
                if (response.sukses) {
                    $('.modalInputView').html(response.sukses).show();
                    $('#modalInput').modal('show');
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
</script>