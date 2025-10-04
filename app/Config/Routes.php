<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'AuthController::chooseLogin');
$routes->get('logout', 'AuthController::logout');

// Rute untuk MENAMPILKAN halaman login
$routes->get('login/admin', 'AuthController::showAdminLogin');

// Rute untuk MEMPROSES form login
$routes->post('login/admin', 'AuthController::processAdminLogin');

// Rute Admin (dijaga oleh filter 'auth')
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    
    // Rute untuk Anggota
    $routes->get('anggota', 'AdminController::anggota');
    
    // TAMBAHKAN BARIS INI: Untuk menampilkan form tambah anggota
    $routes->get('anggota/create', 'AdminController::createAnggota');
    
    // Rute ini untuk memproses data dari form tambah anggota
    $routes->post('anggota/store', 'AdminController::storeAnggota'); 

    $routes->get('anggota/edit/(:num)', 'AdminController::editAnggota/$1');
    $routes->post('anggota/update/(:num)', 'AdminController::updateAnggota/$1'); 
    $routes->post('anggota/delete/(:num)', 'AdminController::deleteAnggota/$1'); 
});

// Rute Publik
$routes->group('public', function ($routes) {
    $routes->get('/', 'PublicController::dashboard');
    $routes->get('anggota', 'PublicController::anggota');
    $routes->get('penggajian', 'PublicController::penggajian');
});
