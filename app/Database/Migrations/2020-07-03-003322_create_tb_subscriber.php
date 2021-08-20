<?php namespace App\Database\Migrations;

class CreateTbSubscriber extends \CodeIgniter\Database\Migration
{
  public function up()
  {
    $this->forge->addField([
      'id' => [
        'type' => 'INT',
        'auto_increment' => true,
      ],
      'email' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
        'null' => true,
      ],
      'status' => [
        'type' => 'VARCHAR',
        'constraint' => '10',
        'null' => true,
      ],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('tb_subscriber');
  }

  public function down()
  {
    $this->forge->dropTable('tb_subscriber');
  }
}
