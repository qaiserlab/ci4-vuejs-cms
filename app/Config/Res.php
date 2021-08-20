<?php namespace Config;

class Res
{
  public $stylesheetsPath = 'assets/stylesheets';
  public $javascriptsPath = 'assets/javascripts';
  public $librariesPath = 'node_modules';
  public $librariesLocalPath = 'assets/libraries';

  public $libraries = [
    'jquery' => [
      'javascripts' => [
        'dist/jquery.min.js' => 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js',
      ],
    ],
    'bootstrap' => [
      'stylesheets' => [
        'dist/css/bootstrap.min.css' => 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css',
      ],
      'javascripts' => [
        'dist/js/bootstrap.min.js' => 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js',
      ],
    ],
    'vue' => [
      'javascripts' => [
        'dist/vue.min.js' => 'https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js',
      ],
    ],
    'vue-tables-2' => [
      'javascripts' => [
        'dist/vue-tables-2.min.js' => 'https://cdnjs.cloudflare.com/ajax/libs/vue-tables-2/2.0.15/vue-tables-2.min.js',
      ],
    ],
    'font-awesome' => [
      'stylesheets' => [
        'css/font-awesome.min.css' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
      ],
    ],
    'jstree' => [
      'stylesheets' => [
        'dist/themes/default/style.min.css' => 'https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.10/themes/default/style.min.css',
      ],
      'javascripts' => [
        'dist/jstree.min.js' => 'https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.10/jstree.min.js',
      ],
    ],
    'jssocials' => [
      'stylesheets' => [
        'dist/jssocials.css' => 'https://cdnjs.cloudflare.com/ajax/libs/jsSocials/1.5.0/jssocials.min.css',
        'dist/jssocials-theme-flat.css' => 'https://cdnjs.cloudflare.com/ajax/libs/jsSocials/1.5.0/jssocials-theme-flat.min.css',
      ],
      'javascripts' => [
        'dist/jssocials.min.js' => 'https://cdnjs.cloudflare.com/ajax/libs/jsSocials/1.5.0/jssocials.min.js',
      ],
    ],
    'cabin' => [
      'local' => true,
      'stylesheets' => [
        'cabin.min.css',
      ],
    ],
    'trumbowyg' => [
      'local' => true,
      'stylesheets' => [
        'dist_/ui/trumbowyg.min.css',
        'dist_/plugins/colors/ui/trumbowyg.colors.min.css',
        'dist_/plugins/table/ui/trumbowyg.table.min.css',
      ],
      'javascripts' => [
        'dist_/trumbowyg.min.js',
        // 'dist_/plugins/upload/trumbowyg.upload.min.js',
        'dist_/plugins/history/trumbowyg.history.min.js',
        'dist_/plugins/colors/trumbowyg.colors.min.js',
        'dist_/plugins/fontsize/trumbowyg.fontsize.min.js',
        'dist_/plugins/noembed/trumbowyg.noembed.min.js',
        'dist_/plugins/table/trumbowyg.table.min.js',
      ],
    ],
    'adminlte' => [
      'local' => true,
      'stylesheets' => [
        'overlayScrollbars/css/OverlayScrollbars.min.css',
        'css/adminlte.min.css',
      ],
      'javascripts' => [
        'js/adminlte.min.js',
        'overlayScrollbars/js/OverlayScrollbars.min.js',
      ],
    ],
  ];
}