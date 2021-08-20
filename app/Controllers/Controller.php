<?php namespace App\Controllers;

class Controller extends \CodeIgniter\Controller
{
  /**
   * An array of helpers to be loaded automatically upon
   * class instantiation. These helpers will be available
   * to all other controllers that extend Controller.
   *
   * @var array
   */
  protected $helpers = [];

  public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
  {
    // Do Not Edit This Line
    parent::initController($request, $response, $logger);

    //--------------------------------------------------------------------
    // Preload any models, libraries, etc, here.
    //--------------------------------------------------------------------
    
    helper('main');
    
    $config = config('App');
    $settingsModel = new \App\Models\SettingsModel();

    $this->session = \Config\Services::session();
    $this->session->set([
      // 'title' => $config->name,
      'title' => 'QaiserLab',
      'settings' => $settingsModel->findAll(),
    ]);
  }

}
