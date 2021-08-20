<?php namespace App\Libraries;

class BreadcrumbWidget
{
  public function html($params = [])
  {
    $items = [];

    if (isset($params['items'])) {
      $items = $params['items'];
    }
    else {
      $url = '';

      $requestUri = $_SERVER['REQUEST_URI'];
      $xRequestUri = explode('/', $requestUri);

      $start = 1;
      $xBaseUrl = explode('/', explode('//', base_url())[1]);
      $start = count($xBaseUrl);

      for ($i = $start; $i < count($xRequestUri); $i++) {
        $url .= $xRequestUri[$i].'/'; 
        $items[$xRequestUri[$i]] = base_url($url);
      }
    }

    $html = '';
    $i = 0;

    foreach ($items as $label => $url) {
      $i++;

      $xLabel = explode('-', $label);
      $label = '';

      foreach ($xLabel as $label_) {
        $label .= strtoupper(substr($label_, 0, 1)).substr($label_, 1).' ';
      }

      if ($i == count($items)) {
        $xLabel = explode('?', $label);
        $html .= '<li class="breadcrumb-item">'.$xLabel[0].'</li>';
      }
      else
        $html .= '<li class="breadcrumb-item"><a href="'.$url.'">'.$label.'</a></li>';
    }

    $html = '
    <ol class="breadcrumb">
      '.$html.'
    </ol>
    ';

    return $html;
  }
}