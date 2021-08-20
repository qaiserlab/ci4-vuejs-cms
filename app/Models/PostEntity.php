<?php namespace App\Models;

use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

class PostEntity extends Entity
{

  public function getUrl()
  {
    $date = Time::parse($this->postedOn);
    return base_url($date->year.'/'.$date->month.'/'.$this->slug);
  }

  public function noImage()
  {
    return empty($this->image);
  }

  public function getImageUrl() 
  {
    return 'http://localhost/marketplace/api/public/archives/'.$this->image;
  }

  public function getExcerpt()
  {
    helper('text');
    return excerpt(strip_tags($this->content));
  }

  public function getPostedOnHumanize() 
  {
    $date = Time::parse($this->postedOn);
    return $date->humanize();
  }

}