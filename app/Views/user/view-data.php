 <?php error_reporting(0) ?>

 <hr>
 <!-- Modal Tambah User -->
 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahUsermodal">
     <span class="fa fa-plus-circle text-light"> User Manual</span>
 </button>
 <div class="dt-responsive table-responsive mt-3">
     <table id="basic-row-reorder" class="table table-striped table-bordered nowrap">
         <thead>
             <tr>
                 <td style="max-width: 5px;">No</td>
                 <td style="max-width: 10px;">Aksi</td>
                 <td style="width: 10px;">Username</td>
                 <td style="width: 300px;">Nama</td>
             </tr>
         </thead>
         <tbody>
             <?php $no = 1 ?>
             <?php foreach ($user as $item) : ?>
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
                                         <h5 class="modal-title text-primary" id="exampleModalLongTitle">Edit Data User</h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                         </button>
                                     </div>
                                     <form action="<?= base_url('user/edit'); ?>" method="POST" class="formEdit">
                                         <?php csrf_field() ?>
                                         <div class="modal-body">
                                             <?php $id = $item['id'] ?>
                                             <?php
                                                $sql_edit = mysqli_query($koneksi, "SELECT *, users.id as idx FROM users JOIN userroles ON users.role=userroles.id_role WHERE users.id='$id'");
                                                $dataEdit = mysqli_fetch_array($sql_edit); ?>
                                             <div class="row">
                                                 <div class="col-lg-5">
                                                     <input type="text" value="<?= $dataEdit['idx'] ?>" name="id" class="form-control" hidden>

                                                     <label class="text-primary">Username</label>
                                                     <input type="text" value="<?= $dataEdit['username'] ?>" name="username" class="form-control usernameEdit">
                                                     <div class="invalid-feedback errorUsernameEdit"></div>

                                                     <label class="text-primary mt-2">Jenis Kelamin</label>
                                                     <select class="form-control jkEdit" name="jk">
                                                         <option>pria</option>
                                                         <option>wanita</option>
                                                     </select>
                                                     <div class="invalid-feedback errorJkEdit"></div>

                                                 </div>
                                                 <div class="col-lg-5 ml-4">
                                                     <label class="text-primary">NAMA</label>
                                                     <input type="text" value="<?= $dataEdit['nama_user'] ?>" name="nama" class="form-control namaEdit">
                                                     <div class="invalid-feedback errorNamaEdit"></div>

                                                     <label class="text-primary mt-2">Role</label>
                                                     <select class="form-control Edit" name="role">
                                                         <option value="<?= $dataEdit['role'] ?>"><?= $dataEdit['user_role'] ?></option>
                                                         <?php foreach ($userRole as $data) : ?>
                                                             <option value="<?= $data['id'] ?>"><?= $data['user_role'] ?></option>
                                                         <?php endforeach ?>
                                                     </select>
                                                     <div class="invalid-feedback errorRoleEdit"></div>
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
                         <form action="<?= base_url('user/hapus'); ?>" method="post" class="d-inline hapusUser">
                             <?= csrf_field() ?>
                             <input type="text" name="id" value="<?= $item['id'] ?>" hidden>
                             <input type="text" name="nama" value="<?= $item['nama_user'] ?>" hidden>
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
                                         <h5 class="modal-title text-primary" id="exampleModalLabel">Informasi Data User</h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                         </button>
                                     </div>
                                     <div class="modal-body">
                                         <div class="row px-4">
                                             <div class="col-lg-5">
                                                 <label class="text-primary">Nama</label>
                                                 <p><?= $dataEdit['nama_user'] ?></p>
                                                 <hr>
                                                 <label class="text-primary mt-2">Username</label>
                                                 <p><?= $dataEdit['username'] ?></p>
                                                 <hr>
                                             </div>
                                             <div class="col-lg-5">
                                                 <label class="text-primary">Role</label>
                                                 <p><?= $dataEdit['user_role'] ?></p>
                                                 <hr>
                                                 <label class="text-primary mt-2">Jenis Kelamin</label>
                                                 <p><?= $dataEdit['jk'] ?></p>
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

                         <!-- RESET PASSWORD -->
                         <form action="<?= base_url('user/resetPassword'); ?>" method="post" class="d-inline resetPassword">
                             <?= csrf_field() ?>
                             <input type="text" name="id" value="<?= $item['id'] ?>" hidden>
                             <input type="text" name="nama" value="<?= $edit['nama_user'] ?>" hidden>
                             <button type="submit" class="bg-transparent border-0" onclick="return confirm('Anda yakin reset password ini ?')">
                                 <i class="icofont icofont-ui-password text-warning"></i>
                             </button>
                         </form>
                     </td>
                     <td><?= $item['username'] ?></td>
                     <td>
                         <?= $item['nama_user'] ?>
                         <?php if ($password != '' && $id_pass == $item['id']) { ?>
                             <span class="text-danger">------ [ Password Baru : <?= $password ?> ]</span>
                         <?php } ?>
                     </td>
                 </tr>
             <?php endforeach ?>
         </tbody>
     </table>
 </div>

 <div class="modal fade" id="tambahUsermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Tambah User Baru</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="<?= base_url('User/tambah'); ?>" method="post" class="tambahUserBaru">
                     <?php csrf_field() ?>
                     <div class="modal-body">
                         <div class="row">
                             <div class="col-lg-6">
                                 <label class="text-primary">Username</label>
                                 <input type="text" name="username" class="form-control username">
                                 <div class="invalid-feedback errorUsername"></div>

                                 <label class="text-primary mt-2">NAMA</label>
                                 <input type="text" name="nama" class="form-control nama">
                                 <div class="invalid-feedback errorNama"></div>

                                 <label class="text-primary mt-2">Jenis Kelamin</label>
                                 <select class="form-control jk" name="jk">
                                     <option value=""></option>
                                     <option>pria</option>
                                     <option>wanita</option>
                                 </select>
                                 <div class="invalid-feedback errorJk"></div>

                             </div>
                             <div class="col-lg-6">
                                 <label class="text-primary">Role</label>
                                 <select class="form-control role" name="role">
                                     <option></option>
                                     <?php foreach ($userRole as $data) : ?>
                                         <option value="<?= $data['id'] ?>"><?= $data['user_role'] ?></option>
                                     <?php endforeach ?>
                                 </select>
                                 <div class="invalid-feedback errorRole"></div>

                                 <label class="text-primary mt-2">Password</label>
                                 <input type="password" name="password" class="form-control password">
                                 <div class="invalid-feedback errorPaswword"></div>

                                 <label class="text-primary mt-2">Konfirmasi Password</label>
                                 <input type="password" name="konfirmasi_password" class="form-control konfirmasi_password">
                                 <div class="invalid-feedback errorKonfirmasiPassword"></div>

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
                     if (response.error) {
                         if (response.error.jk) {
                             $('.jkEdit').addClass('is-invalid');
                             $('.errorJkEdit').html(response.error.jk);
                         } else {
                             $('.jkEdit').removeClass('is-invalid');
                             $('.errorJkEdit').html('');
                         }

                         if (response.error.username) {
                             $('.usernameEdit').addClass('is-invalid');
                             $('.errorUsernameEdit').html(response.error.username);
                         } else {
                             $('.usernameEdit').removeClass('is-invalid');
                             $('.errorUsernameEdit').html('');
                         }

                         if (response.error.nama) {
                             $('.namaEdit').addClass('is-invalid');
                             $('.errorNamaEdit').html(response.error.nama);
                         } else {
                             $('.namaEdit').removeClass('is-invalid');
                             $('.errorNamaEdit').html('');
                         }

                         if (response.error.role) {
                             $('.roleEdit').addClass('is-invalid');
                             $('.errorRoleEdit').html(response.error.role);
                         } else {
                             $('.roleEdit').removeClass('is-invalid');
                             $('.errorRoleEdit').html('');
                         }
                     } else {
                         if (response.status == 'gagal') {
                             Swal.fire({
                                 icon: 'error',
                                 title: 'GAGAL',
                                 text: response.sukses,
                             })
                         } else if (response.status == 'berhasil') {
                             Swal.fire({
                                 icon: 'success',
                                 title: 'Berhasil',
                                 text: response.sukses,
                             });
                         }
                         $('body').removeClass('modal-open');
                         $('.modal-backdrop').remove();
                         $('#result').html(response.data);
                     }
                 },
                 error: function(xhr, ajaxOptions, thrownError) {
                     alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                 }
             })
         });
         $('.tambahUserBaru').submit(function(e) {
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
                         if (response.error.password) {
                             $('.password').addClass('is-invalid');
                             $('.errorPaswword').html(response.error.password);
                         } else {
                             $('.password').removeClass('is-invalid');
                             $('.errorPaswword').html('');
                         }

                         if (response.error.konfirmasi_password) {
                             $('.konfirmasi_password').addClass('is-invalid');
                             $('.errorKonfirmasiPassword').html(response.error.konfirmasi_password);
                         } else {
                             $('.konfirmasi_password').removeClass('is-invalid');
                             $('.errorKonfirmasiPassword').html('');
                         }

                         if (response.error.jk) {
                             $('.jk').addClass('is-invalid');
                             $('.errorJk').html(response.error.jk);
                         } else {
                             $('.jk').removeClass('is-invalid');
                             $('.errorJk').html('');
                         }

                         if (response.error.username) {
                             $('.username').addClass('is-invalid');
                             $('.errorUsername').html(response.error.username);
                         } else {
                             $('.username').removeClass('is-invalid');
                             $('.errorUsername').html('');
                         }

                         if (response.error.nama) {
                             $('.nama').addClass('is-invalid');
                             $('.errorNama').html(response.error.nama);
                         } else {
                             $('.nama').removeClass('is-invalid');
                             $('.errorNama').html('');
                         }

                         if (response.error.role) {
                             $('.role').addClass('is-invalid');
                             $('.errorRole').html(response.error.role);
                         } else {
                             $('.role').removeClass('is-invalid');
                             $('.errorRole').html('');
                         }
                     } else {
                         if (response.status == 'gagal') {
                             Swal.fire({
                                 icon: 'error',
                                 title: 'GAGAL',
                                 text: response.sukses,
                             })
                         } else if (response.status == 'berhasil') {
                             Swal.fire({
                                 icon: 'success',
                                 title: 'Berhasil',
                                 text: response.sukses,
                             });
                         }
                         $('body').removeClass('modal-open');
                         $('.modal-backdrop').remove();
                         $('#result').html(response.data);
                     }
                 },
                 error: function(xhr, ajaxOptions, thrownError) {
                     alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                 }
             })
         });
         $('.hapusUser').submit(function(e) {
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
         $('.resetPassword').submit(function(e) {
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
         window.setTimeout(function() {
             $(".flashAjax").fadeTo(500, 0).slideUp(500, function() {
                 $(this).remove();
             });
         }, 5000);
     });
 </script>

 <!-- Select 2 js -->
 <script type="text/javascript" src="<?= base_url(''); ?>\bower_components\select2\js\select2.full.min.js"></script>
 <!-- Multiselect js -->
 <script type="text/javascript" src="<?= base_url(''); ?>\bower_components\bootstrap-multiselect\js\bootstrap-multiselect.js"></script>
 <script type="text/javascript" src="<?= base_url(''); ?>\bower_components\multiselect\js\jquery.multi-select.js"></script>
 <script type="text/javascript" src="<?= base_url(''); ?>\assets\js\jquery.quicksearch.js"></script>
 <script type="text/javascript" src="<?= base_url(''); ?>\assets\pages\advance-elements\select2-custom.js"></script>


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