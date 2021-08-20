<?php namespace App\Database\Seeds;

class MenuSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $mainMenu = [
      ['title' => 'Beranda', 'url' => '/', 'checked' => true],
      ['title' => 'HTML/CSS', 'url' => 'category/html-css', 'checked' => true],
      ['title' => 'Javascript', 'url' => 'category/javascript', 'checked' => true],
      ['title' => 'PHP', 'url' => 'category/php', 'checked' => true],
      ['title' => 'Web Tools', 'url' => 'category/web-tools', 'checked' => true],
      ['title' => 'Kontak', 'url' => 'contact-us', 'checked' => true],
    ];

    $rs = [
      [
        'title' => 'Main Menu',
        'slug' => 'main-menu',
        'menu' => json_encode($mainMenu),
        'status' => 'Published',
      ], [
        'title' => 'Sidebar',
        'slug' => 'sidebar',
        'menu' => json_encode($mainMenu),
        'status' => 'Published',
      ],
    ];

    $this->db->query('delete from tb_menu');
    
    foreach ($rs as $record) {
      $this->db->table('tb_menu')->insert($record);
    }
  }
}