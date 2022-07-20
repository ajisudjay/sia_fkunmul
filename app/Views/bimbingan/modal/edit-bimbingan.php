<div class="modal fade" id="modalEditBimbingan" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Bimbingan Akademik</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('bimbingan/prosesEdit'); ?>" method="post" class="formEditBimbingan">
                <div class="modal-body">
                    <label class="font-weight-bold">Nama</label>
                    <p><?= $mahasiswa['nama_mahasiswa'] ?></p>
                    <input type="text" name="id" value="<?= $mahasiswa['id_mahasiswa'] ?>" hidden>
                    <input type="text" name="id_ps" value="<?= $id_ps ?>" hidden>
                    <input type="text" name="id_angkatan" value="<?= $mahasiswa['id_angkatan'] ?>" hidden>
                    <hr>
                    <label class="font-weight-bold">Pembimbing Akademik</label>
                    <br>
                    <select name="id_pa" id="" class="form-control select-dosen" style="height: 520px;">
                        <option value="<?= $mahasiswa['id_pa'] ?>"><?= $mahasiswa['nama_dosen'] ?></option>
                        <?php foreach ($dosen as $data) : ?>
                            <option value="<?= $data['id'] ?>"><?= $data['nama_dosen'] ?></option>
                        <?php endforeach ?>
                    </select>
                    <hr>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btnEdit btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select-dosen').select2({
            dropdownParent: $(".modal-body"),
            theme: "classic",
            placeholder: '-- Pilih Dosen --',
            allowClear: true
        });

        $('.formEditBimbingan').submit(function(e) {
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
                    Swal.fire({
                        icon: 'success',
                        title: 'berhasil',
                        text: response.sukses,
                    });
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $(".result").html(response.data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        });
    });
</script>