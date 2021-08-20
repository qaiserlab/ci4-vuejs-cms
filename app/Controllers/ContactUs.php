<?php namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\InboxModel;

class ContactUs extends Controller
{

  public function index()
  {
    $this->session->set('title', 'Contact Us');
    return view('contact-us');
  }

  public function sendMessage()
  {
    if (!$this->request->isAjax()) {
      throw PageNotFoundException::forPageNotFound();
      return;
    }

    $name = $this->request->getPost('name');
    $email = $this->request->getPost('email');
    $phoneNumber = $this->request->getPost('phoneNumber');
    $subject = $this->request->getPost('subject');
    $message = $this->request->getPost('message');

    $model = new InboxModel();

    if ($model->insert([
      'name' => $name,
      'email' => $email,
      'phoneNumber' => $phoneNumber,
      'subject' => $subject,
      'message' => $message,
    ])) {
      return $this->response->setJSON([
        'status' => 200,
        'message' => 'Message has been sent',
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
