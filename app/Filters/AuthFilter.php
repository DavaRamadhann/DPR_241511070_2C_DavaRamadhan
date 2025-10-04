<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();

        // 1. Cek apakah session 'logged_in' ada dan bernilai true
        if (! $session->get('logged_in')) {
            // 2. Jika tidak ada, tendang kembali ke halaman login
            return redirect()->to('/login/admin')->with('msg', 'Anda harus login terlebih dahulu.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu melakukan apa-apa di sini
    }
}