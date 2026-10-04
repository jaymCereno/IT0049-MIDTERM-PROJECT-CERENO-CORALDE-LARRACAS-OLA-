<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');

$routes->get('/products', 'Products::index');

$routes->match(['get','post'], '/products/create', 'Products::create');

$routes->match(['get','post'], '/products/edit/(:num)', 'Products::edit/$1');

$routes->get('/products/delete/(:num)', 'Products::delete/$1');

$routes->get('/customers', 'Customers::index');

$routes->match(['get','post'], '/customers/create', 'Customers::create');

$routes->match(['get','post'], '/customers/edit/(:num)', 'Customers::edit/$1');

$routes->get('/customers/delete/(:num)', 'Customers::delete/$1');

$routes->get('/users', 'Users::index');

$routes->match(['get','post'], '/users/create', 'Users::create');

$routes->match(['get','post'], '/users/edit/(:num)', 'Users::edit/$1');

$routes->get('/users/delete/(:num)', 'Users::delete/$1');

// Phase 6 - Sales Module
$routes->get('/sales/create', 'Sales::create');

$routes->post('/sales/create', 'Sales::create');

$routes->get('/sales', 'Sales::index');