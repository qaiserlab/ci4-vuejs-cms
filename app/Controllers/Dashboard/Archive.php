<?php namespace App\Controllers\Dashboard;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\PhotoModel;

class Archive extends Controller
{
  
  public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
  {
    parent::initController($request, $response, $logger);
    $this->session->set('title', 'Content');
  }

  public function read()
  {
    $model = new PhotoModel();
    $rs = $model->orderBy('id', 'desc')->findAll();

    return $this->response->setJSON([
      'status' => 200,
      'data' => $rs,
    ]);
  }

  public function remove()
  {
    $id = $this->request->getGet('id');

    $model = new PhotoModel();
    $record = $model->find($id);
    $model->delete($id);

    // remove file here
    unlink('writable/uploads/'.$record->file);

    return $this->response->setJSON([
      'status' => 200,
      'message' => 'Photo has been removed',
    ]);
  }

  public function upload()
  {
    $albumId = $this->request->getGet('storeId');
    $file = $this->request->getFile('file');

    if (!$file->isValid()) {
      throw new RuntimeException($file->getErrorString().'('.$file->getError().')');
      return;
    }

    $newName = $file->getRandomName();
    $file->move(WRITEPATH.'uploads', $newName);

    $model = new PhotoModel();
    $model->insert([
      'title' => $newName,
      'slug' => $newName,
      'file' => $newName,
      'albumId' => $albumId,
      'status' => 'Published',
    ]);

    return $this->response->setJSON([
      'status' => 200,
      'destination' => base_url('images/'.$file->getName()),
      'filename' => $file->getName(),
    ]);
  }

  public function render($filename)
  {
    $image = WRITEPATH.'uploads/'.$filename;

    $filename = basename($image);
    $fileExtension = strtolower(substr(strrchr($filename,"."),1));

    switch ($fileExtension) {
      case "gif": $ctype="image/gif"; break;
      case "png": $ctype="image/png"; break;
      case "jpeg":
      case "jpg": $ctype="image/jpeg"; break;
      default:
    }

    header('Content-type: '.$ctype);
    $image = file_get_contents($image);
    echo $image;
  }

}