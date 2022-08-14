<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_item extends Model
{
    protected $table = 'tbl_item';
    protected $primarykey = 'id_item';

    protected $allowedField = [
        'nama_item',
        'harga_item',
        'foto_item',
        'kode_item',
        'tanggal_tambah',
    ];

    public function getAll()
    {
        $builder = $this->db->table('tbl_item');
        $builder->select('*');
        $builder->orderBy('id_item', 'DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getByID($id)
    {
        $builder = $this->db->table('tbl_item');
        $builder->select('*');
        $builder->where('id_item', $id);
        return $builder->get()->getResultArray();
    }

    public function insert_model($data)
    {
        $db      = \Config\Database::connect();

        $query = $this->db->table('tbl_item')->insert($data);
        return $query;
    }

    public function updateItem($data)
    {
        $db      = \Config\Database::connect();

        $query = $this->db->table('tbl_item')->replace($data);
        return $query;
    }
}
