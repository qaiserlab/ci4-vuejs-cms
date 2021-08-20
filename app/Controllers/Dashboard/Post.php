<?php namespace App\Controllers\Dashboard;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\CategoryModel;
use App\Models\PostModel;

class Post extends Controller
{
  
  public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
  {
    parent::initController($request, $response, $logger);
    $this->session->set('title', 'Post');
  }

  public function index()
	{
    $postedOn = $this->request->getGet('postedOn');
    $postedOn = (isset($postedOn))?$postedOn:date('Y-m-d');
    
    $xPostedOn = explode('-', $postedOn);
      
    $year = $xPostedOn[0];
    $month = $xPostedOn[1];

    $model = new PostModel();
    
    $rs = $model->getRsByYearMonth($year, $month);
    $rs = extracty($rs, ['url', 'postedOnHumanize']);
    
    return view('dashboard/post/post-list', [
      'rs' => $rs,
      'postedOn' => $postedOn,
    ]);
  }
  
  public function new()
	{
    $categoryModel = new CategoryModel();
    $rsCategory = $categoryModel->findAll();

    return view('dashboard/post/post-form', [
      'title' => 'New',
      'mode' => 'create',
      'rsCategory' => $rsCategory,
    ]);
  }

  public function edit()
	{
    $id = $this->request->getGet('id');

    $model = new PostModel();
    $record = $model->find($id);

    $categoryModel = new CategoryModel();
    $rsCategory = $categoryModel->findAll();
    
    return view('dashboard/post/post-form', [
      'title' => 'Edit',
      'mode' => 'update',
      'record' => $record,
      'rsCategory' => $rsCategory,
    ]);
  }

  public function create()
  {
    $title = $this->request->getPost('title');
    $slug = $this->request->getPost('slug');
    $image = $this->request->getPost('image');
    $content = $this->request->getPost('content');
    $categoryId = $this->request->getPost('categoryId');
    $status = $this->request->getPost('status');

    $model = new PostModel();
    $data = [
      'title' => $title,
      'slug' => $slug,
      'image' => $image,
      'content' => $content,
      'categoryId' => $categoryId,
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

      return redirect()->to(base_url('dashboard/post/edit?id='.$id));
    }
       
  }

  public function update()
  {
    $id = $this->request->getGet('id');
    
    $title = $this->request->getPost('title');
    $slug = $this->request->getPost('slug');
    $image = $this->request->getPost('image');
    $content = urldecode($this->request->getPost('content'));
    $categoryId = $this->request->getPost('categoryId');
    $status = $this->request->getPost('status');

    $model = new PostModel();
    $data = [
      'id' => $id,
      'title' => $title,
      'slug' => $slug,
      'image' => $image,
      'content' => $content,
      'categoryId' => $categoryId,
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

      return redirect()->to(base_url('dashboard/post/edit?id='.$id));
    }

  }

  public function remove()
  {
    $id = $this->request->getGet('id');

    $model = new PostModel();
    $model->delete($id);

    $message = 'Data has been removed';
    $this->session->setFlashdata('splash', $message);
    
    return $this->response->setJSON([
      'status' => 200,
      'message' => $message,
    ]);
  }

}