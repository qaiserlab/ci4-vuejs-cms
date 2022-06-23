<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/ci4', 'Ci4::index');

$routes->post('/webhook', 'WebHook::index');
$routes->get('/webhook', 'WebHook::getData');
$routes->delete('/webhook', 'WebHook::deleteAll');

$routes->get('/contact-us', 'ContactUs::index');
$routes->post('/contact-us/send-message', 'ContactUs::sendMessage');
$routes->post('/subscribe/send-email', 'Subscribe::sendEmail');
$routes->get('/page/(:any)', 'Page::index/$1');

$routes->get('/(:num)/(:num)/(:any)', 'Post::detail/$1/$2/$3');
$routes->get('/category/(:any)', 'Post::category/$1');

$routes->get('/images/(:any)', 'Dashboard\Archive::render/$1');

$routes->get('admin/login', 'Dashboard\Account::login');
$routes->post('admin/login', 'Dashboard\Account::login');
$routes->get('admin/logout', 'Dashboard\Account::logout');

// Admin/Dashboard

$routes->get('admin/login', 'Dashboard\Account::login');
$routes->post('admin/login', 'Dashboard\Account::login');
$routes->get('admin/logout', 'Dashboard\Account::logout');

$routes->group('dashboard', function ($routes) {
  $routes->get('/', 'Dashboard\Home::index');
  $routes->get('home', 'Dashboard\Home::home');

  $routes->group('archive', function ($routes) {
		$routes->get('read', 'Dashboard\Archive::read');
		$routes->post('upload', 'Dashboard\Archive::upload');
  });

	$routes->group('settings', function ($routes) {
		$routes->get('/', 'Dashboard\Settings::index');
    $routes->post('update', 'Dashboard\Settings::update');
  });
	
	$routes->group('my-account', function ($routes) {
		$routes->get('/', 'Dashboard\MyAccount::index');
		$routes->get('edit', 'Dashboard\MyAccount::edit');
		$routes->post('update', 'Dashboard\MyAccount::update');
		$routes->get('change-password', 'Dashboard\MyAccount::changePassword');
		$routes->post('update-password', 'Dashboard\MyAccount::updatePassword');
	});

	$routes->group('user', function ($routes) {
    $routes->get('/', 'Dashboard\User::index');
		$routes->get('new', 'Dashboard\User::new');
    $routes->get('edit', 'Dashboard\User::edit');
    $routes->get('change-password', 'Dashboard\User::changePassword');
    $routes->post('create', 'Dashboard\User::create');
    $routes->post('update', 'Dashboard\User::update');
    $routes->post('update-password', 'Dashboard\User::updatePassword');
    $routes->get('remove', 'Dashboard\User::remove');
	});

  $routes->group('group', function ($routes) {
    $routes->get('/', 'Dashboard\Group::index');
		$routes->get('new', 'Dashboard\Group::new');
    $routes->get('edit', 'Dashboard\Group::edit');
    $routes->post('create', 'Dashboard\Group::create');
    $routes->post('update', 'Dashboard\Group::update');
    $routes->get('remove', 'Dashboard\Group::remove');
	});

  $routes->group('content', function ($routes) {
    $routes->get('/', 'Dashboard\Content::index');
		$routes->get('new', 'Dashboard\Content::new');
    $routes->get('edit', 'Dashboard\Content::edit');
    $routes->post('create', 'Dashboard\Content::create');
    $routes->post('update', 'Dashboard\Content::update');
    $routes->get('remove', 'Dashboard\Content::remove');

    $routes->get('menu', 'Dashboard\Menu::index');
    $routes->get('menu/new', 'Dashboard\Menu::new');
    $routes->get('menu/edit', 'Dashboard\Menu::edit');
    $routes->post('menu/create', 'Dashboard\Menu::create');
    $routes->post('menu/update', 'Dashboard\Menu::update');
    $routes->get('menu/remove', 'Dashboard\Menu::remove');
    
    $routes->get('banner', 'Dashboard\Banner::index');
    $routes->get('banner/new', 'Dashboard\Banner::new');
    $routes->get('banner/edit', 'Dashboard\Banner::edit');
    $routes->post('banner/create', 'Dashboard\Banner::create');
    $routes->post('banner/update', 'Dashboard\Banner::update');
    $routes->get('banner/remove', 'Dashboard\Banner::remove');
  });
  
  $routes->group('post', function ($routes) {
    $routes->get('/', 'Dashboard\Post::index');
		$routes->get('new', 'Dashboard\Post::new');
    $routes->get('edit', 'Dashboard\Post::edit');
    $routes->post('create', 'Dashboard\Post::create');
    $routes->post('update', 'Dashboard\Post::update');
    $routes->get('remove', 'Dashboard\Post::remove');
    
    $routes->get('category', 'Dashboard\Category::index');
    $routes->get('category/new', 'Dashboard\Category::new');
    $routes->get('category/edit', 'Dashboard\Category::edit');
    $routes->post('category/create', 'Dashboard\Category::create');
    $routes->post('category/update', 'Dashboard\Category::update');
    $routes->get('category/remove', 'Dashboard\Category::remove');
  });
  
  $routes->group('page', function ($routes) {
    $routes->get('/', 'Dashboard\Page::index');
		$routes->get('new', 'Dashboard\Page::new');
    $routes->get('edit', 'Dashboard\Page::edit');
    $routes->post('create', 'Dashboard\Page::create');
    $routes->post('update', 'Dashboard\Page::update');
    $routes->get('remove', 'Dashboard\Page::remove');
  });

});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
