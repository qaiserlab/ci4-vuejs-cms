<?php namespace App\Libraries;

class SidebarWidget
{
  public function html($params = [])
  {
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
    
    $env = getenv();
    $heroku = (isset($env['HOME']) && $env['HOME'] == '/app');
    if ($heroku) $protocol = 'https';

    $actualUrl = $protocol."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    $html = '';

    foreach ($params['menu'] as $menu) {
      if (isset($menu['checked']) && $menu['checked'] == 'true') {

        $submenuHtml = '';
        
        if (isset($menu['submenu'])) {
          
          foreach ($menu['submenu'] as $submenu) {
            if (isset($submenu['checked']) && $submenu['checked'] == 'true') {
              $active = '';
              $style = '';

              $url = 'javascript:';

              if (isset($submenu['url'])) {
                if (substr($submenu['url'], 0, 11) == 'javascript:' ||
                substr($submenu['url'], 0, 6) == 'https:' ||
                substr($submenu['url'], 0, 5) == 'http:')
                  $url = $submenu['url'];
                else 
                  $url = base_url($submenu['url']);

                if ($url == $actualUrl) {
                  $active = 'active';
                  $style = 'style="background: #494e53; color: #fff"';
                }
              }
    
              $submenuHtml .= '<li class="nav-item">
                <a href="'.$url.'" 
                class="nav-link '.$active.'" 
                '.(isset($submenu['target'])?'target='.$submenu['target']:'').' 
                '.$style.'>
                  <i class="'.(isset($submenu['icon'])?'fa fa-'.$submenu['icon']:'').' nav-icon"></i>
                  <p>'.(isset($submenu['title'])?$submenu['title']:'').'</p>
                </a>
              </li>';
            }
          }
  
          $submenuHtml = '<ul class="nav nav-treeview">'.$submenuHtml.'</ul>';
        }
  
        $active = '';
        $style = '';
        $menuOpen = '';
        
        $url = 'javascript:';

        if (isset($menu['url'])) {

          if (substr($menu['url'], 0, 11) == 'javascript:' ||
          substr($menu['url'], 0, 6) == 'https:' ||
          substr($menu['url'], 0, 5) == 'http:')
            $url = $menu['url'];
          else 
            $url = base_url($menu['url']);
            
          if (($url == $actualUrl) && !isset($menu['submenu'])) {
            $active = 'active';
            $style = 'style="background: #494e53"';
          }
          if ((substr($actualUrl, 0, strlen($url)) == $url)) $menuOpen = 'menu-open';
        }
  
        $html .= '<li class="nav-item has-treeview '.$menuOpen.'">
          <a href="'.$url.'" 
          class="nav-link '.$active.'" 
          '.(isset($menu['target'])?'target='.$menu['target']:'').' 
          '.$style.'>
            <i class="nav-icon '.(isset($menu['icon'])?'fa fa-'.$menu['icon']:'').'"></i>
            <p>
              '.(isset($menu['title'])?$menu['title']:'').'
              '.(isset($menu['submenu'])?'<i class="right fa fa-angle-left"></i>':'').'
            </p>
          </a>
          '.$submenuHtml.'
        </li>';

      }
    }

    $html = '
    <ul class="nav nav-pills nav-sidebar flex-column" 
    data-widget="treeview" 
    role="menu" 
    data-accordion="false">'.
      $html.
    '</ul>';
    
    return $html;
  }
}