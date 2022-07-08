 <?php error_reporting(0) ?>

 <!-- Modal Tambah Dosen -->
 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahdosenmodal">
     <span class="fa fa-plus-circle text-light"> Tambah Dosen</span>
 </button>

 <div class="dt-responsive table-responsive mt-3">
     <table id="basic-row-reorder" class="table table-striped table-bordered nowrap">
         <thead>
             <tr>
                 <td style="max-width: 5px;">No</td>
                 <td style="max-width: 5px;">Aksi</td>
                 <td style="max-width: 20px;">Foto</td>
                 <td style="max-width: 25px;">NIP</td>
                 <td style="width: 200px;">Nama</td>
             </tr>
         </thead>
         <tbody>
             <?php $no = 1 ?>
             <?php foreach ($dosen as $item) : ?>
                 <tr>
                     <td style="text-align: center;"><?= $no++ ?></td>
                     <td>
                         <!-- Modal EDIT -->
                         <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#modalEdit<?= $item['id'] ?>">
                             <span class="fa fa-edit text-primary"></span>
                         </button>
                         <div class="modal fade" id="modalEdit<?= $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                             <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h5 class="modal-title text-primary" id="exampleModalLongTitle">Edit Data Dosen</h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                         </button>
                                     </div>
                                     <form action="<?= base_url('dosen/edit'); ?>" method="POST" class="formEdit">
                                         <?php csrf_field() ?>
                                         <div class="modal-body">
                                             <?php $id = $item['id'] ?>
                                             <?php
                                                $sql_edit = mysqli_query($koneksi, "SELECT * FROM dosens JOIN programstudis ON dosens.id_ps=programstudis.id JOIN statusdosens ON dosens.status=statusdosens.id WHERE dosens.id='$id'");
                                                $dataEdit = mysqli_fetch_array($sql_edit); ?>
                                             <div class="row">
                                                 <div class="col-xl-5">
                                                     <input type="text" name="id" value="<?= $id ?>" class="form-control" hidden>
                                                     <label class="text-primary">NIP</label>
                                                     <input type="text" name="nip" value="<?= $dataEdit['nip'] ?>" class="form-control">
                                                     <label class="text-primary mt-2">NAMA</label>
                                                     <input type="text" name="nama" value="<?= $dataEdit['nama_dosen'] ?>" class="form-control">
                                                     <label class="text-primary mt-2">EMAIL</label>
                                                     <input type="text" name="email" value="<?= $dataEdit['email'] ?>" class="form-control">
                                                     <label class="text-primary mt-2">Telepon</label>
                                                     <input type="text" name="telepon" value="<?= $dataEdit['telepon'] ?>" class="form-control">
                                                     <label class="text-primary mt-2">Jenis Kelamin</label>
                                                     <select class="form-control" name="jk">
                                                         <option>pria</option>
                                                         <option>wanita</option>
                                                     </select>
                                                 </div>
                                                 <div class="col-xl-5 ml-4">
                                                     <label class="text-primary">ALAMAT</label>
                                                     <textarea name="alamat" id="" cols="30" rows="8" class="form-control"><?= $dataEdit['alamat'] ?></textarea>
                                                     <label class="text-primary mt-2">PROGRAM STUDI</label>
                                                     <select class="form-control" name="ps">
                                                         <option value="<?= $dataEdit['id_ps'] ?>"><?= $dataEdit['program_studi'] ?></option>
                                                         <?php foreach ($programStudi as $program) : ?>
                                                             <option value="<?= $program['id'] ?>"><?= $program['program_studi'] ?></option>
                                                         <?php endforeach ?>
                                                     </select>
                                                     <label class="text-primary mt-2">STATUS</label>
                                                     <select class="form-control" name="status">
                                                         <option value="<?= $dataEdit['status'] ?>"><?= $dataEdit['nama_status'] ?></option>
                                                         <?php foreach ($statusDosen as $status) : ?>
                                                             <option value="<?= $status['id'] ?>"><?= $status['nama_status'] ?></option>
                                                         <?php endforeach ?>
                                                     </select>
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="modal-footer">
                                             <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                                             <button type="submit" class="btn btn-primary btnEdit">Simpan</button>
                                         </div>
                                     </form>
                                 </div>
                             </div>
                         </div>
                         <!-- HAPUS -->
                         <form action="<?= base_url('dosen/hapus'); ?>" method="post" class="d-inline hapusKelas">
                             <?= csrf_field() ?>
                             <input type="text" name="id" value="<?= $item['id'] ?>" hidden>
                             <input type="text" name="nama" class="form-control" value="<?= $edit['nama_dosen'] ?>" hidden>
                             <button type="submit" class="bg-transparent border-0 btnHapus" onclick="return confirm('Anda yakin menghapus data ini ?')">
                                 <span class="feather icon-trash-2 text-danger"></span>
                             </button>
                         </form>
                         <!-- Button trigger modal -->
                         <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#modalDetail<?= $item['id'] ?>">
                             <span class="fa fa-info text-info"></span>
                         </button>

                         <!-- Modal -->
                         <div class="modal fade" id="modalDetail<?= $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                             <div class="modal-dialog modal-lg" role="document">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h5 class="modal-title text-primary" id="exampleModalLabel">Informasi Data Dosen</h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                         </button>
                                     </div>
                                     <div class="modal-body">
                                         <div class="row px-4">
                                             <div class="col-lg-5">
                                                 <label class="text-primary">Nama</label>
                                                 <p><?= $dataEdit['nama_dosen'] ?></p>
                                                 <hr>
                                                 <label class="text-primary mt-2">NIP</label>
                                                 <p><?= $dataEdit['nip'] ?></p>
                                                 <hr>
                                                 <label class="text-primary mt-2">Telepon</label>
                                                 <p><?= $dataEdit['telepon'] ?></p>
                                                 <hr>
                                             </div>
                                             <div class="col-lg-5">
                                                 <label class="text-primary">Status</label>
                                                 <p><?= $dataEdit['nama_status'] ?></p>
                                                 <hr>
                                                 <label class="text-primary mt-2">Email</label>
                                                 <p><?= $dataEdit['email'] ?></p>
                                                 <hr>
                                                 <label class="text-primary mt-2">Alamat</label>
                                                 <p><?= $dataEdit['alamat'] ?></p>
                                                 <hr>
                                             </div>
                                         </div>
                                     </div>
                                     <div class="modal-footer">
                                         <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </td>
                     <td align="center">
                         <?php if ($item['foto'] == NULL) { ?>
                             <img src="<?= base_url('assets/images/user-profile.png'); ?>" width="30px" height="30px" alt="">
                         <?php } else { ?>
                             <img src="<?= base_url('foto/profile/' . $item['foto'] . ''); ?>" alt="">
                         <?php } ?>
                     </td>
                     <td><?= $item['nip'] ?></td>
                     <td><?= $item['nama_dosen'] ?></td>
                 </tr>
             <?php endforeach ?>
         </tbody>
     </table>
 </div>

 <div class="modal fade" id="tambahdosenmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Tambah Dosen Baru</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="<?= base_url('dosen/tambah'); ?>" method="post" class="tambahDosenBaru">
                     <?php csrf_field() ?>
                     <div class="modal-body">
                         <div class="row">
                             <div class="col-lg-6">
                                 <input type="text" name="id" class="form-control" hidden>
                                 <label class="text-primary">NIP</label>
                                 <input type="text" name="nip" class="form-control" required>
                                 <label class="text-primary mt-2">NAMA</label>
                                 <input type="text" name="nama" class="form-control" required>
                                 <label class="text-primary mt-2">EMAIL</label>
                                 <input type="text" name="email" class="form-control" required>
                                 <label class="text-primary mt-2">Telepon</label>
                                 <input type="text" name="telepon" class="form-control" required>
                                 <label class="text-primary mt-2">Jenis Kelamin</label>
                                 <select class="form-control" required name="jk">
                                     <option>pria</option>
                                     <option>wanita</option>
                                 </select>
                             </div>
                             <div class="col-lg-6">
                                 <label class="text-primary">PROGRAM STUDI</label>
                                 <select class="form-control" required name="ps">
                                     <option value=""></option>
                                     <?php foreach ($programStudi as $program) : ?>
                                         <option value="<?= $program['id'] ?>"><?= $program['program_studi'] ?></option>
                                     <?php endforeach ?>
                                 </select>
                                 <label class="text-primary mt-2">STATUS</label>
                                 <select class="form-control" required name="status">
                                     <option value=""></option>
                                     <?php foreach ($statusDosen as $status) : ?>
                                         <option value="<?= $status['id'] ?>"><?= $status['nama_status'] ?></option>
                                     <?php endforeach ?>
                                 </select>
                                 <label class="text-primary mt-2">ALAMAT</label>
                                 <textarea name="alamat" id="" cols="30" rows="9" class="form-control" required></textarea>
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
     $(document).ready(function() {
         $('.formEdit').submit(function(e) {
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
                     Swal.fire({
                         icon: 'success',
                         title: 'berhasil',
                         text: response.sukses,
                     });
                     $('body').removeClass('modal-open');
                     //modal-open class is added on body so it has to be removed
                     $('.modal-backdrop').remove();
                     //need to remove div with modal-backdrop class
                     $(".result").html(response.data);
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
                     $(".result").html(response.data);

                 },
                 error: function(xhr, ajaxOptions, thrownError) {
                     alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                 }
             })
         });
     });
     $('.tambahDosenBaru').submit(function(e) {
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
                 Swal.fire({
                     icon: 'success',
                     title: 'berhasil',
                     text: response.sukses,
                 });
                 $('body').removeClass('modal-open');
                 //modal-open class is added on body so it has to be removed
                 $('.modal-backdrop').remove();
                 //need to remove div with modal-backdrop class
                 $(".result").html(response.data);
             },
             error: function(xhr, ajaxOptions, thrownError) {
                 alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
             }
         })
     });

     window.setTimeout(function() {
         $(".flashAjax").fadeTo(500, 0).slideUp(500, function() {
             $(this).remove();
         });
     }, 5000);
 </script>

 <script src="<?= base_url(''); ?>\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
 <script src="<?= base_url(''); ?>\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js"></script>
 <script src="<?= base_url(''); ?>\assets\pages\data-table\extensions\row-reorder\js\dataTables.rowReorder.min.js"></script>
 <script src="<?= base_url(''); ?>\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
 <script src="<?= base_url(''); ?>\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
 <script src="<?= base_url(''); ?>\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
 <!-- Custom js -->
 <script src="<?= base_url(''); ?>\assets\pages\data-table\extensions\row-reorder\js\row-reorder-custom.js"></script>