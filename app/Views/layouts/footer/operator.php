<footer class="footer" style="background-color: #ffffff; color:grey;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 footer-copyright">
                <p class="mb-0"></p>
            </div>
            <div class="col-md-6">
                <p class="pull-right mb-0"> © Fakultas Kedokteran - Universitas Mulawarman </p>
            </div>
        </div>
    </div>
</footer>
</div>
<div class="modalGantiPasswordView" style="display: none;"></div>

<script>
    function gantiPassword(id) {
        $.ajax({
            type: "post",
            url: "<?= base_url('auth/modalPassword') ?>",
            dataType: "JSON",
            data: {
                id: id
            },
            success: function(response) {
                if (response.sukses) {
                    $('.modalGantiPasswordView').html(response.sukses).show();
                    $('#gantiPassword').modal('show');
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });
    }
</script>