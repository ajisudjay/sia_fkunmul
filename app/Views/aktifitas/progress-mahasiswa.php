 <div class="main-timeline">
     <div class="cd-timeline cd-container">
         <?php foreach ($progress as $data) : ?>
             <div class="cd-timeline-block">
                 <div class="cd-timeline-icon bg-primary">
                     <a class="bg-transparent border-0">
                         <i class="icofont icofont-ui-file"></i>
                     </a>
                 </div>
                 <div class="cd-timeline-content card_main">
                     <div class="pr-3 pt-4 pb-3 pl-3">
                         <?= $data['progress'] ?>
                     </div>
                     <span class="cd-date">
                         <i class="icofont icofont-ui-calendar"><?= $data['tanggal'] ?></i> <span><?= $data['tanggal'] ?></span>
                     </span>
                     <span class="cd-details"></span>
                 </div>
             </div>
         <?php endforeach ?>
     </div>
 </div>