<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
  protected $table = 'tb_user';
  protected $primaryKey = 'id';

  protected $returnType = '\App\Models\UserEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = [
    'firstname', 
    'lastname',
    'photo',
    'phoneNumber',
    'email',
    'username',
    'password',
    'salt',
    'groupId',
    'status',
  ];

  protected $useTimestamps = false;
  // protected $createdField  = 'createdAt';
  // protected $updatedField  = 'updatedAt';
  // protected $deletedField  = 'deletedAt';

  public $validationRules = [
    'firstname' => 'required|max_length[100]',
    'email' => 'required|max_length[100]|valid_email|is_unique[tb_user.email,id,{id}]',
    'username' => 'required|max_length[100]|is_unique[tb_user.username,id,{id}]',
    'groupId' => 'required',
    'status' => 'required',
    // 'password' => 'required|min_length[6]|max_length[100]',
    // 'retypePassword' => 'required|min_length[6]|max_length[100]|matches[password]',
  ];
  protected $validationMessages = [
    'firstname' => [
      'required' => 'Firstname field is required',
      'max_length' => 'Firstname field cannot exceed 100 characters in length',
    ],
    'email' => [
      'required' => 'Email field is required',
      'max_length' => 'Email field cannot exceed 100 characters in length',
      'valid_email' => 'Email field must contain a valid email address',
      'is_unique' => 'Email field with the same value already exists',
    ],
    'username' => [
      'required' => 'Username field is required',
      'max_length' => 'Username field cannot exceed 100 characters in length',
      'is_unique' => 'Username field with the same value already exists',
    ],
    'password' => [
      'required' => 'Password field is required',
      'min_length' => 'Password field must be at least 6 characters in length',
      'max_length' => 'Password field cannot exceed 100 characters in length',
    ],
    'retypePassword' => [
      'required' => 'Retype Password field is required',
      'min_length' => 'Retype Password field must be at least 6 characters in length',
      'max_length' => 'Retype Password field cannot exceed 100 characters in length',
      'matches' => 'Retype Password field does not match with Password field',
    ],
    'groupId' => ['required' => 'Group field is required'],
    'status' => ['required' => 'Status field is required'],
  ];
  protected $skipValidation = false;
  
  protected $beforeInsert = ['beforeInsert'];

  protected function beforeInsert(array $record) {
    $salt = sha1(rand());
    $password = sha1($record['data']['password'].$salt);

    $record['data']['password'] = $password;
    $record['data']['salt'] = $salt;
    
    return $record;   
  }

}