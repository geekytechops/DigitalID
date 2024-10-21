<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');
$routes->get('/register', 'Home::register');
$routes->post('/login_validate', 'UserController::loginValidate');
$routes->post('/addUser', 'UserController::addUser');
$routes->get('/fetchUsers', 'UserController::fetchUsers');


$routes->group('myAccount', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Home::dashboard');
    $routes->get('users', 'Home::users');
    $routes->get('profile', 'Home::profile');
});