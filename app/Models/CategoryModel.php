<?php namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
  protected $table = 'tb_category';
  protected $primaryKey = 'id';

  protected $returnType = '\App\Models\CategoryEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = [
    'title', 
    'slug',
    'status',
  ];

  protected $useTimestamps = false;
  // protected $createdField  = 'createdAt';
  // protected $updatedField  = 'updatedAt';
  // protected $deletedField  = 'deletedAt';

  protected $validationRules = [
    'title' => 'required|max_length[100]|is_unique[tb_category.title,id,{id}]',
    'slug' => 'required|max_length[100]|is_unique[tb_category.slug,id,{id}]',
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

  public function getRecordBySlug($slug) {
    $record = $this->where('slug', $slug)->first();
    return $record;
  }
}