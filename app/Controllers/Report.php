<?php

namespace App\Controllers;

use App\Models\Model_item;
use App\Models\Model_jual;
use App\Models\Model_order;
use App\Models\Model_pembeli;

use FPDF;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use Dompdf\Dompdf;
use TCPDF;

class Report extends BaseController
{

    public function __construct()
    {
        helper([
            'number',
            'form',
            'url',
            'bulan',
        ]);

        $this->orderModel = new Model_order();
        $this->itemModel = new Model_item();
        $this->pembeliModel = new Model_pembeli();
        $this->itemJualModel = new Model_jual();

        $this->db = \Config\Database::connect();
        $this->builderPembelian = $this->db->table('tbl_pembelian');
        $this->builderPembeli = $this->db->table('tbl_pembeli');
        $this->builderItem = $this->db->table('tbl_item');
        $this->builderJual = $this->db->table('tbl_jual');
    }

    //Halaman data laporan
    public function index()
    {
        echo view('header');
        $this->viewData();
        echo view('footer');
    }

    //Fungsi menampilkan data laporan
    public function viewData()
    {
        $nama_bulan = '';
        if (!$this->request->getPost('datefrom') or !$this->request->getPost('dateto')) {
            $result = $this->orderModel->findAll();
        } else {

            $datefrom = date("Y-m-d", strtotime($this->request->getPost('datefrom')));
            $dateto = date("Y-m-d", strtotime($this->request->getPost('dateto')));

            $result = $this->orderModel->getfilterdata($datefrom, $dateto);
        }

        if (isset($_GET['year'])) {

            $daftarpembeli = $this->pembeliModel->findAll();
            $dataperyear = $this->orderModel->getByYear($_GET);

            foreach ($daftarpembeli as $pembeli) {
                $totalItem = 0;
                $totalHarga = 0;
                $totalTransaksi = 0;
                foreach ($dataperyear as $peryear) {
                    if ($peryear['id_pembeli'] == $pembeli['id_pembeli']) {
                        $totalItem += $peryear['total_item'];;
                        $totalHarga += $peryear['total_harga'];
                        $totalTransaksi++;
                    }
                }
                $dataReport[] = array(
                    'id_pembeli' => $pembeli['id_pembeli'],
                    'nama_pembeli' => $pembeli['nama_pembeli'],
                    'total_transaksi' => $totalTransaksi,
                    'total_item' => $totalItem,
                    'total_harga' => $totalHarga,
                );
            }
        } else {

            foreach ($this->pembeliModel->findAll() as $key => $row) {
                $totalItem = 0;
                $totalHarga = 0;
                $totalTransaksi = 0;
                foreach ($result as $keyorder => $roworder) {
                    if ($row['id_pembeli'] == $roworder['id_pembeli']) {
                        $totalItem += $roworder['total_item'];
                        $totalHarga += $roworder['total_harga'];
                        $totalTransaksi++;
                    }
                }
                $tahun = $this->orderModel->distinctYear();
                foreach ($tahun as $year) {
                    $listTahun[] = $year['YEAR(tanggal_pembelian)'];
                    sort($listTahun);
                }

                $dataReport[] = array(
                    'id_pembeli' => $row['id_pembeli'],
                    'nama_pembeli' => $row['nama_pembeli'],
                    'total_transaksi' => $totalTransaksi,
                    'total_item' => $totalItem,
                    'total_harga' => $totalHarga,
                );
            }
        }
        $data = [
            'title' => 'Daftar Hasil Pembelian',
            'dataReport' => $dataReport,
            'orders' => $this->orderModel->findAll(),
            'datefrom' => '',
            'dateto' => '',
            'bulan' => $nama_bulan,
            'tahun' => $this->orderModel->distinctYear(),
        ];
        echo view('Report/index', $data);
    }

    //Fungsi menampilkan data pertahun
    public function pertahun()
    {
        if (!$this->request->getPost('datefrom') or !$this->request->getPost('dateto')) {
            $result = $this->orderModel->findAll();
        } else {
            $datefrom = date("Y-m-d", strtotime($this->request->getPost('datefrom')));
            $dateto = date("Y-m-d", strtotime($this->request->getPost('dateto')));

            $result = $this->orderModel->getfilterdata($datefrom, $dateto);
        }
        if (isset($_GET['month'])) {
            $selected_month = $_GET['month'];
            $result = $this->orderModel->filterByMonth($selected_month);
        }
        foreach ($this->pembeliModel->findAll() as $key => $row) {
            $totalItem = 0;
            $totalHarga = 0;
            $totalTransaksi = 0;
            foreach ($result as $keyorder => $roworder) {
                if ($row['id_pembeli'] == $roworder['id_pembeli']) {
                    $totalItem += $roworder['total_item'];
                    $totalHarga += $roworder['total_harga'];
                    $totalTransaksi++;
                }
            }

            $dataReport[] = array(
                'id_pembeli' => $row['id_pembeli'],
                'nama_pembeli' => $row['nama_pembeli'],
                'total_transaksi' => $totalTransaksi,
                'total_item' => $totalItem,
                'total_harga' => $totalHarga,
            );
        }

        $data = [
            'title' => 'Daftar Hasil Pembelian',
            'dataReport' => $dataReport,
            'orders' => $this->orderModel->findAll(),
            'datefrom' => '',
            'dateto' => '',
        ];
        echo view('header');
        echo view('Report/pertahun', $data);
        echo view('footer');
    }

    //Fungsi mensortir data berdasarkan tanggal
    public function filterdata()
    {
        $datefrom = date("Y-m-d", strtotime($this->request->getPost('datefrom')));
        $dateto = date("Y-m-d", strtotime($this->request->getPost('dateto')));

        $result = $this->orderModel->getfilterdata($datefrom, $dateto);

        foreach ($this->pembeliModel->findAll() as $key => $row) {
            $totalItem = 0;
            $totalHarga = 0;
            $totalTransaksi = 0;
            foreach ($result as $keyorder => $roworder) {
                if ($row['id_pembeli'] == $roworder['id_pembeli']) {
                    $totalItem += $roworder['total_item'];
                    $totalHarga += $roworder['total_harga'];
                    $totalTransaksi++;
                }
            }
            $this->builderPembelian->countAllResults();

            $dataReport[] = array(
                'id_pembeli' => $row['id_pembeli'],
                'nama_pembeli' => $row['nama_pembeli'],
                'total_transaksi' => $totalTransaksi,
                'total_item' => $totalItem,
                'total_harga' => $totalHarga,
            );
        }

        $data = [
            'title' => 'Daftar Hasil Pembelian',
            'dataReport' => $dataReport,
            'orders' => $this->orderModel->findAll(),
            'datefrom' => $datefrom,
            'dateto' => $dateto,
            'tahun' => $this->orderModel->distinctYear(),
        ];
        echo view('header');
        echo view('Report/index', $data);
        echo view('footer');
    }

    public function deleteAll($id)
    {
        foreach ($this->orderModel->findAll() as $key => $value) {
            if ($value['id_pembeli'] == $id) {
                foreach ($this->itemJualModel->findAll() as $k => $val) {
                    if ($value['id_pembelian'] == $val['id_order']) {
                        $this->builderJual->delete(['id_order' => $value['id_pembelian']]);
                    }
                }
                $this->builderPembelian->delete(['id_pembeli' => $id]);
            }
        }
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to(base_url('report'));
    }
}
