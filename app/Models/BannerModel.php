<?php namespace App\Models;

use CodeIgniter\Model;

class BannerModel extends Model
{
  protected $table = 'tb_banner';
  protected $primaryKey = 'id';

  protected $returnType = 'object';
  protected $useSoftDeletes = false;

  protected $allowedFields = [
    'title', 
    'slug',
    'banners',
    'status',
  ];

  protected $useTimestamps = false;
  // protected $createdField  = 'createdAt';
  // protected $updatedField  = 'updatedAt';
  // protected $deletedField  = 'deletedAt';

  protected $validationRules = [
    'title' => 'required|max_length[100]|is_unique[tb_banner.title,id,{id}]',
    'slug' => 'required|max_length[100]|is_unique[tb_banner.slug,id,{id}]',
    // 'banners' => 'required|max_length[65500]',
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
    'banners' => [
      'required' => 'Banners field is required',
      // 'max_length' => 'Banners field cannot exceed 65.500 characters in length',
    ],
    'status' => ['required' => 'Status field is required'],
  ];
  protected $skipValidation = false;

  public function getRecordBySlug($slug) {
    $record = $this->where('slug', $slug)->first();
    if (isset($record)) {
      $banners = json_decode($record->banners);
      $i = -1;

      foreach ($banners as $banner) {
        $i++;
        $banners[$i]->imageUrl = base_url('images/'.$banner->image);
      }
      $record->banners = $banners;
    }
    return $record;
  }
}