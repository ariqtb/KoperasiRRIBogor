<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_admin extends Model
{
    protected $table = 'tbl_admin';
    protected $primarykey = 'id_admin';

    protected $allowedField = [
        'nama',
        'password',
        'email',
        'foto',
    ];

    public function getDataByID($id)
    {
        $builder = $this->db->table('tbl_admin');
        $builder->where('id_admin', $id);
        $builder->orderBy('tbl_admin.id_admin', 'DESC');
        $query = $builder->get();

        return $query->getRowArray();
    }

    public function insert_model($data)
    {
        $db      = \Config\Database::connect();

        $query = $this->db->table('tbl_admin')->insert($data);
        return $query;
    }
    public function updateItem($data)
    {
        $db      = \Config\Database::connect();

        $query = $this->db->table('tbl_admin')->replace($data);
        return $query;
    }

    public function getDataByEmail($email)
    {
        $builder = $this->db->table('tbl_admin');
        $builder->select('*');
        $builder->where('email', $email);

        return $builder->get()->getRowArray();
    }

    public function getAllExceptOne($id)
    {
        $builder = $this->db->table('tbl_admin');
        $builder->select('email');
        $builder->where('id_admin <>' . $id);
        return $builder->get()->getResultArray();
    }
}
