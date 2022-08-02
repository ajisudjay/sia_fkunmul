 <figure class="highcharts-figure mt-5">
     <div id="container"></div>
 </figure>

 <div class="card text-left">
     <div class="card-body">
         <h5 class="card-title" style="text-align: center;">Pencapaian Kompetensi</h5>
         <hr>
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
                                     <td style="width: 400px;"><span class="icofont icofont-check-circled text-primary"></span> <?= $dataCount['sub_kompetensi'] ?></td>
                                     <td><?= $dataCount['jumlah'] ?></td>
                                 </tr>
                             </table>
                         <?php } ?>
                     <?php endforeach ?>
                     <hr>
                 <?php endforeach ?>
                 <center>
                     <h5 class="text-danger">BELUM ADA AKTIFITAS KOMPETENSI</h5>
                 </center>
             </div>
         </div>
     </div>
 </div>


 <!-- Select 2 js -->
 <script type="text/javascript" src="<?= base_url(''); ?>\bower_components\select2\js\select2.full.min.js"></script>
 <!-- Multiselect js -->
 <script type="text/javascript" src="<?= base_url(''); ?>\bower_components\bootstrap-multiselect\js\bootstrap-multiselect.js"></script>
 <script type="text/javascript" src="<?= base_url(''); ?>\bower_components\multiselect\js\jquery.multi-select.js"></script>
 <script type="text/javascript" src="<?= base_url(''); ?>\assets\js\jquery.quicksearch.js"></script>
 <script type="text/javascript" src="<?= base_url(''); ?>\assets\pages\advance-elements\select2-custom.js"></script>


 <script src="<?= base_url(''); ?>\bower_components\datatables.net\js\jquery.dataTables.min.js">
 </script>
 <script src="<?= base_url(''); ?>\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js">
 </script>
 <script src="<?= base_url(''); ?>\assets\pages\data-table\extensions\row-reorder\js\dataTables.rowReorder.min.js">
 </script>
 <script src="<?= base_url(''); ?>\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
 <script src="<?= base_url(''); ?>\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js">
 </script>
 <script src="<?= base_url(''); ?>\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js">
 </script>
 <!-- Custom js -->
 <script src="<?= base_url(''); ?>\assets\pages\data-table\extensions\row-reorder\js\row-reorder-custom.js"></script>


 <script>
     Highcharts.chart('container', {
         title: {
             text: 'Progress Kompetensi'
         },
         xAxis: {
             categories: [<?= $jumlahsub ?>]
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
             name: 'Sub Kompetensi',
             data: [<?= $jumlah ?>]
         }, {
             type: 'spline',
             name: 'Progress',
             data: [<?= $jumlah ?>],
             marker: {
                 lineWidth: 2,
                 lineColor: Highcharts.getOptions().colors[3],
                 fillColor: 'white'
             }
         }, ]
     });
 </script>