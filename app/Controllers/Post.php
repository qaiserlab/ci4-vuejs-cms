<?php namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

use App\Models\CategoryModel;
use App\Models\PostModel;

class Post extends Controller
{
  
  public function category($slug)
	{
    $categoryModel = new CategoryModel();
    $category = $categoryModel->getRecordBySlug($slug);

    if (!$category || $category->status != 'Published') {
      throw PageNotFoundException::forPageNotFound();
      return;
    }

    $model = new PostModel();
    $rs = $model->getRsByCategorySlug($slug)->paginate(5, 'main');
    
    $this->session->set('title', $category->title);
    
		return view('category', [
      'pager' => $model->pager,
      'category' => $category,
      'rs' => $rs,
    ]);
  }

  public function detail($year, $month, $slug)
	{
    $model = new PostModel();
    $record = $model->getRecordByYearMonthSlug($year, $month, $slug);

    if (!$record || $record->status != 'Published') {
      throw PageNotFoundException::forPageNotFound();
      return;
    }

    $this->session->set('title', $record->title);
    
		return view('post', [
      'record' => $record,
    ]);
  }

}