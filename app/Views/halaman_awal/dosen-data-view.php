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
                                         <div class="row">
                                             <div class="col-md-12">
                                                 <!-- Social wallpaper start -->
                                                 <div class="social-wallpaper">
                                                     <img src="<?= $user['foto_cover'] == null ? base_url('assets/images/auth/cover-profil.jpeg') : base_url('assets/images/user-profile/' . $user['foto_cover'] . '') ?>" height="300px" class="width-100" style="border-radius: 20px;" alt="">
                                                     <div class="profile-hvr">
                                                         <button type="button" class="bg-transparent border-0" data-toggle="modal" data-target="#modalCoverProfil">
                                                             <i class="icofont icofont-ui-edit p-r-10 text-light"></i>
                                                         </button>
                                                         <!-- <i class="icofont icofont-ui-delete"></i> -->
                                                     </div>
                                                 </div>
                                                 <!-- Social wallpaper end -->
                                                 <!-- Timeline button start -->
                                                 <!-- <div class="timeline-btn">
                                                     <a href="#" class="btn btn-primary waves-effect waves-light m-r-10">follows</a>
                                                     <a href="#" class="btn btn-primary waves-effect waves-light">Send Message</a>
                                                 </div> -->
                                                 <!-- Timeline button end -->
                                             </div>
                                         </div>
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
                                                                 <i class="icofont icofont-ui-delete"></i>
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
                                                             <h5 class="card-header-text"><?= $dosen['program_studi'] ?> </h5>
                                                             <hr>
                                                             <h5 class="text-muted card-header-text">
                                                                 <span class="text-primary fa fa-phone mb-2">
                                                                     Telepon
                                                                 </span>
                                                             </h5><br>
                                                             <h5 class="card-header-text"><?= $dosen['telepon'] ?> </h5>
                                                             <hr>
                                                             <h5 class="text-muted card-header-text">
                                                                 <span class="text-info icofont icofont-email mb-2">
                                                                     Email
                                                                 </span>
                                                             </h5><br>
                                                             <h5 class="card-header-text"><?= $dosen['email'] ?> </h5>
                                                             <hr>
                                                             <h5 class="text-muted card-header-text">
                                                                 <span class="text-success fa fa-university mb-2">
                                                                     Alamat
                                                                 </span>
                                                             </h5><br>
                                                             <h5 class="card-header-text"><?= $dosen['alamat'] ?> </h5>
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
                                                             <a class="nav-link active" data-toggle="tab" href="#timeline" role="tab">Timeline</a>
                                                             <div class="slide"></div>
                                                         </li>
                                                         <li class="nav-item">
                                                             <a class="nav-link" data-toggle="tab" href="#about" role="tab">About</a>
                                                             <div class="slide"></div>
                                                         </li>
                                                         <li class="nav-item">
                                                             <a class="nav-link" data-toggle="tab" href="#photos" role="tab">Photos</a>
                                                             <div class="slide"></div>
                                                         </li>
                                                         <li class="nav-item">
                                                             <a class="nav-link" data-toggle="tab" href="#friends" role="tab">Friends</a>
                                                             <div class="slide"></div>
                                                         </li>
                                                     </ul>
                                                 </div>
                                                 <!-- Tab panes -->
                                                 <div class="tab-content">
                                                     <!-- Timeline tab start -->
                                                     <div class="tab-pane active" id="timeline">
                                                         <div class="row">
                                                             <div class="col-md-12 timeline-dot">
                                                                 <div class="social-timelines p-relative">
                                                                     <div class="row timeline-right p-t-35">
                                                                         <div class="col-2 col-sm-2 col-xl-1">
                                                                             <div class="social-timelines-left">
                                                                                 <img class="img-radius timeline-icon" src="<?= base_url(''); ?>\assets\images\avatar-2.jpg" alt="">
                                                                             </div>
                                                                         </div>
                                                                         <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                                                             <div class="card">

                                                                                 <div class="card-block post-timelines">
                                                                                     <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                                                     <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                                         <a class="dropdown-item" href="#">Remove tag</a>
                                                                                         <a class="dropdown-item" href="#">Report Photo</a>
                                                                                         <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                                                         <a class="dropdown-item" href="#">Blog User</a>
                                                                                     </div>
                                                                                     <div class="chat-header f-w-600">Josephin Doe posted on your timeline</div>

                                                                                     <div class="social-time text-muted">50 minutes ago</div>


                                                                                 </div>
                                                                                 <img src="<?= base_url(''); ?>\assets\images\timeline\img1.jpg" class="img-fluid width-100" alt="">
                                                                                 <div class="card-block">

                                                                                     <div class="timeline-details">
                                                                                         <div class="chat-header">Josephin Doe posted on your timeline</div>
                                                                                         <p class="text-muted">lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                                                             quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea </p>
                                                                                     </div>
                                                                                 </div>
                                                                                 <div class="card-block b-b-theme b-t-theme social-msg">
                                                                                     <a href="#"> <i class="icofont icofont-heart-alt text-muted"></i><span class="b-r-muted">Like (20)</span> </a>
                                                                                     <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments (25)</span></a>
                                                                                     <a href="#"> <i class="icofont icofont-share text-muted"></i> <span>Share (10)</span></a>
                                                                                 </div>
                                                                                 <div class="card-block user-box">
                                                                                     <div class="p-b-30"> <span class="f-14"><a href="#">Comments (110)</a></span><span class="f-right">see all comments</span></div>
                                                                                     <div class="media m-b-20">
                                                                                         <a class="media-left" href="#">
                                                                                             <img class="media-object img-radius m-r-20" src="<?= base_url(''); ?>\assets\images\avatar-1.jpg" alt="Generic placeholder image">
                                                                                         </a>
                                                                                         <div class="media-body b-b-muted social-client-description">
                                                                                             <div class="chat-header">About Marta Williams<span class="text-muted">Jane 10, 2015</span></div>
                                                                                             <p class="text-muted">lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor
                                                                                                 sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                                                         </div>
                                                                                     </div>
                                                                                     <div class="media m-b-20">
                                                                                         <a class="media-left" href="#">
                                                                                             <img class="media-object img-radius m-r-20" src="<?= base_url(''); ?>\assets\images\avatar-2.jpg" alt="Generic placeholder image">
                                                                                         </a>
                                                                                         <div class="media-body b-b-muted social-client-description">
                                                                                             <div class="chat-header">About Marta Williams<span class="text-muted">Jane 11, 2015</span></div>
                                                                                             <p class="text-muted">lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor
                                                                                                 sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                                                         </div>
                                                                                     </div>
                                                                                     <div class="media">
                                                                                         <a class="media-left" href="#">
                                                                                             <img class="media-object img-radius m-r-20" src="<?= base_url(''); ?>\assets\images\user.png" alt="Generic placeholder image">
                                                                                         </a>
                                                                                         <div class="media-body">
                                                                                             <form class="">
                                                                                                 <div class="">
                                                                                                     <textarea rows="5" cols="5" class="form-control" placeholder="Write Something here..."></textarea>
                                                                                                     <div class="text-right m-t-20"><a href="#" class="btn btn-primary waves-effect waves-light">Post</a></div>
                                                                                                 </div>
                                                                                             </form>
                                                                                         </div>
                                                                                     </div>
                                                                                 </div>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                                 <div class="social-timelines p-relative">
                                                                     <div class="row timeline-right p-t-35">
                                                                         <div class="col-2 col-sm-2 col-xl-1">
                                                                             <div class="social-timelines-left">
                                                                                 <img class="img-radius timeline-icon" src="<?= base_url(''); ?>\assets\images\avatar-2.jpg" alt="">
                                                                             </div>
                                                                         </div>
                                                                         <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                                                             <div class="card">
                                                                                 <div class="card-block post-timelines">
                                                                                     <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                                                     <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                                         <a class="dropdown-item" href="#">Remove tag</a>
                                                                                         <a class="dropdown-item" href="#">Report Photo</a>
                                                                                         <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                                                         <a class="dropdown-item" href="#">Blog User</a>
                                                                                     </div>
                                                                                     <div class="chat-header f-w-600">Josephin Doe posted on your timeline</div>

                                                                                     <div class="social-time text-muted">50 minutes ago</div>


                                                                                 </div>

                                                                                 <img src="<?= base_url(''); ?>\assets\images\timeline\img1.jpg" class="img-fluid width-100" alt="">
                                                                                 <div class="card-block">
                                                                                     <div class="timeline-details">
                                                                                         <div class="chat-header">Josephin Doe posted on your timeline</div>
                                                                                         <p class="text-muted">lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                                                             quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea </p>
                                                                                     </div>
                                                                                 </div>
                                                                                 <div class="card-block b-b-theme b-t-theme social-msg">
                                                                                     <a href="#"> <i class="icofont icofont-heart-alt text-muted"></i><span class="b-r-muted">Like (20)</span></a>
                                                                                     <a href="#"> <i class="icofont icofont-comment text-muted"></i><span class="b-r-muted">Comments (25)</span> </a>
                                                                                     <a href="#"> <i class="icofont icofont-share text-muted"></i><span>Share (10)</span> </a>
                                                                                 </div>
                                                                                 <div class="card-block user-box">
                                                                                     <div class="p-b-30"> <span class="f-14"><a href="#">Comments (110)</a></span><span class="f-right">see all comments</span></div>
                                                                                     <div class="media m-b-20">
                                                                                         <a class="media-left" href="#">
                                                                                             <img class="media-object img-radius m-r-20" src="<?= base_url(''); ?>\assets\images\avatar-1.jpg" alt="Generic placeholder image">
                                                                                         </a>
                                                                                         <div class="media-body b-b-muted social-client-description">
                                                                                             <div class="chat-header">About Marta Williams<span class="text-muted">Jane 10, 2015</span></div>
                                                                                             <p class="text-muted">lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor
                                                                                                 sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                                                                         </div>
                                                                                     </div>
                                                                                     <div class="media">
                                                                                         <a class="media-left" href="#">
                                                                                             <img class="media-object img-radius m-r-20" src="<?= base_url(''); ?>\assets\images\user.png" alt="Generic placeholder image">
                                                                                         </a>
                                                                                         <div class="media-body">
                                                                                             <form class="">
                                                                                                 <div class="">
                                                                                                     <textarea rows="5" cols="5" class="form-control" placeholder="Write Something here..."></textarea>
                                                                                                     <div class="text-right m-t-20"><a href="#" class="btn btn-primary waves-effect waves-light">Post</a></div>
                                                                                                 </div>
                                                                                             </form>
                                                                                         </div>
                                                                                     </div>
                                                                                 </div>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                         <div class="f-30 text-muted text-center">2014</div>
                                                         <div class="row">
                                                             <div class="col-md-12 timeline-dot">
                                                                 <div class="social-timelines p-relative">
                                                                     <div class="row timeline-right p-t-35">
                                                                         <div class="col-2 col-sm-2 col-xl-1">
                                                                             <div class="social-timelines-left">
                                                                                 <img class="img-radius timeline-icon" src="<?= base_url(''); ?>\assets\images\avatar-2.jpg" alt="">
                                                                             </div>
                                                                         </div>
                                                                         <div class="col-10 col-sm-10 col-xl-11 p-l-5 p-b-35">
                                                                             <div class="card">
                                                                                 <div class="card-block post-timelines">
                                                                                     <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                                                     <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                                         <a class="dropdown-item" href="#">Remove tag</a>
                                                                                         <a class="dropdown-item" href="#">Report Photo</a>
                                                                                         <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                                                         <a class="dropdown-item" href="#">Blog User</a>
                                                                                     </div>
                                                                                     <div class="chat-header f-w-600">Josephin Doe posted on your timeline</div>

                                                                                     <div class="social-time text-muted">50 minutes ago</div>


                                                                                 </div>

                                                                                 <img src="<?= base_url(''); ?>\assets\images\timeline\img1.jpg" class="img-fluid width-100" alt="">
                                                                                 <div class="card-block">
                                                                                     <div class="timeline-details">
                                                                                         <div class="chat-header">Josephin Doe posted on your timeline</div>
                                                                                         <p class="text-muted">lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                                                                             quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea </p>
                                                                                     </div>
                                                                                 </div>
                                                                                 <div class="card-block b-b-theme b-t-theme social-msg">
                                                                                     <a href="#"> <i class="icofont icofont-heart-alt text-muted"></i><span class="b-r-muted">Like (20)</span> </a>
                                                                                     <a href="#"> <i class="icofont icofont-comment text-muted"></i> <span class="b-r-muted">Comments (25)</span></a>
                                                                                     <a href="#"> <i class="icofont icofont-share text-muted"></i> <span>Share (10)</span></a>
                                                                                 </div>
                                                                                 <div class="card-block user-box">
                                                                                     <div class="p-b-30"> <span class="f-14"><a href="#">Comments (110)</a></span><span class="f-right">see all comments</span></div>
                                                                                     <div class="media">
                                                                                         <a class="media-left" href="#">
                                                                                             <img class="media-object img-radius m-r-20" src="<?= base_url(''); ?>\assets\images\user.png" alt="Generic placeholder image">
                                                                                         </a>
                                                                                         <div class="media-body">
                                                                                             <form class="">
                                                                                                 <div class="">
                                                                                                     <textarea rows="5" cols="5" class="form-control" placeholder="Write Something here..."></textarea>
                                                                                                     <div class="text-right m-t-20"><a href="#" class="btn btn-primary waves-effect waves-light">Post</a></div>
                                                                                                 </div>
                                                                                             </form>
                                                                                         </div>
                                                                                     </div>
                                                                                 </div>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <!-- Timeline tab end -->
                                                     <!-- About tab start -->
                                                     <div class="tab-pane" id="about">
                                                         <div class="row">
                                                             <div class="col-sm-12">
                                                                 <div class="card">
                                                                     <div class="card-header">
                                                                         <h5 class="card-header-text">Basic Information</h5>
                                                                         <button id="edit-btn" type="button" class="btn btn-primary waves-effect waves-light f-right">
                                                                             <i class="icofont icofont-edit"></i>
                                                                         </button>
                                                                     </div>
                                                                     <div class="card-block">
                                                                         <div id="view-info" class="row">
                                                                             <div class="col-lg-6 col-md-12">
                                                                                 <form>
                                                                                     <table class="table table-responsive m-b-0">
                                                                                         <tr>
                                                                                             <th class="social-label b-none p-t-0">Full Name
                                                                                             </th>
                                                                                             <td class="social-user-name b-none p-t-0 text-muted">Josephine Villa</td>
                                                                                         </tr>
                                                                                         <tr>
                                                                                             <th class="social-label b-none">Gender</th>
                                                                                             <td class="social-user-name b-none text-muted">Female</td>
                                                                                         </tr>
                                                                                         <tr>
                                                                                             <th class="social-label b-none">Birth Date</th>
                                                                                             <td class="social-user-name b-none text-muted">October 25th, 1990</td>
                                                                                         </tr>
                                                                                         <tr>
                                                                                             <th class="social-label b-none">Martail Status</th>
                                                                                             <td class="social-user-name b-none text-muted">Single</td>
                                                                                         </tr>
                                                                                         <tr>
                                                                                             <th class="social-label b-none p-b-0">Location</th>
                                                                                             <td class="social-user-name b-none p-b-0 text-muted">New York, USA</td>
                                                                                         </tr>
                                                                                     </table>
                                                                                 </form>
                                                                             </div>
                                                                         </div>
                                                                         <div id="edit-info" class="row">
                                                                             <div class="col-lg-12 col-md-12">
                                                                                 <form>
                                                                                     <div class="input-group">
                                                                                         <input type="text" class="form-control" placeholder="Full Name">
                                                                                     </div>
                                                                                     <div class="input-group">
                                                                                         <div class="form-radio">
                                                                                             <div class="form-radio">
                                                                                                 <label class="md-check p-0">Gender</label>
                                                                                                 <div class="radio radio-inline">
                                                                                                     <label>
                                                                                                         <input type="radio" name="radio" checked="checked">
                                                                                                         <i class="helper"></i>Male
                                                                                                     </label>
                                                                                                 </div>
                                                                                                 <div class="radio radio-inline">
                                                                                                     <label>
                                                                                                         <input type="radio" name="radio">
                                                                                                         <i class="helper"></i>Female
                                                                                                     </label>
                                                                                                 </div>
                                                                                             </div>
                                                                                         </div>
                                                                                     </div>
                                                                                     <div class="input-group">
                                                                                         <input id="dropper-default" class="form-control" type="text" placeholder="Birth Date">
                                                                                     </div>
                                                                                     <div class="input-group">
                                                                                         <select id="hello-single" class="form-control">
                                                                                             <option value="">---- Marital Status ----</option>
                                                                                             <option value="married">Married</option>
                                                                                             <option value="unmarried">Unmarried</option>
                                                                                         </select>
                                                                                     </div>
                                                                                     <div class="md-group-add-on">
                                                                                         <textarea rows="5" cols="5" class="form-control" placeholder="Address..."></textarea>
                                                                                     </div>
                                                                                     <div class="text-center m-t-20">
                                                                                         <a href="javascript:;" id="edit-save" class="btn btn-primary waves-effect waves-light m-r-20">Save</a>
                                                                                         <a href="javascript:;" id="edit-cancel" class="btn btn-default waves-effect waves-light">Cancel</a>
                                                                                     </div>
                                                                                 </form>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="col-sm-12">
                                                                 <div class="card">
                                                                     <div class="card-header">
                                                                         <h5 class="card-header-text">Contact Information</h5>
                                                                         <button id="edit-Contact" type="button" class="btn btn-primary waves-effect waves-light f-right">
                                                                             <i class="icofont icofont-edit"></i>
                                                                         </button>
                                                                     </div>
                                                                     <div class="card-block">
                                                                         <div id="contact-info" class="row">
                                                                             <div class="col-lg-6 col-md-12">
                                                                                 <table class="table table-responsive m-b-0">
                                                                                     <tr>
                                                                                         <th class="social-label b-none p-t-0">Mobile Number</th>
                                                                                         <td class="social-user-name b-none p-t-0 text-muted">eg. (0123) - 4567891</td>
                                                                                     </tr>
                                                                                     <tr>
                                                                                         <th class="social-label b-none">Email Address</th>
                                                                                         <td class="social-user-name b-none text-muted"><a href="..\..\..\cdn-cgi\l\email-protection.htm" class="__cf_email__" data-cfemail="e195849295a1868c80888dcf828e8c">[email&#160;protected]</a></td>
                                                                                     </tr>
                                                                                     <tr>
                                                                                         <th class="social-label b-none">Twitter</th>
                                                                                         <td class="social-user-name b-none text-muted">@phonixcoded</td>
                                                                                     </tr>
                                                                                     <tr>
                                                                                         <th class="social-label b-none p-b-0">Skype</th>
                                                                                         <td class="social-user-name b-none p-b-0 text-muted">@phonixcoded demo</td>
                                                                                     </tr>
                                                                                 </table>
                                                                             </div>
                                                                         </div>
                                                                         <div id="edit-contact-info" class="row">
                                                                             <div class="col-lg-12 col-md-12">
                                                                                 <form>
                                                                                     <div class="input-group">
                                                                                         <input type="text" class="form-control" placeholder="Mobile number">
                                                                                     </div>
                                                                                     <div class="input-group">
                                                                                         <input type="text" class="form-control" placeholder="Email address">
                                                                                     </div>
                                                                                     <div class="input-group">
                                                                                         <input type="text" class="form-control" placeholder="Twitter id">
                                                                                     </div>
                                                                                     <div class="input-group">
                                                                                         <input type="text" class="form-control" placeholder="Skype id">
                                                                                     </div>
                                                                                     <div class="text-center m-t-20">
                                                                                         <a href="javascript:;" id="contact-save" class="btn btn-primary waves-effect waves-light m-r-20">Save</a>
                                                                                         <a href="javascript:;" id="contact-cancel" class="btn btn-default waves-effect waves-light">Cancel</a>
                                                                                     </div>
                                                                                 </form>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="col-sm-12">
                                                                 <div class="card">
                                                                     <div class="card-header">
                                                                         <h5 class="card-header-text">Work</h5>
                                                                         <button id="edit-work" type="button" class="btn btn-primary waves-effect waves-light f-right">
                                                                             <i class="icofont icofont-edit"></i>
                                                                         </button>
                                                                     </div>
                                                                     <div class="card-block">
                                                                         <div id="work-info" class="row">
                                                                             <div class="col-lg-6 col-md-12">
                                                                                 <table class="table table-responsive m-b-0">
                                                                                     <tr>
                                                                                         <th class="social-label b-none p-t-0">Occupation &nbsp; &nbsp; &nbsp;
                                                                                         </th>
                                                                                         <td class="social-user-name b-none p-t-0 text-muted">Developer</td>
                                                                                     </tr>
                                                                                     <tr>
                                                                                         <th class="social-label b-none">Skills</th>
                                                                                         <td class="social-user-name b-none text-muted">C#, Javascript, Anguler</td>
                                                                                     </tr>
                                                                                     <tr>
                                                                                         <th class="social-label b-none">Jobs</th>
                                                                                         <td class="social-user-name b-none p-b-0 text-muted">#</td>
                                                                                     </tr>
                                                                                 </table>
                                                                             </div>
                                                                         </div>
                                                                         <div id="edit-contact-work" class="row">
                                                                             <div class="col-lg-12 col-md-12">
                                                                                 <form>
                                                                                     <div class="input-group">
                                                                                         <select id="occupation" class="form-control">
                                                                                             <option value=""> Select occupation </option>
                                                                                             <option value="married">Developer</option>
                                                                                             <option value="unmarried">Web Design</option>
                                                                                         </select>
                                                                                     </div>
                                                                                     <div class="input-group">
                                                                                         <select id="skill" class="form-control">
                                                                                             <option value=""> Select Skills </option>
                                                                                             <option value="married">C# &amp; .net</option>
                                                                                             <option value="unmarried">Angular</option>
                                                                                         </select>
                                                                                     </div>
                                                                                     <div class="input-group">
                                                                                         <select id="job" class="form-control">
                                                                                             <option value=""> Select Job </option>
                                                                                             <option value="married">#</option>
                                                                                             <option value="unmarried">Other</option>
                                                                                         </select>
                                                                                     </div>
                                                                                     <div class="text-center m-t-20">
                                                                                         <a href="javascript:;" id="work-save" class="btn btn-primary waves-effect waves-light m-r-20">Save</a>
                                                                                         <a href="javascript:;" id="work-cancel" class="btn btn-default waves-effect waves-light">Cancel</a>
                                                                                     </div>
                                                                                 </form>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                     <!-- About tab end -->
                                                     <!-- Photos tab start -->
                                                     <div class="tab-pane" id="photos">
                                                         <div class="card">
                                                             <!-- Row start -->

                                                             <!-- Gallery start -->
                                                             <div class="card-block">
                                                                 <div class="demo-gallery">
                                                                     <ul id="profile-lightgallery" class="row">
                                                                         <li class="col-md-4 col-lg-2 col-sm-6 col-xs-12">
                                                                             <a href="<?= base_url(''); ?>\assets\images\light-box\l1.jpg" data-toggle="lightbox" data-title="A random title" data-footer="A custom footer text">
                                                                                 <img src="<?= base_url(''); ?>\assets\images\light-box\sl1.jpg" class="img-fluid" alt="">
                                                                             </a>
                                                                         </li>
                                                                         <li class="col-md-4 col-lg-2 col-sm-6 col-xs-12">
                                                                             <a href="<?= base_url(''); ?>\assets\images\light-box\l1.jpg" data-toggle="lightbox" data-title="A random title" data-footer="A custom footer text">
                                                                                 <img src="<?= base_url(''); ?>\assets\images\light-box\sl1.jpg" class="img-fluid" alt="">
                                                                             </a>
                                                                         </li>
                                                                         <li class="col-md-4 col-lg-2 col-sm-6 col-xs-12">
                                                                             <a href="<?= base_url(''); ?>\assets\images\light-box\l1.jpg" data-toggle="lightbox" data-title="A random title" data-footer="A custom footer text">
                                                                                 <img src="<?= base_url(''); ?>\assets\images\light-box\sl1.jpg" class="img-fluid" alt="">
                                                                             </a>
                                                                         </li>
                                                                         <li class="col-md-4 col-lg-2 col-sm-6 col-xs-12">
                                                                             <a href="<?= base_url(''); ?>\assets\images\light-box\l1.jpg" data-toggle="lightbox" data-title="A random title" data-footer="A custom footer text">
                                                                                 <img src="<?= base_url(''); ?>\assets\images\light-box\sl1.jpg" class="img-fluid" alt="">
                                                                             </a>
                                                                         </li>
                                                                     </ul>
                                                                 </div>
                                                             </div>

                                                             <!-- Gallery end -->
                                                         </div>
                                                     </div>
                                                     <!-- Photos tab end -->
                                                     <!-- Friends tab start -->
                                                     <div class="tab-pane" id="friends">
                                                         <div class="row">
                                                             <div class="col-lg-12 col-xl-6">
                                                                 <div class="card">
                                                                     <div class="card-block post-timelines">
                                                                         <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                                         <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                             <a class="dropdown-item" href="#">Remove tag</a>
                                                                             <a class="dropdown-item" href="#">Report Photo</a>
                                                                             <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                                             <a class="dropdown-item" href="#">Blog User</a>
                                                                         </div>
                                                                         <div class="media bg-white d-flex">
                                                                             <div class="media-left media-middle">
                                                                                 <a href="#">
                                                                                     <img class="media-object" src="<?= base_url(''); ?>\assets\images\timeline\img2.png" alt="">
                                                                                 </a>
                                                                             </div>
                                                                             <div class="media-body friend-elipsis">
                                                                                 <div class="f-15 f-bold m-b-5">Josephin Doe</div>
                                                                                 <div class="text-muted social-designation">Software Engineer</div>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="col-lg-12 col-xl-6">
                                                                 <div class="card">
                                                                     <div class="card-block post-timelines">
                                                                         <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                                         <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                             <a class="dropdown-item" href="#">Remove tag</a>
                                                                             <a class="dropdown-item" href="#">Report Photo</a>
                                                                             <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                                             <a class="dropdown-item" href="#">Blog User</a>
                                                                         </div>
                                                                         <div class="media bg-white d-flex">
                                                                             <div class="media-left media-middle">
                                                                                 <a href="#">
                                                                                     <img class="media-object" src="<?= base_url(''); ?>\assets\images\timeline\img2.png" alt="">
                                                                                 </a>
                                                                             </div>
                                                                             <div class="media-body friend-elipsis">
                                                                                 <div class="f-15 f-bold m-b-5">Josephin Doe</div>
                                                                                 <div class="text-muted social-designation">Software Engineer</div>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="col-lg-12 col-xl-6">
                                                                 <div class="card">
                                                                     <div class="card-block post-timelines">
                                                                         <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                                         <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                             <a class="dropdown-item" href="#">Remove tag</a>
                                                                             <a class="dropdown-item" href="#">Report Photo</a>
                                                                             <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                                             <a class="dropdown-item" href="#">Blog User</a>
                                                                         </div>
                                                                         <div class="media bg-white d-flex">
                                                                             <div class="media-left media-middle">
                                                                                 <a href="#">
                                                                                     <img class="media-object" src="<?= base_url(''); ?>\assets\images\timeline\img2.png" alt="">
                                                                                 </a>
                                                                             </div>
                                                                             <div class="media-body friend-elipsis">
                                                                                 <div class="f-15 f-bold m-b-5">Josephin Doe</div>
                                                                                 <div class="text-muted social-designation">Software Engineer</div>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="col-lg-12 col-xl-6">
                                                                 <div class="card">
                                                                     <div class="card-block post-timelines">
                                                                         <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                                         <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                             <a class="dropdown-item" href="#">Remove tag</a>
                                                                             <a class="dropdown-item" href="#">Report Photo</a>
                                                                             <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                                             <a class="dropdown-item" href="#">Blog User</a>
                                                                         </div>
                                                                         <div class="media bg-white d-flex">
                                                                             <div class="media-left media-middle">
                                                                                 <a href="#">
                                                                                     <img class="media-object" src="<?= base_url(''); ?>\assets\images\timeline\img2.png" alt="">
                                                                                 </a>
                                                                             </div>
                                                                             <div class="media-body friend-elipsis">
                                                                                 <div class="f-15 f-bold m-b-5">Josephin Doe</div>
                                                                                 <div class="text-muted social-designation">Software Engineer</div>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="col-lg-12 col-xl-6">
                                                                 <div class="card">
                                                                     <div class="card-block post-timelines">
                                                                         <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                                         <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                             <a class="dropdown-item" href="#">Remove tag</a>
                                                                             <a class="dropdown-item" href="#">Report Photo</a>
                                                                             <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                                             <a class="dropdown-item" href="#">Blog User</a>
                                                                         </div>
                                                                         <div class="media bg-white d-flex">
                                                                             <div class="media-left media-middle">
                                                                                 <a href="#">
                                                                                     <img class="media-object" src="<?= base_url(''); ?>\assets\images\timeline\img2.png" alt="">
                                                                                 </a>
                                                                             </div>
                                                                             <div class="media-body friend-elipsis">
                                                                                 <div class="f-15 f-bold m-b-5">Josephin Doe</div>
                                                                                 <div class="text-muted social-designation">Software Engineer</div>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="col-lg-12 col-xl-6">
                                                                 <div class="card">
                                                                     <div class="card-block post-timelines">
                                                                         <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                                         <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                             <a class="dropdown-item" href="#">Remove tag</a>
                                                                             <a class="dropdown-item" href="#">Report Photo</a>
                                                                             <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                                             <a class="dropdown-item" href="#">Blog User</a>
                                                                         </div>
                                                                         <div class="media bg-white d-flex">
                                                                             <div class="media-left media-middle">
                                                                                 <a href="#">
                                                                                     <img class="media-object" src="<?= base_url(''); ?>\assets\images\timeline\img2.png" alt="">
                                                                                 </a>
                                                                             </div>
                                                                             <div class="media-body friend-elipsis">
                                                                                 <div class="f-15 f-bold m-b-5">Josephin Doe</div>
                                                                                 <div class="text-muted social-designation">Software Engineer</div>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="col-lg-12 col-xl-6">
                                                                 <div class="card">
                                                                     <div class="card-block post-timelines">
                                                                         <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                                         <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                             <a class="dropdown-item" href="#">Remove tag</a>
                                                                             <a class="dropdown-item" href="#">Report Photo</a>
                                                                             <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                                             <a class="dropdown-item" href="#">Blog User</a>
                                                                         </div>
                                                                         <div class="media bg-white d-flex">
                                                                             <div class="media-left media-middle">
                                                                                 <a href="#">
                                                                                     <img class="media-object" src="<?= base_url(''); ?>\assets\images\timeline\img2.png" alt="">
                                                                                 </a>
                                                                             </div>
                                                                             <div class="media-body friend-elipsis">
                                                                                 <div class="f-15 f-bold m-b-5">Josephin Doe</div>
                                                                                 <div class="text-muted social-designation">Software Engineer</div>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="col-lg-12 col-xl-6">
                                                                 <div class="card">
                                                                     <div class="card-block post-timelines">
                                                                         <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                                         <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                             <a class="dropdown-item" href="#">Remove tag</a>
                                                                             <a class="dropdown-item" href="#">Report Photo</a>
                                                                             <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                                             <a class="dropdown-item" href="#">Blog User</a>
                                                                         </div>
                                                                         <div class="media bg-white d-flex">
                                                                             <div class="media-left media-middle">
                                                                                 <a href="#">
                                                                                     <img class="media-object" src="<?= base_url(''); ?>\assets\images\timeline\img2.png" alt="">
                                                                                 </a>
                                                                             </div>
                                                                             <div class="media-body friend-elipsis">
                                                                                 <div class="f-15 f-bold m-b-5">Josephin Doe</div>
                                                                                 <div class="text-muted social-designation">Software Engineer</div>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="col-lg-12 col-xl-6">
                                                                 <div class="card">
                                                                     <div class="card-block post-timelines">
                                                                         <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                                         <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                             <a class="dropdown-item" href="#">Remove tag</a>
                                                                             <a class="dropdown-item" href="#">Report Photo</a>
                                                                             <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                                             <a class="dropdown-item" href="#">Blog User</a>
                                                                         </div>
                                                                         <div class="media bg-white d-flex">
                                                                             <div class="media-left media-middle">
                                                                                 <a href="#">
                                                                                     <img class="media-object" src="<?= base_url(''); ?>\assets\images\timeline\img2.png" alt="">
                                                                                 </a>
                                                                             </div>
                                                                             <div class="media-body friend-elipsis">
                                                                                 <div class="f-15 f-bold m-b-5">Josephin Doe</div>
                                                                                 <div class="text-muted social-designation">Software Engineer</div>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="col-lg-12 col-xl-6">
                                                                 <div class="card">
                                                                     <div class="card-block post-timelines">
                                                                         <span class="dropdown-toggle addon-btn text-muted f-right service-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="tooltip"></span>
                                                                         <div class="dropdown-menu dropdown-menu-right b-none services-list">
                                                                             <a class="dropdown-item" href="#">Remove tag</a>
                                                                             <a class="dropdown-item" href="#">Report Photo</a>
                                                                             <a class="dropdown-item" href="#">Hide From Timeline</a>
                                                                             <a class="dropdown-item" href="#">Blog User</a>
                                                                         </div>
                                                                         <div class="media bg-white d-flex">
                                                                             <div class="media-left media-middle">
                                                                                 <a href="#">
                                                                                     <img class="media-object" src="<?= base_url(''); ?>\assets\images\timeline\img2.png" alt="">
                                                                                 </a>
                                                                             </div>
                                                                             <div class="media-body friend-elipsis">
                                                                                 <div class="f-15 f-bold m-b-5">Josephin Doe</div>
                                                                                 <div class="text-muted social-designation">Software Engineer</div>
                                                                             </div>
                                                                         </div>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                     </div>
                                                 </div>
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

         <div id="styleSelector">

         </div>
     </div>
 </div>
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
                     <img src="<?= $user['foto_cover'] == null ? base_url('assets/images/auth/no-image.png') : base_url('assets/images/user-profile/' . $user['foto_cover'] . '') ?>" class="" style="border-radius: 20px; width:450px; height:250px;display:block; margin:auto">
                     <input type="text" class="id_user_cover" value="<?= $user['id'] ?>" hidden hidden>
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
                 <h5 class="modal-title" id="exampleModalLongTitle">Edit Cover Beranda</h5>
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
                     <div style="font-size: 12px;margin-top:7px" class="text-danger errortelepon"></div>
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
             url: '<?= base_url('profil/prosesEditFotoDosenBeranda') ?>',
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
             url: '<?= base_url('profil/prosesEditFotoCoverDosen') ?>',
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
 </script>