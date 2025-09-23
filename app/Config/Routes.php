<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Rute utama sekarang adalah halaman pemilihan peran
$routes->get('/', 'AuthController::selectRole');

// Rute untuk menampilkan halaman login spesifik
$routes->get('/login/admin', 'AuthController::loginAdmin');
$routes->get('/login/mahasiswa', 'AuthController::loginMahasiswa');

// Rute untuk memproses form login diarahkan ke metode yang benar
$routes->post('/login/admin', 'AuthController::processAdminLogin'); // Diperbarui
$routes->post('/login/mahasiswa', 'AuthController::processMahasiswaLogin'); // Diperbarui

$routes->get('/logout', 'AuthController::logout');

// ... sisa kode rute tetap sama ...
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/dashboard', 'DashboardController::index');

    // Grup khusus untuk Admin
    $routes->group('admin', ['filter' => 'role:Admin'], function ($routes) {
        $routes->get('courses', 'Admin\CourseController::index');
        $routes->post('courses/create', 'Admin\CourseController::create');
        $routes->post('courses/delete/(:num)', 'Admin\CourseController::delete/$1');
        $routes->get('students', 'Admin\StudentController::index');
        $routes->post('students/create', 'Admin\StudentController::create');
        $routes->post('students/delete/(:num)', 'Admin\StudentController::delete/$1');
    });

    // Grup khusus untuk Mahasiswa
    $routes->group('mahasiswa', ['filter' => 'role:Mahasiswa'], function ($routes) {
        $routes->get('courses', 'Mahasiswa\CourseController::index');
        $routes->post('courses/enroll', 'Mahasiswa\CourseController::enroll');
        $routes->get('my-courses', 'Mahasiswa\CourseController::myCourses');
    });
});