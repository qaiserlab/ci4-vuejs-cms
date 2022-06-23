<?php namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\InboxModel;

class WebHook extends Controller
{

  public function index()
  {
    $data = $this->request->getPost()
    $model = new InboxModel();

    $model->insert([
      'name' => 'Fadlun Anaturdasa',
      'email' => 'f.anaturdasa@gmail.com',
      'phoneNumber' => '-',
      'subject' => 'webhook',
      'message' => implode(', ', $data),
    ])

    return $this->response->setJSON([
      'status' => 200,
      'message' => 'Success',
      'data' => $data,
    ]);
  }
  
}
