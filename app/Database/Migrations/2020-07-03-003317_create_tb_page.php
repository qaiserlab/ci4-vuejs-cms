<?php namespace App\Database\Migrations;

class CreateTbPage extends \CodeIgniter\Database\Migration
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
        'constraint' => '200',
        'null' => true,
      ],
      'slug' => [
        'type' => 'VARCHAR',
        'constraint' => '200',
        'null' => true,
      ],
      'image' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
        'null' => true,
      ],
      'content' => [
        'type' => 'TEXT',
        'null' => true,
      ],
      'view' => [
        'type' => 'INT',
        'null' => true,
      ],
      'postedOn' => [
        'type' => 'DATETIME',
        'null' => true,
      ],
      'status' => [
        'type' => 'VARCHAR',
        'constraint' => '10',
        'null' => true,
      ],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('tb_page');
  }

  public function down()
  {
    $this->forge->dropTable('tb_page');
  }
}
