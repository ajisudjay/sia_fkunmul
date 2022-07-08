<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <meta charset="utf-8">
    <title>SIA - Fakultas Kedokteran Universitas Mulawraman</title>
    <meta name="description" content="The description should optimally be between 150-160 characters.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Madeon08">

    <!-- ================= Favicons ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="img/favicon.png">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="img/favicon-retina-ipad.png">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="img/favicon-retina-iphone.png">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="img/favicon-standard-ipad.png">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="img/favicon-standard-iphone.png">

    <!-- ============== Resources style ============== -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>/assets/login/css/style.css" />

    <!-- Modernizr runs quickly on page load to detect features -->
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

    <!-- *** / LOADING *** -->

    <!-- *** Menu icon for opening/closing the menu on small screen *** -->

    <button id="small-screen-menu">

        <span class="custom-menu"></span>

    </button>

    <!-- *** / Menu icon *** -->

    <!-- *** Constellation *** -->
    <canvas id="constellationel"></canvas> <!-- Canvas displaying the animation -->

    <div id="constellation"></div> <!-- Used to display your background picture, set up the path to your picture in your css/style.css file OR replace the img/constellation.jpg file by yours -->

    <!-- The overlay that you can see over the animation is generated with the following CSS rule : .custom-overlay, it can be found in your style.css file under 2. GENERIC STYLES part -->
    <div class="custom-overlay"></div>

    <!-- Logo on top right -->
    <a class="brand-logo" href="#Home">
        <img src="<?= base_url(''); ?>/assets/login/img/logo.png" alt="Our company logo" class="img-fluid" />
    </a>

    <!-- *** Fullpage sections *** -->
    <div id="fullpage">

        <!-- +++ START - Home +++ -->
        <div class="section" id="section0">

            <section class="content-inside-section">

                <div class="container">

                    <div class="container-inside">

                        <div class="main-content align-center">

                            <!-- *** TEXT TITLE *** -->
                            <h1>
                                e-Portofolio <br>

                            </h1>


                            <p class="on-home">Sistem Informasi Portofolio mahasiswa
                                <br> Fakultas Kedokteran Universitas Mulawarman
                            </p>

                            <br>

                            <div class="command">

                                <!-- ********** IF YOU WANT TO USE MORE POPUPS, SEE THE RECOMMENDATIONS AT THE END OF <?= base_url(''); ?>/assets/login/js/dialogFx.js ********** -->
                                <a id="popup_somedialog_1" data-dialog="somedialog_1" class="trigger light-btn colored">

                                    <span id="first-text">Get Started</span>

                                    <span id="second-text">Login</span> <!-- On this span, it's important to use a text smaller or equal than the first one (here: Weekly Newsletter) to avoid any troubles -->
                                </a>

                                <div class="clear"></div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <!-- +++ END - Home +++ -->

    </div>
    <!-- +++ / Fullpage sections +++ -->

    <!-- START - Newsletter Popup -->
    <div id="somedialog_1" class="dialog">
        <div class="dialog__overlay"></div>

        <div class="dialog__content">

            <div class="dialog-inner">

                <h3>Sistem Informasi Portofolio</h3>

                <p>Fakultas Kedokteran <br> Universitas Mulawarman</p>

                <!-- Newsletter Form -->
                <div id="subscribe">
                    <div class="form-group mt-5">
                        <div class="controls" align="center">
                            <form class="theme-form login-form" action="<?= base_url('auth/index'); ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="form-group">
                                    <input type="text" name="username" style="height: 40px; width:300px" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" placeholder="NIP/ NIM" autofocus>
                                    <span class="form-bar"></span>
                                    <div class="invalid-feedback"><?= $validation->getError('username') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" style="height: 40px; width:300px" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" placeholder="Password">
                                    <span class="form-bar"></span>
                                    <div class="invalid-feedback"><?= $validation->getError('password') ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" style="height: 40px; width:200px" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-30 col-lg-6">Sign in</button>
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
                <!-- /. Newsletter Form -->

            </div>

            <!-- Cross closing the Newsletter Popup -->
            <button class="close-newsletter" data-dialog-close><i class="icon ion-close-round"></i></button>

        </div>
    </div>
    <!-- END - Newsletter Popup -->

    <div class="block-message">

        <div class="message">

            <p class="notify-valid"></p>
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
                        <a href="https://www.facebook.com/themehelite" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    </li>

                    <li>
                        <a href="https://twitter.com/themehelite" target="_blank"><i class="fab fa-twitter"></i></a>
                    </li>

                    <li>
                        <a href="#" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                    </li>

                    <li>
                        <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

    <!-- ///////////////////\\\\\\\\\\\\\\\\\\\ -->
    <!-- ********** jQuery Resources ********** -->
    <!-- \\\\\\\\\\\\\\\\\\\/////////////////// -->

    <!-- * Libraries jQuery, Easing and Bootstrap - Be careful to not remove them * -->
    <script src="<?= base_url(''); ?>/assets/login/js/jquery.min.js"></script>
    <script src="<?= base_url(''); ?>/assets/login/js/jquery.easings.min.js"></script>
    <script src="<?= base_url(''); ?>/assets/login/js/bootstrap.min.js"></script>

    <!-- Countdown plugin -->
    <script src="<?= base_url(''); ?>/assets/login/js/jquery.countdown.js"></script>

    <!-- FullPage plugin -->
    <script src="<?= base_url(''); ?>/assets/login/js/jquery.fullPage.js"></script>

    <!-- Constellation plugin -->
    <script src="<?= base_url(''); ?>/assets/login/js/constellation.js"></script>

    <!-- Contact form plugin -->
    <script src="<?= base_url(''); ?>/assets/login/js/contact-me.js"></script>

    <!-- Popup Newsletter Form -->
    <script src="<?= base_url(''); ?>/assets/login/js/classie.js"></script>
    <script src="<?= base_url(''); ?>/assets/login/js/dialogFx.js"></script>

    <!-- Newsletter plugin -->
    <script src="<?= base_url(''); ?>/assets/login/js/notifyMe.js"></script>

    <!-- Gallery plugin -->
    <script src="<?= base_url(''); ?>/assets/login/js/jquery.detect_swipe.min.js"></script>
    <script src="<?= base_url(''); ?>/assets/login/js/featherlight.js"></script>
    <script src="<?= base_url(''); ?>/assets/login/js/featherlight.gallery.js"></script>

    <!-- Main JS File -->
    <script src="<?= base_url(''); ?>/assets/login/js/main.js"></script>

</body>

</html>