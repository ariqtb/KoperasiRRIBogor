<?php

namespace App\Models;

use CodeIgniter\Model;

class Model_order extends Model
{
    protected $table = 'tbl_pembelian';
    protected $primarykey = 'id_pembelian';

    protected $allowedField = [
        'id_pembeli',
        'nama_pembeli',
        'total_item',
        'total_harga',
        'tanggal_pembelian',
        'waktu_pembelian',
        'penanggung_jawab',
    ];

    public function listing()
    {
        $builder = $this->db->table('tbl_pembelian');
        $builder->select('tbl_pembelian.*, tbl_pembeli.*, tbl_jualbarang.nama_item, tbl_jualbarang.jumlah_item');
        $builder->join('tbl_jualbarang', 'tbl_jualbarang.id_jualbarang = tbl_pembelian.id_jualbarang', 'LEFT');
        $builder->join('tbl_pembeli', 'tbl_pembeli.id_pembeli = tbl_pembelian.id_pembeli', 'LEFT');
        $builder->orderBy('tbl_pembelian.id_pembelian', 'DESC');
        $query = $builder->get();

        return $query->getResultArray();
    }

    public function getBarang()
    {
        return $this->findAll();
    }

    public function edit($data)
    {
        $builder = $this->db->table('tbl_pembelian');
        $builder->where('id_pembelian', $data['id_pembelian']);
        $builder->update($data);
    }

    public function getById($id)
    {
        $builder = $this->db->table('tbl_pembelian');
        $builder->select('*');
        $builder->where('id_pembelian', $id);
        return $builder->get()->getResultArray();
    }

    public function insert_model($data)
    {
        $db      = \Config\Database::connect();

        $query = $this->db->table('tbl_pembelian')->insert($data);
        $id_order = $this->db->insertID();
        return $query;
    }

    public function get_datatables($year)
    {
        $query = "SELECT * FROM tbl_pembelian WHERE YEAR(tanggal_pembelian) IN $year";
    }

    public function filterMonth()
    {
        $db = db_connect();
        $query = $db->query("SELECT * FROM attendance WHERE month(DATE) = '.$month.' AND year(DATE) = YEAR(now()");
    }

    function get_item_list($sort_by, $sort_order)
    {
        $db = db_connect();
        $sort_order = ($sort_order == 'DESC') ? 'DESC' : 'ASC';

        $sort_columns = array('nama_pembeli', 'total_item', 'tanggal_pembelian');

        $sort_by = (in_array($sort_by, $sort_columns)) ? '`' . $sort_by . '`' : '`id_pembelian`';

        $sql = $db->query("SELECT id_pembelian, nama_pembeli, total_item, total_harga, tanggal_pembelian, waktu_pembelian, penanggung_jawab
                FROM tbl_pembelian ORDER BY $sort_by $sort_order");

        return $sql->getResultArray();
    }

    function getfilterdata($datefrom, $dateto)
    {
        $db = db_connect();
        $builder = $this->db->table('tbl_pembelian');
        $builder->where("tanggal_pembelian BETWEEN '$datefrom' AND '$dateto'");
        $sql = $db->query("SELECT * FROM `tbl_pembelian` WHERE tanggal_pembelian BETWEEN '$datefrom' AND '$dateto'");
        return $builder->get()->getResultArray();
    }

    function filterByYear($year)
    {
        $db = db_connect();
        $builder = $this->db->table('tbl_pembelian');
        $builder->where(" YEAR(tanggal_pembelian) = '$year'");
        return $builder->get()->getResultArray();
    }

    function filterByMonth($month)
    {
        $db = db_connect();
        $builder = $this->db->table('tbl_pembelian');
        $builder->where(" YEAR(tanggal_pembelian) = YEAR(curdate()) AND month(tanggal_pembelian) = '$month'");
        return $builder->get()->getResultArray();
    }

    function distinctYear()
    {
        $builder = $this->db->table('tbl_pembelian');
        $builder->select("DISTINCT YEAR(tanggal_pembelian)");
        $builder->orderBy("tanggal_pembelian");
        return $builder->get()->getResultArray();
    }

    function getByYear($year)
    {
        $builder = $this->db->table('tbl_pembelian');
        $builder->select("*");
        $builder->where('YEAR(tanggal_pembelian)', $year);
        $builder->orderBy("id_pembeli");
        return $builder->get()->getResultArray();
    }

    // SELECT  MONTH(tanggal_pembelian) AS bulan, COUNT(tanggal_pembelian) AS jumlah_pembelian FROM tbl_pembelian
    // WHERE YEAR(tanggal_pembelian) = YEAR(CURDATE()) GROUP BY MONTH(tanggal_pembelian)
    public function itemsPerMonth()
    {
        $builder = $this->db->table('tbl_pembelian');
        $builder->select('MONTH(tanggal_pembelian) AS bulan, SUM(total_item) AS jumlah_pembelian');
        $builder->where("YEAR(tanggal_pembelian) = YEAR(CURDATE())");
        $builder->groupBy("MONTH(tanggal_pembelian)");
        return $builder->get()->getResultArray();
    }

    public function transactionPerMonth()
    {
        $builder = $this->db->table('tbl_pembelian');
        $builder->select('MONTH(tanggal_pembelian) AS bulan, COUNT(id_pembelian) AS jumlah_transaksi');
        $builder->groupBy("MONTH(tanggal_pembelian)");

        return $builder->get()->getResultArray();
    }

    public function incomePerMonth()
    {
        $builder = $this->db->table('tbl_pembelian');
        $builder->select('MONTH(tanggal_pembelian) AS bulan, SUM(total_harga) AS total_harga');
        $builder->groupBy("MONTH(tanggal_pembelian)");

        return $builder->get()->getResultArray();
    }

    public function getBuyer($id_order)
    {
        $builder = $this->db->table('tbl_pembelian');
        $builder->select('nama_pembeli');
        $builder->where('id_pembelian', $id_order);
        return $builder->get()->getResultArray();
    }

    public function countItemSold()
    {
        $builder = $this->db->table('tbl_pembelian');
        $builder->selectSum('total_item');
        return $builder->get()->getResultArray();
    }
}
