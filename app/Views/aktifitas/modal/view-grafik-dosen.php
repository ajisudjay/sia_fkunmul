<!-- tambah modal-->
<div class="modal fade" id="modalGrafikAktifitas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 80%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Detail Aktifitas</h5>
                <button type="button" class="btn btn-danger" style="border-radius: 5px;" onclick="statusAktifitas()" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row">
                <div class="col">
                    <?= $json ?>
                    <div class="scroll_aktifitas">
                        <figure class="highcharts-figure">
                            <div id="container"></div>
                            <div class="highcharts-description mt-4">
                                <div class="container">
                                    <?php foreach ($sqlkompetensi as $itemKompetensi) : ?>
                                        <table class="mt-3">
                                            <tr>
                                                <td style="width: 400px;">
                                                    <p class="alert alert-primary col-lg-4 d-inline" style="margin-bottom:10px"><?= $itemKompetensi['data_kompetensi'] ?></p>
                                                </td>
                                                <td>
                                                    <span class="text-primary"><?= $itemKompetensi['jumlah'] ?></span>
                                                </td>
                                            </tr>
                                        </table>
                                        <?php foreach ($sqlcount as $dataCount) : ?>
                                            <?php if ($dataCount['kompetensi'] == $itemKompetensi['id_kompetensi']) { ?>
                                                <table class="mt-3">
                                                    <tr>
                                                        <td style="width: 400px;"><?= $dataCount['sub_kompetensi'] ?></td>
                                                        <td><?= $dataCount['jumlah'] ?></td>
                                                    </tr>
                                                </table>
                                            <?php } ?>
                                        <?php endforeach ?>
                                        <hr>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </figure>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    Highcharts.chart('container', {
        title: {
            text: 'Pencapaian Kompetensi'
        },
        xAxis: {
            categories: [<?= $jumlahSemester ?>]
        },
        labels: {
            items: [{
                html: '',
                style: {
                    left: '50px',
                    top: '18px',
                    color: ( // theme
                        Highcharts.defaultOptions.title.style &&
                        Highcharts.defaultOptions.title.style.color
                    ) || 'black'
                }
            }]
        },
        series: [{
            type: 'column',
            name: '<?= $itemcount['data_kompetensi'] ?>',
            data: [<?= $itemcount['jumlah'] ?>]
        }],
    });
</script>