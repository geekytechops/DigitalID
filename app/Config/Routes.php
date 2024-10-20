<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');
$routes->get('/register', 'Home::register');
$routes->get('/admin/dashboard', 'Home::dashboard');
$routes->get('/admin/users', 'Home::users');
$routes->post('/login_validate', 'UserController::loginValidate');
$routes->post('/addUser', 'UserController::addUser');
$routes->get('/fetchUsers', 'UserController::fetchUsers');
