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
$routes->post('/fileUpload', 'UserController::fileUpload');
$routes->post('/updateProfile', 'UserController::updateProfile');
$routes->get('/logout', 'UserController::logout');


$routes->group('myAccount', ['filter' => 'auth'], function($routes) {
    $routes->get('dashboard', 'Home::dashboard');
    $routes->get('users', 'Home::users');
    $routes->get('profile', 'UserController::profile');
});