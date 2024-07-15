<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::Index');
$routes->get('/home', 'Home::Index');
$routes->get('/shop', 'Shop::Index');
$routes->get('showdetail/(:num)/(:num)', 'Showdetail::index/$1/$2');
$routes->get('/category/(:num)', 'Category::Index/$1');
$routes->get('/about/shipping', 'About::Shipping');
$routes->get('/about/contact', 'About::Contact');

$routes->get('/login', 'Login::Index');
$routes->post('/login/check', 'Login::Check');
$routes->get('/logout', 'Logout::Index');

$routes->get('/user', 'User::Index');
$routes->get('/user/create', 'User::Create');
$routes->post('/user/create/submit', 'User::SubmitCreate');
$routes->get('/user/update/(:num)', 'User::Update/$1');
$routes->post('/user/update/submit', 'User::SubmitUpdate');
$routes->get('/user/delete/(:num)', 'User::Delete/$1');

$routes->get('/product', 'Product::Index');
$routes->get('/product/create', 'Product::Create');
$routes->post('/product/create/submit', 'Product::SubmitCreate');
$routes->get('/product/update/(:num)', 'Product::Update/$1');
$routes->post('/product/update/submit', 'Product::SubmitUpdate');
$routes->get('/product/delete/(:num)', 'Product::Delete/$1');

$routes->resource('api/user');
$routes->get('/api/user', 'Api\User::Index');
$routes->get('/api/user/(:num)', 'Api\User::Show/$1');
$routes->post('/api/user/', 'Api\User::create');
$routes->put('/api/user/', 'Api\User::Modify');
$routes->delete('/api/user/(:num)', 'Api\User::Delete/$1');
