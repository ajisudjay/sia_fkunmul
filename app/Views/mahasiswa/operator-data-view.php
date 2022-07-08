 <?php error_reporting(0) ?>
 <?php if ($sukses == 'pesanBerhasil') : ?>
     <div class="flashAjax alert background-success" role="alert" style="width: 100%;">
         <?= $item ?> Berhasil <?= $itemResponse ?>
     </div>
 <?php endif; ?>
 <!-- Modal Tambah Dosen -->
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
             </tr>
         </thead>
         <tbody>
             <?php $no = 1 ?>
             <?php foreach ($mahasiswa as $item) : ?>
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
                                         <h5 class="modal-title text-primary" id="exampleModalLongTitle">Edit Data Mahasiswa</h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                         </button>
                                     </div>
                                     <form action="<?= base_url('mahasiswa/edit'); ?>" method="POST" class="formEdit">
                                         <?php csrf_field() ?>
                                         <div class="modal-body">
                                             <?php $id = $item['id'] ?>
                                             <?php
                                                $sql_edit = mysqli_query($koneksi, "SELECT * FROM mahasiswas JOIN programstudis ON mahasiswas.id_ps=programstudis.id JOIN statusdosens ON mahasiswas.status=statusdosens.id JOIN angkatans ON mahasiswas.id_angkatan=angkatans.id WHERE mahasiswas.id='$id'");
                                                $dataEdit = mysqli_fetch_array($sql_edit); ?>
                                             <div class="row">
                                                 <div class="col-xl-5">
                                                     <input type="text" name="id" value="<?= $id ?>" class="form-control" hidden>
                                                     <label class="text-primary">NIM</label>
                                                     <input type="text" name="nim" value="<?= $dataEdit['nim'] ?>" class="form-control">
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
                                                         <option value="<?= $sd['id'] ?>"><?= $sd['nama_status'] ?></option>
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
                             <input type="text" name="id" value="<?= $item['id'] ?>" hidden>
                             <input type="text" name="ps" value="<?= $item['id_ps'] ?>" hidden>
                             <input type="text" name="angkatan" value="<?= $item['id_angkatan'] ?>" hidden>
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
                     </td>
                     <td align="center">
                         <?php if ($item['foto'] == NULL) { ?>
                             <img src="<?= base_url('assets/images/user-profile.png'); ?>" width="30px" height="30px" alt="">
                         <?php } else { ?>
                             <img src="<?= base_url('foto/profile/' . $item['foto'] . ''); ?>" alt="">
                         <?php } ?>
                     </td>
                     <?php
                        $sql_angkatan = mysqli_query($koneksi, "SELECT * FROM mahasiswas    JOIN angkatans ON mahasiswas.id_angkatan=angkatans.id WHERE mahasiswas.id='$id'");
                        $dataAngkatan = mysqli_fetch_array($sql_angkatan); ?>
                     <td><?= $dataAngkatan['angkatan'] ?></td>
                     <td><?= $item['nim'] ?></td>
                     <td><?= $item['nama_mahasiswa'] ?></td>
                 </tr>
             <?php endforeach ?>
         </tbody>
     </table>
 </div>

 <div class="modal fade" id="tambahMahasiswa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Tambah Dosen Baru</h5>
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
                                 <input type="text" name="nim" class="form-control" required>
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
                                     <option value="<?= $ps['id'] ?>"><?= $ps['program_studi'] ?></option>
                                 </select>
                                 <label class="text-primary mt-2">ANGKATAN</label>
                                 <select class="form-control" required name="angkatan">
                                     <option value="<?= $ang['id'] ?>"><?= $ang['angkatan'] ?></option>
                                 </select>
                                 <label class="text-primary mt-2">STATUS</label>
                                 <select class="form-control" required name="status">
                                     <option value="<?= $sd['id'] ?>"><?= $sd['nama_status'] ?></option>
                                 </select>
                                 <label class="text-primary mt-2">ALAMAT</label>
                                 <textarea name="alamat" id="" cols="30" rows="5" class="form-control" required></textarea>
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

 <script src="<?= base_url(''); ?>\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
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


     window.setTimeout(function() {
         $(".flashAjax").fadeTo(500, 0).slideUp(500, function() {
             $(this).remove();
         });
     }, 5000);
 </script>