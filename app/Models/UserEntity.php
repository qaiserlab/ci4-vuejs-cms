<?php namespace App\Models;

use CodeIgniter\Entity;
// use CodeIgniter\I18n\Time;

use App\Models\GroupModel;

class UserEntity extends Entity
{

  public function getFullname()
  {
    return $this->firstname.' '.$this->lastname;
  }

  public function getNoPhoto()
  {
    return empty($this->photo);
    // return empty($this->photo) || is_null($this->photo);
  }

  public function getPhotoUrl() 
  {
    return base_url('images/'.$this->photo);
  }

  public function getGroup() 
  {
    $model = new GroupModel();
    $record = $model->find($this->groupId);

    if (isset($record)) {
      $record->menu = json_decode($record->menu, true);
      $record->settingsMenu = json_decode($record->settingsMenu, true);
    }
    
    return $record;
  }

  // public function getRegisteredOnHumanize() 
  // {
  //   $date = Time::parse($this->registeredOn);
  //   return $date->humanize();
  // }

}