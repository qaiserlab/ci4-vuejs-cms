<?php namespace App\Database\Migrations;

class CreateTbCity extends \CodeIgniter\Database\Migration
{
  public function up()
  {
    $this->forge->addField([
      'id' => [
        'type' => 'INT',
        'auto_increment' => true,
      ],
      'provinceId' => [
        'type' => 'INT',
        'null' => true,
      ],
      'name' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
        'null' => true,
      ],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('tb_city');
  }

  public function down()
  {
    $this->forge->dropTable('tb_city');
  }
}
