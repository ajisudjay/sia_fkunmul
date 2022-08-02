<!-- tambah modal-->
<div class="modal fade" id="modalEditAktifitas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="min-width: 80%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Aktifitas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="">
                <form action="<?= base_url('aktifitas/editMahasiswa'); ?>" method="post" enctype="multipart/form-data">
                    <?php csrf_field() ?>
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-5">
                                    <input type="text" name="id_aktifitas" value="<?= $aktifitas['id_aktifitas'] ?>" hidden>
                                    <label class="font-weight-bold text-primary">Kompetensi</label>
                                    <select required class="form-control kompetensi" name="kompetensi" id="kompetensi">
                                        <option value="<?= $aktifitas['id_kompetensi'] ?>"><?= $aktifitas['data_kompetensi'] ?></option>
                                        <?php foreach ($kompetensi as $dataKompetensi) { ?>
                                            <option value="<?= $dataKompetensi['id_kompetensi'] ?>"><?= $dataKompetensi['jenis'] ?> - <?= $dataKompetensi['kompetensi'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback errorkompetensi"></div>
                                </div>
                                <div class="col-lg-5">
                                    <label class="font-weight-bold text-primary judul_data_kompetensi">Sub Kompetensi</label>
                                    <select class="form-control subkompetensi" name="subkompetensi" id="data_kompetensi">
                                        <option value="<?= $id_sub_kompetensi ?>"><?= $sub_kompetensi ?></option>
                                    </select>
                                    <div class="invalid-feedback errorsubkompetensi"></div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label class="font-weight-bold text-primary">Kegiatan</label>
                                            <select required class="form-control kegiatan" name="kegiatan" id="kegiatan">
                                                <option value="<?= $aktifitas['id_kegiatan'] ?>"><?= $aktifitas['kegiatan'] ?></option>
                                                <?php foreach ($kegiatan as $data) : ?>
                                                    <option value="<?= $data['id'] ?>"><?= $data['kegiatan'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <div class="invalid-feedback errorKegiatan"></div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="font-weight-bold text-primary">Tanggal</label>
                                            <input required type="date" name="tanggal" value="<?= $aktifitas['tanggal'] ?>" class="form-control tanggal" id="tanggal">
                                            <div class="invalid-feedback errorTanggal"></div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="font-weight-bold mt-3 text-primary">Tahun Ajaran</label><br>
                                            <select name="id_tahun_ajaran" class="form-control" id="">
                                                <option value="<?= $aktifitas['id_tahun_ajaran'] ?>"><?= $aktifitas['tahun_ajaran'] ?></option>
                                                <?php foreach ($tahunajaran as $item) : ?>
                                                    <option value="<?= $item['id'] ?>"><?= $item['tahun_ajaran'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-6">
                                            <label class="font-weight-bold mt-3 text-primary">File Bukti</label><br>
                                            <div class="j-input">
                                                <input type="file" name="file" id="file" class="form-control" accept=".pdf">
                                                <input type="text" name="file_lama" id="file_lama" class="form-control" value="<?= $aktifitas['file_bukti'] ?>" hidden>
                                            </div>
                                            <div class="invalid-feedback errorfile"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="col">
                                        <label class="font-weight-bold text-primary">Judul</label>
                                        <textarea name="judul" id="" cols="30" rows="6" class="form-control judul"><?= $aktifitas['judul'] ?></textarea>
                                        <div class="invalid-feedback errorJudul"></div>
                                        <!-- <label class="font-weight-bold mt-3 text-primary">Gambaran Umum Aktifitas</label>
                                    <textarea required name="deskripsi_awal" id="" cols="30" rows="12" class="form-control deskripsi_awal judul"></textarea>
                                    <div class="invalid-feedback errordeskripsi_awal"></div> -->
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <label class="font-weight-bold mb-2 mt-2 j-label text-primary">Refleksi Diri</label>
                            <hr>
                            <div class="row">
                                <?php foreach ($deskripsiaktifitas as $data) : ?>
                                    <div class="col-lg-4">
                                        <label class="font-weight-bold text-primary mt-2">- <?= $data['pertanyaan'] ?></label>
                                        <?php foreach ($detailaktifitas as $dataDetail) :
                                            if ($dataDetail['id_deskripsi_aktifitas'] == $data['id']) { ?>
                                                <input type="text" name="id_deskripsi_aktifitas[]" value="<?= $data['id'] ?>" hidden>
                                                <input type="text" name="id[]" value="<?= $dataDetail['id'] ?>" hidden>
                                                <textarea name="deskripsi[]" id="deskripsi" class="form-control" cols="30" rows="8" required><?= $dataDetail['deskripsi_aktifitas'] ?></textarea>
                                            <?php } ?>
                                        <?php endforeach ?>
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
</div>

<script>
    $('.kompetensi').change(function() {
        var kompetensi = $(this).val();
        $.ajax({
            type: "post",
            url: '<?= base_url('aktifitas/kompetensiEdit') ?>',
            data: {
                kompetensi: kompetensi,
                id_sub_kompetensi: '<?= $id_sub_kompetensi ?>',
                sub_kompetensi: '<?= $sub_kompetensi ?>',
            },
            dataType: "json",
            success: function(response) {
                if (response.jenis == 'REGULAR') {
                    $('#data_kompetensi').html(response.data);
                    $('#data_kompetensi').removeClass('d-none');
                    $('.judul_data_kompetensi').removeClass('d-none');
                } else {
                    $('#data_kompetensi').html(response.data);
                    $('#data_kompetensi').addClass('d-none');
                    $('.judul_data_kompetensi').addClass('d-none');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    })


    $('.btnSimpan').click(function() {
        $('.btnSimpan').html('<i class="fa fa-spin fa-spinner"></i>');
    })
</script>