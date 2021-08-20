<?php namespace App\Controllers\Dashboard;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\SettingsModel;

class Settings extends Controller
{
  
  public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
  {
    parent::initController($request, $response, $logger);
    $this->session->set('title', 'Settings');
  }

  public function index()
	{
    $model = new SettingsModel();
    $record = $model->find(1);

    return view('dashboard/settings/settings-form', [
      'title' => 'Configuration',
      'mode' => 'update',
      'record' => $record,
    ]);
  }

  public function update()
  {
    if (!$this->request->isAjax()) {
      throw PageNotFoundException::forPageNotFound();
      return;
    }

    $id = $this->session->get('id');
    
    $firstname = $this->request->getPost('firstname');
    $lastname = $this->request->getPost('lastname');
    $photo = $this->request->getPost('photo');
    $phoneNumber = $this->request->getPost('phoneNumber');
    $email = $this->request->getPost('email');
    $username = $this->request->getPost('username');
    $status = $this->request->getPost('status');

    $model = new SettingsModel();
    $record = $model->find($id);

    $record->firstname = $firstname;
    $record->lastname = $lastname;
    $record->photo = $photo;
    $record->phoneNumber = $phoneNumber;
    $record->email = $email;
    $record->username = $username;
    $record->status = $status;

    if ($model->save($record)) {

      $this->session->set([
        'loggedIn' => true,
        'id' => $record->id,
        'username' => $record->username,
        'fullname' => $record->fullname,
        'noPhoto' => $record->noPhoto,
        'photoUrl' => $record->photoUrl,
        'group' => $record->group,
      ]);

      $message = 'Data has been updated';
      $this->session->setFlashdata('splash', $message);

      return $this->response->setJSON([
        'status' => 200,
        'message' => $message,
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