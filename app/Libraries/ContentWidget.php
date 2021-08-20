<?php namespace App\Libraries;

use App\Models\ContentModel;

class ContentWidget
{
  public function html($params = [])
  {
    $html = '';

    $model = new ContentModel();
    $record = $model->getRecordBySlug($params['slug']);

    if ($record->status == 'Published') {
      if (!isset($params['noTitle']))
        $html .= '<h5>'.$record->title.'</h5>';
      
      $html .= $record->content;
    }

    $html = '
    <div id="content-'.$params['slug'].'">
      '.$html.'
    </div>
    ';

    return $html;
  }
}