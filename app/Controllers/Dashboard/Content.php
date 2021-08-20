<?php namespace App\Controllers\Dashboard;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\ContentModel;

class Content extends Controller
{
  
  public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
  {
    parent::initController($request, $response, $logger);
    $this->session->set('title', 'Content');
  }

  public function index()
	{
    $model = new ContentModel();
    $rs = $model->orderBy('id')->findAll();
    return view('dashboard/content/content-list', [
      'rs' => $rs,
    ]);
  }
  
  public function new()
	{
    return view('dashboard/content/content-form', [
      'title' => 'New',
      'mode' => 'create',
    ]);
  }

  public function edit()
	{
    $id = $this->request->getGet('id');

    $model = new ContentModel();
    $record = $model->find($id);
    
    return view('dashboard/content/content-form', [
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
    $content = urldecode($this->request->getPost('content'));
    $status = $this->request->getPost('status');

    $model = new ContentModel();

    if ($model->insert([
      'title' => $title,
      'slug' => $slug,
      'content' => $content,
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
    $content = urldecode($this->request->getPost('content'));
    $status = $this->request->getPost('status');

    $model = new ContentModel();
    $record = $model->find($id);

    $record->title = $title;
    $record->slug = $slug;
    $record->content = $content;
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

    $model = new ContentModel();
    $model->delete($id);

    $message = 'Data has been removed';
    $this->session->setFlashdata('splash', $message);
    
    return $this->response->setJSON([
      'status' => 200,
      'message' => $message,
    ]);
  }

}