<!DOCTYPE html>
<html lang="en">

<head>
    <title>Beranda | Siakad Fakultas Kedokteran UNMUL</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sistem Administrasi Akademik | Fakultas Kedokteran Universitas Mulawarman">
    <meta name="keywords" content="Sistem Administrasi Akademik | Fakultas Kedokteran Universitas Mulawarman">
    <meta name="description" content="#">
    <meta name="keywords" content="Admin , Responsive, Landing, Bootstrap, App, Template, Mobile, iOS, Android, apple, creative app">
    <meta name="author" content="#">
    <!-- Favicon icon -->
    <link rel="icon" href="<?= base_url(''); ?>\assets\images\favicon.ico" type="image/x-icon">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\bower_components\bootstrap\css\bootstrap.min.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\icon\feather\css\feather.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\css\jquery.mCustomScrollbar.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\bower_components\sweetalert\css\sweetalert2.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\icon\themify-icons\themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\icon\icofont\css\icofont.css">
    <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\icon\font-awesome\css\font-awesome.min.css">
    <!-- light-box css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\bower_components\ekko-lightbox\css\ekko-lightbox.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\bower_components\lightbox2\css\lightbox.css">
    <!-- Date-time picker css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\pages\advance-elements\css\bootstrap-datetimepicker.css">
    <!-- Date-range picker css  -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\bower_components\bootstrap-daterangepicker\css\daterangepicker.css">
    <!-- Date-Dropper css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\bower_components\datedropper\css\datedropper.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\icon\themify-icons\themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\icon\icofont\css\icofont.css">
    <!-- feather Awesome -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\icon\feather\css\feather.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\pages\social-timeline\timeline.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\pages\message\message.css">

    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\css\style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\css\jquery.mCustomScrollbar.css">
    <!-- jpro forms css -->
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\pages\j-pro\css\demo.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\pages\j-pro\css\font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\pages\j-pro\css\j-pro-modern.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\css\toastr.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\css\toastr.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(''); ?>\assets\pages\timeline\style.css">
    <!-- Select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://js.pusher.com/7.1/pusher.min.js"></script>
</head>
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #28a745;
        border-color: #3d9970;
    }

    .select2-container .select2-selection--single {
        height: 40px !important;
    }

    .select2-selection__arrow {
        height: 38px !important;
    }

    @media only screen and (max-width: 600px) {
        .cover-bg {
            display: none;
        }

        .foto-beranda {
            width: 80%;
            border-radius: 20px;
            margin: auto;
            display: block;
        }
    }

    .scroll_view {
        width: 100%;
        height: 300px;
        overflow: scroll;
        padding: 40px;
        background: #f6f6f6;
        border-radius: 10px;
    }

    .scroll_aktifitas {
        width: 100%;
        height: 650px;
        overflow: scroll;
        padding: 40px;
        background: #f6f6f6;
        border-radius: 10px;
    }

    blink {
        -webkit-animation: 2s linear infinite kedip;
        /* for Safari 4.0 - 8.0 */
        animation: 2s linear infinite kedip;
    }

    /* for Safari 4.0 - 8.0 */
    @-webkit-keyframes kedip {
        0% {
            visibility: hidden;
        }

        50% {
            visibility: hidden;
        }

        100% {
            visibility: visible;
        }
    }

    @keyframes kedip {
        0% {
            visibility: hidden;
        }

        50% {
            visibility: hidden;
        }

        100% {
            visibility: visible;
        }
    }
</style>