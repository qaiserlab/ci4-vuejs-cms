<?php namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\SubscriberModel;

class Subscribe extends Controller
{

  public function sendEmail()
  {
    if (!$this->request->isAjax()) {
      throw PageNotFoundException::forPageNotFound();
      return;
    }

    $email = $this->request->getPost('email');
    
    $model = new SubscriberModel();

    if ($model->insert([
      'email' => $email,
    ])) {
      return $this->response->setJSON([
        'status' => 200,
        'message' => 'Email has been registered to be subscriber',
      ]);
    }
    else {
      return $this->response->setJSON([
        'status' => 422,
        'message' => 'Please correct following errors;',
        'data' => $model->errors(),
      ]);
    }
  }
  
}
