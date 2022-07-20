 <?php
    error_reporting(0);
    $csv = [
        'name' => 'fileexcel',
        'id' => 'fileexcel',
        'class' => 'form-control mb-3',
        'accept' => '.xls, .xlsx '
    ];

    $submit = [
        'name' => 'submit',
        'id' => 'submit',
        'value' => 'Simpan',
        'class' => 'btn btn-primary',
        'type' => 'submit'
    ];
    ?>
 <!-- Modal Tambah Dosen -->
 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahdosenmodal">
     <span class="fa fa-plus-circle text-light"> Tambah Dosen</span>
 </button>

 <button type="button" class="btn btn-danger float-right ml-2" data-toggle="modal" data-target="#tambahDosenExcel">
     <span class="fa fa-plus-circle text-light"> Import Excel</span>
 </button>

 <a href="<?= base_url('file/template/dosen.xlsx'); ?>" download="<?= base_url('file/template/dosen.xlsx'); ?>" class="btn btn-info float-right">
     <span class="fa fa-download text-light"> Format Excel</span>
 </a>

 <div class="dt-responsive table-responsive mt-3">
     <table id="basic-row-reorder" class="table table-striped table-bordered nowrap">
         <thead>
             <tr>
                 <td style="max-width: 5px;">No</td>
                 <td style="max-width: 5px;">Aksi</td>
                 <td style="max-width: 20px;">Foto</td>
                 <td style="max-width: 25px;">NIP</td>
                 <td style="width: 200px;">Nama</td>
                 <td style="width: 100px;">Akun User</td>
             </tr>
         </thead>
         <tbody>
             <?php $no = 1 ?>
             <?php foreach ($dosen as $item) :
                    $id_user = $item['nip'];
                ?>
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
                                                $sql_edit = mysqli_query($koneksi, "SELECT * FROM dosens JOIN programstudis ON dosens.id_ps=programstudis.id JOIN statusdosens ON dosens.id_status_dosen=statusdosens.id WHERE dosens.id='$id'");
                                                $dataEdit = mysqli_fetch_array($sql_edit); ?>
                                             <div class="row">
                                                 <div class="col-xl-5">
                                                     <input type="text" name="id" value="<?= $id ?>" class="form-control" hidden>
                                                     <label class="text-primary">NIP</label>
                                                     <input type="text" name="nip" value="<?= $dataEdit['nip'] ?>" class="form-control">
                                                     <input type="text" name="nip_lama" value="<?= $dataEdit['nip'] ?>" class="form-control" hidden>
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
                             <input type="text" name="nip" value="<?= $item['nip'] ?>" hidden>
                             <input type="text" name="nama" class="form-control" value="<?= $edit['nama_dosen'] ?>" hidden>
                             <button type="submit" class="bg-transparent border-0 btnHapus" onclick="return confirm('Anda yakin menghapus data ini ?')">
                                 <span class="feather icon-trash-2 text-danger"></span>
                             </button>
                         </form>
                         <!-- Modal Detail -->
                         <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#modalDetail<?= $item['id'] ?>">
                             <span class="fa fa-info text-info"></span>
                         </button>
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
                         <!-- Modal Tambah User -->
                         <?php $sql_user = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$id_user'");
                            $dataUser = mysqli_num_rows($sql_user);
                            if ($dataUser < 1) {
                                $user = '<i class="badge badge-danger">Belum Ada</i>';
                                $akun = '';
                            } else {
                                $user = '<i class="badge badge-success">Ada</i>';
                                $akun = 'hidden';
                            } ?>
                         <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#tambahUserDosen<?= $item['id'] ?>" <?= $akun ?>>
                             <span class="fa fa-key text-warning"></span>
                         </button>
                         <div class="modal fade" id="tambahUserDosen<?= $item['id'] ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                             <div class="modal-dialog modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                         </button>
                                     </div>
                                     <div class="modal-body">
                                         <form action="<?= base_url('dosen/tambahUser'); ?>" method="post" class="tambahUser">
                                             <?php csrf_field() ?>
                                             <div class="mr-5 ml-2">
                                                 <label class="text-primary">NIP</label>
                                                 <input type="text" name="username" value="<?= $dataEdit['nip'] ?>" class="form-control" readonly>
                                                 <label class="text-primary mt-3">NAMA</label>
                                                 <input type="text" name="nama_user" value="<?= $dataEdit['nama_dosen'] ?>" class="form-control" readonly>
                                                 <label class="text-primary mt-3">PROGRAM STUDI</label>
                                                 <select class="form-control" name="ps">
                                                     <option value="<?= $dataEdit['id_ps'] ?>"><?= $dataEdit['program_studi'] ?></option>
                                                 </select>
                                                 <label class="text-primary mt-3">Jenis Kelamin</label>
                                                 <select class="form-control" name="jk">
                                                     <option><?= $dataEdit['jk'] ?></option>
                                                 </select>

                                                 <label class="text-primary mt-3">Password</label>
                                                 <i style="font-size: 10px;" class="errorpassword text-danger"></i>
                                                 <input type="password" name="password" class="form-control password">

                                                 <label class="text-primary mt-3">Konfirmasi Password</label>
                                                 <i style="font-size: 10px;" class="errorkonfirmasi_password text-danger"></i>
                                                 <input type="password" name="konfirmasi_password" class="konfirmasi_password form-control">

                                             </div>
                                             <div class="modal-footer">
                                                 <button type="button" class="btn btn-danger" data-dismiss="modal">Batalkan</button>
                                                 <button type="submit" class="btn btn-primary btnUser">Simpan</button>
                                             </div>
                                         </form>
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
                     <td><?= $user ?></td>
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

 <div class="modal fade" id="tambahDosenExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="<?= base_url('dosen/prosesExcel'); ?>" method="post" id="" enctype="multipart/form-data">
                     <div class="form-group">
                         <label>File Excel</label>
                         <input type="file" name="fileexcel" class="form-control" id="fileexceldosen" accept=".xls, .xlsx" /></p>
                         <span class="text-danger errorexcel"></span>
                     </div>
                     <div class="form-group">
                         <button class="btn btn-primary btnSimpan" type="submit">Upload</button>
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

     $('.tambahUser').submit(function(e) {
         e.preventDefault();
         $.ajax({
             type: "post",
             url: $(this).attr('action'),
             data: $(this).serialize(),
             dataType: "json",
             beforeSend: function() {
                 $('.btnUser').attr('disable', 'disabled');
                 $('.btnUser').html('<i class="fa fa-spin fa-spinner"></i>');
             },
             complete: function() {
                 $('.btnUser').removeAttr('disable', 'disabled');
                 $('.btnUser').html('Simpan');
             },
             success: function(response) {
                 if (response.error) {
                     if (response.error.password) {
                         $('.password').addClass('is-invalid');
                         $('.errorpassword').html(response.error.password);
                     } else {
                         $('.password').removeClass('is-invalid');
                         $('.errorpassword').html('');
                     }

                     if (response.error.konfirmasi_password) {
                         $('.konfirmasi_password').addClass('is-invalid');
                         $('.errorkonfirmasi_password').html(response.error.konfirmasi_password);
                     } else {
                         $('.konfirmasi_password').removeClass('is-invalid');
                         $('.errorkonfirmasi_password').html('');
                     }
                 } else {
                     Swal.fire({
                         icon: 'success',
                         title: 'berhasil',
                         text: response.sukses,
                     });
                     $('body').removeClass('modal-open');
                     $('.modal-backdrop').remove();
                     $(".result").html(response.data);
                 }
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