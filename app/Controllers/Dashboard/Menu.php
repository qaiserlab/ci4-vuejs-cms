<?php namespace App\Controllers\Dashboard;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\MenuModel;

class Menu extends Controller
{
  
  public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
  {
    parent::initController($request, $response, $logger);
    $this->session->set('title', 'Menu');
  }

  public function index()
	{
    $model = new MenuModel();
    $rs = $model->orderBy('id')->findAll();
    return view('dashboard/menu/menu-list', [
      'rs' => $rs,
    ]);
  }
  
  public function new()
	{
    return view('dashboard/menu/menu-form', [
      'title' => 'New',
      'mode' => 'create',
    ]);
  }

  public function edit()
	{
    $id = $this->request->getGet('id');

    $model = new MenuModel();
    $record = $model->find($id);

    $record = [
      'id' => $record->id,
      'title' => $record->title,
      'slug' => $record->slug,
      'menu' => json_decode($record->menu),
      'status' => $record->status,
    ];
    
    return view('dashboard/menu/menu-form', [
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

    $title = $this->request->getPost('title');
    $slug = $this->request->getPost('slug');
    $menu = $this->request->getPost('menu');
    $status = $this->request->getPost('status');

    $model = new MenuModel();

    if ($model->insert([
      'title' => $title,
      'slug' => $slug,
      'menu' => json_encode($menu),
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
    
    $title = $this->request->getPost('title');
    $slug = $this->request->getPost('slug');
    $menu = $this->request->getPost('menu');
    $status = $this->request->getPost('status');

    $model = new MenuModel();
    $record = $model->find($id);

    $record->title = $title;
    $record->slug = $slug;
    $record->menu = json_encode($menu);
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

    $model = new MenuModel();
    $model->delete($id);

    $message = 'Data has been removed';
    $this->session->setFlashdata('splash', $message);
    
    return $this->response->setJSON([
      'status' => 200,
      'message' => $message,
    ]);
  }

}