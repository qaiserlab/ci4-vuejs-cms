<?php namespace App\Database\Migrations;

class CreateTbUser extends \CodeIgniter\Database\Migration
{
  public function up()
  {
    $this->forge->addField([
      'id' => [
        'type' => 'INT',
        'auto_increment' => true,
      ],
      'firstname' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
        'null' => true,
      ],
      'lastname' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
        'null' => true,
      ],
      'photo' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
        'null' => true,
      ],
      'phoneNumber' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
        'null' => true,
      ],
      'email' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
        'null' => true,
      ],
      'username' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
        'null' => true,
      ],
      'password' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
        'null' => true,
      ],
      'salt' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
        'null' => true,
      ],
      'groupId' => [
        'type' => 'INT',
        'null' => true,
      ],
      'status' => [
        'type' => 'VARCHAR',
        'constraint' => '10',
        'null' => true,
      ],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('tb_user');
  }

  public function down()
  {
    $this->forge->dropTable('tb_user');
  }
}
