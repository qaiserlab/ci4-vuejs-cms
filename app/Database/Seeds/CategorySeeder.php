<?php namespace App\Database\Seeds;

class CategorySeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $rs = [
      [
        'title' => 'HTML/CSS',
        'slug' => 'html-css',
        'status' => 'Published',
      ], [
        'title' => 'Javascript',
        'slug' => 'javascript',
        'status' => 'Published',
      ], [
        'title' => 'PHP',
        'slug' => 'php',
        'status' => 'Published',
      ], [
        'title' => 'Web Tools',
        'slug' => 'web-tools',
        'status' => 'Published',
      ], 
    ];

    $this->db->query('delete from tb_category');
    
    foreach ($rs as $record) {
      $this->db->table('tb_category')->insert($record);
    }
  }
}