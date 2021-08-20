<?php namespace App\Controllers\Dashboard;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\UserModel;

class MyAccount extends Controller
{
  
  public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
  {
    parent::initController($request, $response, $logger);
    $this->session->set('title', 'My Account');
  }

  public function index()
	{
    $model = new UserModel();
    $record = $model->find($this->session->get('id'));

    $record = [
      'id' => $record->id,
      'fullname' => $record->fullname,
      'firstname' => $record->firstname,
      'photo' => $record->photo,
      'lastname' => $record->lastname,
      'phoneNumber' => $record->phoneNumber,
      'email' => $record->email,
      'username' => $record->username,
      'group' => $record->group,
      'status' => $record->status,
    ];
    
    return view('dashboard/my-account/my-account-preview', [
      'title' => 'Profile',
      'mode' => 'update',
      'record' => $record,
    ]);
  }
  
  public function changePassword()
	{
    $model = new UserModel();
    $record = $model->find($this->session->get('id'));

    $record = [
      'id' => $record->id,
      'fullname' => $record->fullname,
      'photo' => $record->photo,
      'email' => $record->email,
      'username' => $record->username,
      'status' => $record->status,
    ];
    
    return view('dashboard/my-account/my-account-change-password', [
      'title' => 'Change Password',
      'mode' => 'update',
      'record' => $record,
    ]);
  }

  public function updatePassword()
  {
    if (!$this->request->isAjax()) {
      throw PageNotFoundException::forPageNotFound();
      return;
    }

    $id = $this->session->get('id');
    
    $oldPassword = $this->request->getPost('oldPassword');
    $newPassword = $this->request->getPost('newPassword');
    $retypePassword = $this->request->getPost('retypePassword');
    
    if ($this->validate([
      'oldPassword' => 'required|min_length[6]|max_length[100]|isValidPassword[session]',
      'newPassword' => 'required|min_length[6]|max_length[100]',
      'retypePassword' => 'required|min_length[6]|max_length[100]|matches[newPassword]',
    ], [
      'oldPassword' => [
        'required' => 'Old Password field is required',
        'min_length' => 'Old Password field must be at least 6 characters in length',
        'max_length' => 'Old Password field cannot exceed 100 characters in length',
        'isValidPassword' => 'Invalid Old Password',
      ],
      'newPassword' => [
        'required' => 'New Password field is required',
        'min_length' => 'New Password field must be at least 6 characters in length',
        'max_length' => 'New Password field cannot exceed 100 characters in length',
      ],
      'retypePassword' => [
        'required' => 'Retype Password field is required',
        'min_length' => 'Retype Password field must be at least 6 characters in length',
        'max_length' => 'Retype Password field cannot exceed 100 characters in length',
        'matches' => 'Retype Password field does not match with Password field',
      ],
    ])) {

      $model = new UserModel();
      
      $salt = sha1(rand());
      $password = sha1($newPassword.$salt);

      $model->update($id, [
        'password' => $password,
        'salt' => $salt,
      ]);

      $message = 'Password has been changed';
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
        'data' => $this->validator->getErrors(),
      ]);
    }   
  }

  public function edit()
	{
    $model = new UserModel();
    $record = $model->find($this->session->get('id'));

    $record = [
      'id' => $record->id,
      'firstname' => $record->firstname,
      'lastname' => $record->lastname,
      'photo' => $record->photo,
      'phoneNumber' => $record->phoneNumber,
      'email' => $record->email,
      'username' => $record->username,
      'status' => $record->status,
    ];
    
    return view('dashboard/my-account/my-account-form', [
      'title' => 'Edit',
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

    $model = new UserModel();
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