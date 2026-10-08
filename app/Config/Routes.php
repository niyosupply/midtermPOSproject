<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes = Services::routes();

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Authentication Routes
 * --------------------------------------------------------------------
 */

$routes->get('/login', 'Auth::login');
$routes->post('/login/authenticate', 'Auth::authenticate');
$routes->get('/logout', 'Auth::logout');

/*
 * --------------------------------------------------------------------
 * Dashboard
 * --------------------------------------------------------------------
 */

$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);

/*
 * --------------------------------------------------------------------
 * Products
 * --------------------------------------------------------------------
 */

$routes->get('/products', 'Products::index', ['filter' => 'auth']);
$routes->get('/products/create', 'Products::create', ['filter' => 'auth']);
$routes->post('/products/store', 'Products::store', ['filter' => 'auth']);
$routes->get('/products/edit/(:num)', 'Products::edit/$1', ['filter' => 'auth']);
$routes->post('/products/update/(:num)', 'Products::update/$1', ['filter' => 'auth']);
$routes->post('/products/delete/(:num)', 'Products::delete/$1', ['filter' => 'auth']);

/*
 * --------------------------------------------------------------------
 * Customers
 * --------------------------------------------------------------------
 */

// Customers
$routes->get('/customers', 'Customers::index', ['filter' => 'auth']);
$routes->get('/customers/create', 'Customers::create', ['filter' => 'auth']);
$routes->post('/customers/store', 'Customers::store', ['filter' => 'auth']);
$routes->get('/customers/edit/(:num)', 'Customers::edit/$1', ['filter' => 'auth']);
$routes->post('/customers/update/(:num)', 'Customers::update/$1', ['filter' => 'auth']);
$routes->post('/customers/delete/(:num)', 'Customers::delete/$1', ['filter' => 'auth']);

/*
 * --------------------------------------------------------------------
 * Staff
 * --------------------------------------------------------------------
 */
// Staff
$routes->get('/staff', 'Staff::index', ['filter' => 'auth']);
$routes->get('/staff/create', 'Staff::create', ['filter' => 'auth']);
$routes->post('/staff/store', 'Staff::store', ['filter' => 'auth']);
$routes->get('/staff/edit/(:num)', 'Staff::edit/$1', ['filter' => 'auth']);
$routes->post('/staff/update/(:num)', 'Staff::update/$1', ['filter' => 'auth']);
$routes->post('/staff/delete/(:num)', 'Staff::delete/$1', ['filter' => 'auth']);

$routes->get('/sales/create', 'Sales::create', ['filter' => 'auth']);
$routes->post('/sales/store', 'Sales::store', ['filter' => 'auth']);
$routes->get('/sales/history', 'Sales::history', ['filter' => 'auth']);


