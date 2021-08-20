<?php namespace App\Database\Seeds;

class SettingsSeeder extends \CodeIgniter\Database\Seeder
{
  private function getMenu() 
  {
    return [
      ['title' => 'Dashboard', 'url' => 'dashboard/home', 'icon' => 'dashboard'],
      ['title' => 'Content', 'url' => 'dashboard/content', 'icon' => 'calculator', 'submenu' => [
        ['title' => 'List', 'url' => 'dashboard/content'],
        ['title' => 'New', 'url' => 'dashboard/content/new'],
        ['title' => 'Menu', 'url' => 'dashboard/content/menu'],
        ['title' => 'Banner', 'url' => 'dashboard/content/banner'],
      ]],
      ['title' => 'Post', 'url' => 'dashboard/post', 'icon' => 'paper-plane', 'submenu' => [
        ['title' => 'List', 'url' => 'dashboard/post'],
        ['title' => 'New', 'url' => 'dashboard/post/new'],
        ['title' => 'Category', 'url' => 'dashboard/post/category'],
      ]],
      ['title' => 'Page', 'url' => 'dashboard/page', 'icon' => 'file', 'submenu' => [
        ['title' => 'List', 'url' => 'dashboard/page'],
        ['title' => 'New', 'url' => 'dashboard/page/new'],
      ]],
      // ['title' => 'Gallery', 'url' => 'dashboard/gallery', 'icon' => 'image', 'submenu' => [
      //   ['title' => 'List', 'url' => 'dashboard/gallery'],
      //   ['title' => 'New', 'url' => 'dashboard/gallery/new'],
      // ]],
    ];
  }

  private function getSettingsMenu()
  {
    return [
      ['title' => 'Settings', 'url' => 'dashboard/settings', 'icon' => 'cog'],
      ['title' => 'My Account', 'url' => 'dashboard/my-account', 'icon' => 'user'],
      ['title' => 'User Management', 'url' => 'dashboard/user', 'icon' => 'users'],
      ['title' => 'Group & Privileges', 'url' => 'dashboard/group', 'icon' => 'key'],
      ['title' => 'Preview Website', 'url' => '', 'target' => '_blank', 'icon' => 'desktop'],
      ['title' => 'Logout', 'url' => 'javascript:confirmLogout()', 'icon' => 'lock'],
    ];
  }

  public function run()
  {
    $rs = [
      [
        'key' => 'websiteURL',
        'value' => 'http://produktif.art',
      ], [
        'key' => 'menu',
        'value' => json_encode($this->getMenu()),
      ], [
        'key' => 'settingsMenu',
        'value' => json_encode($this->getSettingsMenu()),
      ],
    ];

    $this->db->query('delete from tb_settings');
    
    foreach ($rs as $record) {
      $this->db->table('tb_settings')->insert($record);
    }
  }
}