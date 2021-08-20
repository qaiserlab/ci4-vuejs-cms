<?php namespace App\Controllers\Dashboard;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\BannerModel;

class Banner extends Controller
{
  
  public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
  {
    parent::initController($request, $response, $logger);
    $this->session->set('title', 'Banner');
  }

  public function index()
	{
    $model = new BannerModel();
    $rs = $model->orderBy('id')->findAll();
    return view('dashboard/banner/banner-list', [
      'rs' => $rs,
    ]);
  }
  
  public function new()
	{
    $record = [
      'title' => '',
      'slug' => '',
      'banners' => [[
        'image' => '',
        'title' => '',
        'content' => '',
        'tabActive' => 1,
        'status' => 'Published',
      ]]
    ];
    
    return view('dashboard/banner/banner-form', [
      'title' => 'New',
      'mode' => 'create',
      'record' => $record,
    ]);
  }

  public function edit()
	{
    $id = $this->request->getGet('id');

    $model = new BannerModel();
    $record = $model->find($id);

    $record = [
      'id' => $record->id,
      'title' => $record->title,
      'slug' => $record->slug,
      'banners' => json_decode($record->banners),
      'status' => $record->status,
    ];
    
    return view('dashboard/banner/banner-form', [
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
    $banners = $this->request->getPost('banners');
    $status = $this->request->getPost('status');

    $model = new BannerModel();

    if ($model->insert([
      'title' => $title,
      'slug' => $slug,
      'banners' => json_encode($banners),
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
    $banners = $this->request->getPost('banners');
    $status = $this->request->getPost('status');

    $model = new BannerModel();
    $record = $model->find($id);

    $record->title = $title;
    $record->slug = $slug;
    $record->banners = json_encode($banners);
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

    $model = new BannerModel();
    $model->delete($id);

    $message = 'Data has been removed';
    $this->session->setFlashdata('splash', $message);
    
    return $this->response->setJSON([
      'status' => 200,
      'message' => $message,
    ]);
  }

}