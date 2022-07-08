  <?php error_reporting(0) ?>
  <?php
    if ($smt == 1) {
        $nama_smt = 'Ganjil';
    } else if ($smt == 2) {
        $nama_smt = 'Genap';
    } else {
        $nama_smt = '';
    }
    ?>
  <hr>
  <div>
      <h5 class="text-primary">Tambah Mata Kuliah</h5>
      <hr>
      <form action="<?= base_url('mataKuliah/tambah'); ?>" method="post" class="tambahMataKuliah">
          <?php csrf_field() ?>
          <div class="form-row">
              <input type="text" name="id_fak" value="<?= $id_fak ?>" hidden>
              <input type="text" name="id_ps" value="<?= $id_ps ?>" hidden>
              <input type="text" name="id_kurikulum" value="<?= $id_kurikulum ?>" hidden>
              <br>

              <div class="col-lg-5 mb-3">
                  <label for="validationServer01">Mata Kuliah</label>
                  <input type="text" class="form-control mataKuliah" name="mata_kuliah" value="<?= $mk ?>">
                  <div class="invalid-feedback errorMataKuliah"></div>
              </div>
              <div class="col-lg-2 mb-3">
                  <label for="validationServer02">Semester</label>
                  <select name="id_semester" class="semester form-control">
                      <option value="<?= $smt ?>"><?= $nama_smt ?></option>
                      <?php foreach ($semester as $semester) : ?>
                          <option value="<?= $semester['id'] ?>"><?= $semester['nama_semester'] ?></option>
                      <?php endforeach ?>
                  </select>
                  <div class="invalid-feedback errorSemester"></div>
              </div>
              <div class="col-lg-1 mb-3">
                  <label for="validationServerUsername">SKS</label>
                  <select name="sks" class="form-control sks">
                      <option value="<?= $sks ?>"><?= $sks ?></option>
                      <?php for ($i = 1; $i <= 7; $i++) { ?>
                          <option><?= $i ?></option>
                      <?php } ?>
                  </select>
                  <div class="invalid-feedback errorSks"></div>

              </div>
              <div class="col-lg-2 mb-3">
                  <label for="validationServerUsername">Paket Semester</label>
                  <select name="id_paket_semester" class="form-control paketSemester">
                      <option value="<?= $pkt ?>"><?= $pkt ?></option>
                      <?php for ($i = 1; $i <= 8; $i++) { ?>
                          <option><?= $i ?></option>
                      <?php } ?>
                  </select>
                  <div class="invalid-feedback errorPaketSemester"></div>
              </div>
              <div class="col-lg-1 mb-3">
                  <label for="validationServerUsername">Acuan Nilai</label>
                  <select name="acuan_nilai" class="form-control acuan">
                      <option value="<?= $an ?>"><?= $an ?></option>
                      <?php for ($i = 1; $i <= 7; $i++) { ?>
                          <option><?= $i ?></option>
                      <?php } ?>
                  </select>
                  <div class="invalid-feedback errorAcuan"></div>

              </div>
          </div>
          <button class="btn btn-primary btnTambah" type="submit">Simpan</button>
      </form>
  </div>
  <?php if ($sukses == 'pesanBerhasil') : ?>
      <div class="flashAjax alert background-success mt-3" role="alert" style="width: 100%;">
          <?= $pesan ?>
      </div>
  <?php endif; ?>
  <hr>
  <div class="table-responsive mt-3">
      <table class="table table-hover table-bordered">
          <tr>
              <td style="width: 20px;">NO</td>
              <td style="width: 70px;" align="center">Aksi</td>
              <td>mataKuliah</td>
          </tr>
          <?php $no = 1 ?>
          <?php foreach ($mataKuliah as $item) { ?>
              <tr>
                  <td align="center"><?= $no++ ?></td>
                  <td>
                      <!-- Button trigger modal Edit mataKuliah -->
                      <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#editmataKuliah<?= $id = $item['id'] ?>">
                          <span class="feather icon-edit-1 text-primary"></span>
                      </button>
                      <!-- Modal Edit mataKuliah-->
                      <div class="modal fade" id="editmataKuliah<?= $id = $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Edit mataKuliah</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <form action="<?= base_url('mataKuliah/edit'); ?>" method="post" class="editmataKuliah">
                                      <?= csrf_field() ?>
                                      <div class="modal-body">
                                          <?php
                                            $sql_ta = mysqli_query($koneksi, "SELECT * FROM matakuliahs WHERE id='$id'");
                                            $edit = mysqli_fetch_array($sql_ta) ?>
                                          <label>Mata Kuliah</label>

                                      </div>
                                      <div class="modal-footer">
                                          <button type="submit" class="btn btn-primary btnEdit">Simpan</button>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div> |
                      <!-- Button trigger modal Hapus mataKuliah -->
                      <form action="<?= base_url('mataKuliah/hapus'); ?>" method="post" class="d-inline hapusmataKuliah">
                          <?= csrf_field() ?>
                          <input type="text" name="id" value="<?= $item['id'] ?>" hidden>
                          <input type="text" name="programStudi" class="form-control" value="<?= $edit['id_ps'] ?>" hidden>
                          <input type="text" name="tahunAjaran" class="form-control" value="<?= $edit['id_ta'] ?>" hidden>
                          <input type="text" name="fakultas" class="form-control" value="<?= $edit['id_fak'] ?>" hidden>
                          <input type="text" name="mataKuliah" class="form-control" value="<?= $edit['mata_kuliah'] ?>" hidden>
                          <button type="submit" class="bg-transparent border-0 btnHapus" onclick="return confirm('Anda yakin menghapus data ini ?')">
                              <span class="feather icon-trash-2 text-danger"></span>
                          </button>
                      </form>
                  </td>
                  <td><?= $item['mata_kuliah'] ?></td>
              </tr>
          <?php } ?>
      </table>
  </div>

  <script>
      $(document).ready(function() {

      });

      $('.tambahMataKuliah').submit(function(e) {
          e.preventDefault();
          $.ajax({
              type: "post",
              url: $(this).attr('action'),
              data: $(this).serialize(),
              dataType: "json",
              beforeSend: function() {
                  $('.btnTambah').attr('disable', 'disabled');
                  $('.btnTambah').html('<i class="fa fa-spin fa-spinner"></i>');
              },
              complete: function() {
                  $('.btnTambah').removeAttr('disable', 'disabled');
                  $('.btnTambah').html('Simpan');
              },
              success: function(response) {
                  if (response.error) {
                      if (response.error.matakuliah) {
                          $('.mataKuliah').addClass('is-invalid');
                          $('.errorMataKuliah').html(response.error.matakuliah);
                      } else {
                          $('.mataKuliah').removeClass('is-invalid');
                          $('.errorMataKuliah').html('');
                      }

                      if (response.error.semester) {
                          $('.semester').addClass('is-invalid');
                          $('.errorSemester').html(response.error.semester);
                      } else {
                          $('.semester').removeClass('is-invalid');
                          $('.errorSemester').html('');
                      }

                      if (response.error.sks) {
                          $('.sks').addClass('is-invalid');
                          $('.errorSks').html(response.error.sks);
                      } else {
                          $('.sks').removeClass('is-invalid');
                          $('.errorSks').html('');
                      }

                      if (response.error.id_paket_semester) {
                          $('.paketSemester').addClass('is-invalid');
                          $('.errorPaketSemester').html(response.error.id_paket_semester);
                      } else {
                          $('.paketSemester').removeClass('is-invalid');
                          $('.errorPaketSemester').html('');
                      }

                      if (response.error.acuan_nilai) {
                          $('.acuan').addClass('is-invalid');
                          $('.errorAcuan').html(response.error.acuan_nilai);
                      } else {
                          $('.acuan').removeClass('is-invalid');
                          $('.errorAcuan').html('');
                      }
                  } else {
                      $("#result").html(response.data);
                  }
              },
              error: function(xhr, ajaxOptions, thrownError) {
                  alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
              }
          })

          $('.editmataKuliah').submit(function(e) {
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
                      if (response.error) {
                          if (response.error.matakuliah) {
                              $('.matakuliah').addClass('is-invalid');
                              $('.errorMatakuliah').html(response.error.matakuliah);
                          } else {
                              $('.matakuliah').removeClass('is-invalid');
                              $('.errorMatakuliah').html('');
                          }

                          if (response.error.semester) {
                              $('.semester').addClass('is-invalid');
                              $('.errorSemester').html(response.error.semester);
                          } else {
                              $('.semester').removeClass('is-invalid');
                              $('.errorSemester').html('');
                          }

                          if (response.error.sks) {
                              $('.sks').addClass('is-invalid');
                              $('.errorSks').html(response.error.sks);
                          } else {
                              $('.sks').removeClass('is-invalid');
                              $('.errorSks').html('');
                          }

                          if (response.error.paketSemester) {
                              $('.paketSemester').addClass('is-invalid');
                              $('.errorPaketSemester').html(response.error.paketSemester);
                          } else {
                              $('.paketSemester').removeClass('is-invalid');
                              $('.errorPaketSemester').html('');
                          }

                          if (response.error.acuan) {
                              $('.acuan').addClass('is-invalid');
                              $('.errorAcuan').html(response.error.acuan);
                          } else {
                              $('.acuan').removeClass('is-invalid');
                              $('.errorAcuan').html('');
                          }
                      } else {
                          Swal.fire({
                              icon: 'success',
                              title: 'berhasil',
                              text: response.sukses,
                          });
                          $("#result").html(response.data);
                      }
                  },
                  error: function(xhr, ajaxOptions, thrownError) {
                      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                  }
              })
          });

          $('.hapusmataKuliah').submit(function(e) {
              e.preventDefault();
              $.ajax({
                  type: "post",
                  url: $(this).attr('action'),
                  data: $(this).serialize(),
                  dataType: "json",
                  beforeSend: function() {
                      $('.btnHapus').attr('disable', 'disabled');
                      $('.btnHapus').html('<i class="fa fa-spin fa-spinner"></i>');
                  },
                  complete: function() {
                      $('.btnHapus').removeAttr('disable', 'disabled');
                  },
                  success: function(response) {
                      Swal.fire({
                          icon: 'success',
                          title: 'berhasil',
                          text: response.sukses,
                      });
                      $("#result").html(response.data);

                  },
                  error: function(xhr, ajaxOptions, thrownError) {
                      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                  }
              })
          });
      });

      window.setTimeout(function() {
          $(".flashAjax").fadeTo(500, 0).slideUp(500, function() {
              $(this).remove();
          });
      }, 5000);
  </script>