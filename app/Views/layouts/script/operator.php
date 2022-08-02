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
<script type="text/javascript" src="<?= base_url(''); ?>\assets\js\script.js"></script>
<script type="text/javascript" src="<?= base_url(''); ?>\assets\pages\message\message.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script src="<?= base_url(''); ?>\bower_components\sweetalert\js\sweetalert2.all.min.js"></script>

<!-- Date-dropper js -->
<script type="text/javascript" src="<?= base_url(''); ?>\bower_components\datedropper\js\datedropper.min.js"></script>
<script type="text/javascript" src="<?= base_url(''); ?>\assets\js\toastr.js"></script>
<script type="text/javascript" src="<?= base_url(''); ?>\assets\js\toastr.min.js"></script>
<script type="text/javascript" src="<?= base_url(''); ?>\assets\js\toastr2.min.js"></script>

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
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
    if (flashdata1) {
        Swal.fire({
            title: 'Berhasil',
            text: 'Data Berhasil Ditambahkan!',
            icon: 'success',
            AnimationEffect: 'bounce'
        })
    } else if (flashdata2) {
        Swal.fire({
            title: 'Berhasil',
            text: 'Data Berhasil Diubah!',
            icon: 'success',
            AnimationEffect: 'bounce'
        })
    }

    window.setTimeout(function() {
        $(".flash").fadeTo(500, 0).slideUp(500, function() {
            $(this).remove();
        });
    }, 5000);
    // END SWEET ALERT //
</script>


<script>
    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    var pusher = new Pusher('f3d8b822045da0f51d29', {
        cluster: 'ap1'
    });

    var channel = pusher.subscribe('sia-fkunmul');
    channel.bind('my-event', function(data) {
        // alert(JSON.stringify(data));
        $('.nama_user').html(data.nama);
        $('.nama_user_awal').addClass('d-none');
        $('.nama_user').removeClass('d-none');
    });

    var channel = pusher.subscribe('sia-fkunmul');
    channel.bind('feedback', function(data) {
        //  dosen
        $('.feedback_aktifitas_dosen').html(data.feedbackdosen);
        $('.isi_pesan_feedback').html(data.isi_pesan_feedback);
        $('.feedback_aktifitas_dosen_status').removeClass('d-none');
        $('.feedback_aktifitas_dosen_awal').addClass('d-none');
        $('.view_isi_pesan_feedback').addClass('d-none');

        // mahasiswa
        $('.feedback_aktifitas_mahasiswa').html(data.feedbackmahasiswa);
        $('.isi_pesan_feedback_mahasiswa').html(data.isi_pesan_feedback_mahasiswa);
        $('.feedback_aktifitas_mahasiswa_status').removeClass('d-none');
        $('.feedback_aktifitas_mahasiswa_awal').addClass('d-none');
        $('.view_isi_pesan_feedback_mahasiswa').addClass('d-none');
    });

    var channel = pusher.subscribe('sia-fkunmul');
    channel.bind('aktifitas', function(data) {
        // alert(JSON.stringify(data));
        $('.aktifitas_dosen').html(data.aktifitas_dosen);
        $('.isi_pesan_aktifitas').html(data.isi_pesan_aktifitas);
        $('.aktifitas_dosen_status').removeClass('d-none');
        $('.aktifitas_dosen_awal').addClass('d-none');
        $('.view_isi_pesan_aktifitas').addClass('d-none');
    });

    var channel = pusher.subscribe('sia-fkunmul');
    channel.bind('progress', function(data) {
        // alert(JSON.stringify(data));
        $('.isi_pesan_progress').html(data.isi_pesan_progress);
        $('.view_isi_pesan_progress').addClass('d-none');
    });
</script>

</body>

</html>