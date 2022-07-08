  <div class="modal fade" id="modalView">
      <div class="modal-dialog" style="min-width: 80%;">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Rekap Monitoring</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  <table class="table">
                      <tr>
                          <td style="width: 200px;font-weight:bold">Program Studi</td>
                          <td class="font-weight-bold">: <?= ucfirst($matkul['program_studi']) ?></td>
                      </tr>
                      <tr>
                          <td style="width: 200px;font-weight:bold">Tahun Ajaran</td>
                          <td class="font-weight-bold">: <?= ucfirst($matkul['tahun_ajaran']) ?></td>
                      </tr>
                      <tr>
                          <td style="width: 200px;font-weight:bold">Mata Kuliah</td>
                          <td class="font-weight-bold">: <?= ucfirst($matkul['mata_kuliah']) ?></td>
                      </tr>
                      <tr>
                          <td style="width: 200px;font-weight:bold">Kelas</td>
                          <td class="font-weight-bold">: <?= ucfirst($matkul['kelas']) ?></td>
                      </tr>
                  </table>
                  <hr>
                  <table class="table table-bordered">
                      <tr style="font-weight: bold;">
                          <td>Pertemuan</td>
                          <td>Aksi</td>
                          <td>Materi Yang Disampaikan</td>
                          <td style="text-align: center;">Tanggal <br> Perkuliahan</td>
                          <td style="text-align: center;">Jam <br> Perkuliahan</td>
                          <td>Dosen Pengajar</td>
                      </tr>
                      <?php foreach ($monitoring as $itemMonitoring) : ?>
                          <tr>
                              <td style="width: 100px;text-align: center;"><?= $itemMonitoring['pertemuan'] ?></td>
                              <td>
                                  <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#exampleModalCenter" onclick="modalEdit('<?= $itemMonitoring['id_monitoring'] ?>')">
                                      <span class="fa fa-edit text-warning"></span>
                                  </button>
                              </td>
                              <td><?= $itemMonitoring['materi'] ?></td>
                              <td style="width: 150px;text-align: center;"><?= date('d-m-Y', strtotime($itemMonitoring['tanggal_realisasi'])) ?></td>
                              <td style="width: 150px;text-align: center;"><?= $itemMonitoring['jam_realisasi'] ?></td>
                              <td><?= $itemMonitoring['nama_dosen'] ?></td>
                          </tr>
                      <?php endforeach ?>
                  </table>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
              </div>
          </div>
      </div>
  </div>
  <div class="modalEditData" style="display: none;"></div>

  <script>
      function modalEdit(id) {
          $.ajax({
              type: "post",
              url: "<?= base_url('monitoring/modalEdit') ?>",
              dataType: "JSON",
              data: {
                  id: id
              },
              success: function(response) {
                  if (response.sukses) {
                      $('.modalEditData').html(response.sukses).show();
                      $('#modalEdit').modal('show');
                  }
              },
              error: function(xhr, ajaxOptions, thrownError) {
                  alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
              }
          });
      }
  </script>