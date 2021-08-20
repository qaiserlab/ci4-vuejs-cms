<?php namespace App\Models;

use CodeIgniter\Model;

class GroupModel extends Model
{
  protected $table = 'tb_group';
  protected $primaryKey = 'id';

  protected $returnType = 'object';
  protected $useSoftDeletes = false;

  protected $allowedFields = [
    'name', 
    'menu',
    'settingsMenu',
    'status',
  ];

  protected $useTimestamps = false;
  // protected $createdField  = 'createdAt';
  // protected $updatedField  = 'updatedAt';
  // protected $deletedField  = 'deletedAt';

  protected $validationRules = [
    'name' => 'required|max_length[100]|is_unique[tb_group.name,id,{id}]',
    // 'menu' => 'required|max_length[65500]',
    // 'settingsMenu' => 'required|max_length[65500]',
    'status' => 'required',
  ];
  protected $validationMessages = [
    'name' => [
      'required' => 'Name field is required',
      'max_length' => 'Name field cannot exceed 100 characters in length',
      'is_unique' => 'Name field with the same value already exists',
    ],
    'menu' => [
      'required' => 'Menu field is required',
      // 'max_length' => 'Menu field cannot exceed 65.500 characters in length',
    ],
    'settingsMenu' => [
      'required' => 'Menu field is required',
      // 'max_length' => 'Menu field cannot exceed 65.500 characters in length',
    ],
    'status' => ['required' => 'Status field is required'],
  ];
  protected $skipValidation = false;
  
  public function getActiveRs() {
    return $this->where('status', 'Active')->findAll();
  }
}