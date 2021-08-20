<?php namespace App\Controllers\Dashboard;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\GroupModel;

class Group extends Controller
{
  
  public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
  {
    parent::initController($request, $response, $logger);
    $this->session->set('title', 'Group & Privileges');
  }

  public function index()
	{
    $model = new GroupModel();
    $rs = $model->orderBy('name')->findAll();
    return view('dashboard/group/group-list', [
      'rs' => $rs,
    ]);
  }
  
  public function new()
	{
    $record = [
      'menu' => settings('menu', true), 
      'settingsMenu' => settings('settingsMenu', true), 
    ];

    return view('dashboard/group/group-form', [
      'title' => 'New',
      'mode' => 'create',
      'record' => $record,
    ]);
  }

  public function edit()
	{
    $id = $this->request->getGet('id');

    $model = new GroupModel();
    $record = $model->find($id);

    $record = [
      'id' => $record->id,
      'name' => $record->name,
      'menu' => json_decode($record->menu),
      'settingsMenu' => json_decode($record->settingsMenu),
      'status' => $record->status,
    ];
    
    return view('dashboard/group/group-form', [
      'title' => 'Edit',
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

    $name = $this->request->getPost('name');
    $menu = $this->request->getPost('menu');
    $settingsMenu = $this->request->getPost('settingsMenu');
    $status = $this->request->getPost('status');

    $model = new GroupModel();

    if ($model->insert([
      'name' => $name,
      'menu' => json_encode($menu),
      'settingsMenu' => json_encode($settingsMenu),
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
    
    $name = $this->request->getPost('name');
    $menu = $this->request->getPost('menu');
    $settingsMenu = $this->request->getPost('settingsMenu');
    $status = $this->request->getPost('status');

    $model = new GroupModel();
    $record = $model->find($id);

    $record->name = $name;
    $record->menu = json_encode($menu);
    $record->settingsMenu = json_encode($settingsMenu);
    $record->status = $status;

    if ($model->save($record)) {
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

  public function remove()
  {
    $id = $this->request->getGet('id');

    $model = new GroupModel();
    $model->delete($id);

    $message = 'Data has been removed';
    $this->session->setFlashdata('splash', $message);
    
    return $this->response->setJSON([
      'status' => 200,
      'message' => $message,
    ]);
  }

}