 <?php error_reporting(0) ?>

 <hr>
 <!-- button tambah modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPrestasimodal">
     <span class="fa fa-plus-circle text-light"> Tambah Prestasi / Kegiatan</span>
    </button>    

     <!-- tambah modal-->
    <div class="modal fade" id="tambahPrestasimodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Prestasi / Kegiatan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('prestasi/tambah'); ?>" method="post" enctype="multipart/form-data" class="tambahPrestasi">
                        <?php csrf_field() ?>
                        <div class="modal-body">                         
                        <div class="row">
                        <div class="col-lg-12">   
                                <label class="text-primary">Judul</label>
                                <input type="text" name="judul" class="form-control judul" placeholder="Judul">
                                <div class="invalid-feedback errorJudul"></div>
                                <hr>  
                        </div>
                                <div class="col-lg-4">                                
                                <label class="text-primary">Jenis</label>                                
                                    <select class="form-control jenis" name="jenis">
                                        <option value="">Pilih Jenis</option>
                                        <option value="Partisipan">Partisipan</option>
                                        <option value="Kelembagaan">Kelembagaan</option>
                                        <option value="Prestasi">Prestasi</option>
                                    </select>
                                    <div class="invalid-feedback errorJenis"></div>                                
                                    <hr> 
                                </div>
                               
                                <div class="col-lg-4">
                                <label class="text-primary">Tingkat</label>                                
                                    <select class="form-control tingkat" name="tingkat">
                                        <option value="">Pilih Tingkat</option>
                                        <option value="Program Studi">Program Studi</option>
                                        <option value="Jurusan">Jurusan</option>
                                        <option value="Fakultas">Fakultas</option>
                                        <option value="Universitas">Universitas</option>
                                        <option value="Regional">Regional</option>                                        
                                        <option value="Nasional">Nasional</option>
                                        <option value="Internasional">Internasional</option>
                                    </select>
                                    <div class="invalid-feedback errorTingkat"></div>                                
                                    <hr>                                                                                                
                                </div>

                                <div class="col-lg-4">
                                    <label class="text-primary">Tanggal</label>
                                    <input type="date" name="tanggal" class="form-control tanggal">
                                    <div class="invalid-feedback errorTanggal"></div>
                                    <hr>                                                                                                     
                                </div>
                                <div class="col-lg-12">                                                               
                                    <label class="text-primary">File Bukti</label>
                                    <input type="file" name="file_bukti" class="form-control file_bukti">
                                    <div class="invalid-feedback errorFilebukti"></div>
                                    <hr>                                   
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

    <!-- VIEW-->                         
 <div class="dt-responsive table-responsive mt-3">
     <table id="basic-row-reorder" class="table table-striped table-bordered nowrap">
         <thead>
             <tr>
                 <td style="max-width: 5%;">No</td>
                 <td style="max-width: 10%;">Aksi</td>
                 <td style="max-width: 20%;">Jenis</td>
                 <td style="max-width: 50%;">Judul</td>
                 <td style="max-width: 10%;">Tanggal</td>                                                               
             </tr>
         </thead>
         <tbody>
             <?php $no = 1 ?>
             <?php foreach ($prestasi as $item) : ?>
                <?php $id = $item['id'] ?>                                            
                <?php
                $sql_edit = mysqli_query($koneksi, "SELECT *, prestasi.id as idx FROM prestasi WHERE prestasi.id='$id'");
                $dataEdit = mysqli_fetch_array($sql_edit);                       
                ?>
                 <tr>
                     <td style="text-align: center;"><?= $no++ ?></td>
                     <td>              

                        <!-- button detail modal -->
                        <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#modalDetail<?= $item['id'] ?>">
                             <span class="fa fa-info text-info"></span>
                         </button>

                         <!-- detail modal-->
                        <div class="modal fade" id="modalDetail<?= $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary" id="exampleModalLabel"><?= $dataEdit['judul'] ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>                                    
                                    <div class="modal-body">
                                        <div class="row px-12">                                    
                                            <div class="col-lg-3">
                                            <label class="text-primary">Jenis</label>
                                                <p><?= $dataEdit['jenis'] ?></p>
                                                <hr>                                      
                                            </div>                                            
                                        <div class="col-lg-3">                                                                           
                                        <label class="text-primary">Tingkat</label>
                                                <p><?= $dataEdit['tingkat'] ?></p>
                                                <hr>                                                                                              
                                        </div>
                                        <div class="col-lg-3">                                                                           
                                        <label class="text-primary">Tanggal</label>
                                                <p><?= $dataEdit['tanggal'] ?></p>
                                                <hr>                                                                                               
                                        </div>                                       
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row px-11">
                                            <div class="col-lg-11" align="center">                                                 
                                                <img src="assets/img/prestasi/<?= $dataEdit['file_bukti'] ?>" width="40%">
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
 
                         <!-- button edit modal -->
                         <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#modalEdit<?= $item['id'] ?>">
                             <span class="fa fa-edit text-primary"></span>
                         </button>                                                                                                  
                        <!-- edit modal -->
                        <div class="modal fade" id="modalEdit<?= $item['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-primary" id="exampleModalLongTitle">Edit : <?= $dataEdit['judul'] ?></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="<?= base_url('prestasi/edit'); ?>" method="POST" class="formEdit">
                                        <?php csrf_field() ?>
                                        <div class="modal-body">                                            
                                            <div class="row">
                                                <div class="col-lg-10">
                                                    <input type="text" value="<?= $dataEdit['idx'] ?>" name="id" class="form-control" hidden>
                                                    <label class="text-primary">Judul</label>
                                                    <input type="text" value="<?= $dataEdit['judul'] ?>" name="judul" class="form-control judulEdit">
                                                    <div class="invalid-feedback errorJudulEdit"></div>
                                                </div>   
                                                <div class="col-lg-3">                                                    
                                                    <label class="text-primary">Jenis</label>
                                                <select class="form-control jenisEdit" name="jenis">
                                                    <option value="<?= $dataEdit['jenis'] ?>"><?= $dataEdit['jenis'] ?></option>
                                                    <option value="Partisipan">Partisipan</option>
                                                    <option value="Kelembagaan">Kelembagaan</option>
                                                    <option value="Prestasi">Prestasi</option>
                                                </select>    
                                                    <div class="invalid-feedback errorJenisEdit"></div>
                                                </div>

                                                <div class="col-lg-3 ">
                                                <label class="text-primary">Tingkat</label>       
                                                <select class="form-control tingkatEdit" name="tingkat">
                                                <option value="<?= $dataEdit['tingkat'] ?>"><?= $dataEdit['tingkat'] ?></option>
                                                    <option value="">Pilih Tingkat</option>
                                                    <option value="Program Studi">Program Studi</option>
                                                    <option value="Jurusan">Jurusan</option>
                                                    <option value="Fakultas">Fakultas</option>
                                                    <option value="Universitas">Universitas</option>
                                                    <option value="Regional">Regional</option>                                        
                                                    <option value="Nasional">Nasional</option>
                                                    <option value="Internasional">Internasional</option>
                                                </select>                                    
                                                    <div class="invalid-feedback errorTingkatEdit"></div>                                         
                                                </div>

                                                <div class="col-lg-3 ">  
                                                <label class="text-primary">Tanggal</label>
                                                    <input type="date" value="<?= $dataEdit['tanggal'] ?>" name="tanggal" class="form-control tanggalEdit">
                                                    <div class="invalid-feedback errorTanggalEdit"></div>                                                
                                                                                            
                                                </div>
                                                <div class="col-lg-11 ">
                                                    <div class="col-lg-11" align="center">                                                 
                                                        <img src="assets/img/prestasi/<?= $dataEdit['file_bukti'] ?>" width="50%">
                                                        
                                                    <input type="file" value="<?= $dataEdit['file_bukti'] ?>" name="file_bukti" class="form-control file_buktiEdit">
                                                    <div class="invalid-feedback errorFile_buktiEdit"></div>
                                                        <hr>                                               
                                                    </div>                                           
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
                        
                         <!-- button hapus modal-->
                        <form action="<?= base_url('prestasi/hapus'); ?>" method="post" class="d-inline hapusUser">
                            <?= csrf_field() ?>
                            <input type="text" name="id" value="<?= $item['id'] ?>" hidden>                                                         
                            <button type="submit" class="bg-transparent border-0 btnHapus" onclick="return confirm('Anda yakin menghapus data ini ?')">
                                <span class="feather icon-trash-2 text-danger"></span>
                            </button>
                        </form>

                        </td>

                        <!-- ISI VIEW -->                         
                     <td><?= $item['jenis'] ?></td>
                     <td><?= $item['judul'] ?></td>
                     <td><?= $item['tanggal'] ?></td>                     
                 </tr>
             <?php endforeach ?>
         </tbody>
     </table>
 </div>

 <!-- SCRIPT AJAX -->
 <script>
     $(document).ready(function() {
    // function edit
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
                         if (response.error.judul) {
                             $('.judulEdit').addClass('is-invalid');
                             $('.errorJudulEdit').html(response.error.judul);
                         } else {
                             $('.judulEdit').removeClass('is-invalid');
                             $('.errorJudulEdit').html('');
                         }

                         if (response.error.jenis) {
                             $('.jenisEdit').addClass('is-invalid');
                             $('.errorJenisEdit').html(response.error.jenis);
                         } else {
                             $('.jenisEdit').removeClass('is-invalid');
                             $('.errorJenisEdit').html('');
                         }

                         if (response.error.tingkat) {
                             $('.tingkatEdit').addClass('is-invalid');
                             $('.errorTingkatEdit').html(response.error.tingkat);
                         } else {
                             $('.tingkatEdit').removeClass('is-invalid');
                             $('.errorTingkatEdit').html('');
                         }

                         if (response.error.tanggal) {
                             $('.tanggalEdit').addClass('is-invalid');
                             $('.errorTanggalEdit').html(response.error.tanggal);
                         } else {
                             $('.tanggalEdit').removeClass('is-invalid');
                             $('.errorTanggalEdit').html('');
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
        //  function tambah
         $('.tambahPrestasi').submit(function(e) {
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
                         if (response.error.judul) {
                             $('.judul').addClass('is-invalid');
                             $('.errorJudul').html(response.error.judul);
                         } else {
                             $('.judul').removeClass('is-invalid');
                             $('.errorJudul').html('');
                         }
                         if (response.error.jenis) {
                             $('.jenis').addClass('is-invalid');
                             $('.errorJenis').html(response.error.jenis);
                         } else {
                             $('.jenis').removeClass('is-invalid');
                             $('.errorJenis').html('');
                         }
                         if (response.error.tingkat) {
                             $('.tingkat').addClass('is-invalid');
                             $('.errorTingkat').html(response.error.tingkat);
                         } else {
                             $('.tingkat').removeClass('is-invalid');
                             $('.errorTingkat').html('');
                         }                        
                         if (response.error.tanggal) {
                             $('.tanggal').addClass('is-invalid');
                             $('.errorTanggal').html(response.error.tanggal);
                         } else {
                             $('.tanggal').removeClass('is-invalid');
                             $('.errorTanggal').html('');
                         }                         
                         if (response.error.file_bukti) {
                             $('.file_bukti').addClass('is-invalid');
                             $('.errorFile_bukti').html(response.error.file_bukti);
                         } else {
                             $('.file_bukti').removeClass('is-invalid');
                             $('.errorFile_bukti').html('');
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

        //  function hapus
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