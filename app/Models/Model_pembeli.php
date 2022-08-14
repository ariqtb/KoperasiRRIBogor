<?php

namespace App\Models;
use CodeIgniter\Model;

class Model_pembeli extends Model
{
    protected $table = 'tbl_pembeli';
    protected $primarykey = 'id_pembeli';

    protected $allowedField = [
        'id_pembeli',
        'nama_pembeli',
        'nomor_anggota',
    ];

    public function getBarang()
    {
        return $this->findAll();
    }

    public function getIdByOrder($id)
    {
        $builder = $this->db->table('tbl_pembeli');
        $builder->select('tbl_pembeli.*');
        $builder->join('tbl_pembelian', 'tbl_pembeli.id_pembeli = tbl_pembelian.id_pembeli');
        $builder->where('tbl_pembelian.id_pembelian', $id);
        $builder->groupBy('id_pembeli');
        return $builder->get()->getResultArray();
    }

    public function getById($id)
    {
        $builder = $this->db->table('tbl_pembeli');
        $builder->select('*');
        $builder->where('id_pembeli', $id);
        return $builder->get()->getResultArray();
    }
}
