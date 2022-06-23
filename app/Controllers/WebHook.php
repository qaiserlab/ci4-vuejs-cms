<?php namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\InboxModel;

class WebHook extends Controller
{

  public function index()
  {
    $data = json_decode(file_get_contents("php://input"), true);

    $model = new InboxModel();

    if (!$model->insert([
      'name' => 'WebHook',
      'email' => 'f.anaturdasa@gmail.com',
      'phoneNumber' => $data->status,
      'subject' => date("Y-m-d H:i:s"),
      'message' => json_encode($data),
    ])) {
      return $this->response->setJSON([
        'status' => 422,
        'message' => 'Please correct following errors;',
        'data' => $model->errors(),
      ]);
    }

    return $this->response->setJSON([
      'status' => 200,
      'message' => 'Post WebHook Success',
      'data' => $data,
    ]);
  }
  
  public function getData() {
    $model = new InboxModel();

    $data = $model->orderBy('id', 'DESC')->findAll();

    return $this->response->setJSON([
      'status' => 200,
      'message' => 'Get WebHook Success',
      'data' => $data,
    ]);
  }

  public function deleteAll() {
    $model = new InboxModel();

    $model->where('name', 'WebHook');
    $model->delete();

    return $this->response->setJSON([
      'status' => 200,
      'message' => 'Clear WebHook Success',
    ]);
  }
}
