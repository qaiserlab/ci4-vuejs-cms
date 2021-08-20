<?php $session = session() ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="The Content Management System website">

  <title><?= $session->get('title') ?></title>

	<link rel="shortcut icon" type="image/png" href="<?= base_url('public/favicon.png') ?>">

  <?= view_cell('\App\Libraries\ResWidget::html', [
  'type' => 'library',
  'stylesheets' => [
    'font-awesome',
    'bootstrap',
    'jssocials',
    'cabin',
  ]]) ?>

  <?= view_cell('\App\Libraries\ResWidget::html', [
  'stylesheets' => [
    'main.min.css',
  ]]) ?>

  <?php $this->renderSection('head') ?>  
</head>
<body>

  <nav id="navbar" class="sticky-top">
    <div class="container" style="text-align: right">
      <a style="color: #000; font-weight: bold" href="<?= base_url('dashboard') ?>">
        ADMIN/DASHBOARD
      </a>
    </div>
  
    <div class="navbar navbar-expand-sm bg-dark navbar-dark">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        <a class="navbar-brand" href="<?= base_url() ?>">
          <img src="<?= base_url('assets/images/qaiserlab-logo.png') ?>" alt="">
        </a>

        <div class="collapse navbar-collapse" id="collapsibleNavbar">
          <div class="container">
            <?= view_cell('\App\Libraries\MenuWidget::html', ['slug' => 'main-menu']) ?>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <div id="content">
    <?php $this->renderSection('content') ?>
  </div>
  
  <footer>
    <div class="container-fluid" style="background: #F0F0F0; margin-top: 64px; margin-bottom: 0; padding: 32px">
      <div class="container">
        <div class="row">

          <div class="col-md-4">
            <?= view_cell('\App\Libraries\ContentWidget::html', ['slug' => 'about-us']) ?>
          </div>
          
          <div class="col-md-4">
            <?= view_cell('\App\Libraries\ContentWidget::html', ['slug' => 'kontak']) ?>
          </div>
        
          <div class="col-md-4" style="text-align: right;">
            <?= view_cell('\App\Libraries\VueWidget::html', [
            'widget' => 'subscribe-widget' 
            ]) ?>
            <br>
            
            <?= view_cell('\App\Libraries\ContentWidget::html', [
            'slug' => 'copyright', 
            'noTitle' => true,
            ]) ?>
          </div>

        </div>
      </div>
    </div>
  </footer>

  <?= view_cell('\App\Libraries\ResWidget::html', [
  'type' => 'library',
  'javascripts' => [
    'jquery',
    'bootstrap',
    'vue',
    'jssocials',
  ]]) ?>

  <?= view_cell('\App\Libraries\ResWidget::html', [
  'javascripts' => [
    'main.js',
    'FaComponent.js',
    'AlertComponent.js',
    'ModalComponent.js',
    'InvalidFeedbackComponent.js',
    'LabelComponent.js',
    'TextboxComponent.js',
    'SelectComponent.js',
    'RadioComponent.js',
    'ComboboxComponent.js',
    'ButtonComponent.js',
    'HyperlinkComponent.js',
    'SubscribeWidget.js',
  ]]) ?>

  <?= view_cell('\App\Libraries\JsWidget::html') ?>
  <?php $this->renderSection('foot'); ?>
</body>
</html>
