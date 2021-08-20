<?php namespace App\Libraries;

class VueWidget
{
  public function html($params = [])
  {
    $serverData = '';

    if (isset($params['serverData'])) 
      $serverData = json_encode($params['serverData']);

    return '
    <div id="'.$params['widget'].'">
      <section>
        <'.$params['widget'].' server-data="'.$serverData.'"></'.$params['widget'].'>
      </section>
    </div>
    ';
  }
}