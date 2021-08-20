<?php 
$session = session();
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <title><?= $session->get('title') ?></title>

  <link rel="shortcut icon" type="image/png" href="<?= base_url('public/favicon.png') ?>">
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->

  <?= view_cell('\App\Libraries\ResWidget::html', [
  'type' => 'library',
  'stylesheets' => [
    'font-awesome',
    'trumbowyg',
    'jstree',
    'adminlte',
  ]]) ?>

  <?= view_cell('\App\Libraries\ResWidget::html', [
  'stylesheets' => [
    'components.min.css',
    'dashboard.min.css',
  ]]) ?>

  <?php $this->renderSection('head') ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-dark" style="background: #3c8dbc">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
        </li>
        <!-- <li class="nav-item d-none d-sm-inline-block">
          <a href="../../index3.html" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="nav-link">Contact</a>
        </li> -->
      </ul>

      <!-- SEARCH FORM -->
      <!-- <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
          <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-navbar" type="submit">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
      </form> -->

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <!-- <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="#" class="dropdown-item">
              <div class="media">
                <img src="<?= base_url('assets/adminlte/img') ?>/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    Brad Diesel
                    <span class="float-right text-sm text-danger"><i class="fa fa-star"></i></span>
                  </h3>
                  <p class="text-sm">Call me whenever you can...</p>
                  <p class="text-sm text-muted"><i class="fa fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <div class="media">
                <img src="<?= base_url('assets/adminlte/img') ?>/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3">
                <div class="media-body">
                  <h3 class="dropdown-item-title">
                    John Pierce
                    <span class="float-right text-sm text-muted"><i class="fa fa-star"></i></span>
                  </h3>
                  <p class="text-sm">I got your message bro</p>
                  <p class="text-sm text-muted"><i class="fa fa-clock mr-1"></i> 4 Hours Ago</p>
                </div>
              </div>
            </a>
            <div class="dropdown-divider"></div>
            
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
          </div>
        </li> -->
        <!-- Notifications Dropdown Menu -->
        <!-- <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="fa fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-item dropdown-header">15 Notifications</span>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fa fa-envelope mr-2"></i> 4 new messages
              <span class="float-right text-muted text-sm">3 mins</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fa fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fa fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
          </div>
        </li> -->
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fa fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="https://www.sribulancer.com/id/users/qaiserlab" class="brand-link" style="background: #3c8dbc; padding: 5px">
        <img src="<?= base_url('assets/images/qaiserlab-sticker.png') ?>" alt="">
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <?php if (!$session->get('noPhoto')): ?>
            <div class="image">
              <img src="<?= $session->get('photoUrl') ?>" 
              class="elevation-2 img-circle" 
              alt=""
              style="width: 64px">
            </div>
          <?php endif; ?>
          <div class="info">
            <a href="<?= base_url('dashboard/my-account') ?>" class="d-block">
              <?= $session->get('fullname') ?>
            </a>

            <a href="javascript:confirmLogout()">
              <small>
                <i class="fa fa-lock"></i>
                Logout
              </small>
            </a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <?= view_cell('\App\Libraries\SidebarWidget::html', [
          'menu' => $session->get('group')->menu, 
          ]) ?>

          <!-- <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fa fa-tachometer-alt"></i>
                <p>
                  Dashboard
                  <i class="right fa fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="../../index.html" class="nav-link">
                    <i class="fa fa-circle nav-icon"></i>
                    <p>Dashboard v1</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../../index2.html" class="nav-link">
                    <i class="fa fa-circle nav-icon"></i>
                    <p>Dashboard v2</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="../../index3.html" class="nav-link">
                    <i class="fa fa-circle nav-icon"></i>
                    <p>Dashboard v3</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="../widgets.html" class="nav-link">
                <i class="nav-icon fa fa-th"></i>
                <p>
                  Widgets
                  <span class="right badge badge-danger">New</span>
                </p>
              </a>
            </li>
          </ul> -->
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <div class="content-wrapper">
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1><?= $session->get('title') ?></h1>
            </div>
            <div class="col-sm-6">
              <div class="float-sm-right">
                <?= view_cell('\App\Libraries\BreadcrumbWidget::html') ?>
              </div>
            </div>
          </div>
        </div>
      </section>
      
      <section class="content">
        <div class="container-fluid">
          <?php $this->renderSection('content') ?>
        </div>
      </section>
    </div>

    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 1.0.0
      </div>
      <strong>Copyright &copy; 2020 <a href="https://www.sribulancer.com/id/users/qaiserlab">QaiserLab</a>.</strong> All rights
      reserved.
    </footer>

    <aside class="control-sidebar control-sidebar-dark">
      <?= view_cell('\App\Libraries\SidebarWidget::html', [
      'menu' => $session->get('group')->settingsMenu, 
      ]) ?>
    </aside>
  </div>
  <!-- ./wrapper -->

  <?= view_cell('\App\Libraries\ResWidget::html', [
  'type' => 'library',
  'javascripts' => [
    'jquery',
    'bootstrap',
    'vue',
    'vue-tables-2',
    'jstree',
    'trumbowyg',
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
    'LabelComponent.js',
    'TextboxComponent.js',
    'TextareaComponent.js',
    'SelectComponent.js',
    'RadioComponent.js',
    'ComboboxComponent.js',
    'DatepickerComponent.js',
    'UploaderComponent.js',
    'ThumbnailComponent.js',
    'ButtonComponent.js',
    'HyperlinkComponent.js',
    'FloatareaComponent.js',
    'DirectoryComponent.js',
    'TabsComponent.js',
    'GalleryComponent.js',
    'DatatableComponent.js',
    'TrumbowygComponent.js',
    'JstreeComponent.js',
    'ChecktreeComponent.js',
  ]]) ?>

  <?= view_cell('\App\Libraries\JsWidget::html', ['loadData' => true]) ?>
  
  <?php $this->renderSection('foot') ?>
</body>
</html>
