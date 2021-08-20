<?php namespace App\Database\Seeds;

class PhotoSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $this->db->query('delete from tb_photo');
    $this->db->table('tb_photo')->insert([
      'title' => 'Hyun Bin',
      'slug' => 'hyun-bin',
      'file' => 'hyun-bin.png',
      'albumId' => 5,
      'postedOn' => date('Y-m-d h:i:s'),
      'status' => 'Published',
    ]);
  }
}