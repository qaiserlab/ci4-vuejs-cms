<?php namespace App\Libraries;

use App\Models\BannerModel;

class BannerWidget
{
  public function html($params = [])
  {
    $html = '';

    $model = new BannerModel();
    $record = $model->getRecordBySlug($params['slug']);

    if ($record->status == 'Published') {
      $indicatorsHtml = '';
      $carouselItemsHtml = '';

      $i = -1;

      foreach ($record->banners as $banner) {
        $i++;

        $indicatorsHtml .= '
        <li data-target="#banner-'.$params['slug'].'" 
        data-slide-to="'.$i.'" 
        class="'.(($i == 0)?'active':'').'"></li>
        ';

        $carouselItemsHtml .= '
        <div class="carousel-item '.(($i == 0)?'active':'').'">
          <a href="'.((!empty($banner->url))?$banner->url:'javascript:').'">
            <img src="'.$banner->imageUrl.'" 
            style="width: 100%" 
            alt="">
            
            <div class="carousel-caption d-none d-sm-block">
              <h4>'.$banner->title.'</h4>
              <p>'.$banner->content.'</p> 
            </div>
          </a>
        </div>
        ';
      }

      $indicatorsHtml = '
      <ul class="carousel-indicators">
        '.$indicatorsHtml.'
      </ul>';

      $carouselItemsHtml = '
      <div class="carousel-inner">
        '.$carouselItemsHtml.'
      </div>';
    }

    $html = '
    <div id="banner-'.$params['slug'].'" class="carousel slide" data-ride="carousel">
      '.$carouselItemsHtml.'
      
      <a class="carousel-control-prev" href="#banner-'.$params['slug'].'" data-slide="prev">
        <span class="carousel-control-prev-icon">
        </span>
        <!-- <i class="fa fa-chevron-left"></i> -->
      </a>
      <a class="carousel-control-next" href="#banner-'.$params['slug'].'" data-slide="next">
        <span class="carousel-control-next-icon">
        </span>
        <!-- <i class="fa fa-chevron-right"></i> -->
      </a>
    </div>
    ';

    return $html;
  }
}