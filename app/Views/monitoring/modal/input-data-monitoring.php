<!-- Modal -->
<div class="modal fade" id="modalInput" aria-labelledby="exampleModalCenterTitle">
    <div class="modal-dialog modal-dialog-centered" style="min-width: 80%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Input Monitoring</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-block" style="margin-top: -30px;">
                                <div class="j-wrapper">
                                    <form action="<?= base_url('monitoring/prosesInput'); ?>" method="post" class="j-pro formInputMonitoring">
                                        <input type="text" name="id_fak" value="<?= $fakultas['id'] ?>" hidden>
                                        <div class="j-content">
                                            <div class="row">
                                                <div class="col-lg-6 j-unit">
                                                    <div class="j-input">
                                                        <label class="j-icon-right" for="first_name">
                                                            <i class="icofont icofont-bank-alt"></i>
                                                        </label>
                                                        <input type="text" id="" name="" value="<?= $ps['program_studi'] ?>" readonly>
                                                        <input type="text" id="id_ps" name="id_ps" value="<?= $ps['id'] ?>" hidden>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 j-unit">
                                                    <div class="j-input">
                                                        <label class="j-icon-right" for="last_name">
                                                            <i class="icofont icofont-id-card"></i>
                                                        </label>
                                                        <input type="text" id="" name="" value="<?= $tahun_ajaran['tahun_ajaran'] ?>" readonly>
                                                        <input type="text" id="last_name" name="id_tahun_ajaran" value="<?= $tahun_ajaran['id'] ?>" hidden>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 j-unit">
                                                    <label class="j-label">Matakuliah</label>
                                                    <label class="">
                                                        <select name="id_matakuliah" class="select-matakuliah is-invalid">
                                                            <option value=""></option>
                                                            <?php foreach ($matakuliah as $dataMatakuliah) : ?>
                                                                <option value="<?= $dataMatakuliah['id'] ?>"><?= $dataMatakuliah['mata_kuliah'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </label>
                                                    <span class="text-danger error_id_matakuliah" style="font-size: 10px;margin-top:10px"></span>
                                                </div>
                                                <div class="col-lg-6 j-unit">
                                                    <label class="j-label">Dosen</label>
                                                    <label class="">
                                                        <select name="id_dosen" class="select-dosen">
                                                            <option value=""></option>
                                                            <?php foreach ($dosen as $dataDosen) : ?>
                                                                <option value="<?= $dataDosen['id'] ?>"><?= $dataDosen['nama_dosen'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </label>
                                                    <span class="text-danger error_id_dosen" style="font-size: 10px;margin-top:10px"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-4 j-unit">
                                                    <label class="j-label">Pertemuan</label>
                                                    <label class="">
                                                        <select name="pertemuan" class="select-pertemuan">
                                                            <option></option>
                                                            <?php for ($i = 1; $i <= 16; $i++) { ?>
                                                                <option><?= $i ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <i></i>
                                                        <span class="text-danger error_id_pertemuan" style="font-size: 10px;margin-top:10px"></span>
                                                        <span class="text-danger error_cek_pertemuan" style="font-size: 10px;margin-top:10px"></span>
                                                    </label>
                                                </div>
                                                <div class="col-lg-4 j-unit">
                                                    <label class="j-label">kelas</label>
                                                    <label class="">
                                                        <select name="id_kelas" class="select-kelas id_kelas">
                                                            <option value=""></option>
                                                            <?php foreach ($kelas as $datakelas) : ?>
                                                                <option value="<?= $datakelas['id'] ?>"><?= $datakelas['kelas'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                        <i></i>
                                                    </label>
                                                    <span class="text-danger error_id_kelas" style="font-size: 10px;margin-top:10px"></span>
                                                </div>
                                                <div class="col-lg-4 j-unit">
                                                    <label class="j-label">RPS</label>
                                                    <label class="">
                                                        <select name="rps" class="select-rps">
                                                            <option value=""></option>
                                                            <option>Sesuai</option>
                                                            <option>Tidak Sesuai</option>
                                                        </select>
                                                        <i></i>
                                                    </label>
                                                    <span class="text-danger error_rps" style="font-size: 10px;margin-top:10px"></span>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 j-unit">
                                                    <label class="j-label">Tanggal Jadwal</label>
                                                    <div class="j-input">
                                                        <label class="j-icon-right" for="email">
                                                            <i class="icofont icofont-ui-calendar"></i>
                                                        </label>
                                                        <input class="form-control tanggal_rencana" type="date" name="tanggal_rencana" style="height: 46px;">
                                                    </div>
                                                    <span class="text-danger error_tanggal_rencana" style="font-size: 10px;margin-top:10px"></span>
                                                </div>
                                                <div class="col-lg-3 j-unit">
                                                    <label class="j-label">Tanggal Realisasi</label>
                                                    <div class="j-input">
                                                        <label class="j-icon-right" for="phone">
                                                            <i class="icofont icofont-ui-calendar"></i>
                                                        </label>
                                                        <input class="form-control tanggal_realisasi" style="height: 46px;" type="date" name="tanggal_realisasi">
                                                    </div>
                                                    <span class="text-danger error_tanggal_realisasi" style="font-size: 10px;margin-top:10px"></span>
                                                </div>
                                                <div class="col-lg-3 j-unit">
                                                    <label class="j-label">Waktu Jadwal</label>
                                                    <div class="j-input">
                                                        <label class="j-icon-right" for="email">
                                                            <i class="icofont icofont-time"></i>
                                                        </label>
                                                        <input class="form-control jam_rencana" type="time" name="jam_rencana" style="height: 46px;">
                                                    </div>
                                                    <span class="text-danger error_jam_rencana" style="font-size: 10px;margin-top:10px"></span>
                                                </div>
                                                <div class="col-lg-3 j-unit">
                                                    <label class="j-label">Waktu Realisasi</label>
                                                    <div class="j-input">
                                                        <label class="j-icon-right" for="phone">
                                                            <i class="icofont icofont-time"></i>
                                                        </label>
                                                        <input class="form-control jam_realisasi" style="height: 46px;" type="time" name="jam_realisasi">
                                                    </div>
                                                    <span class="text-danger error_jam_realisasi" style="font-size: 10px;margin-top:10px"></span>
                                                </div>
                                            </div>
                                            <div class="j-unit">
                                                <label class="j-label">Monitoring</label>
                                                <div class="j-input">
                                                    <textarea placeholder="-- Monitoring --" spellcheck="false" name="materi" class="materi"></textarea>
                                                    <span class="j-tooltip j-tooltip-right-top">Isi sesuai dengan materi yang diberikan</span>
                                                </div>
                                                <span class="text-danger error_materi" style="font-size: 10px;margin-top:10px"></span>
                                            </div>
                                            <div class="j-response"></div>
                                        </div>
                                        <div class="j-footer">
                                            <button type="submit" class="btnInput btn btn-primary">Simpan</button>
                                            <button type="button" class="btn btn-danger mr-2" data-dismiss="modal">Batal</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select-matakuliah').select2({
            dropdownParent: $(".modal-body"),
            theme: "classic",
            placeholder: '-- Pilih Matakuliah --',
            allowClear: true,
        });

        $('.select-dosen').select2({
            dropdownParent: $(".modal-body"),
            theme: "classic",
            placeholder: '-- Pilih Dosen --',
            allowClear: true
        });

        $('.select-kelas').select2({
            dropdownParent: $(".modal-body"),
            theme: "classic",
            placeholder: '-- Pilih Kelas --',
            allowClear: true
        });

        $('.select-pertemuan').select2({
            dropdownParent: $(".modal-body"),
            theme: "classic",
            placeholder: '-- Pilih Pertemuan --',
            allowClear: true
        });

        $('.select-rps').select2({
            dropdownParent: $(".modal-body"),
            theme: "classic",
            placeholder: '-- Pilih RPS --',
            allowClear: true
        });
    });

    $(".formInputMonitoring").submit(function(e) {
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
                if (response.error) {
                    if (response.error.id_matakuliah) {
                        $('.id_matakuliah').addClass('is-invalid');
                        $('.error_id_matakuliah').text(response.error.id_matakuliah);
                    } else {
                        $('.id_matakuliah').removeClass('is_invalid');
                        $('.error_id_matakuliah').text('');
                    }

                    if (response.error.id_dosen) {
                        $('.id_dosen').addClass('is-invalid');
                        $('.error_id_dosen').text(response.error.id_dosen);
                    } else {
                        $('.id_dosen').removeClass('is_invalid');
                        $('.error_id_dosen').text('');
                    }

                    if (response.error.id_kelas) {
                        $('.id_kelas').addClass('is-invalid');
                        $('.error_id_kelas').text(response.error.id_kelas);
                    } else {
                        $('.id_kelas').removeClass('is_invalid');
                        $('.error_id_kelas').text('');
                    }

                    if (response.error.id_dosen) {
                        $('.id_dosen').addClass('is-invalid');
                        $('.error_id_dosen').text(response.error.id_dosen);
                    } else {
                        $('.id_dosen').removeClass('is_invalid');
                        $('.error_id_dosen').text('');
                    }

                    if (response.error.pertemuan) {
                        $('.id_pertemuan').addClass('is-invalid');
                        $('.error_id_pertemuan').text(response.error.pertemuan);
                    } else {
                        $('.id_pertemuan').removeClass('is_invalid');
                        $('.error_id_pertemuan').text('');
                    }

                    if (response.error.tanggal_rencana) {
                        $('.tanggal_rencana').addClass('is-invalid');
                        $('.error_tanggal_rencana').text(response.error.tanggal_rencana);
                    } else {
                        $('.tanggal_rencana').removeClass('is_invalid');
                        $('.error_tanggal_rencana').text('');
                    }

                    if (response.error.tanggal_realisasi) {
                        $('.tanggal_realisasi').addClass('is-invalid');
                        $('.error_tanggal_realisasi').text(response.error.tanggal_realisasi);
                    } else {
                        $('.tanggal_realisasi').removeClass('is_invalid');
                        $('.error_tanggal_realisasi').text('');
                    }

                    if (response.error.jam_rencana) {
                        $('.jam_rencana').addClass('is-invalid');
                        $('.error_jam_rencana').text(response.error.jam_rencana);
                    } else {
                        $('.jam_rencana').removeClass('is_invalid');
                        $('.error_jam_rencana').text('');
                    }

                    if (response.error.jam_realisasi) {
                        $('.jam_realisasi').addClass('is-invalid');
                        $('.error_jam_realisasi').text(response.error.jam_realisasi);
                    } else {
                        $('.jam_realisasi').removeClass('is_invalid');
                        $('.error_jam_realisasi').text('');
                    }

                    if (response.error.materi) {
                        $('.materi').addClass('is-invalid');
                        $('.error_materi').text(response.error.materi);
                    } else {
                        $('.materi').removeClass('is_invalid');
                        $('.error_materi').text('');
                    }

                    if (response.error.rps) {
                        $('.rps').addClass('is-invalid');
                        $('.error_rps').text(response.error.rps);
                    } else {
                        $('.rps').removeClass('is_invalid');
                        $('.error_rps').text('');
                    }

                    if (response.error.cek_pertemuan) {
                        $('.cek_pertemuan').addClass('is-invalid');
                        $('.error_cek_pertemuan').text(response.error.cek_pertemuan);
                    } else {
                        $('.cek_pertemuan').removeClass('is_invalid');
                        $('.error_cek_pertemuan').text('');
                    }
                } else {
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $('.modalInputView').html(response.sukses).hide();
                    $('#modalInput').modal('hide');
                    Swal.fire({
                        icon: 'success',
                        title: 'berhasil',
                        customClass: 'animated bounceIn',
                        text: response.sukses,
                    });
                    $("#result").html(response.data);
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>