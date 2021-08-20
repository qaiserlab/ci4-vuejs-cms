<?php 
$this->extend('layouts/website'); 
$this->section('content');
?>
  <div id="banner">
    <?= view_cell('\App\Libraries\BannerWidget::html', ['slug' => 'main-banner']) ?>
  </div>
  <section class="container">
    
    <div class="row" style="margin-top: 32px">

      <div class="col-sm-12">
        <div class="row">
          <div class="col-md-4">
            <div class="content-box">
              <?= view_cell('\App\Libraries\ContentWidget::html', ['slug' => 'javascript']) ?>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="content-box">
              <?= view_cell('\App\Libraries\ContentWidget::html', ['slug' => 'php']) ?>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="content-box">
              <?= view_cell('\App\Libraries\ContentWidget::html', ['slug' => 'web-tools']) ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="content-box">
              <?= view_cell('\App\Libraries\ContentWidget::html', [
              'slug' => 'hello', 
              'noTitle' => true,
              ]) ?>
            </div>
          </div>
        </div>

      </div>
      
    </div>
  </section>
  
<?php $this->endSection() ?>