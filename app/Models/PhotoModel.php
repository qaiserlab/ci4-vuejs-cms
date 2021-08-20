<?php namespace App\Models;

use CodeIgniter\Model;

class PhotoModel extends Model
{
  protected $table = 'tb_photo';
  protected $primaryKey = 'id';

  protected $returnType = 'object';
  protected $useSoftDeletes = false;

  protected $allowedFields = [
    'title', 
    'slug',
    'file',
    'albumId',
    'postedOn',
    'status',
  ];

  protected $useTimestamps = false;
  // protected $createdField  = 'createdAt';
  // protected $updatedField  = 'updatedAt';
  // protected $deletedField  = 'deletedAt';

  protected $validationRules = [
    'title' => 'required|max_length[200]|is_unique[tb_photo.title,id,{id}]',
    'slug' => 'required|max_length[200]|is_unique[tb_photo.slug,id,{id}]',
    'status' => 'required',
  ];
  protected $validationMessages = [
    'title' => [
      'required' => 'Title field is required',
      'max_length' => 'Title field cannot exceed 100 characters in length',
      'is_unique' => 'Title field with the same value already exists',
    ],
    'slug' => [
      'required' => 'Slug field is required',
      'max_length' => 'Slug field cannot exceed 100 characters in length',
      'is_unique' => 'Slug field with the same value already exists',
    ],
    'status' => ['required' => 'Status field is required'],
  ];
  protected $skipValidation = false;

  protected $beforeInsert = ['beforeInsert'];
  protected function beforeInsert(array $record) {
    $record['data']['postedOn'] = date('Y-m-d h:i:s');
    return $record;   
  }

  public function getRecordBySlug($slug) {
    $record = $this->where('slug', $slug)->first();
    return $record;
  }
}