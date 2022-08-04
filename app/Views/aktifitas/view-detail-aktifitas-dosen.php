  <div class="card p-4">
      <div class="dt-responsive table-responsive mt-3">
          <table id="basic-row-reorder" class="table table-striped table-bordered nowrap">
              <thead>
                  <tr>
                      <td>No</td>
                      <td>Status</td>
                      <td>Aksi</td>
                      <td>Judul</td>
                      <td>Kompetensi</td>
                      <td>Sub kompetensi</td>
                      <td>Kegiatan</td>
                  </tr>
              </thead>
              <tbody>
                  <?php $no = 1 ?>
                  <?php foreach ($aktifitas as $item) :
                        $id_aktifitas = $item['id_aktifitas'];
                        $id_user = session()->get('id_user'); ?>
                      <tr>
                          <td style="width: 5%;"><?= $no++ ?></td>
                          <td style="width: 10%;">
                              <?php if ($item['status_aktifitas'] == 'new') { ?>
                                  <blink>
                                      <span class="badge badge-danger"> Aktifitas Baru</span>
                                  </blink>
                              <?php } ?>
                              <?php $sql_aktifitas_count = mysqli_query($koneksi, "SELECT *, COUNT(feedback) as jumlah FROM feedbackaktifitas WHERE id_aktifitas='$id_aktifitas' AND status='new' AND penerima=$id_user");
                                while ($item_count = mysqli_fetch_array($sql_aktifitas_count)) {
                                    if ($item_count['jumlah'] > 0) { ?>
                                      <blink>
                                          <span class="badge badge-danger"><?= $item_count['jumlah'] ?> Feedback Baru</span>
                                      </blink>
                                  <?php } else { ?>
                                      <?php $sql_aktifitas_jumlah = mysqli_query($koneksi, "SELECT COUNT(feedback) as jumlah FROM feedbackaktifitas WHERE id_aktifitas='$id_aktifitas'");
                                        while ($item_jumlah = mysqli_fetch_array($sql_aktifitas_jumlah)) { ?>
                                          <span class="badge badge-primary"><?= $item_jumlah['jumlah'] ?> Feedback</span>
                                      <?php } ?>
                                  <?php  } ?>
                              <?php  } ?>
                          </td>
                          <td style="width: 10%;">
                              <a href="#" class="badge badge-inverse-success" onclick="modalFeedback('<?= $item['id_aktifitas'] ?>')">
                                  <span class="font-weight-bold fa fa-comment"> Feedback</span>
                              </a>
                              <a href="#" class="ml-2 badge badge-inverse-info" onclick="modalDetail('<?= $item['id_aktifitas'] ?>')">
                                  <span class="text-purple font-weight-bold fa fa-eye"> Detail</span>
                              </a>
                          </td>
                          <td><?= $item['judul'] ?></td>
                          <td><?= $item['data_kompetensi'] ?></td>
                          <td><?= $item['sub_kompetensi'] ?></td>
                          <td><?= $item['kegiatan'] ?></td>
                      </tr>
                  <?php endforeach ?>
              </tbody>
          </table>
      </div>
  </div>


  <script src="<?= base_url(''); ?>\bower_components\datatables.net\js\jquery.dataTables.min.js">
  </script>
  <script src="<?= base_url(''); ?>\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js">
  </script>
  <script src="<?= base_url(''); ?>\assets\pages\data-table\extensions\row-reorder\js\dataTables.rowReorder.min.js">
  </script>
  <script src="<?= base_url(''); ?>\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url(''); ?>\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js">
  </script>
  <script src="<?= base_url(''); ?>\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js">
  </script>
  <!-- Custom js -->
  <script src="<?= base_url(''); ?>\assets\pages\data-table\extensions\row-reorder\js\row-reorder-custom.js"></script>