<?php

namespace App\Controllers;

use App\Models\AnggotaModel;

class PublicController extends BaseController
{
    /**
     * Menampilkan halaman dashboard untuk publik.
     */
    public function dashboard()
    {
        $db = \Config\Database::connect();
        
        // Menghitung jumlah total anggota DPR
        $data['jumlah_anggota'] = $db->table('anggota')->countAllResults();

        // Menghitung rata-rata Take Home Pay
        $builder = $db->table('anggota');
        $builder->select('
            (
                SELECT SUM(komponen_gaji.nominal) 
                FROM penggajian 
                JOIN komponen_gaji ON penggajian.id_komponen = komponen_gaji.id_komponen
                WHERE penggajian.id_anggota = anggota.id_anggota
            ) as total_gaji
        ');
        $query = $builder->get()->getResultArray();
        
        $total_penghasilan_semua_anggota = array_sum(array_column($query, 'total_gaji'));
        $data['rata_rata_gaji'] = ($data['jumlah_anggota'] > 0) ? $total_penghasilan_semua_anggota / $data['jumlah_anggota'] : 0;

        return view('public/dashboard', $data);
    }

    /**
     * Menampilkan daftar anggota DPR (read-only).
     */
    public function anggota()
    {
        $model = new AnggotaModel();
        $data['anggota'] = $model->findAll();

        return view('public/anggota', $data);
    }

    /**
     * Menampilkan daftar penggajian semua anggota (read-only).
     */
    public function penggajian()
    {
        $db = \Config\Database::connect();
        
        // Query ini sama dengan yang ada di AdminController untuk menghitung Take Home Pay
        $builder = $db->table('anggota');
        $builder->select('
            anggota.id_anggota, 
            anggota.gelar_depan, 
            anggota.nama_depan, 
            anggota.nama_belakang, 
            anggota.gelar_belakang, 
            anggota.jabatan,
            (
                SELECT SUM(komponen_gaji.nominal) 
                FROM penggajian 
                JOIN komponen_gaji ON penggajian.id_komponen = komponen_gaji.id_komponen
                WHERE penggajian.id_anggota = anggota.id_anggota
            ) as total_gaji
        ');
        $builder->groupBy('anggota.id_anggota');
        
        $data['penggajian'] = $builder->get()->getResultArray();

        return view('public/penggajian', $data);
    }
    
    /**
     * Menampilkan rincian detail penggajian untuk satu anggota (read-only).
     */
    public function detailPenggajian($id_anggota)
    {
        $anggotaModel = new AnggotaModel();
        $data['anggota'] = $anggotaModel->find($id_anggota);

        if (!$data['anggota']) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data anggota tidak ditemukan.');
        }
    
        $db = \Config\Database::connect();

        $builder = $db->table('penggajian p');
        $builder->select('kg.nama_komponen, kg.kategori, kg.nominal');
        $builder->join('komponen_gaji kg', 'p.id_komponen = kg.id_komponen');
        $builder->where('p.id_anggota', $id_anggota);
        $komponen_diterima = $builder->get()->getResultArray();
        $data['komponen_diterima'] = $komponen_diterima;
    
        $tunjangan_pasangan = 0;
        if($data['anggota']['status_pernikahan'] == 'Kawin'){
            $query = $db->table('komponen_gaji')->where('nama_komponen', 'Tunjangan Istri/Suami')->get()->getRow();
            if ($query) $tunjangan_pasangan = $query->nominal;
        }
    
        $query = $db->table('komponen_gaji')->where('nama_komponen', 'Tunjangan Anak')->get()->getRow();
    
        $data['tunjangan_pasangan'] = ['nama' => 'Tunjangan Istri/Suami', 'nominal' => $tunjangan_pasangan];

        $total_pokok_jabatan = array_sum(array_column($komponen_diterima, 'nominal'));
        $data['take_home_pay'] = $total_pokok_jabatan + $tunjangan_pasangan;

        return view('public/detail_penggajian', $data);
    }
}