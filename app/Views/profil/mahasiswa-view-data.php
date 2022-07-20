<form action="<?= base_url('profil/prosesEditMahasiswa'); ?>" method="post" class="j-pro formEdit">
    <!-- end /.header-->
    <div class="j-content">
        <div class="row">
            <div class="col-lg-6">
                <!-- profil Foto -->
                <label class="j-label mb-2">Foto Profil</label>
                <div class="card">
                    <div class="card-block user-radial-card">
                        <div data-label="50%" class="radial-bar radial-bar-90 radial-bar-lg radial-bar-danger">
                            <img src="<?= $mahasiswa['foto'] == null ? base_url('assets/images/auth/no-image.png') : base_url('assets/images/user-profile/' . $mahasiswa['foto'] . '') ?>" alt="User-Image" style="width:285px; height:285px">
                        </div>
                        <button type="button" class="btn btn-warning mt-4" data-toggle="modal" data-target="#modalProfil">
                            <i class="feather icon-users"></i> Ganti Foto Profil
                        </button>

                    </div>
                </div>
                <!-- end profil Foto -->
            </div>
            <div class="col-lg-6">
                <!-- start name -->
                <input type="text" class="" placeholder="" value="<?= $mahasiswa['nim'] ?>" id="nim" name="nim" hidden>
                <input type="text" class="" placeholder="" value="<?= $mahasiswa['foto'] ?>" id="nama_file_lama" name="nama_file_lama" hidden>
                <div class="j-unit">
                    <label class="j-label">Nama Lengkap</label>
                    <div class="j-input">
                        <label class="j-icon-right" for="name">
                            <i class="icofont icofont-ui-user"></i>
                        </label>
                        <input type="text" class="" placeholder="" value="<?= $mahasiswa['nama_mahasiswa'] ?>" id="nama" name="nama">
                        <div style="font-size: 12px;margin-top:7px" class="text-danger errornama"></div>
                    </div>
                </div>
                <!-- end name -->
                <!-- start email -->
                <div class="j-unit">
                    <label class="j-label">Email</label>
                    <div class="j-input">
                        <label class="j-icon-right" for="email">
                            <i class="icofont icofont-envelope"></i>
                        </label>
                        <input type="email" placeholder="" value="<?= $mahasiswa['email'] ?>" id="email" name="email">
                    </div>
                    <div style="font-size: 12px;margin-top:7px" class="text-danger erroremail"></div>
                </div>
                <!-- end email -->
                <!-- start phone -->
                <div class="j-unit">
                    <label class="j-label">Telepon</label>
                    <div class="j-input">
                        <label class="j-icon-right" for="phone">
                            <i class="icofont icofont-phone"></i>
                        </label>
                        <input type="text" placeholder="" value="<?= $mahasiswa['telepon'] ?>" id="telepon" name="telepon">
                    </div>
                    <div style="font-size: 12px;margin-top:7px" class="text-danger errortelepon"></div>
                </div>
                <!-- end phone -->
                <!-- start textarea -->
                <div class="j-unit">
                    <label class="j-label">Alamat</label>
                    <div class="j-input">
                        <textarea placeholder="" spellcheck="false" id="alamat" name="alamat"><?= $mahasiswa['alamat'] ?></textarea>
                    </div>
                    <div style="font-size: 12px;margin-top:7px" class="text-danger erroralamat"></div>
                </div>
                <!-- end textarea -->
            </div>
        </div>
        <!-- start response from server -->
        <div class="j-response"></div>
        <div class="j-unit col-lg-6">
            <!-- end response from server -->
            <button type="submit" class="btnSimpan btn btn-primary">Simpan</button>
        </div>
    </div>
</form>

<div class="modal fade" id="modalProfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="j-unit">
                    <label class="j-label">Foto profil</label>
                    <div class="j-input">
                        <input type="file" name="file" id="file" class="form-control" onchange="previewImg()">
                    </div>
                    <div style="font-size: 12px;margin-top:7px" class="text-danger errortelepon"></div>
                </div>
                <label class="mb-2 mt-2 custom-file-label j-label" for="customFile">Preview</label>
                <div style="font-size: 12px;margin-top:7px" class="text-danger errorfile"></div>
                <div class="container">
                    <img src="<?= $mahasiswa['foto'] == null ? base_url('assets/images/auth/no-image.png') : base_url('assets/images/user-profile/' . $mahasiswa['foto'] . '') ?>" class="img-preview" style="border-radius: 20px; width:250px; height:250px">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="formEditFoto btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>

<script>
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

    $(document).ready(function() {
        $(".formEdit").submit(function(e) {
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
                        if (response.error.nama) {
                            $('.nama').addClass('is-invalid');
                            $('.errornama').html(response.error.nama);
                        } else {
                            $('.nama').removeClass('is-invalid');
                            $('.errornama').html('');
                        }

                        if (response.error.email) {
                            $('.email').addClass('is-invalid');
                            $('.erroremail').html(response.error.email);
                        } else {
                            $('.email').removeClass('is-invalid');
                            $('.erroremail').html('');
                        }

                        if (response.error.alamat) {
                            $('.alamat').addClass('is-invalid');
                            $('.erroralamat').html(response.error.alamat);
                        } else {
                            $('.alamat').removeClass('is-invalid');
                            $('.erroralamat').html('');
                        }

                        if (response.error.telepon) {
                            $('.telepon').addClass('is-invalid');
                            $('.errortelepon').html(response.error.telepon);
                        } else {
                            $('.telepon').removeClass('is-invalid');
                            $('.errortelepon').html('');
                        }
                    } else {
                        Swal.fire({
                            title: 'Berhasil',
                            text: response.sukses,
                            icon: 'success',
                            type: "success",
                        })
                        $(".result").html(response.data);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });

        $(".formEditFoto").click(function(e) {
            e.preventDefault(); //Prevent Default action.
            var nama = $('#nama').val();
            var nim = $('#nim').val();
            var email = $('#email').val();
            var telepon = $('#telepon').val();
            var alamat = $('#alamat').val();
            var files = $('#file')[0].files;
            var fd = new FormData();

            fd.append('file', files[0]);
            fd.append('nama', nama);
            fd.append('email', email);
            fd.append('telepon', telepon);
            fd.append('alamat', alamat);
            fd.append('nim', nim);

            $.ajax({
                type: "post",
                url: '<?= base_url('profil/prosesEditFotoMahasiswa') ?>',
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
                        if (response.error.file) {
                            $('.file').addClass('is-invalid');
                            $('.errorfile').html(response.error.file);
                        } else {
                            $('.file').removeClass('is-invalid');
                            $('.errorfile').html('');
                        }
                    } else {
                        Swal.fire({
                            title: 'Berhasil',
                            text: response.sukses,
                            icon: 'success',
                            type: "success",
                        })
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                        $(".result").html(response.data);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            });
        });
    });
</script>