<?php namespace App\Database\Seeds;

use App\Models\GroupModel;

class UserSeeder extends \CodeIgniter\Database\Seeder
{
  public function run()
  {
    $groupModel = new GroupModel();
    $group = $groupModel->where('name', 'Administrator')->first();

    $this->db->query('delete from tb_user');
    $this->db->table('tb_user')->insert([
      'firstname' => 'Fadlun',
      'lastname' => 'Anaturdasa',
      'photo' => 'hyun-bin.png',
      'phoneNumber' => '082167028705',
      'email' => 'f.anaturdasa@gmail.com',
      'username' => 'admin',
      'password' => '394870d64d9518f69673df912406a143ad3506b9',
      'salt' => 'c0237cd92f5f340b62fdf5393c620ef7a995d4be',
      'groupId' => $group->id,
      'status' => 'Active',
    ]);
  }
}