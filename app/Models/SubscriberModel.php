<?php namespace App\Models;

use CodeIgniter\Model;

class SubscriberModel extends Model
{
  protected $table = 'tb_subscriber';
  protected $primaryKey = 'id';

  protected $returnType = 'object';
  protected $useSoftDeletes = false;

  protected $allowedFields = [
    'name', 
    'email',
    'status',
  ];

  protected $useTimestamps = false;
  // protected $createdField  = 'createdAt';
  // protected $updatedField  = 'updatedAt';
  // protected $deletedField  = 'deletedAt';

  protected $validationRules = [
    'email' => 'required|valid_email',
  ];
  protected $validationMessages = [
    'email' => [
      'required' => 'Email field is required',
      'valid_email' => 'Email field must contain a valid email address.',
    ],
  ];
  protected $skipValidation = false;
  
}