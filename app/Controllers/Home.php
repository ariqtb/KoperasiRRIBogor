<?php

namespace App\Controllers;

use App\Models\Model_item;
use App\Models\Model_jual;
use App\Models\Model_order;
use App\Models\Model_pembeli;
use App\Models\Model_admin;

class Home extends BaseController
{
    private $findAll;

    public function __construct()
    {
        helper('bulan_helper');
        helper('uri');

        $this->db = \Config\Database::connect();
        $this->m_order = new Model_order();
        $this->m_item = new Model_item();
        $this->m_pembeli = new Model_pembeli();
        $this->m_jual = new Model_jual();
        $this->m_admin = new Model_admin();

        $this->builderOrder = $this->db->table('tbl_pembelian');
        $this->builderItem = $this->db->table('tbl_item');
    }

    public function index()
    {
        $db = db_connect();
        $itemjualsql = $db->query("SELECT id_order, nama_item, jumlah_item FROM tbl_jual
                                   ORDER BY id_jual DESC  LIMIT 7 ");
        $itemjualresult = $itemjualsql->getResultArray();
        foreach ($itemjualresult as $key => $val) {
            $arr_jual[] = $val;
        }
        $data = [
            'title' => 'Beranda',
            'admin' => $this->m_admin->findAll(),
            'logged_in' => session()->get(),
            'itemPerMonth' => $this->m_order->itemsPerMonth(),
            'totalperitem' => $this->m_jual->countPerItem(),
            'tot_item' => $this->m_item->get()->getNumRows(),
            'tot_pembeli' => $this->m_pembeli->get()->getNumRows(),
            'tot_pembelian' => $this->m_order->get()->getNumRows(),
            'tot_sold' => $this->m_order->countItemSold(),
            'tot_jual' => $this->m_jual->countItemSold(),
            'itemjual' => $this->m_jual->findAll(),
            'item' => $this->m_item->findAll(),
            'tabel_jual' => $arr_jual,
            'transaksiperbulan' => $this->m_order->transactionPerMonth(),
            'pemasukanperbulan' => $this->m_order->incomePerMonth(),
            'pembelian' => $this->m_order->findAll(),
        ];
        if (isset($_GET['month'])) {
            if (bulanan($_GET['month']) == date("Y")) {
                unset($_GET['month']);
                return redirect()->to(base_url('Home'));
            } else {
                $data['totalperitem'] = $this->m_jual->countPerItemByMonths($_GET['month']);
            }
        }
        echo view('header');
        echo view('beranda', $data);
        echo view('footer');
    }

    public function tabel_item_ajax()
    {
        if ($this->request->isAJAX()) {
            $postData = $_POST['month'];
            return print_r($postData);
        }
    }
}
