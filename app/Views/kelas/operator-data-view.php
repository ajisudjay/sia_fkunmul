  <?php error_reporting(0) ?>
  <hr>
  <div>
      <h5 class="text-primary">Tambah kelas</h5>
      <hr>
      <?php if ($sukses == 'pesanBerhasil') : ?>
          <div class="flashAjax alert background-success" role="alert" style="width: 100%;">
              Kelas <?= $namaKelas ?> Berhasil Ditambahkan
          </div>
      <?php endif; ?>
      <form action="<?= base_url('kelas/tambah'); ?>" method="post" class="tambahKelas">
          <?= csrf_field() ?>
          <input type="text" name="fakultas" value="<?= $fakultas ?>" hidden>
          <input type="text" name="programStudi" value="<?= $programStudi ?>" hidden>
          <input type="text" name="tahunAjaran" value="<?= $tahunAjaran ?>" hidden>
          <label class="f-w-700">Nama Kelas</label>
          <input type="text" name="kelas" id="kelas" class="form-control col-lg-6" placeholder="Tulis Kelas" autofocus>
          <div class="invalid-feedback errorKelas">
              <i class="text-danger">Kelas Wajib Diisi !</i>
          </div>
          <button type="submit" class="btn btn-primary mt-3 btnSimpan">Simpan</button>
      </form>
  </div>
  <hr>
  <div class="table-responsive mt-3">
      <table class="table table-hover table-bordered">
          <tr>
              <td style="width: 20px;">NO</td>
              <td style="width: 70px;" align="center">Aksi</td>
              <td>Kelas</td>
          </tr>
          <?php $no = 1 ?>
          <?php foreach ($kelas as $item) { ?>
              <tr>
                  <td align="center"><?= $no++ ?></td>
                  <td>
                      <!-- Button trigger modal Edit Kelas -->
                      <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#editkelas<?= $id = $item['id'] ?>">
                          <span class="feather icon-edit-1 text-primary"></span>
                      </button>
                      <!-- Modal Edit Kelas-->
                      <div class="modal fade" id="editkelas<?= $id = $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Edit Kelas</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <form action="<?= base_url('kelas/edit'); ?>" method="post" class="editKelas">
                                      <?= csrf_field() ?>
                                      <div class="modal-body">
                                          <?php
                                            $sql_ta = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id='$id'");
                                            $edit = mysqli_fetch_array($sql_ta) ?>
                                          <label>Kelas</label>
                                          <input type="text" name="kelas" class="form-control" value="<?= $edit['kelas'] ?>">
                                          <input type="text" name="programStudi" class="form-control" value="<?= $edit['id_ps'] ?>" hidden>
                                          <input type="text" name="tahunAjaran" class="form-control" value="<?= $edit['id_ta'] ?>" hidden>
                                          <input type="text" name="fakultas" class="form-control" value="<?= $edit['id_fak'] ?>" hidden>
                                          <input type="text" name="id" value="<?= $edit['id'] ?>" hidden>
                                      </div>
                                      <div class="modal-footer">
                                          <button type="submit" class="btn btn-primary btnEdit">Simpan</button>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div> |
                      <!-- Button trigger modal Hapus Kelas -->
                      <form action="<?= base_url('kelas/hapus'); ?>" method="post" class="d-inline hapusKelas">
                          <?= csrf_field() ?>
                          <input type="text" name="id" value="<?= $item['id'] ?>" hidden>
                          <input type="text" name="programStudi" class="form-control" value="<?= $edit['id_ps'] ?>" hidden>
                          <input type="text" name="tahunAjaran" class="form-control" value="<?= $edit['id_ta'] ?>" hidden>
                          <input type="text" name="fakultas" class="form-control" value="<?= $edit['id_fak'] ?>" hidden>
                          <input type="text" name="kelas" class="form-control" value="<?= $edit['kelas'] ?>" hidden>
                          <button type="submit" class="bg-transparent border-0 btnHapus" onclick="return confirm('Anda yakin menghapus data ini ?')">
                              <span class="feather icon-trash-2 text-danger"></span>
                          </button>
                      </form>
                  </td>
                  <td><?= $item['kelas'] ?></td>
              </tr>
          <?php } ?>
      </table>
  </div>

  <script>
      $(document).ready(function() {
          $('.tambahKelas').submit(function(e) {
              e.preventDefault();
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
                          if (response.error.kelas) {
                              $('#kelas').addClass('is-invalid');
                              $('.errorkelas').html(response.error.kelas);
                          } else {
                              $('#kelas').removeClass('is-invalid');
                              $('.errorkelas').html('');
                          }
                      } else {
                          $("#result").html(response.data);
                      }
                  },
                  error: function(xhr, ajaxOptions, thrownError) {
                      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                  }
              })
          });

          $('.editKelas').submit(function(e) {
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
                          if (response.error.kelas) {
                              $('.kelas').addClass('is-invalid');
                              $('.errorkelasEdit').html(response.error.kelas);
                          }
                      } else {
                          Swal.fire({
                              icon: 'success',
                              title: 'berhasil',
                              text: response.sukses,
                          });
                          $('body').removeClass('modal-open');
                          //modal-open class is added on body so it has to be removed
                          $('.modal-backdrop').remove();
                          //need to remove div with modal-backdrop class
                          $("#result").html(response.data);
                      }
                  },
                  error: function(xhr, ajaxOptions, thrownError) {
                      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                  }
              })
          });

          $('.hapusKelas').submit(function(e) {
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