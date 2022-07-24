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
                        <div class="main-content align-center">
                            <h1>
                                e-Portofolio <br>
                            </h1>
                            <h1>
                                e-Portofolio <br>
                            </h1>
                            <p class="on-home">Sistem Informasi Portofolio mahasiswa
                                <br> Fakultas Kedokteran <br> Universitas Mulawarman
                            </p>
                            <br>
                            <div class="command">
                                <a id="popup_somedialog_1" data-dialog="somedialog_1" class="trigger light-btn colored">
                                    <span id="first-text">Get Started</span>
                                    <span id="second-text">Login</span>
                                </a>
                                <a href="<?= base_url('/register'); ?>" class=" trigger light-btn">
                                    <span id="first-text">Register</span>
                                </a>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- Modal Login -->
    <div id="somedialog_1" class="dialog">
        <div class="dialog__overlay"></div>
        <div class="dialog__content">
            <div class="dialog-inner">
                <h3>Sistem Informasi <br> e-Portofolio</h3>
                <p>Fakultas Kedokteran <br> Universitas Mulawarman</p>

                <div id="subscribe">
                    <div class="form-group mt-5">
                        <div class="controls" align="center">
                            <form class="theme-form login-form" action="<?= base_url('auth/index'); ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <input type="text" name="username" style="text-align:center;font-size:15px; height: 40px; width:300px" class="form-control username" placeholder="Username" autofocus>
                                    <span class="form-bar"></span>
                                    <div class="font-weight-bold invalid-feedback errorusername"></div>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" style="text-align:center;font-size:15px; height: 40px; width:300px" class="form-control password" placeholder="Password">
                                    <span class="form-bar"></span>
                                    <div class="font-weight-bold invalid-feedback errorpassword"></div>
                                    <div class="font-weight-bold text-danger errorgagal_login"></div>
                                    <div class="font-weight-bold text-danger errorgagal_user"></div>
                                </div>
                                <br>
                                <div class="row m-t-20">
                                    <div class="col-md-12">
                                        <button type="submit" style="height: 40px; width:200px" class="btn btn-primary btnLogin btn-md btn-block">
                                            <p>Login</p>
                                        </button>
                                    </div>
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
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="close-newsletter" data-dialog-close><i class="icon ion-close-round"></i></button>
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
        $('.login-form').submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                beforeSend: function() {
                    $('.btnLogin').attr('disable', 'disabled');
                    $('.btnLogin').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnLogin').removeAttr('disable', 'disabled');
                    $('.btnLogin').html('Login');
                },
                success: function(response) {
                    if (response.error) {
                        if (response.error.username) {
                            $('.username').addClass('is-invalid');
                            $('.errorusername').html(response.error.username);
                        } else {
                            $('.username').removeClass('is-invalid');
                            $('.errorusername').html('');
                        }

                        if (response.error.password) {
                            $('.password').addClass('is-invalid');
                            $('.errorpassword').html(response.error.password);
                        } else {
                            $('.password').removeClass('is-invalid');
                            $('.errorpassword').html('');
                        }
                    } else {
                        if (response.title == 'gagaluser') {
                            $('.errorgagal_user').html(response.usernamegagal);
                            $('.errorpassword').html('');
                            $('.errorusername').html('');
                        } else {
                            $('.errorgagal_user').html('');
                            $('.errorpassword').html('');
                            $('.errorusername').html('');
                        }

                        if (response.title == 'gagallogin') {
                            $('.errorgagal_login').html(response.usernamelogin);
                            $('.errorpassword').html('');
                            $('.errorusername').html('');
                        } else {
                            $('.errorgagal_login').html('');
                            $('.errorpassword').html('');
                            $('.errorusername').html('');
                        }

                        if (response.title == 'berhasiloperator') {
                            window.location.href = '<?= base_url(''); ?>' + response.urloperator;
                        }
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
                }
            })
        })
    </script>
</body>

</html>