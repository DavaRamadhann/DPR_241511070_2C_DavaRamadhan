<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table            = 'pengguna';
    protected $primaryKey       = 'id_pengguna';
    protected $allowedFields    = ['username', 'password'];
    protected $useTimestamps    = true; // Jika ada kolom created_at & updated_at
}