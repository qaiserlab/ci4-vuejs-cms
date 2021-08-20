<?php namespace App\Database\Seeds;

class AlbumSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $rs = [
      [
        'title' => 'Uploads',
        'slug' => 'uploads',
        'status' => 'Published',
      ], [
        'title' => 'Posts',
        'slug' => 'posts',
        'status' => 'Published',
      ], [
        'title' => 'Pages',
        'slug' => 'pages',
        'status' => 'Published',
      ], [
        'title' => 'Banners',
        'slug' => 'banners',
        'status' => 'Published',
      ], [
        'title' => 'Users',
        'slug' => 'users',
        'status' => 'Published',
      ],
    ];

    $this->db->query('delete from tb_album');
    
    foreach ($rs as $record) {
      $this->db->table('tb_album')->insert($record);
    }
  }
}