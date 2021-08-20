<?php namespace App\Controllers;

use CodeIgniter\Controller;

class Tools extends Controller {

  public function test($params = '') {
    $test = 'string';
    echo substr($test, 3, 12);

    // $env = getenv();

    // print_r(getenv());
    // echo "\n";
    // echo "OS: ".$env['OS'];
    // echo "\n";
  }

  public function test_($params = '')
  {
    $db = db_connect();
    $rs = $db->query('select * from tb_content')->getResult();
    print_r($rs);
    
    echo "=============================\n";
    echo "\n";
    
    foreach ($rs as $record) {
      echo 'title: '.$record->title."\n";
      echo 'slug: '.$record->slug."\n";
      echo 'status: '.$record->status."\n";
      echo "\n";
    }

    echo "\n=============================\n";

    $tables = $db->listTables();

    foreach ($tables as $table)
    {
      echo $table."\n";
    }
  }

}