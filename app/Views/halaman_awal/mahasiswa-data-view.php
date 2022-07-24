 <div class="pcoded-content">
     <div class="pcoded-inner-content">
         <!-- Main-body start -->
         <div class="main-body">
             <div class="page-wrapper">
                 <!-- Page-header start -->
                 <div class="page-header">
                     <div class="row align-items-end">
                         <div class="col-lg-8">
                             <div class="page-header-title">
                                 <div class="d-inline">
                                     <h4>Selamat Datang</h4>
                                     <span><?= $user['nama_user'] ?></span>
                                 </div>
                             </div>
                         </div>
                         <div class="col-lg-4">
                             <div class="page-header-breadcrumb">
                                 <ul class="breadcrumb-title">
                                     <li class="breadcrumb-item">
                                         <a href="index-1.htm"> <i class="feather icon-home"></i> </a>
                                     </li>
                                     <li class="breadcrumb-item"><a href="/operator">Beranda</a>
                                     </li>
                                 </ul>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- Page-header end -->
                 <!-- Page-body start -->
                 <div class="page-body">
                     <div class="row">
                         <div class="col-sm-12">
                             <div>
                                 <div class="content social-timeline">
                                     <div class="">
                                         <!-- Row Starts -->
                                         <div class="row cover-bg">
                                             <div class="col-md-12">
                                                 <!-- Social wallpaper start -->
                                                 <div class="social-wallpaper" style="border-radius: 20px;">
                                                     <img src="<?= $user['foto_cover'] == null ? base_url('assets/images/auth/cover-profil.jpeg') : base_url('assets/images/user-profile/' . $user['foto_cover'] . '') ?>" height="300px" class="width-100" style="border-radius: 20px;" alt="">

                                                     <div class="profile-hvr">
                                                         <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#modalCoverProfil">
                                                             <i class="icofont icofont-ui-edit p-r-10 text-light"></i>
                                                         </button>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                         <!-- Row end -->
                                         <!-- Row Starts -->
                                         <div class="row">
                                             <div class="col-xl-3 col-lg-4 col-md-4 col-xs-12">
                                                 <!-- Social timeline left start -->
                                                 <div class="social-timeline-left">
                                                     <!-- social-profile card start -->
                                                     <div class="card">
                                                         <div class="social-profile">
                                                             <img class="foto-beranda width-100" src="<?= $user['foto'] == null ? base_url('assets/images/auth/no-image.png') : base_url('assets/images/user-profile/' . $user['foto'] . '') ?>" alt="" height="250px" style="border-radius: 10px;">
                                                             <div class="profile-hvr m-t-15">
                                                                 <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#modalFotoProfilBeranda">
                                                                     <i class="icofont icofont-ui-edit p-r-10 text-light"></i>
                                                                 </button>
                                                             </div>
                                                         </div>
                                                         <div class="card-block social-follower">
                                                             <h4><?= $user['nama_user'] ?></h4>
                                                             <h5><?= $user['user_role'] ?></h5>
                                                         </div>
                                                     </div>
                                                     <!-- social-profile card end -->
                                                     <!-- Who to follow card start -->
                                                     <div class="card">
                                                         <div class="card-header">
                                                             <h5 class="text-muted card-header-text">
                                                                 <span class="text-warning fa fa-university mb-2">
                                                                     Program Studi
                                                                 </span>
                                                             </h5><br>
                                                             <h5 class="card-header-text"><?= $mahasiswa['program_studi'] ?> </h5>
                                                             <hr>
                                                             <h5 class="text-muted card-header-text">
                                                                 <span class="text-danger fa fa-suitcase mb-2">
                                                                     Angkatan
                                                                 </span>
                                                             </h5><br>
                                                             <h5 class="card-header-text"><?= $mahasiswa['angkatan'] ?> </h5>
                                                             <hr>
                                                             <h5 class="text-muted card-header-text">
                                                                 <span class="text-primary fa fa-phone mb-2">
                                                                     Telepon
                                                                 </span>
                                                             </h5><br>
                                                             <h5 class="card-header-text"><?= $mahasiswa['telepon'] ?> </h5>
                                                             <hr>
                                                             <h5 class="text-muted card-header-text">
                                                                 <span class="text-info icofont icofont-email mb-2">
                                                                     Email
                                                                 </span>
                                                             </h5><br>
                                                             <h5 class="card-header-text"><?= $mahasiswa['email'] ?> </h5>
                                                             <hr>
                                                             <h5 class="text-muted card-header-text">
                                                                 <span class="text-success fa fa-university mb-2">
                                                                     Alamat
                                                                 </span>
                                                             </h5><br>
                                                             <h5 class="card-header-text"><?= $mahasiswa['alamat'] ?> </h5>
                                                             <hr>
                                                             <h5 class="text-muted card-header-text">
                                                                 <span class="text-primary fa fa-university mb-2">
                                                                     Pembimbing Akademik
                                                                 </span>
                                                             </h5><br>
                                                             <h5 class="card-header-text"><?= $mahasiswa['nama_dosen'] ?> </h5>
                                                             <hr>
                                                         </div>
                                                     </div>
                                                     <!-- Who to follow card end -->
                                                     <!-- Friends card start -->
                                                     <div class="card">
                                                         <div class="card-header">
                                                             <h5 class="card-header-text d-inline-block">Friends</h5>
                                                             <!-- <span class="friend-more f-right">see 12 more</span> -->
                                                             <span class="label label-primary f-right"> See 12 More </span>
                                                         </div>
                                                         <div class="card-block friend-box">
                                                             <img class="media-object img-radius" src="<?= base_url(''); ?>\assets\images\avatar-1.jpg" alt="" data-toggle="tooltip" data-placement="top" title="user image">
                                                             <img class="media-object img-radius" src="<?= base_url(''); ?>\assets\images\avatar-2.jpg" alt="" data-toggle="tooltip" data-placement="top" title="user image">
                                                             <img class="media-object img-radius" src="<?= base_url(''); ?>\assets\images\avatar-3.jpg" alt="" data-toggle="tooltip" data-placement="top" title="user image">
                                                             <img class="media-object img-radius" src="<?= base_url(''); ?>\assets\images\avatar-4.jpg" alt="" data-toggle="tooltip" data-placement="top" title="user image">
                                                             <img class="media-object img-radius" src="<?= base_url(''); ?>\assets\images\avatar-1.jpg" alt="" data-toggle="tooltip" data-placement="top" title="user image">
                                                             <img class="media-object img-radius" src="<?= base_url(''); ?>\assets\images\avatar-4.jpg" alt="" data-toggle="tooltip" data-placement="top" title="user image">
                                                             <img class="media-object img-radius" src="<?= base_url(''); ?>\assets\images\avatar-3.jpg" alt="" data-toggle="tooltip" data-placement="top" title="user image">
                                                             <img class="media-object img-radius" src="<?= base_url(''); ?>\assets\images\avatar-2.jpg" alt="" data-toggle="tooltip" data-placement="top" title="user image">
                                                         </div>
                                                     </div>
                                                     <!-- Friends card end -->
                                                 </div>
                                                 <!-- Social timeline left end -->
                                             </div>
                                             <div class="col-xl-9 col-lg-8 col-md-8 col-xs-12 ">
                                                 <!-- Nav tabs -->
                                                 <div class="card social-tabs">
                                                     <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist">
                                                         <li class="nav-item">
                                                             <a class="nav-link timeline active" data-toggle="tab" href="" role="tab">Aktifitas</a>
                                                             <div class="slide"></div>
                                                         </li>
                                                         <li class="nav-item">
                                                             <a class="nav-link prestasi" data-toggle="tab" href="" role="tab">Prestasi</a>
                                                             <div class="slide"></div>
                                                         </li>
                                                         <li class="nav-item">
                                                             <a class="nav-link perkuliahan" data-toggle="tab" href="#photos" role="tab">Perkuliahan</a>
                                                             <div class="slide"></div>
                                                         </li>
                                                     </ul>
                                                 </div>
                                                 <!-- Tab panes -->
                                                 <div class="tab-content">
                                                     <div class="result-timeline"></div>
                                                     <div class="result-prestasi"></div>
                                                     <div class="result-perkuliahan"></div>
                                                 </div>
                                             </div>
                                             <!-- Row end -->
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- Page-body end -->
         </div>
     </div>
     <!-- Main-body end -->
 </div>


 <div class="modal fade" id="modalCoverProfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLongTitle">Edit Cover Beranda</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="j-unit">
                     <label class="j-label">Pilih Foto</label>
                     <div class="j-input">
                         <input type="file" name="file" id="file_cover" class="form-control" onchange="previewImg()">
                     </div>
                     <div style="font-size: 12px;margin-top:7px" class="text-danger errortelepon"></div>
                 </div>
                 <label class="mb-2 mt-2 custom-file-label j-label" for="customFile">Preview</label>
                 <div style="font-size: 12px;margin-top:7px" class="text-danger errorfile"></div>
                 <div class="container">
                     <img src="<?= $user['foto_cover'] == null ? base_url('assets/images/auth/no-image.png') : base_url('assets/images/user-profile/' . $user['foto_cover'] . '') ?>" class="img-preview" style="border-radius: 20px; width:450px; height:250px;display:block; margin:auto">
                     <input type="text" class="id_user_cover" value="<?= $user['id'] ?>" hidden>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="button" class="formEditFotoCover btn btn-primary">Simpan</button>
             </div>
         </div>
     </div>
 </div>

 <div class="modal fade" id="modalFotoProfilBeranda" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLongTitle">Edit Foto Profil</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <div class="j-unit">
                     <label class="j-label">Pilih Foto</label>
                     <div class="j-input">
                         <input type="file" name="file" id="file_foto_beranda" class="form-control" onchange="previewImgFoto()">
                     </div>
                 </div>
                 <label class="mb-2 mt-2 custom-file-label j-label" for="customFile">Preview</label>
                 <div style="font-size: 12px;margin-top:7px" class="text-danger errorfile"></div>
                 <div class="container">
                     <img src="<?= $user['foto'] == null ? base_url('assets/images/auth/no-image.png') : base_url('assets/images/user-profile/' . $user['foto'] . '') ?>" class="img-preview-foto" style="border-radius: 20px; width:250px; height:250px; display:block; margin:auto">
                     <input type="text" class="id_user_cover" value="<?= $user['id'] ?>" hidden>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="button" class="formEditFoto btn btn-primary">Simpan</button>
             </div>
         </div>
     </div>
 </div>

 <script>
     function previewImg() {
         const gambar = document.querySelector('#file_cover');
         const gambarLabel = document.querySelector('.custom-file-label');
         const imgPreview = document.querySelector('.img-preview');

         gambarLabel.textContent = gambar.files[0].name;

         const fileGambar = new FileReader();
         fileGambar.readAsDataURL(gambar.files[0]);

         fileGambar.onload = function(e) {
             imgPreview.src = e.target.result;
         }
     }

     function previewImgFoto() {
         const gambar = document.querySelector('#file_foto_beranda');
         const gambarLabel = document.querySelector('.custom-file-label');
         const imgPreview = document.querySelector('.img-preview-foto');

         gambarLabel.textContent = gambar.files[0].name;

         const fileGambar = new FileReader();
         fileGambar.readAsDataURL(gambar.files[0]);

         fileGambar.onload = function(e) {
             imgPreview.src = e.target.result;
         }
     }

     $(".formEditFoto").click(function(e) {
         e.preventDefault(); //Prevent Default action.
         var id = $('.id_user_cover').val();
         var files = $('#file_foto_beranda')[0].files;
         var fd = new FormData();

         fd.append('file', files[0]);
         fd.append('id', id);

         $.ajax({
             type: "post",
             url: '<?= base_url('profil/prosesEditFotoMahasiswaBeranda') ?>',
             data: fd,
             dataType: "json",
             contentType: false,
             processData: false,
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
                     if (response.error.file) {
                         $('.file').addClass('is-invalid');
                         $('.errorfile').html(response.error.file);
                     } else {
                         $('.file').removeClass('is-invalid');
                         $('.errorfile').html('');
                     }
                 } else {
                     Swal.fire({
                         title: 'Berhasil',
                         text: response.sukses,
                         icon: 'success',
                         type: "success",
                     })
                     $('body').removeClass('modal-open');
                     $('.modal-backdrop').remove();
                     $(".result").html(response.data);
                 }
             },
             error: function(xhr, ajaxOptions, thrownError) {
                 alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
             }
         });
     });

     $(".formEditFotoCover").click(function(e) {
         e.preventDefault(); //Prevent Default action.
         var id = $('.id_user_cover').val();
         var files = $('#file_cover')[0].files;
         var fd = new FormData();

         fd.append('file', files[0]);
         fd.append('id', id);

         $.ajax({
             type: "post",
             url: '<?= base_url('profil/prosesEditFotoCoverMahasiswa') ?>',
             data: fd,
             dataType: "json",
             contentType: false,
             processData: false,
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
                     if (response.error.file) {
                         $('.file').addClass('is-invalid');
                         $('.errorfile').html(response.error.file);
                     } else {
                         $('.file').removeClass('is-invalid');
                         $('.errorfile').html('');
                     }
                 } else {
                     Swal.fire({
                         title: 'Berhasil',
                         text: response.sukses,
                         icon: 'success',
                         type: "success",
                     })
                     $('body').removeClass('modal-open');
                     $('.modal-backdrop').remove();
                     $(".result").html(response.data);
                 }
             },
             error: function(xhr, ajaxOptions, thrownError) {
                 alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
             }
         });
     });

     $(document).ready(function() {
         $.ajax({
             url: '<?= base_url('home/timelineMahasiswa') ?>',
             dataType: 'json',
             success: function(response) {
                 $(".result-timeline").html(response.data);
                 $(".result-prestasi").hide();
             },
             error: function(xhr, ajaxOptions, thrownError) {
                 alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
             }
         });
     });

     $('.prestasi').click(function() {
         $.ajax({
             url: '<?= base_url('home/prestasiMahasiswa') ?>',
             dataType: 'json',
             success: function(response) {
                 $(".result-prestasi").html(response.data).show();
                 $(".result-timeline").hide();
                 $(".result-perkuliahan").hide();
             },
             error: function(xhr, ajaxOptions, thrownError) {
                 alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
             }
         });
     });

     $('.timeline').click(function() {
         $.ajax({
             url: '<?= base_url('home/timelineMahasiswa') ?>',
             dataType: 'json',
             success: function(response) {
                 $(".result-timeline").html(response.data).show();
                 $(".result-prestasi").hide();
                 $(".result-perkuliahan").hide();
             },
             error: function(xhr, ajaxOptions, thrownError) {
                 alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
             }
         });
     });

     $('.perkuliahan').click(function() {
         $.ajax({
             url: '<?= base_url('home/perkuliahanMahasiswa') ?>',
             dataType: 'json',
             success: function(response) {
                 $(".result-perkuliahan").html(response.data).show();
                 $(".result-prestasi").hide();
                 $(".result-timeline").hide();
             },
             error: function(xhr, ajaxOptions, thrownError) {
                 alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
             }
         });
     });
 </script>