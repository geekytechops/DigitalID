<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');
$routes->get('/register', 'Home::register');
$routes->get('/admin/dashboard', 'Home::dashboard');
$routes->post('/login_validate', 'UserController::loginValidate');
