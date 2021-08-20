<?php namespace App\Database\Migrations;

class CreateTbContent extends \CodeIgniter\Database\Migration
{
  public function up()
  {
    $this->forge->addField([
      'id' => [
        'type' => 'INT',
        'auto_increment' => true,
      ],
      'title' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
        'null' => true,
      ],
      'slug' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
        'null' => true,
      ],
      'content' => [
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
    $this->forge->createTable('tb_content');
  }

  public function down()
  {
    $this->forge->dropTable('tb_content');
  }
}
