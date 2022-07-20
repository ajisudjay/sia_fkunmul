 <?php error_reporting(0) ?>

 <div class="dt-responsive table-responsive mt-3">
     <table id="" class="table table-striped table-bordered nowrap">
         <thead>
             <tr class="font-weight-bold">
                 <td>No</td>
                 <td>Aksi</td>
                 <td>Foto</td>
                 <td>Nim</td>
                 <td>Nama</td>
                 <td>Dosen PA</td>
             </tr>
         </thead>
         <tbody>
             <?php $no = 1 ?>
             <?php foreach ($bimbingan as $item) : ?>
                 <tr>
                     <td style="text-align: center; width: 10px;"><?= $no++ ?></td>
                     <td style="width: 20px;">
                         <button type="button" class="bg-transparent border-0" onclick="edit('<?= $item['id_mahasiswa'] ?>')" data-toggle="modal">
                             <span class="fa fa-edit text-warning"></span>
                         </button>
                         <form action="" class="d-inline formHapusBimbingan">
                             <button type="button" class="bg-transparent border-0" data-toggle="modal">
                                 <span class="fa fa-trash text-danger"></span>
                             </button>
                         </form>
                     </td>
                     <td align="center">
                         <?php if ($item['foto'] == NULL) { ?>
                             <img src="<?= base_url('assets/images/user-profile.png'); ?>" width="30px" height="30px" alt="">
                         <?php } else { ?>
                             <img src="<?= base_url('foto/profile/' . $item['foto'] . ''); ?>" alt="">
                         <?php } ?>
                     </td>
                     <td style="width: 20px;"><?= $item['nim'] ?></td>
                     <td><?= $item['nama_mahasiswa'] ?></td>
                     <td><?= $item['nama_dosen'] ?></td>
                 </tr>
             <?php endforeach ?>
         </tbody>
     </table>
 </div>
 <div class="modalEditBimbingan" style="display: none;"></div>

 <script>
     function edit(id) {
         $.ajax({
             type: "post",
             url: "<?= base_url('bimbingan/modalEdit') ?>",
             dataType: "JSON",
             data: {
                 id: id,
                 id_ps: <?= $id_ps ?>
             },
             success: function(response) {
                 if (response.data) {
                     $('.modalEditBimbingan').html(response.data).show();
                     $('#modalEditBimbingan').modal('show');
                 }
             },
             error: function(xhr, ajaxOptions, thrownError) {
                 alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
             }
         });
     }
 </script>

 <script src="<?= base_url(''); ?>\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
 <script src="<?= base_url(''); ?>\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js"></script>
 <script src="<?= base_url(''); ?>\assets\pages\data-table\extensions\row-reorder\js\dataTables.rowReorder.min.js"></script>
 <script src="<?= base_url(''); ?>\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
 <script src="<?= base_url(''); ?>\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
 <script src="<?= base_url(''); ?>\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
 <!-- Custom js -->
 <script src="<?= base_url(''); ?>\assets\pages\data-table\extensions\row-reorder\js\row-reorder-custom.js"></script>