</div>
</div>
</div>
</div>

<script type="text/javascript" src="<?= base_url(''); ?>\bower_components\jquery\js\jquery.min.js"></script>
<script type="text/javascript" src="<?= base_url(''); ?>\bower_components\jquery-ui\js\jquery-ui.min.js"></script>
<script type="text/javascript" src="<?= base_url(''); ?>\bower_components\popper.js\js\popper.min.js"></script>
<script type="text/javascript" src="<?= base_url(''); ?>\bower_components\bootstrap\js\bootstrap.min.js"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="<?= base_url(''); ?>\bower_components\jquery-slimscroll\js\jquery.slimscroll.js"></script>
<!-- modernizr js -->
<script type="text/javascript" src="<?= base_url(''); ?>\bower_components\modernizr\js\modernizr.js"></script>
<script type="text/javascript" src="<?= base_url(''); ?>\bower_components\modernizr\js\css-scrollbars.js"></script>
<!-- Chart js -->
<script type="text/javascript" src="<?= base_url(''); ?>\bower_components\chart.js\js\Chart.js"></script>
<!-- amchart js -->
<script src="<?= base_url(''); ?>\assets\pages\widget\amchart\amcharts.js"></script>
<script src="<?= base_url(''); ?>\assets\pages\widget\amchart\serial.js"></script>
<script src="<?= base_url(''); ?>\assets\pages\widget\amchart\light.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="<?= base_url(''); ?>\assets\js\SmoothScroll.js"></script>
<script src="<?= base_url(''); ?>\assets\js\pcoded.min.js"></script>
<script src="<?= base_url(''); ?>\assets\js\jquery.mCustomScrollbar.concat.min.js"></script>
<script src="<?= base_url(''); ?>\assets\js\vartical-layout.min.js"></script>
<script type="text/javascript" src="<?= base_url(''); ?>\assets\pages\dashboard\analytic-dashboard.min.js"></script>
<script type="text/javascript" src="<?= base_url(''); ?>\assets\js\script.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script src="<?= base_url(''); ?>\bower_components\sweetalert\js\sweetalert2.all.min.js"></script>
<!-- Bootstrap date-time-picker js -->
<script type="text/javascript" src="<?= base_url(''); ?>\assets\pages\advance-elements\moment-with-locales.min.js"></script>
<script type="text/javascript" src="<?= base_url(''); ?>\bower_components\bootstrap-datepicker\js\bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?= base_url(''); ?>\assets\pages\advance-elements\bootstrap-datetimepicker.min.js"></script>
<!-- Date-range picker js -->
<script type="text/javascript" src="<?= base_url(''); ?>\bower_components\bootstrap-daterangepicker\js\daterangepicker.js"></script>
<!-- Date-dropper js -->
<script type="text/javascript" src="<?= base_url(''); ?>\bower_components\datedropper\js\datedropper.min.js"></script>
<script type="text/javascript" src="<?= base_url(''); ?>\assets\pages\advance-elements\custom-picker.js"></script>

<script>
    // SWEET ALERT //
    $('.btn-del').on('click', function(e) {
        e.preventDefault();
        const href = $(this).attr('href')
        Swal.fire({
            title: 'Anda Yakin?',
            text: "Data Akan Dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hapus!'
        }).then((result) => {
            if (result.value) {
                document.location.href = href;
            }
        });
    });

    const flashdata1 = $('.flash-data1').data('flashdata')
    const flashdata2 = $('.flash-data2').data('flashdata')
    const flashdata3 = $('.flash-data3').data('flashdata')
    const flashdata4 = $('.flash-data4').data('flashdata')
    if (flashdata1) {
        Swal.fire({
            title: 'Berhasil',
            text: 'Data Berhasil Ditambahkan!',
            icon: 'success'
        })
    } else if (flashdata2) {
        Swal.fire({
            title: 'Berhasil',
            text: 'Data Berhasil Diedit!',
            icon: 'success'
        })
    } else if (flashdata3) {
        Swal.fire({
            title: 'Berhasil',
            text: 'Data Berhasil Dihapus!',
            icon: 'success'
        })
    } else if (flashdata4) {
        Swal.fire({

            title: 'Gagal',
            text: 'Pertemuan Sudah Ada',
            icon: 'warning'
        })
    } else if (flashdata5) {
        Swal.fire({

            title: 'Gagal',
            text: 'Dosen Sudah Terdaftar',
            icon: 'warning'
        })
    } else if (flashdata6) {
        Swal.fire({

            title: 'Berhasil',
            text: 'Data Telah Tervalidasi',
            icon: 'success'
        })
    } else if (flashdata7) {
        Swal.fire({

            title: 'Berhasil',
            text: 'Presensi Diaktifkan',
            icon: 'success'
        })
    } else if (flashdata8) {
        Swal.fire({

            title: 'Berhasil',
            text: 'Presensi Di Nonaktifkan',
            icon: 'success'
        })
    } else if (flashdata9) {
        Swal.fire({

            title: 'Berhasil',
            text: 'Data Berhasil Di Edit !',
            icon: 'success'
        })
    } else if (flashdata10) {
        Swal.fire({

            title: 'Berhasil',
            text: 'Anda Berhasil Keluar !',
            icon: 'success'
        })
    } else if (flashdata11) {
        Swal.fire({

            title: 'Berhasil',
            text: 'Validasi Berhasil Di Batalkan !',
            icon: 'success'
        })
    } else if (flashdata12) {
        Swal.fire({

            title: 'GAGAL',
            text: 'Proses Input GAGAL !',
            icon: 'warning'
        })
    }
    // END SWEET ALERT //
</script>

</body>

</html>