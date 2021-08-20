<?php namespace App\Models;

use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

class CategoryEntity extends Entity
{

  public function getUrl()
  {
    return base_url('category/'.$this->slug);
  }

}