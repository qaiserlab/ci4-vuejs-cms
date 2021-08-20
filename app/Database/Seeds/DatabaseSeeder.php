<?php namespace App\Database\Seeds;

class DatabaseSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $this->call('SettingsSeeder');
    $this->call('GroupSeeder');
    $this->call('UserSeeder');
    $this->call('CategorySeeder');
    $this->call('MenuSeeder');
    $this->call('AlbumSeeder');
    $this->call('PhotoSeeder');
    $this->call('BannerSeeder');
    $this->call('ContentSeeder');
    $this->call('PageSeeder');
  }
}