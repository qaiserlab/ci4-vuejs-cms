<?php namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

use App\Models\PageModel;

class Page extends Controller
{
  
  public function index($slug)
	{
    $model = new PageModel();
    $record = $model->getRecordBySlug($slug);

    if (!$record || $record->status != 'Published') {
      throw PageNotFoundException::forPageNotFound();
      return;
    }

    $this->session->set('title', $record->title);
    
		return view('page', [
      'record' => $record,
    ]);
  }
  
}
