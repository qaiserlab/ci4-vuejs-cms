<?php namespace App\Database\Migrations;

class CreateTbAlbum extends \CodeIgniter\Database\Migration
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
      'status' => [
        'type' => 'VARCHAR',
        'constraint' => '10',
        'null' => true,
      ],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('tb_album');
  }

  public function down()
  {
    $this->forge->dropTable('tb_album');
  }
}
