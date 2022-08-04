  <?php error_reporting(0) ?>
  <hr>
  <div>
      <h5 class="text-primary">Tambah</h5>
      <hr>
      <?php if ($sukses == 'pesanBerhasil') : ?>
          <div class="flashAjax alert background-success" role="alert" style="width: 100%;">
              Kurikulum <?= $namaKurikulum ?> Berhasil Ditambahkan
          </div>
      <?php endif; ?>
      <form action="<?= base_url('kurikulum/tambah'); ?>" method="post" class="tambahKurikulum">
          <?= csrf_field() ?>
          <input type="text" name="programStudi" value="<?= $programStudi ?>" hidden>
          <label class="f-w-700">Nama Kurikulum</label>
          <input type="text" name="kurikulum" id="kurikulum" class="form-control col-lg-6" placeholder="Tulis Kurikulum" autofocus>
          <div class="invalid-feedback errorKurikulum">
              <i class="text-danger">Kurikulum Wajib Diisi !</i>
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
              <td>Kurikulum</td>
          </tr>
          <?php $no = 1 ?>
          <?php foreach ($kurikulum as $item) { ?>
              <tr>
                  <td align="center"><?= $no++ ?></td>
                  <td>
                      <!-- Button trigger modal Edit Kurikulum -->
                      <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#editkurikulum<?= $id = $item['id'] ?>">
                          <span class="feather icon-edit-1 text-primary"></span>
                      </button> |
                      <!-- Modal Edit Kurikulum-->
                      <div class="modal fade" id="editkurikulum<?= $id = $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h5 class="modal-title" id="exampleModalLabel">Edit Kurikulum</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                      </button>
                                  </div>
                                  <form action="<?= base_url('kurikulum/edit'); ?>" method="post" class="editKurikulum">
                                      <?= csrf_field() ?>
                                      <div class="modal-body">
                                          <?php
                                            $sql_ta = mysqli_query($koneksi, "SELECT * FROM kurikulums WHERE id='$id'");
                                            $edit = mysqli_fetch_array($sql_ta) ?>
                                          <label>Kurikulum</label>
                                          <input type="text" name="kurikulum" class="form-control" value="<?= $edit['kurikulum'] ?>">
                                          <input type="text" name="programStudi" class="form-control" value="<?= $edit['id_ps'] ?>" hidden>
                                          <input type="text" name="id" value="<?= $edit['id'] ?>" hidden>
                                      </div>
                                      <div class="modal-footer">
                                          <button type="submit" class="btn btn-primary btnEdit">Simpan</button>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                      <!-- Button trigger modal Hapus Kurikulum -->
                      <a href="<?= base_url('kurikulum/hapus/' . $item['id']); ?>" class="hapusKurikulum">
                          <span class="feather icon-trash-2 text-danger"></span>
                      </a>
                  </td>
                  <td><?= $item['kurikulum'] ?></td>
              </tr>
          <?php } ?>
      </table>
  </div>
  <script>
      $(document).ready(function() {
          $('.tambahKurikulum').submit(function(e) {
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
                          if (response.error.kurikulum) {
                              $('#kurikulum').addClass('is-invalid');
                              $('.errorkurikulum').html(response.error.kurikulum);
                          } else {
                              $('#kurikulum').removeClass('is-invalid');
                              $('.errorkurikulum').html('');
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

          $('.editKurikulum').submit(function(e) {
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
                          if (response.error.kurikulum) {
                              $('.kurikulum').addClass('is-invalid');
                              $('.errorkurikulumEdit').html(response.error.kurikulum);
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
          $('.hapusKurikulum').on('click', function(e) {
              e.preventDefault();
              const href = $(this).attr('href')
              Swal.fire({
                  title: 'Anda Yakin?',
                  text: "Data Akan Dihapus!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Hapus!'
              }).then((result) => {
                  if (result.value) {
                      document.location.href = href;
                  }
              });
          });
      });

      window.setTimeout(function() {
          $(".flashAjax").fadeTo(500, 0).slideUp(500, function() {
              $(this).remove();
          });
      }, 5000);
  </script>