<?php namespace App\Models;

use CodeIgniter\Model;

class InboxModel extends Model
{
  protected $table = 'tb_inbox';
  protected $primaryKey = 'id';

  protected $returnType = 'object';
  protected $useSoftDeletes = false;

  protected $allowedFields = [
    'name', 
    'email',
    'phoneNumber',
    'subject',
    'message',
    'status',
  ];

  protected $useTimestamps = false;
  // protected $createdField  = 'createdAt';
  // protected $updatedField  = 'updatedAt';
  // protected $deletedField  = 'deletedAt';

  protected $validationRules = [
    'name' => 'required',
    'phoneNumber' => 'required',
    'email' => 'required|valid_email',
    'subject' => 'required',
    'message' => 'required',
  ];
  protected $validationMessages = [
    'name' => ['required' => 'Name field is required'],
    'phoneNumber' => ['required' => 'Phone Number field is required'],
    'email' => [
      'required' => 'Email field is required',
      'valid_email' => 'Email field must contain a valid email address.',
    ],
    'subject' => ['required' => 'Subject field is required'],
    'message' => ['required' => 'Message field is required'],
  ];
  protected $skipValidation = false;
  
}