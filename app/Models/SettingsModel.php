<?php namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
  protected $table = 'tb_settings';
  protected $primaryKey = 'id';

  protected $returnType = 'object';
  protected $useSoftDeletes = false;

  protected $allowedFields = [
    'key', 
    'value',
  ];

  protected $useTimestamps = false;
  // protected $createdField  = 'createdAt';
  // protected $updatedField  = 'updatedAt';
  // protected $deletedField  = 'deletedAt';

  protected $validationRules = [
    'key' => 'required|max_length[100]|is_unique[tb_settings.key,id,{id}]',
    // 'value' => 'required',
  ];
  protected $validationMessages = [
    'key' => [
      'required' => 'Key field is required',
      'max_length' => 'Key field cannot exceed 100 characters in length',
      'is_unique' => 'Key field with the same value already exists',
    ],
    'value' => [
      'required' => 'Value field is required',
    ],
  ];
  protected $skipValidation = false;

  public function getRecordByKey($key) {
    $record = $this->where('key', $key)->first();
    return $record;
  }
}