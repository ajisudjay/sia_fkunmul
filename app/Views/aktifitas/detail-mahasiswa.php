<?= $this->include('layouts/header/index') ?>
<?= $this->include('layouts/navbar_top/mahasiswa') ?>
<?= $this->include('layouts/navbar_side/mahasiswa') ?>

<div id="result"></div>

<script>
    $(document).ready(function() {
        $.ajax({
            url: '<?= base_url('aktifitas/viewDataDetail') ?>',
            dataType: 'json',
            data: {
                id_aktifitas: <?= $id_aktifitas ?>
            },
            success: function(response) {
                $("#result").html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    });
</script>

<?= $this->include('layouts/footer/operator') ?>
<?= $this->include('layouts/script/operator') ?>