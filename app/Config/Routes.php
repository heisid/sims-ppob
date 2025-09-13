<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/dashboard', 'Home::dashboard', ['filter' => 'auth']);

$routes->group('auth', function($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::doLogin');
    $routes->get('register', 'Auth::register');
    $routes->post('register', 'Auth::doRegister');
    $routes->get('logout', 'Auth::logout');
});

$routes->group('profile', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Profile::index');
    $routes->post('/', 'Profile::update');
    $routes->post('image', 'Profile::updateImage');
});

$routes->group('transaction', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Transaction::index');
    $routes->get('(:num)', 'Transaction::getTransactionsWithOffset/$1');
    $routes->get('pay/(:any)', 'Transaction::pay/$1');
    $routes->post('pay', 'Transaction::doPay');
    $routes->get('topup', 'Transaction::topup');
    $routes->post('topup', 'Transaction::doTopup');
    $routes->get('/fetch-balance', 'Transaction::fetchBalance');
});