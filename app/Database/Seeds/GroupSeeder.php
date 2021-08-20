<?php namespace App\Database\Seeds;

class GroupSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    helper('main');
    
    $menuIndex = -1;
    $menu = settings('menu', true);

    foreach ($menu as $menuItem) {
      $menuIndex++;
      $menu[$menuIndex]->checked = true;

      if (isset($menuItem->submenu)) {
        $submenuIndex = -1;
        foreach ($menuItem->submenu as $submenuItem) {
          $submenuIndex++;
          $menu[$menuIndex]->submenu[$submenuIndex]->checked = true;
        }
      }
    }

    $settingsMenuIndex = -1;
    $settingsMenu = settings('settingsMenu', true);

    foreach ($settingsMenu as $settingsMenuItem) {
      $settingsMenuIndex++;
      $settingsMenu[$settingsMenuIndex]->checked = true;

      if (isset($settingsMenuItem->submenu)) {
        $submenuIndex = -1;
        foreach ($settingsMenuItem->submenu as $submenuItem) {
          $submenuIndex++;
          $settingsMenu[$settingsMenuIndex]->submenu[$submenuIndex]->checked = true;
        }
      }
    }

    $this->db->query('delete from tb_group');
    $this->db->table('tb_group')->insert([
      'name' => 'Administrator',
      'menu' => json_encode($menu),
      'settingsMenu' => json_encode($settingsMenu),
      'status' => 'Active',
    ]);
  }
}