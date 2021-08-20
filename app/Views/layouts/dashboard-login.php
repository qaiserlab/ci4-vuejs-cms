<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title><?= session()->get('title') ?></title>

  <link rel="shortcut icon" type="image/png" href="<?= base_url('public/favicon.png') ?>">
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->

  <?= view_cell('\App\Libraries\ResWidget::html', [
  'type' => 'library',
  'stylesheets' => [
    'font-awesome',
    'adminlte',
  ]]) ?>

  <?php $this->renderSection('head') ?>
</head>
<body class="hold-transition login-page">

  <?php $this->renderSection('content') ?>

  <?= view_cell('\App\Libraries\ResWidget::html', [
  'type' => 'library',
  'javascripts' => [
    'jquery',
    'bootstrap',
    'vue',
    'adminlte',
  ]]) ?>

  <?= view_cell('\App\Libraries\ResWidget::html', [
  'javascripts' => [
    'dashboard.js',
    'FaComponent.js',
    'AlertComponent.js',
    'ModalComponent.js',
    'CardComponent.js',
    'InvalidFeedbackComponent.js',
    'TextboxComponent.js',
    'ButtonComponent.js',
    'HyperlinkComponent.js',
  ]]) ?>

  <?= view_cell('\App\Libraries\JsWidget::html') ?>  
  <?php $this->renderSection('foot') ?>
</body>
</html>
