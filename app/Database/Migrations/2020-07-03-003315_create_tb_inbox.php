<?php namespace App\Database\Migrations;

class CreateTbInbox extends \CodeIgniter\Database\Migration
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
      'email' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
        'null' => true,
      ],
      'phoneNumber' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
        'null' => true,
      ],
      'subject' => [
        'type' => 'VARCHAR',
        'constraint' => '100',
        'null' => true,
      ],
      'message' => [
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
    $this->forge->createTable('tb_inbox');
  }

  public function down()
  {
    $this->forge->dropTable('tb_inbox');
  }
}
