<?php namespace App\Controllers\Dashboard;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\PageModel;

class Page extends Controller
{
  
  public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
  {
    parent::initController($request, $response, $logger);
    $this->session->set('title', 'Page');
  }

  public function index()
	{
    $model = new PageModel();
    
    $rs = $model->orderBy('id')->findAll();
    $rs = extracty($rs, ['url']);

    return view('dashboard/page/page-list', [
      'rs' => $rs,
    ]);
  }
  
  public function new()
	{
    return view('dashboard/page/page-form', [
      'title' => 'New',
      'mode' => 'create',
    ]);
  }

  public function edit()
	{
    $id = $this->request->getGet('id');

    $model = new PageModel();
    $record = $model->find($id);
    
    return view('dashboard/page/page-form', [
      'title' => 'Edit',
      'mode' => 'update',
      'record' => $record,
    ]);
  }

  public function create()
  {
    $title = $this->request->getPost('title');
    $slug = $this->request->getPost('slug');
    $image = $this->request->getPost('image');
    $content = $this->request->getPost('content');
    $status = $this->request->getPost('status');

    $model = new PageModel();
    $data = [
      'title' => $title,
      'slug' => $slug,
      'image' => $image,
      'content' => $content,
      'status' => $status,
    ];

    if ($this->request->isAjax()) {
      if ($model->validate($data)) {
        return $this->response->setJSON([
          'status' => 200,
          'message' => 'The data sent is valid',
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
    else {
      $id = $model->insert($data);
      $this->session->setFlashdata('splash', 'Data has been created');

      return redirect()->to(base_url('dashboard/page/edit?id='.$id));
    }
       
  }

  public function update()
  {
    $id = $this->request->getGet('id');
    
    $title = $this->request->getPost('title');
    $slug = $this->request->getPost('slug');
    $image = $this->request->getPost('image');
    $content = urldecode($this->request->getPost('content'));
    $status = $this->request->getPost('status');

    $model = new PageModel();
    $data = [
      'id' => $id,
      'title' => $title,
      'slug' => $slug,
      'image' => $image,
      'content' => $content,
      'status' => $status,
    ];

    if ($this->request->isAjax()) {
      if ($model->validate($data)) {
        return $this->response->setJSON([
          'status' => 200,
          'message' => 'The data sent is valid',
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
    else {
      $model->update($id, $data);
      $this->session->setFlashdata('splash', 'Data has been updated');

      return redirect()->to(base_url('dashboard/page/edit?id='.$id));
    }

  }

  public function remove()
  {
    $id = $this->request->getGet('id');

    $model = new PageModel();
    $model->delete($id);

    $message = 'Data has been removed';
    $this->session->setFlashdata('splash', $message);
    
    return $this->response->setJSON([
      'status' => 200,
      'message' => $message,
    ]);
  }

}