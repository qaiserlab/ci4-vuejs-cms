<?php namespace App\Controllers\Dashboard;

class Home extends Controller
{
  
  public function index()
	{
    if ($this->session->has('loggedIn'))
      return view('dashboard/home');
    else
      return redirect()->to(base_url('admin/login'));
  }

  public function home()
  {
    return redirect()->to(base_url('dashboard'));
  }
  
}
