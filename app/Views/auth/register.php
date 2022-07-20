<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <meta charset="utf-8">
    <title>SIA - Fakultas Kedokteran Universitas Mulawraman</title>
    <meta name="description" content="The description should optimally be between 150-160 characters.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Madeon08">
    <link rel="shortcut icon" href="img/favicon.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/favicon-retina-ipad.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/favicon-retina-iphone.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/favicon-standard-ipad.png">
    <link rel="apple-touch-icon" sizes="57x57" href="img/favicon-standard-iphone.png">
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>/assets/login/css/style.css" />
    <script src="<?= base_url(''); ?>/assets/login/js/modernizr.custom.js"></script>
</head>

<body>
    <!-- *** LOADING *** -->
    <div id="loading">
        <div class="loader">
            <span class="dots"> .</span>
            <span class="dots"> .</span>
            <span class="dots"> .</span>
            <span class="dots"> .</span>
            <span class="dots"> .</span>
            <span class="dots"> .</span>
            <p class="loader__label">FKUNMUL | <span data-words="Kedokteran|Kedokteran Gigi|Keperawatan|"></span></p>
        </div>
    </div>

    <canvas id="constellationel"></canvas>
    <div id="constellation"></div>
    <div class="custom-overlay"></div>
    <!-- Logo on top right -->
    <a class="brand-logo logo-unmul" href="#Home">
        <img src="<?= base_url(''); ?>/assets/login/img/unmul.png" alt="Our company logo" class="img-fluid" />
    </a>
    <div id="fullpage">
        <div class="section" id="section0">
            <section class="content-inside-section">
                <div class="container">
                    <div class="container-inside">
                        <div class="main-content">
                            <span class="section-name ">Fakultas Kedokteran Universitas Mulawarman</span>
                            <h2 class="">Registrasi</h2>
                            <div class="result"></div>
                            <span class="separator"></span>
                            <form class="theme-form register-form" action="<?= base_url('auth/prosesRegister'); ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="row" id="contact-form">
                                    <div class="col-lg-6">
                                        <span style="font-size: 10px;font-weight:bold" class="text-danger errornama"></span>
                                        <div class="form-group">
                                            <input type="text" id="nama" class="form form-control nama" placeholder="Nama*" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nama*'" name="nama" data-name="nama" autocomplete="nama">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <span style="font-size: 10px;font-weight:bold" class="text-danger erroremail"></span>
                                        <div class="form-group">
                                            <input type="email" id="email" class="form form-control" placeholder="Alamat Email*" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Alamat Email*'" name="email" data-name="Email Address" autocomplete="email">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <span style="font-size: 10px;font-weight:bold" class="text-danger errornim"></span>
                                        <div class="form-group">
                                            <input type="text" id="nim" class="form form-control" placeholder="NIM*" onfocus="this.placeholder = ''" onblur="this.placeholder = 'NIM*'" name="nim" data-name="Checking">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <span style="font-size: 10px;font-weight:bold" class="text-danger errorjk"></span>
                                        <div class="form-group">
                                            <select name="jk" class="form form-control" id="">
                                                <option disabled selected hidden>
                                                    Jenis Kelamin*
                                                </option>
                                                <option>Pria</option>
                                                <option>Wanita</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <span style="font-size: 10px;font-weight:bold" class="text-danger errorpassword"></span>
                                        <div class="form-group">
                                            <input type="password" id="password" class="form form-control" placeholder="Password*" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password*'" name="password" data-name="Checking">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <span style="font-size: 10px;font-weight:bold" class="text-danger errorkonfirmasi_password"></span>
                                        <div class="form-group">
                                            <input type="password" id="konfirmasi_password" class="form form-control" placeholder="Konfirmasi Password*" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Konfirmasi Password*'" name="konfirmasi_password" data-name="Checking">
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <img src="<?= $captcha; ?>" alt="">
                                    </div>
                                    <div class="col-lg-4">
                                        <input type="password" id="konfirmasi_password" class="form form-control" placeholder="Kode Keamanan*" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Kode Keamanan*'" name="konfirmasi_password" data-name="Checking">
                                    </div>
                                </div>

                                <div class="flash-regist">
                                </div>
                                <br>
                                <div class="row m-t-20">
                                    <button type="submit" class="btn mt-3 mr-3 btn-lg btnRegister submit"><span>Registrasi</span></button>
                                    <a href="<?= base_url('/'); ?>" class="mt-3 trigger light-btn">
                                        <span id="first-text">Login</span>
                                    </a>
                                </div>
                                <?php if (session()->get('pesanGagal')) { ?>
                                    <div class="alert alert-danger alert-dismissible fade show flash text-center" role="alert">
                                        <strong>Gagal Login !</strong> <?= session()->getFlashdata('pesanGagal') ?>
                                    </div>
                                <?php } ?>
                                <?php if (session()->get('pesanLogout')) { ?>
                                    <div class="alert alert-danger alert-dismissible fade show flash text-center" role="alert">
                                        <strong>Gagal Login !</strong> <?= session()->getFlashdata('pesanLogout') ?>
                                    </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <footer>
        <div class="line"></div>
        <div class="row">
            <div class="col-12 col-xl-4 footer-nav">
            </div>
            <div class="col-12 col-xl-4 footer-copyright">
                <p>© Fakultas Kedokteran - Universitas Mulawarman</p>
            </div>
            <div class="col-12 col-xl-4 footer-nav">
                <ul class="on-right">
                    <li>
                        <a href="https://fk.unmul.ac.id/" target="_blank">
                            <i class="fab fa-internet-explorer"></i></a>
                    </li>
                    <li>
                        <a href="https://www.instagram.com/fkunmul/" target="_blank"><i class="fab fa-instagram"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

</body>

<script src="<?= base_url(''); ?>/assets/login/js/jquery.min.js"></script>
<script src="<?= base_url(''); ?>/assets/login/js/jquery.easings.min.js"></script>
<script src="<?= base_url(''); ?>/assets/login/js/bootstrap.min.js"></script>
<script src="<?= base_url(''); ?>/assets/login/js/jquery.countdown.js"></script>
<script src="<?= base_url(''); ?>/assets/login/js/jquery.fullPage.js"></script>
<script src="<?= base_url(''); ?>/assets/login/js/constellation.js"></script>
<script src="<?= base_url(''); ?>/assets/login/js/contact-me.js"></script>
<script src="<?= base_url(''); ?>/assets/login/js/classie.js"></script>
<script src="<?= base_url(''); ?>/assets/login/js/dialogFx.js"></script>
<script src="<?= base_url(''); ?>/assets/login/js/notifyMe.js"></script>
<script src="<?= base_url(''); ?>/assets/login/js/jquery.detect_swipe.min.js"></script>
<script src="<?= base_url(''); ?>/assets/login/js/featherlight.js"></script>
<script src="<?= base_url(''); ?>/assets/login/js/featherlight.gallery.js"></script>
<script src="<?= base_url(''); ?>/assets/login/js/main.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: '<?= base_url('auth/viewRegister') ?>',
            dataType: "json",
            complete: function(response) {
                $(".result").html('<img src=' + response.data + '>');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    })

    $('.refresh-captcha').click(function() {

    })

    $('.register-form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnRegister').attr('disable', 'disabled');
                $('.btnRegister').html('<i class="fa fa-spin fa-spinner"></i>');
            },
            complete: function() {
                $('.btnRegister').removeAttr('disable', 'disabled');
                $('.btnRegister').html('Login');
            },
            success: function(response) {
                if (response.error) {
                    if (response.error.nama) {
                        $('.nama').addClass('is-invalid');
                        $('.errornama').html(response.error.nama);
                    } else {
                        $('.nama').removeClass('is-invalid');
                        $('.errornama').html('');
                    }

                    if (response.error.nim) {
                        $('.nim').addClass('is-invalid');
                        $('.errornim').html(response.error.nim);
                    } else {
                        $('.nim').removeClass('is-invalid');
                        $('.errornim').html('');
                    }

                    if (response.error.email) {
                        $('.email').addClass('is-invalid');
                        $('.erroremail').html(response.error.email);
                    } else {
                        $('.email').removeClass('is-invalid');
                        $('.erroremail').html('');
                    }

                    if (response.error.jk) {
                        $('.jk').addClass('is-invalid');
                        $('.errorjk').html(response.error.jk);
                    } else {
                        $('.jk').removeClass('is-invalid');
                        $('.errorjk').html('');
                    }

                    if (response.error.konfirmasi_password) {
                        $('.konfirmasi_password').addClass('is-invalid');
                        $('.errorkonfirmasi_password').html(response.error.konfirmasi_password);
                    } else {
                        $('.konfirmasi_password').removeClass('is-invalid');
                        $('.errorkonfirmasi_password').html('');
                    }

                    if (response.error.password) {
                        $('.password').addClass('is-invalid');
                        $('.errorpassword').html(response.error.password);
                    } else {
                        $('.password').removeClass('is-invalid');
                        $('.errorpassword').html('');
                    }
                } else {
                    if (response.title == 'berhasil') {
                        $('.flash-regist').html('<div class="alert alert-success">' + response.pesan + '</div>');
                        $('.success').hide();
                        setTimeout(function() {
                            window.location.href = '<?= base_url('/'); ?>';
                        }, 3000);
                    } else if (response.title == 'gagal') {
                        $('.flash').html('<div class="alert alert-danger">' + response.pesan + '</div>');
                    }
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        })
    })
</script>

</html>