<?php namespace App\Database\Migrations;

class CreateTbGroup extends \CodeIgniter\Database\Migration
{
  public function up()
  {
    $this->forge->addField([
      'id' => [
        'type' => 'INT',
        'auto_increment' => true,
      ],
      'name' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
        'null' => true,
      ],
      'menu' => [
        'type' => 'TEXT',
        'null' => true,
      ],
      'settingsMenu' => [
        'type' => 'TEXT',
        'null' => true,
      ],
      'status' => [
        'type' => 'VARCHAR',
        'constraint' => '10',
        'null' => true,
      ],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('tb_group');
  }

  public function down()
  {
    $this->forge->dropTable('tb_group');
  }
}
