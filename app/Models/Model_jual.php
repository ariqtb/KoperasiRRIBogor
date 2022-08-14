<?php

namespace App\Models;

use CodeIgniter\Model;
use PhpOffice\PhpSpreadsheet\Calculation\MathTrig\Sum;

class Model_jual extends Model
{
    protected $table = 'tbl_jual';
    protected $primarykey = 'id_jual';

    protected $allowedField = [
        'id_item',
        'id_order',
        'nama_item',
        'harga_item',
        'jumlah_item',
        'subtotal_harga',
    ];

    public function getAll()
    {
        return $this->findAll();
    }

    public function insert_model($data)
    {
        $db      = \Config\Database::connect();

        $query = $this->db->table('tbl_jual')->insert($data);
        return $query;
    }

    public function chartjual($id_pembelian)
    {
        $db = db_connect();
        $sql = $db->query("SELECT SUM(jumlah_item) AS jumlah_item $this->table WHERE id_order='" . $id_pembelian . "'");

        return $sql->getResultArray();
    }

    public function countItemSold()
    {
        $builder = $this->db->table('tbl_jual');
        $builder->selectSum('jumlah_item');
        return $builder->get()->getResultArray();
    }

    public function countPerItem()
    {
        $builder = $this->db->table('tbl_jual');
        $builder->select('id_item, nama_item');
        $builder->selectSum('jumlah_item');
        $builder->groupBy('id_item');
        $builder->orderBy('jumlah_item', 'DESC');

        return $builder->get()->getResultArray();
    }

    public function countPerItemByMonth($month)
    {
        $builder = $this->db->table('tbl_jual');
        $builder->select('tbl_jual.id_item, tbl_jual.nama_item');
        $builder->selectSum('tbl_jual.jumlah_item');
        $builder->join('tbl_pembelian', 'tbl_pembelian.id_pembelian = tbl_jual.id_order');
        // $builder->where(" tbl_pembelian.YEAR(tanggal_pembelian) = YEAR(curdate()) AND tbl_pembelian.month(tanggal_pembelian) = '$month'");
        $builder->groupBy('id_item');
        $builder->orderBy('jumlah_item', 'DESC');
        // home?month=07
        return $builder->get()->getResultArray();
    }

    public function countPerItemByMonths($month)
    {
        $builder = $this->db->table('tbl_pembelian');
        $builder->where(" YEAR(tanggal_pembelian) = YEAR(curdate()) AND month(tanggal_pembelian) = '$month'");
        $builder->join('tbl_jual', 'tbl_jual.id_order = tbl_pembelian.id_pembelian');
        $builder->select('tbl_jual.id_item, tbl_jual.nama_item');
        $builder->selectSum('tbl_jual.jumlah_item');
        $builder->groupBy('id_item');
        $builder->orderBy('jumlah_item', 'DESC');
        return $builder->get()->getResultArray();
    }

    public function deleteupdate($id_order)
    {
        $builder = $this->db->table('tbl_jual');
        $builder->delete(['id_order' => $id_order]);
        return $builder->get()->getResultArray();
    }

    public function getByOrder($id_order)
    {
        $builder = $this->db->table('tbl_jual');
        $builder->select('*');
        $builder->where('id_order', $id_order);
        $builder->orderBy('id_jual', 'DESC');
        return $builder->get()->getResultArray();
    }

    public function countItemSoldMember()
    {
        $builder = $this->db->table('tbl_jual');
        $builder->selectSum('jumlah_item');
        $builder->where('id_o');
        return $builder->get()->getResultArray();
    }
}
