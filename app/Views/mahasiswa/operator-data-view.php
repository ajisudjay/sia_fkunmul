 <?php error_reporting(0); ?>
 <!-- Modal Tambah Mahasiswa -->
 <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#tambahMahasiswa">
     <span class="fa fa-plus-circle text-light"> Tambah Mahasiswa</span>
 </button>

 <div class="dt-responsive table-responsive mt-3">
     <table id="basic-row-reorder" class="table table-striped table-bordered nowrap">
         <thead>
             <tr>
                 <td style="max-width: 5px;">No</td>
                 <td style="max-width: 10px;">Aksi</td>
                 <td style="max-width: 30px;">Foto</td>
                 <td style="max-width: 50px;">Angkatan</td>
                 <td style="width: 10px;">NIM</td>
                 <td style="width: 300px;">Nama</td>
                 <td style="width: 100px;">Akun User</td>
             </tr>
         </thead>
         <tbody>
             <?php $no = 1 ?>
             <?php foreach ($mahasiswa as $item) :
                    $id_user = $item['nim'];
                ?>
                 <tr>
                     <td style="text-align: center;"><?= $no++ ?></td>
                     <td>
                         <!-- Modal EDIT -->
                         <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#modalEdit<?= $item['id_mahasiswa'] ?>">
                             <span class="fa fa-edit text-primary"></span>
                         </button>
                         <div class="modal fade" id="modalEdit<?= $item['id_mahasiswa'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                             <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h5 class="modal-title text-primary" id="exampleModalLongTitle">Edit Data Mahasiswa</h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                         </button>
                                     </div>
                                     <form action="<?= base_url('mahasiswa/edit'); ?>" method="POST" class="formEdit">
                                         <?php csrf_field() ?>
                                         <div class="modal-body">
                                             <?php $id = $item['id_mahasiswa'] ?>
                                             <?php
                                                $sql_edit = mysqli_query($koneksi, "SELECT * FROM mahasiswas JOIN programstudis ON mahasiswas.id_ps=programstudis.id JOIN statusdosens ON mahasiswas.status=statusdosens.id JOIN angkatans ON mahasiswas.id_angkatan=angkatans.id WHERE mahasiswas.id_mahasiswa='$id'");
                                                $dataEdit = mysqli_fetch_array($sql_edit); ?>
                                             <div class="row">
                                                 <div class="col-xl-5">
                                                     <input type="text" name="id" value="<?= $id ?>" class="form-control" hidden>
                                                     <label class="text-primary">NIM</label>
                                                     <input type="text" name="nim" value="<?= $dataEdit['nim'] ?>" class="form-control">
                                                     <input type="text" name="nim_lama" value="<?= $dataEdit['nim'] ?>" class="form-control" hidden>
                                                     <label class="text-primary mt-2">NAMA</label>
                                                     <input type="text" name="nama" value="<?= $dataEdit['nama_mahasiswa'] ?>" class="form-control">
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
                                                     <label class="text-primary">Angkatan</label>
                                                     <select class="form-control" name="angkatan">
                                                         <option value="<?= $dataEdit['id_angkatan'] ?>"><?= $dataEdit['angkatan'] ?></option>
                                                         <?php foreach ($angkatan as $itemAngkatan) : ?>
                                                             <option value="<?= $itemAngkatan['id_angkatan'] ?>"><?= $itemAngkatan['angkatan'] ?></option>
                                                         <?php endforeach ?>
                                                     </select>
                                                     <label class="text-primary mt-2">PROGRAM STUDI</label>
                                                     <select class="form-control" name="ps">
                                                         <option value="<?= $dataEdit['id_ps'] ?>"><?= $dataEdit['program_studi'] ?></option>
                                                     </select>
                                                     <label class="text-primary mt-2">STATUS</label>
                                                     <select class="form-control" name="status">
                                                         <option value="<?= $sd['id_mahasiswa'] ?>"><?= $sd['nama_status'] ?></option>
                                                     </select>
                                                     <label class="text-primary mt-2">ALAMAT</label>
                                                     <textarea name="alamat" id="" cols="30" rows="4" class="form-control"><?= $dataEdit['alamat'] ?></textarea>
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
                         <form action="<?= base_url('mahasiswa/hapus'); ?>" method="post" class="d-inline hapusMahasiswa">
                             <?= csrf_field() ?>
                             <input type="text" name="id" value="<?= $item['id_mahasiswa'] ?>" hidden>
                             <input type="text" name="ps" value="<?= $item['id_ps'] ?>" hidden>
                             <input type="text" name="nim" value="<?= $item['nim'] ?>" hidden>
                             <input type="text" name="angkatan" value="<?= $item['id_angkatan'] ?>" hidden>
                             <input type="text" name="nama" class="form-control" value="<?= $edit['nama_dosen'] ?>" hidden>
                             <button type="submit" class="bg-transparent border-0 btnHapus" onclick="return confirm('Anda yakin menghapus data ini ?')">
                                 <span class="feather icon-trash-2 text-danger"></span>
                             </button>
                         </form>
                         <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#modalDetail<?= $item['id_mahasiswa'] ?>">
                             <span class="fa fa-info text-info"></span>
                         </button>

                         <!-- Modal Detail-->
                         <div class="modal fade" id="modalDetail<?= $item['id_mahasiswa'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                             <div class="modal-dialog modal-lg" role="document">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h5 class="modal-title text-primary" id="exampleModalLabel">Informasi Data Mahasiswa</h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                         </button>
                                     </div>
                                     <div class="modal-body">
                                         <div class="row px-4">
                                             <div class="col-lg-5">
                                                 <label class="text-primary">Nama</label>
                                                 <p><?= $dataEdit['nama_mahasiswa'] ?></p>
                                                 <hr>
                                                 <label class="text-primary mt-2">NIM</label>
                                                 <p><?= $dataEdit['nim'] ?></p>
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

                         <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#tambahUserMahasiswa<?= $item['id'] ?>" <?= $akun ?>>
                             <span class="fa fa-key text-warning"></span>
                         </button>
                         <div class="modal fade" id="tambahUserMahasiswa<?= $item['id'] ?>" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                             <div class="modal-dialog modal-dialog-centered" role="document">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                         </button>
                                     </div>
                                     <div class="modal-body">
                                         <form action="<?= base_url('mahasiswa/tambahUser'); ?>" method="post" class="tambahUser">
                                             <?php csrf_field() ?>
                                             <div class="mr-5 ml-2">
                                                 <input type="text" name="id_ps" value="<?= $dataEdit['id_ps'] ?>" id="" hidden>
                                                 <input type="text" name="id_angkatan" value="<?= $dataEdit['id_angkatan'] ?>" id="" hidden>
                                                 <label class="text-primary">NIM</label>
                                                 <input type="text" name="username" value="<?= $dataEdit['nim'] ?>" class="form-control" readonly>
                                                 <label class="text-primary mt-3">NAMA</label>
                                                 <input type="text" name="nama_user" value="<?= $dataEdit['nama_mahasiswa'] ?>" class="form-control" readonly>
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
                     <?php
                        $sql_angkatan = mysqli_query($koneksi, "SELECT * FROM mahasiswas JOIN angkatans ON mahasiswas.id_angkatan=angkatans.id WHERE mahasiswas.id_mahasiswa='$id'");
                        $dataAngkatan = mysqli_fetch_array($sql_angkatan); ?>
                     <td><?= $dataAngkatan['angkatan'] ?></td>
                     <td><?= $item['nim'] ?></td>
                     <td><?= $item['nama_mahasiswa'] ?></td>
                     <td><?= $user ?></td>
                 </tr>
             <?php endforeach ?>
         </tbody>
     </table>
 </div>
 <!-- MODAL MAHASISWA -->
 <div class="modal fade" id="tambahMahasiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Tambah Mahasiswa Baru</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="<?= base_url('mahasiswa/tambah'); ?>" method="post" class="tambahBaru">
                     <?php csrf_field() ?>
                     <div class="modal-body">
                         <div class="row">
                             <div class="col-lg-6">
                                 <label class="text-primary">NIM</label>
                                 <input type="text" name="nim" class="form-control">
                                 <label class="text-primary mt-2">NAMA</label>
                                 <input type="text" name="nama" class="form-control">
                                 <label class="text-primary mt-2">EMAIL</label>
                                 <input type="text" name="email" class="form-control">
                                 <label class="text-primary mt-2">Telepon</label>
                                 <input type="text" name="telepon" class="form-control">
                                 <label class="text-primary mt-2">Jenis Kelamin</label>
                                 <select class="form-control" name="jk">
                                     <option>pria</option>
                                     <option>wanita</option>
                                 </select>
                             </div>
                             <div class="col-lg-6">
                                 <label class="text-primary">PROGRAM STUDI</label>
                                 <select class="form-control" name="id_ps">
                                     <option value="<?= $ps['id'] ?>"><?= $ps['program_studi'] ?></option>
                                 </select>
                                 <label class="text-primary mt-2">ANGKATAN</label>
                                 <select class="form-control" name="id_angkatan">
                                     <option value="<?= $ang['id'] ?>"><?= $ang['angkatan'] ?></option>
                                 </select>
                                 <label class="text-primary mt-2">STATUS</label>
                                 <select class="form-control" name="status">
                                     <option value="<?= $sd['id'] ?>"><?= $sd['nama_status'] ?></option>
                                 </select>
                                 <label class="text-primary mt-2">ALAMAT</label>
                                 <textarea name="alamat" id="" cols="30" rows="5" class="form-control"></textarea>
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


 <script src=" <?= base_url(''); ?>\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
 <script src="<?= base_url(''); ?>\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js"></script>
 <script src="<?= base_url(''); ?>\assets\pages\data-table\extensions\row-reorder\js\dataTables.rowReorder.min.js"></script>
 <script src="<?= base_url(''); ?>\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
 <script src="<?= base_url(''); ?>\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
 <script src="<?= base_url(''); ?>\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
 <!-- Custom js -->
 <script src="<?= base_url(''); ?>\assets\pages\data-table\extensions\row-reorder\js\row-reorder-custom.js"></script>
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
                         title: 'Berhasil',
                         text: response.sukses,
                     });
                     $('body').removeClass('modal-open');
                     //modal-open class is added on body so it has to be removed
                     $('.modal-backdrop').remove();
                     //need to remove div with modal-backdrop class
                     $("#result").html(response.data);
                 },
                 error: function(xhr, ajaxOptions, thrownError) {
                     alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                 }
             })
         });

         $('.hapusMahasiswa').submit(function(e) {
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
                         title: 'Berhasil',
                         text: response.sukses,
                     });
                     $("#result").html(response.data);
                 },
                 error: function(xhr, ajaxOptions, thrownError) {
                     alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                 }
             })
         });

         $('.tambahBaru').submit(function(e) {
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
                 },
                 success: function(response) {
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
                 },
                 error: function(xhr, ajaxOptions, thrownError) {
                     alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                 }
             })
         });
     });

     $('.formTambahMahasiswaExcel').submit(function(e) {
         e.preventDefault();
         //  var id_ps = <?= $id_ps ?>;
         //  var id_angkatan = <?= $id_angkatan ?>;
         //  var files = $('#fileexcel')[0].files;
         //  var fd = new FormData();

         //  fd.append('fileexcel', files[0]);
         //  fd.append('id_ps', id_ps);
         //  fd.append('id_angkatan', id_angkatan);

         $.ajax({
             type: "post",
             url: $(this).attr('action'),
             data: new FormData(this),
             processData: false,
             contentType: false,
             cache: false,
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
                     if (response.error.fileexcel) {
                         $('.excel').addClass('is-invalid');
                         $('.errorexcel').html(response.error.fileexcel);
                     } else {
                         $('.excel').removeClass('is-invalid');
                         $('.errorexcel').html('');
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