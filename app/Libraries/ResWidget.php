<?php namespace App\Libraries;

use Config\Res;

class ResWidget
{
  public function html($params = [])
  {
    $res = new Res();

    $html = '';
		$env = getenv();
    $heroku = (isset($env['HOME']) && $env['HOME'] == '/app');

    $libraries = $res->libraries;
    
    helper('html');
    
    if (isset($params['stylesheets'])) {
      foreach ($params['stylesheets'] as $stylesheet) {
        $isLocal = isset($libraries[$stylesheet]['local']);
        
        if (isset($params['type']) && $params['type'] == 'library') {
          
          $stylesheets = $libraries[$stylesheet]['stylesheets'];
  
          foreach ($stylesheets as $local => $cdn) {
            if (!$isLocal)
              $source = (!$heroku)?base_url($res->librariesPath.'/'.$stylesheet.'/'.$local):$cdn;
            else
              $source = base_url($res->librariesLocalPath.'/'.$stylesheet.'/'.$cdn);

            $html .= link_tag($source)."\n";
          }
        }
        else {
          $source = base_url($res->stylesheetsPath.'/'.$stylesheet);
          $html .= link_tag($source)."\n";
        }

      }
    }

    if (isset($params['javascripts'])) {
      foreach ($params['javascripts'] as $javascript) {
        $isLocal = isset($libraries[$javascript]['local']);

        if (isset($params['type']) && $params['type'] == 'library') {
          $javascripts = $libraries[$javascript]['javascripts'];

          foreach ($javascripts as $local => $cdn) {
            if (!$isLocal)
              $source = (!$heroku)?base_url($res->librariesPath.'/'.$javascript.'/'.$local):$cdn;
            else
              $source = base_url($res->librariesLocalPath.'/'.$javascript.'/'.$cdn);

            $html .= script_tag($source)."\n";
          }
        }
        else {
          $source = base_url($res->javascriptsPath.'/'.$javascript);
          $html .= script_tag($source)."\n";
        }
      }
    }
    
    return $html;
  }

}