<?php namespace App\Controllers\Dashboard;

use App\Models\UserModel;

class AuthRules
{

  public function isUsernameRegistered(string $str, string $fields, array $data): bool
  {
    $username = $str;
    $password = $data[$fields];

    $model = new UserModel();
    $record = $model->where('username', $username)->first();

    return (!$record)?false:true;
  }

  public function isActive(string $str): bool
  {
    $username = $str;

    $model = new UserModel();
    $record = $model->where('username', $username)->first();

    return ($record->status == 'Active');
  }

  public function isValidPassword(string $str, string $fields, array $data): bool
  {
    $username = ($fields != 'session')?$data[$fields]:session()->get('username');
    $password = $str;

    $model = new UserModel();
    $record = $model->where('username', $username)->first();

    if ($record) {
      $salt = $record->salt;
      $password = sha1($password.$salt);

      if ($password != $record->password)
        return false;
    }
    
    return true;
  }

}