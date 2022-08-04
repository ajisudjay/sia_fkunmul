<!-- tambah modal-->
<div class="modal fade" id="modalGrafikAktifitas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 80%;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <center>
                    <h5 class="modal-title font-weight-bold" id="exampleModalLabel">Rekapitulasi Aktifitas Kompetensi <?= $nama_mahasiswa ?></h5>
                </center>
                <button type="button" class="btn btn-danger" style="border-radius: 5px;" onclick="statusAktifitas()" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row">
                <div class="col">
                    <div class="scroll_aktifitas">
                        <div class="card p-4">
                            <figure class="highcharts-figure">
                                <div class="highcharts-description mt-4">
                                    <div class="container">
                                        <?php foreach ($sqlkompetensi as $itemKompetensi) : ?>
                                            <p class="alert alert-danger col-lg-4">Tahun Ajaran - <?= $itemKompetensi['tahun_ajaran'] ?></p>
                                            <?php foreach ($sqlgrafik1 as $dataCount) :
                                                if ($itemKompetensi['id_tahun_ajaran'] == $dataCount['id_tahun_ajaran']) { ?>
                                                    <table class="mt-1">
                                                        <tr>
                                                            <td style="width: 400px;">
                                                                <p class="badge badge-primary d-inline" style="margin-bottom:10px"><?= $dataCount['data_kompetensi'] ?></p>
                                                            </td>
                                                            <td>
                                                                <span class="text-primary"><?= $dataCount['jumlah'] ?></span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <?php foreach ($sqlcount as $dataCountSub) : ?>
                                                        <?php if ($dataCountSub['kompetensi'] == $dataCount['kompetensi_aktifitas'] and $dataCountSub['id_tahun_ajaran'] == $dataCount['id_tahun_ajaran']) { ?>
                                                            <table class="mt-3">
                                                                <tr>
                                                                    <td style="width: 400px;">
                                                                        <span class="icofont icofont-check-circled text-primary ml-1"></span> <?= $dataCountSub['sub_kompetensi'] ?>
                                                                    </td>
                                                                    <td><?= $dataCountSub['jumlah'] ?></td>
                                                                </tr>
                                                            </table>
                                                        <?php } ?>
                                                    <?php endforeach ?>
                                                <?php } ?>
                                            <?php endforeach ?>
                                            <hr>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </figure>
                        </div>
                        <div class="card">
                            <div class="card-content p-4">
                                <div id="container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    Highcharts.chart('container', {
        title: {
            text: 'Rekap Pencapaian Kompetensi <?= $nama_mahasiswa ?> Selama Menjalani Pendidikan'
        },
        xAxis: {
            categories: [<?= $jumlahsub == null ? $jumlahsub : $jumlahIPE ?>]
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
        plotOptions: {
            column: {
                borderRadius: 8
            }
        },
        series: [{
            type: 'column',
            name: 'Sub Kompetensi Yang Dilakukan',
            data: [<?= $jumlah ?>]
        }],
    });
</script>