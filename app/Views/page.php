<?php 
$this->extend('layouts/website'); 
$this->section('content');
?>
  <section class="container">
    <div class="row">
      <div class="col-md-12">
        
        <br>
        <div class="article">
          <!-- <sup>
            <i class="fa fa-bookmark-o"></i>
            <?= $record->postedOnHumanize ?>
          </sup> -->
          <h3><?= $record->title ?></h3>
          <br>
          
          <article class="content">
            <?php if (!$record->noImage): ?>
              <img src="<?= $record->imageUrl ?>" 
              align="right"
              alt=""
              style="width: 400px">
            <?php endif; ?>
            <div class="share"></div>
            <br>
            
            <?= $record->content ?>
          </article>
        </div>
        
      </div>
      
    </div>
  </section>
  
<?php 
$this->endSection(); 
$this->section('foot');
?>
  <script>
    $('.share').jsSocials({
      shares: [
        'email', 
        'twitter', 
        'facebook', 
        'googleplus', 
        'linkedin', 
        // 'pinterest', 
        // 'stumbleupon', 
        'whatsapp',
      ],
    });
  </script>
<?php $this->endSection() ?>