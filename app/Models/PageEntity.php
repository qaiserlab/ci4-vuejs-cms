<?php namespace App\Models;

use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

class PageEntity extends Entity
{

  public function getUrl()
  {
    return base_url('page/'.$this->slug);
  }

  public function noImage()
  {
    return empty($this->image);
  }

  public function getImageUrl() 
  {
    return 'http://localhost/marketplace/api/public/archives/'.$this->image;
  }

  public function getPostedOnHumanize() 
  {
    $date = Time::parse($this->postedOn);
    return $date->humanize();
  }

}