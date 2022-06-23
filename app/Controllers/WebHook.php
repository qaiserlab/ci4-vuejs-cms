<?php namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\InboxModel;

class WebHook extends Controller
{

  public function index()
  {
    return $this->response->setJSON([
      'status' => 200,
      'message' => 'Success',
      'data' => $this->request->getPost(),
    ]);
  }
  
}
