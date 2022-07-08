<div class="modal fade" id="modalEdit" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="background-color: #5F7161; height:600px">
            <div class="modal-header">
                <h5 class="modal-title" style="color:aliceblue" id="exampleModalLongTitle">Edit Monitoring</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('monitoring/prosesEdit'); ?>" method="post" class="formEditMonitoring">
                <?php csrf_field() ?>
                <div class="modal-body">
                    <label style="color:aliceblue" for="">Pertemuan</label>
                    <select name="pertemuan" class="select-pertemuan form-control">
                        <option><?= $monitoring['pertemuan'] ?></option>
                        <?php for ($i = 1; $i <= 16; $i++) { ?>
                            <option><?= $i ?></option>
                        <?php } ?>
                    </select>
                    <label style="color:aliceblue" for="" class="mt-2">Tanggal Realisasi</label>
                    <input type="date" class="form-control" name="tanggal_realisasi" value="<?= $monitoring['tanggal_realisasi'] ?>" id="">
                    <label style="color:aliceblue" for="" class="mt-2">Jam Realisasi</label>
                    <input type="time" class="form-control" name="jam_realisasi" value="<?= $monitoring['jam_realisasi'] ?>" id="">
                    <label style="color:aliceblue" for="" class="mt-2">Dosen</label>
                    <select name="id_dosen" class="select-dosen-edit">
                        <option><?= $monitoring['nama_dosen'] ?></option>
                        <?php foreach ($dosen as $dataDosen) : ?>
                            <option value="<?= $dataDosen['id'] ?>"><?= $dataDosen['nama_dosen'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="modal-footer" style="margin-top: 150px;">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select-dosen-edit').select2({
            dropdownParent: $(".modal-body"),
            theme: "classic",
            placeholder: '-- Pilih Dosen --',
            allowClear: true
        });
    });

    $(".formEditMonitoring").submit(function(e) {
        e.preventDefault(); //Prevent Default action.
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnInput').attr('disable', 'disabled');
                $('.btnInput').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.btnInput').removeAttr('disable', 'disabled');
                $('.btnInput').html('Tampilkan');
            },
            success: function(response) {
                $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();
                $('.modalEditView').html(response.sukses).hide();
                $('#modalEdit').modal('hide');
                Swal.fire({
                    icon: 'success',
                    title: 'berhasil',
                    customClass: 'animated bounceIn',
                    text: response.sukses,
                });
                $("#result").html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>