<?php namespace App\Database\Seeds;

class BannerSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $mainBanners = [
      [ 'image' => 'banner.png', 'title' => '', 'content' => '', 'tabActive' => 1, 'status' => 'Published' ],
      [ 'image' => 'banner.png', 'title' => '', 'content' => '', 'tabActive' => 1, 'status' => 'Published' ],
      [ 'image' => 'banner.png', 'title' => '', 'content' => '', 'tabActive' => 1, 'status' => 'Published' ],
    ];
          
    $rs = [
      [
        'title' => 'Main Banner',
        'slug' => 'main-banner',
        'banners' => json_encode($mainBanners),
        'postedOn' => date('Y-m-d h:i:s'),
        'status' => 'Published',
      ], 
      // [
      //   'id' => 2,
      //   'title' => 'Main Banner',
      //   'slug' => 'main-banner',
      //   'banners' => $mainBanners,
      //   'postedOn' => date('Y-m-d h:i:s'),
      //   'status' => 'Published',
      // ],
    ];

    $this->db->query('delete from tb_banner');
    
    foreach ($rs as $record) {
      $this->db->table('tb_banner')->insert($record);
    }
  }
}