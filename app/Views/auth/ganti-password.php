<!-- Modal Ganti Password -->
<div class="modal fade" id="gantiPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ubah Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('auth/ubahPassword'); ?>" method="post" class="formGantiPassword">
                <div class="modal-body">
                    <?php csrf_field() ?>
                    <input type="text" name="id" value="<?= $user['id'] ?>" id="" hidden>
                    <input type="text" name="password" value="<?= $user['password'] ?>" id="" hidden>
                    <Label class="font-weight-bold mb-2">Password Lama</Label>
                    <input type="password" name="password_lama" class="form-control" id="">
                    <span style="font-size: 10px;" class="text-danger errorpassword_lama"></span>
                    <br>
                    <Label class="font-weight-bold mb-2">Password Baru</Label>
                    <input type="password" name="password_baru" class="form-control" id="">
                    <span style="font-size: 10px;" class="text-danger errorpassword_baru"></span>
                    <br>
                    <Label class="font-weight-bold mb-2">Konfirmasi Password</Label>
                    <input type="password" name="konfirmasi_password" class="konfirmasi_password form-control" id="">
                    <span style="font-size: 10px;" class="text-danger errorkonfirmasi_password"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btnSimpan btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(".formGantiPassword").submit(function(e) {
        e.preventDefault(); //Prevent Default action.
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
                    if (response.error.password_lama) {
                        $('.password_lama').addClass('is-invalid');
                        $('.errorpassword_lama').html(response.error.password_lama);
                    } else {
                        $('.password_lama').removeClass('is-invalid');
                        $('.errorpassword_lama').html('');
                    }

                    if (response.error.password_baru) {
                        $('.password_baru').addClass('is-invalid');
                        $('.errorpassword_baru').html(response.error.password_baru);
                    } else {
                        $('.password_baru').removeClass('is-invalid');
                        $('.errorpassword_baru').html('');
                    }

                    if (response.error.konfirmasi_password) {
                        $('.konfirmasi_password').addClass('is-invalid');
                        $('.errorkonfirmasi_password').html(response.error.konfirmasi_password);
                    } else {
                        $('.konfirmasi_password').removeClass('is-invalid');
                        $('.errorkonfirmasi_password').html('');
                    }
                } else {
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $('.modalGantiPasswordView').html(response.sukses).hide();
                    $('#gantiPassword').modal('hide');
                    Swal.fire({
                        title: 'Berhasil',
                        text: response.sukses,
                        icon: 'success',
                        type: "success",
                    })
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>