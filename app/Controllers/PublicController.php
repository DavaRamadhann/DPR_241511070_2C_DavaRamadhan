<?php namespace App\Controllers;

use App\Models\AnggotaModel;
use App\Models\PenggajianModel;

class PublicController extends BaseController
{
    public function anggota()
    {
        $model = new AnggotaModel();
        $data['anggota'] = $model->findAll();
        return view('public/anggota', $data);
    }

    public function penggajian()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('anggota');
        $builder->select('anggota.*, SUM(komponen_gaji.nominal) as take_home_pay');
        $builder->join('penggajian', 'penggajian.id_anggota = anggota.id_anggota', 'left');
        $builder->join('komponen_gaji', 'komponen_gaji.id_komponen = penggajian.id_komponen', 'left');
        $builder->groupBy('anggota.id_anggota');
        $query = $builder->get();
        $data['penggajian'] = $query->getResultArray();
        
        return view('public/penggajian', $data);
    }
}