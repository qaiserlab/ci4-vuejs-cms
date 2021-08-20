<?php namespace App\Controllers\Dashboard;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\CategoryModel;

class Category extends Controller
{
  
  public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
  {
    parent::initController($request, $response, $logger);
    $this->session->set('title', 'Category');
  }

  public function index()
	{
    $model = new CategoryModel();
    
    $rs = $model->orderBy('title')->findAll();
    $rs = extracty($rs, ['url']);

    return view('dashboard/category/category-list', [
      'rs' => $rs,
    ]);
  }
  
  public function new()
	{
    return view('dashboard/category/category-form', [
      'title' => 'New',
      'mode' => 'create',
    ]);
  }

  public function edit()
	{
    $id = $this->request->getGet('id');

    $model = new CategoryModel();
    $record = $model->find($id);
    
    return view('dashboard/category/category-form', [
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
    $status = $this->request->getPost('status');

    $model = new CategoryModel();

    if ($model->insert([
      'title' => $title,
      'slug' => $slug,
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
    $status = $this->request->getPost('status');

    $model = new CategoryModel();
    $record = $model->find($id);

    $record->title = $title;
    $record->slug = $slug;
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

    $model = new CategoryModel();
    $model->delete($id);

    $message = 'Data has been removed';
    $this->session->setFlashdata('splash', $message);
    
    return $this->response->setJSON([
      'status' => 200,
      'message' => $message,
    ]);
  }

}