<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/', 'Products::index');
$routes->get('/products', 'Products::index');
$routes->match(['get','post'], '/products/create', 'Products::create');
$routes->match(['get','post'], '/products/edit/(:num)', 'Products::edit/$1');
$routes->get('/products/delete/(:num)', 'Products::delete/$1');