<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// app/Config/Routes.php

$routes->get('/', 'AuthController::login');
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::processLogin');
$routes->get('/logout', 'AuthController::logout');

// Grup untuk semua user yang sudah login [cite: 212]
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/dashboard', 'DashboardController::index');

    // Grup khusus untuk Admin [cite: 215]
        $routes->group('admin', ['filter' => 'role:Admin'], function ($routes) {
        $routes->get('courses', 'Admin\CourseController::index');
        $routes->post('courses/create', 'Admin\CourseController::create');
        $routes->post('courses/delete/(:num)', 'Admin\CourseController::delete/$1');
        // Tambahkan rute untuk manage student jika diperlukan
        $routes->get('students', 'Admin\StudentController::index');
        $routes->post('students/create', 'Admin\StudentController::create');
        $routes->post('students/delete/(:num)', 'Admin\StudentController::delete/$1');
    });

    // Grup khusus untuk Mahasiswa
        $routes->group('mahasiswa', ['filter' => 'role:Mahasiswa'], function ($routes) {
        $routes->get('courses', 'Mahasiswa\CourseController::index');
        $routes->get('courses/enroll/(:num)', 'Mahasiswa\CourseController::enroll/$1');
        // Tambahkan rute untuk melihat mata kuliah yang sudah diambil
        $routes->get('my-courses', 'Mahasiswa\CourseController::myCourses');
    });
});