<?php namespace App\Models;

use CodeIgniter\Model;

class PageModel extends Model
{
  protected $table = 'tb_page';
  protected $primaryKey = 'id';

  protected $returnType = '\App\Models\PageEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = [
    'title', 
    'slug',
    'image',
    'content',
    'view',
    'postedOn',
    'status',
  ];

  protected $useTimestamps = false;
  // protected $createdField  = 'createdAt';
  // protected $updatedField  = 'updatedAt';
  // protected $deletedField  = 'deletedAt';

  protected $validationRules = [
    'title' => 'required|max_length[100]|is_unique[tb_page.title,id,{id}]',
    'slug' => 'required|max_length[100]|is_unique[tb_page.slug,id,{id}]',
    'content' => 'required|max_length[65500]',
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
    'content' => [
      'required' => 'Content field is required',
      'max_length' => 'Content field cannot exceed 65.500 characters in length',
    ],
    'status' => ['required' => 'Status field is required'],
  ];
  protected $skipValidation = false;

  protected $beforeInsert = ['beforeInsert'];

  protected function beforeInsert(array $record) {

    $record['data']['view'] = 0;
    $record['data']['postedOn'] = date('Y-m-d h:i:s');
    
    return $record;   
  }
  
  public function getRecordBySlug($slug) {
    $record = $this->where('slug', $slug)->first();
    return $record;
  }
}