<?php namespace App\Database\Migrations;

class CreateTbVisitor extends \CodeIgniter\Database\Migration
{
  public function up()
  {
    $this->forge->addField([
      'id' => [
        'type' => 'INT',
        'auto_increment' => true,
      ],
      'memberId' => [
        'type' => 'INT',
        'null' => true,
      ],
      'ip' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
        'null' => true,
      ],
      'url' => [
        'type' => 'TEXT',
        'null' => true,
      ],
      'counter' => [
        'type' => 'INT',
        'null' => true,
      ],
      'visitOn' => [
        'type' => 'DATETIME',
        'null' => true,
      ],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('tb_visitor');
  }

  public function down()
  {
    $this->forge->dropTable('tb_visitor');
  }
}
