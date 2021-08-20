<?php 
$this->extend('layouts/website'); 
$this->section('content');
?>
  <section class="container">
    <div class="row">
      <div class="col-md-9">
      
      <br>
      <h4><?= $category->title ?></h4>
      <br>
      <?= $pager->links('main', 'bootstrap_paging') ?>
      <br>

      <?php foreach ($rs as $record): ?>
        <div class="articles row">

          <div class="col-md-4">
            <?php if (!$record->noImage): ?>
              <a href="<?= $record->url ?>">
                <img src="<?= $record->imageUrl ?>" 
                class="featured-thumbnail"
                style="width: 240px"
                alt="">
              </a>
            <?php endif ?>
          </div>

          <div class="col-md-8">
            <sup>
              <i class="fa fa-bookmark-o"></i>
              <?= $record->postedOnHumanize ?>
            </sup>
            <h6>
              <a href="<?= $record->url ?>">
                <?= $record->title ?>
                <br>
              </a>
            </h6>
            
            <?= $record->excerpt ?>
            <br>
            <br>
            <a href="<?= $record->url ?>"
            class="btn btn-outline-dark btn-sm">
            <!-- <i class="fa fa-chevron-right"></i> -->
            Readmore
            <i class="fa fa-ellipsis-h"></i>
            </a>
          </div>

        </div>
        <br>
      <?php endforeach ?>
    
      </div>
      <div class="col-md-3">
        <br>
        <?= view_cell('\App\Libraries\MenuWidget::html', ['slug' => 'sidebar']) ?>
      </div>
    </div>
  </section>
<?php $this->endSection() ?>