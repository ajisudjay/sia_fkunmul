<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login | Siakad Fakultas Kedokteran UNMUL</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sistem Administrasi Akademik | Fakultas Kedokteran Universitas Mulawarman">
    <meta name="keywords" content="Sistem Administrasi Akademik | Fakultas Kedokteran Universitas Mulawarman">
    <meta name="author" content="#">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\bower_components\bootstrap\css\bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\icon\themify-icons\themify-icons.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\icon\icofont\css\icofont.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\css\style.css">
</head>

<body class="fix-menu">
    <div class="theme-loader">
        <div class="ball-scale">
            <div class='contain'>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
                <div class="ring">
                    <div class="frame"></div>
                </div>
            </div>
        </div>
    </div>

    <section class="login-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="text-center">
                        <img src="<?= base_url(''); ?>\assets\images\unmul.png" width="100px" alt="logo.png">
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <form class="theme-form login-form" action="<?= base_url('auth/index'); ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h5 class="text-center">
                                            Sistem Administrasi Akademik <br>
                                            Fakultas Kesehatan Masyarakat <br>
                                            Universitas Mulawarman
                                        </h5>
                                    </div>
                                </div>
                                <div class="form-group form-primary">
                                    <label class="text-primary">Username</label>
                                    <input type="text" name="username" class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : '' ?>" placeholder="NIP/ NIM" autofocus>
                                    <span class="form-bar"></span>
                                    <div class="invalid-feedback"><?= $validation->getError('username') ?>
                                    </div>
                                </div>
                                <div class="form-group form-primary">
                                    <label class="text-primary">Password</label>
                                    <input type="password" name="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : '' ?>" placeholder="Password">
                                    <span class="form-bar"></span>
                                    <div class="invalid-feedback"><?= $validation->getError('password') ?>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect waves-light text-center m-b-30">Sign in</button>
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
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="<?= base_url(''); ?>\bower_components\jquery\js\jquery.min.js"></script>
    <script type="text/javascript" src="<?= base_url(''); ?>\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= base_url(''); ?>\bower_components\popper.js\js\popper.min.js"></script>
    <script type="text/javascript" src="<?= base_url(''); ?>\bower_components\bootstrap\js\bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= base_url(''); ?>\bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>
    <script type="text/javascript" src="<?= base_url(''); ?>\bower_components\modernizr\js\modernizr.js"></script>
    <script type="text/javascript" src="<?= base_url(''); ?>\bower_components\modernizr\js\css-scrollbars.js"></script>
    <script type="text/javascript" src="<?= base_url(''); ?>\bower_components\i18next\js\i18next.min.js"></script>
    <script type="text/javascript" src="<?= base_url(''); ?>\bower_components\i18next-xhr-backend\js\i18nextXHRBackend.min.js"></script>
    <script type="text/javascript" src="<?= base_url(''); ?>\bower_components\i18next-browser-languagedetector\js\i18nextBrowserLanguageDetector.min.js"></script>
    <script type="text/javascript" src="<?= base_url(''); ?>\bower_components\jquery-i18next\js\jquery-i18next.min.js"></script>
    <script type="text/javascript" src="<?= base_url(''); ?>\assets\js\common-pages.js"></script>
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
</body>

</html>