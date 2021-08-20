<?php namespace App\Libraries;

use App\Models\MenuModel;

class MenuWidget
{
  public function html($params = [])
  {
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
    
    $env = getenv();
    $heroku = (isset($env['HOME']) && $env['HOME'] == '/app');
    if ($heroku) $protocol = 'https';

    $actualUrl = $protocol."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    if (substr($actualUrl, -1) == '/') $actualUrl = substr($actualUrl, 0 , strlen($actualUrl) - 1);

    $html = '';

    $model = new MenuModel();
    $record = $model->getRecordBySlug($params['slug']);

    if ($record->status == 'Published') {
      $menuHtml = '';
      $dropdownToggle = '';
      $dropdown = '';
  
      foreach ($record->menu as $menu) {

        $submenuHtml = '';

        if (isset($menu->submenu) && count($menu->submenu) > 0) {
          $url = 'javascript:';
          $dropdownToggle = 'dropdown-toggle';
          $dropdown = 'dropdown';
          
          foreach ($menu->submenu as $submenu) {
            $submenuUrl = base_url($submenu->url);

            if ($submenu->checked == 1)
              $submenuHtml .= '
                <a class="dropdown-item" href="'.$submenuUrl.'">
                  '.$submenu->title.'
                </a>
              ';
          }

          $submenuHtml = '<div class="ui-dropdown dropdown-menu">'.$submenuHtml.'</div>';
        }
        else 
          $url = base_url($menu->url);

        $active = ($url == $actualUrl)?'active':'';
        
        if ($menu->checked == 1)
          $menuHtml .= '
            <li class="nav-item '.$dropdown.'"
            data-toggle="'.$dropdown.'">
              <a class="nav-link '.$active.' '.$dropdownToggle.'" 
              href="'.$url.'">'.
                $menu->title.
              '</a>
              '.$submenuHtml.'
            </li>
          ';
      }
      $html = '
        <ul id="menu-'.$params['slug'].'" class="navbar-nav">
          '.$menuHtml.'  
        </ul>
      ';
    }
    
    return $html;
  }
}