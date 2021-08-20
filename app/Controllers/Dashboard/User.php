<?php namespace App\Controllers\Dashboard;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\UserModel;
use App\Models\GroupModel;

class User extends Controller
{
  
  public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
  {
    parent::initController($request, $response, $logger);
    $this->session->set('title', 'User Management');
  }

  public function index()
	{
    $model = new UserModel();
    
    $rs = $model->orderBy('firstname')->findAll();
    $rs = extracty($rs, ['fullname', 'group']);

    $model = new GroupModel();
    $rsGroup_ = $model->orderBy('name')->findAll();
    $rsGroup = [];

    foreach ($rsGroup_ as $record) {
      $rsGroup []= [
        'id' => $record->name,
        'text' => $record->name,
      ];
    }

    return view('dashboard/user/user-list', [
      'rs' => $rs,
      'rsGroup' => $rsGroup,
    ]);
  }
  
  public function new()
	{
    $groupModel = new GroupModel();
    $rsGroup = $groupModel->getActiveRs();

    return view('dashboard/user/user-form', [
      'title' => 'New',
      'mode' => 'create',
      'rsGroup' => $rsGroup,
    ]);
  }

  public function edit()
	{
    $id = $this->request->getGet('id');

    $model = new UserModel();
    $record = $model->find($id);

    $record = [
      'id' => $record->id,
      'firstname' => $record->firstname,
      'lastname' => $record->lastname,
      'photo' => $record->photo,
      'phoneNumber' => $record->phoneNumber,
      'email' => $record->email,
      'username' => $record->username,
      'groupId' => $record->groupId,
      'status' => $record->status,
    ];

    $groupModel = new GroupModel();
    $rsGroup = $groupModel->getActiveRs();

    return view('dashboard/user/user-form', [
      'title' => 'Edit',
      'mode' => 'update',
      'record' => $record,
      'rsGroup' => $rsGroup,
    ]);
  }

  public function changePassword()
	{
    $id = $this->request->getGet('id');

    $model = new UserModel();
    $record = $model->find($id);

    $record = [
      'id' => $record->id,
      'fullname' => $record->fullname,
      'photo' => $record->photo,
      'phoneNumber' => $record->phoneNumber,
      'email' => $record->email,
      'username' => $record->username,
      // 'groupId' => $record->groupId,
      'status' => $record->status,
    ];

    return view('dashboard/user/user-change-password', [
      'title' => 'Change Password',
      'mode' => 'update',
      'record' => $record,
    ]);
  }

  public function create()
  {
    if (!$this->request->isAjax()) {
      throw PageNotFoundException::forPageNotFound();
      return;
    }

    $firstname = $this->request->getPost('firstname');
    $lastname = $this->request->getPost('lastname');
    $photo = $this->request->getPost('photo');
    $phoneNumber = $this->request->getPost('phoneNumber');
    $email = $this->request->getPost('email');
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');
    $retypePassword = $this->request->getPost('retypePassword');
    $groupId = $this->request->getPost('groupId');
    $status = $this->request->getPost('status');

    $model = new UserModel();

    $model->validationRules['password'] = 'required|min_length[6]|max_length[100]';
    $model->validationRules['retypePassword'] = 'required|min_length[6]|max_length[100]|matches[password]';

    if ($model->insert([
      'firstname' => $firstname,
      'lastname' => $lastname,
      'photo' => $photo,
      'phoneNumber' => $phoneNumber,
      'email' => $email,
      'username' => $username,
      'password' => $password,
      'retypePassword' => $retypePassword,
      'groupId' => $groupId,
      'status' => $status,
    ])) {
      $message = 'Data has been created';
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

  public function update()
  {
    if (!$this->request->isAjax()) {
      throw PageNotFoundException::forPageNotFound();
      return;
    }

    $id = $this->request->getGet('id');

    $firstname = $this->request->getPost('firstname');
    $lastname = $this->request->getPost('lastname');
    $photo = $this->request->getPost('photo');
    $phoneNumber = $this->request->getPost('phoneNumber');
    $email = $this->request->getPost('email');
    $username = $this->request->getPost('username');
    $groupId = $this->request->getPost('groupId');
    $status = $this->request->getPost('status');
    
    $model = new UserModel();
    $record = $model->find($id);

    $record->firstname = $firstname;
    $record->lastname = $lastname;
    $record->photo = $photo;
    $record->phoneNumber = $phoneNumber;
    $record->email = $email;
    $record->username = $username;
    $record->groupId = $groupId;
    $record->status = $status;

    if ($model->save($record)) {
      $message = 'Data has been updated';
      $this->session->setFlashdata('splash', $message);

      return $this->response->setJSON([
        'status' => 200,
        'message' => $message,
      ]);
    } else {
      return $this->response->setJSON([
        'status' => 422,
        'message' => 'Please correct following errors;',
        'data' => $model->errors(),
      ]);
    }   

  }

  public function updatePassword()
  {
    if (!$this->request->isAjax()) {
      throw PageNotFoundException::forPageNotFound();
      return;
    }

    $id = $this->request->getGet('id');
    
    $oldPassword = $this->request->getPost('oldPassword');
    $newPassword = $this->request->getPost('newPassword');
    $retypePassword = $this->request->getPost('retypePassword');
    
    if ($this->validate([
      'oldPassword' => 'required|min_length[6]|max_length[100]|isValidPassword[username]',
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

  public function remove()
  {
    $id = $this->request->getGet('id');

    $model = new UserModel();
    $model->delete($id);

    $message = 'Data has been removed';
    $this->session->setFlashdata('splash', $message);
    
    return $this->response->setJSON([
      'status' => 200,
      'message' => $message,
    ]);
  }

}