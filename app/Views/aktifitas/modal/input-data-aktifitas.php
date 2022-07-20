<!-- tambah modal-->
<div class="modal fade" id="modalInputAktifitas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="min-width: 80%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Aktifitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('aktifitas/tambah'); ?>" method="post" enctype="multipart/form-data">
                <?php csrf_field() ?>
                <div class="modal-body">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <label class="font-weight-bold mt-3 text-primary">Modul</label>
                                <select required class="form-control id_modul" name="id_modul" id="id_modul">
                                    <option value=""></option>
                                    <?php foreach ($matakuliah as $data) : ?>
                                        <option value="<?= $data['id'] ?>"><?= $data['mata_kuliah'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback errorid_modul"></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="font-weight-bold mt-3 text-primary">Kegiatan</label>
                                <select required class="form-control kegiatan" name="kegiatan" id="kegiatan">
                                    <option value=""></option>
                                    <?php foreach ($kegiatan as $data) : ?>
                                        <option value="<?= $data['id'] ?>"><?= $data['kegiatan'] ?></option>
                                    <?php endforeach ?>
                                </select>
                                <div class="invalid-feedback errorKegiatan"></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="font-weight-bold mt-3 text-primary">Tanggal</label>
                                <input required type="date" name="tanggal" class="form-control tanggal" id="tanggal">
                                <div class="invalid-feedback errorTanggal"></div>
                            </div>
                            <div class="col-lg-3">
                                <label class="font-weight-bold mt-3 text-primary">File Bukti</label><br>
                                <div class="j-input">
                                    <input required type="file" name="file" id="file" class="form-control" accept=".pdf">
                                </div>
                                <div class="invalid-feedback errorfile"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="font-weight-bold mt-3 text-primary">Judul</label>
                                <textarea name="judul" id="" cols="30" rows="2" class="form-control judul"></textarea>
                                <div class="invalid-feedback errorJudul"></div>
                                <div class="row">
                                    <div class="col">
                                        <label class="font-weight-bold mt-3 text-primary">Tahun Ajaran</label><br>
                                        <select name="id_tahun_ajaran" class="form-control" id="">
                                            <option value=""></option>
                                            <?php foreach ($tahunajaran as $item) : ?>
                                                <option value="<?= $item['id'] ?>"><?= $item['tahun_ajaran'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label class="font-weight-bold mt-3 text-primary">Gambaran Umum Aktifitas</label>
                                <textarea required name="deskripsi_awal" id="" cols="30" rows="7" class="form-control deskripsi_awal judul"></textarea>
                                <div class="invalid-feedback errordeskripsi_awal"></div>
                            </div>
                        </div>
                        <hr>
                        <label class="font-weight-bold mb-2 mt-2 j-label text-primary">Deskripsi</label>
                        <hr>
                        <div class="row">
                            <?php foreach ($deskripsiaktifitas as $data) : ?>
                                <div class="col-lg-4">
                                    <label class="font-weight-bold text-bold mt-2">- <?= $data['pertanyaan'] ?></label>
                                    <input required type="text" name="id_deskripsi_aktifitas" value="<?= $data['id'] ?>" hidden>
                                    <textarea name="deskripsi[]" id="deskripsi" class="form-control" cols="30" rows="5" required></textarea>
                                </div>
                            <?php endforeach ?>
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
    $('.tambahAktifitas').click(function() {
        var id_modul = $('#id_modul').val();
        var kegiatan = $('#kegiatan').val();
        var tanggal = $('#tanggal').val();
        var judul = $('#judul').val();
        var deskripsi = $('#deskripsi').val();
        var files = $('#file')[0].files;
        var fd = new FormData();

        fd.append('file', files[0]);
        fd.append('id_modul', id_modul);
        fd.append('kegiatan', kegiatan);
        fd.append('tanggal', tanggal);
        fd.append('judul', judul);
        fd.append('deskripsi', deskripsi);

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
                    if (response.error.file) {
                        $('.file').addClass('is-invalid');
                        $('.errorfile').html(response.error.file);
                    } else {
                        $('.file').removeClass('is-invalid');
                        $('.errorfile').html('');
                    }
                } else {
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $('#result').html(response.data);
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: response.sukses,
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    });
</script>