<?php namespace App\Models;

use CodeIgniter\Model;

class PostModel extends Model
{
  protected $table = 'tb_post';
  protected $primaryKey = 'id';

  protected $returnType = '\App\Models\PostEntity';
  protected $useSoftDeletes = false;

  protected $allowedFields = [
    'title', 
    'slug',
    'image',
    'content',
    'categoryId',
    'tags',
    'view',
    'postedOn',
    'viewOn',
    'status',
  ];

  protected $useTimestamps = false;
  // protected $createdField  = 'createdAt';
  // protected $updatedField  = 'updatedAt';
  // protected $deletedField  = 'deletedAt';

  protected $validationRules = [
    'title' => 'required|max_length[100]|is_unique[tb_post.title,id,{id}]',
    'slug' => 'required|max_length[100]|is_unique[tb_post.slug,id,{id}]',
    'content' => 'required|max_length[65500]',
    'categoryId' => 'required',
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
    'categoryId' => ['required' => 'Category field is required'],
    'status' => ['required' => 'Status field is required'],
  ];
  protected $skipValidation = false;

  protected $beforeInsert = ['beforeInsert'];

  protected function beforeInsert(array $record) {

    $record['data']['view'] = 0;
    $record['data']['postedOn'] = date('Y-m-d h:i:s');
    
    return $record;   
  }

  public function getRsByCategorySlug($slug) {
    $categoryModel = new CategoryModel();
    $category = $categoryModel->where('slug', $slug)->first();
    $rs = $this->where('categoryId', $category->id)->orderBy('id', 'desc');
    return $rs;
  }

  public function getRsByYearMonth($year, $month) {
    $config = config('Database');
    $DBDriver = $config->default['DBDriver'];

    switch ($DBDriver) {
      case 'MySQLi':
        $model = $this->where([
          'year(postedOn)' => $year,
          'month(postedOn)' => $month,
        ]);
        break;
      case 'Postgre':
        $model = $this->where([
          'EXTRACT(YEAR FROM "postedOn")' => $year,
          'EXTRACT(MONTH FROM "postedOn")' => $month,
        ]);
    }

    return $model->orderBy('id', 'DESC')->findAll();
  }

  public function getRecordByYearMonthSlug($year, $month, $slug) {

    $config = config('Database');
    $DBDriver = $config->default['DBDriver'];

    switch ($DBDriver) {
      case 'MySQLi':
        $record = $this->where([
          'YEAR(postedOn)' => $year,
          'MONTH(postedOn)' => $month,
          'slug' => $slug,
        ])->first();
        break;
      case 'Postgre':
        $record = $this->where([
          'EXTRACT(YEAR FROM "postedOn")' => $year,
          'EXTRACT(MONTH FROM "postedOn")' => $month,
          'slug' => $slug,
        ])->first();
    }

    return $record;
  }

}