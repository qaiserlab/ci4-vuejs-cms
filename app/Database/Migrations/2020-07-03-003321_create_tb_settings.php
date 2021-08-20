<?php namespace App\Database\Migrations;

class CreateTbSettings extends \CodeIgniter\Database\Migration
{
  public function up()
  {
    $this->forge->addField([
      'id' => [
        'type' => 'INT',
        'auto_increment' => true,
      ],
      'key' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
        'null' => true,
      ],
      'value' => [
        'type' => 'TEXT',
        'null' => true,
      ],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('tb_settings');
  }

  public function down()
  {
    $this->forge->dropTable('tb_settings');
  }
}
