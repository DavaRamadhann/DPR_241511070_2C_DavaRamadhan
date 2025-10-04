<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggajianModel extends Model
{
    /**
     * Nama tabel di database.
     * @var string
     */
    protected $table            = 'penggajian';

    /**
     * Primary key dari tabel.
     * @var string
     */
    protected $primaryKey       = 'id';

    /**
     * Field yang diizinkan untuk diisi.
     * @var array
     */
    protected $allowedFields    = [
        'id_anggota',
        'id_komponen'
    ];

    /**
     * Apakah menggunakan timestamp (created_at, updated_at).
     * @var bool
     */
    protected $useTimestamps = false;
}