<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    /**
     * Nama tabel di database
     * @var string
     */
    protected $table            = 'anggota';

    /**
     * Primary key dari tabel
     * @var string
     */
    protected $primaryKey       = 'id_anggota';

    /**
     * Mengizinkan field mana saja yang dapat diisi
     * @var array
     */
    protected $allowedFields    = [
        'gelar_depan',
        'nama_depan',
        'nama_belakang',
        'gelar_belakang',
        'jabatan',
        'status_pernikahan'
    ];

    /**
     * Menggunakan timestamp (created_at, updated_at) atau tidak
     * @var bool
     */
    protected $useTimestamps = false;
}   