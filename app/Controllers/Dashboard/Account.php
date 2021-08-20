<?php namespace App\Controllers\Dashboard;

use App\Models\UserModel;

class Account extends Controller
{
  
  public function login()
	{
    if ($this->request->isAjax()) {
      $username = $this->request->getPost('username');
      $password = $this->request->getPost('password');

      if ($this->validate([
        'username' => 'required|isUsernameRegistered[password]|isActive',
        'password' => 'required|isValidPassword[username]',
      ], [
        'username' => [
          'required' => 'Username field is required',
          'isUsernameRegistered' => "Username '$username' is not registered",
          'isActive' => "Username '$username' has been suspended",
        ],
        'password' => [
          'required' => 'Password field is required',
          'isValidPassword' => "Invalid Password for '$username'",
        ],
      ])) {

        $model = new UserModel();
        $record = $model->where('username', $username)->first();
        
        $this->session->set([
          'loggedIn' => true,
          'id' => $record->id,
          'username' => $record->username,
          'fullname' => $record->fullname,
          'noPhoto' => $record->noPhoto,
          'photoUrl' => $record->photoUrl,
          'group' => $record->group,
        ]);

        return $this->response->setJSON([
          'status' => 200,
          'message' => 'Login success',
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
    else
      return view('dashboard/account/account-login');
  }

  public function logout() {
    $this->session->destroy();
    return redirect()->to(base_url('admin/login'));
  }
  
}
