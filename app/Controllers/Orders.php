<?php

namespace App\Controllers;

use App\Models\Model_item;
use App\Models\Model_jual;
use App\Models\Model_order;
use App\Models\Model_pembeli;

class Orders extends BaseController
{
    public $findAll;

    public $orderModel;
    public $itemModel;
    public $pembeliModel;

    public $data;

    public function __construct()
    {
        helper('number');
        helper('form');

        $this->orderModel = new Model_order();
        $this->itemModel = new Model_item();
        $this->pembeliModel = new Model_pembeli();
        $this->itemJualModel = new Model_jual();

        $this->db = \Config\Database::connect();
        $this->builderPembelian = $this->db->table('tbl_pembelian');
        $this->builderPembeli = $this->db->table('tbl_pembeli');
        $this->builderItem = $this->db->table('tbl_item');
        $this->builderJual = $this->db->table('tbl_jual');

        $this->session = \Config\Services::session();
    }

    //Halaman Data Pembelian
    public function index()
    {
        $data = [
            'title' => 'Daftar Pembelian',
            'orders' => $this->orderModel->get_item_list('id_pembelian', 'DESC'),
            'sort_by' => 'id_pembelian',
            'sort_order' => 'DESC',
            'item' =>  $this->itemModel->getAll(),
        ];
        echo view('header');
        echo view('Orders/orderView', $data);
        echo view('footer');
    }

    //Halaman menambah data pembelian
    public function input()
    {
        $cart = \Config\Services::cart();
        // $cart->destroy();
        $data = [
            'title' => 'Input Pembelian',
            'item' => $this->itemModel->getAll(),
            'pembeli' => $this->pembeliModel->getBarang(),
            'cart' => \Config\Services::cart(),
        ];
        echo view('header');
        echo view('orders/input', $data);
        echo view('footer');
    }

    //Halaman detail data pembelian
    public function viewDetail($id_pembelian)
    {
        $data = [
            'title' => 'Detail Pembelian',
            'orders' => $this->orderModel->findAll(),
            'itemJual' => $this->itemJualModel->getAll(),
            'id' => $id_pembelian,
        ];

        echo view('header');
        echo view('Orders/viewDetail', $data);
        echo view('footer');
    }

    //Fungsi menambah data pembelian
    public function add($id)
    {
        $cart = \Config\Services::cart();
        $m_item = new Model_item();

        $item = $m_item->getByID($id);

        if ($item) {
            $cart->insert(array(
                'id_item'      => $item[0]['id_item'],
                'jumlah_item'     => 1,
                'harga_item'   =>  $item[0]['harga_item'],
                'nama_item'    =>  $item[0]['nama_item'],
            ));
        }
        session()->setFlashdata('pesan', 'Barang berhasil ditambahkan !');
        return redirect()->back()->withInput();
    }

    //Fungsi membersihkan keranjang pembelian
    public function clear()
    {
        $cart = \Config\Services::cart();
        $cart->destroy();
        return redirect()->to(base_url('/Orders/input'));
    }

    public function clearPerItem($index)
    {
        $cart = \Config\Services::cart();
        $cart->remove($index);
        return redirect()->back()->withInput();
    }

    //Fungsi menghapus data pembelian
    public function deleteOrder($id_pembelian)
    {
        $this->builderPembelian->delete(['id_pembelian' => $id_pembelian]);
        $this->builderJual->delete(['id_order' => $id_pembelian]);
        session()->setFlashdata('pesan', 'Data Berhasil di Hapus !');
        return redirect()->to(base_url('Orders'));
    }

    //Fungsi mengubah data pembelian
    public function editOrder($id_pembelian)
    {
        $data = [
            'title' => 'Edit Pembelian',
            'item' => $this->itemModel->getAll(),
            'pembeli' => $this->pembeliModel->getBarang(),
            'order' => $this->orderModel->getById($id_pembelian),
            'itemJual' => $this->itemJualModel->getAll(),
            'cart' => \Config\Services::cart(),
            'id' => $id_pembelian,
        ];
        echo view('header');
        echo view('Orders/edit', $data);
        echo view('footer');
    }

    //Fungsi menambah barang ke keranjang
    public function itemToCart($id_pembelian)
    {
        $cart = \Config\Services::cart();
        $cart->destroy();
        $itemJual = $this->itemJualModel->getAll();
        foreach ($itemJual as $key => $row) :
            if ($itemJual[$key]['id_order'] == $id_pembelian) {
                $rowbyorder = $itemJual[$key];
                $cart->insert(array(
                    'id_item' => $rowbyorder['id_item'],
                    'jumlah_item' => $rowbyorder['jumlah_item'],
                    'harga_item' => $rowbyorder['harga_item'],
                    'nama_item' => $rowbyorder['nama_item'],
                ));
            }
        endforeach;
        return redirect()->to(base_url('Orders/editOrder/' . $id_pembelian));
    }

    public function saveupdate($id_order)
    {
        $cart = \Config\Services::cart();

        $pembeli = explode('|', $this->request->getPost('pembeli'));

        $dataOrder = array(
            'id_pembeli' => $pembeli[0],
            'nama_pembeli' => $pembeli[1],
            'total_item' => $cart->totalItems(),
            'total_harga' => $cart->total(),
            'penanggung_jawab' => session()->get()['username'],
            'id_pembelian' => $id_order,
        );
        $this->orderModel->edit($dataOrder);

        $i = 0;
        foreach ($cart->contents() as $key => $value) {
            $dataItem[] = array(
                'id_item' => $value['id_item'],
                'id_order' => $id_order,
                'nama_item' => $value['nama_item'],
                'harga_item' => $value['harga_item'],
                'jumlah_item' => $value['jumlah_item'],
                'subtotal_harga' => $value['harga_item'] * $value['jumlah_item'],
            );
            $i++;
        }
        $this->builderJual->delete(['id_order' => $id_order]);
        $this->builderJual->insertBatch($dataItem);
        $cart->destroy();
        // return print_r($dataItem);
        return redirect()->to(base_url('Orders'));
    }

    //Fungsi menyimpan data pembelian dan memperbaharui data keranjang
    public function aksi()
    {
        switch ($_REQUEST['action']) {
            case 'save':
                $cart = \Config\Services::cart();

                $pembeli = $this->request->getPost('pembeli');
                $pembeli2 = $this->request->getPost('nonanggota');
                // print_r($pembeli);
                if (empty($pembeli) && empty($pembeli2)) {
                    session()->setFlashdata('peringatan', 'Harap pembeli diisi terlebih dahulu');
                    return redirect()->back()->withInput();
                    break;
                } elseif (!empty($pembeli) && !empty($pembeli2)) {
                    session()->setFlashdata('peringatan', 'Harap pilih jenis pembeli terlebih dahulu');
                    return redirect()->back()->withInput();
                    break;
                } elseif (empty($cart->contents())) {
                    session()->setFlashdata('peringatan', 'Harap barang diisi terlebih dahulu');
                    return redirect()->back()->withInput();
                    break;
                }

                if (isset($pembeli2)) {
                    $dataOrder = array(
                        'nama_pembeli' => $pembeli2,
                        'total_item' => $cart->totalItems(),
                        'total_harga' => $cart->total(),
                        'penanggung_jawab' => session()->get()['username'],
                    );
                    $this->db->table('tbl_pembelian')->insert($dataOrder);
                    // return print_r('oke masbroww');
                } else {

                    $pembeli = explode('|', $this->request->getPost('pembeli'));

                    $dataOrder = array(
                        'id_pembeli' => $pembeli[0],
                        'nama_pembeli' => $pembeli[1],
                        'total_item' => $cart->totalItems(),
                        'total_harga' => $cart->total(),
                        'penanggung_jawab' => session()->get()['username'],
                    );
                    $this->db->table('tbl_pembelian')->insert($dataOrder);
                }
                $id_order = $this->db->insertID();

                $i = 0;
                foreach ($cart->contents() as $key => $value) {
                    $dataItem[] = array(
                        'id_item' => $value['id_item'],
                        'id_order' => $id_order,
                        'nama_item' => $value['nama_item'],
                        'harga_item' => $value['harga_item'],
                        'jumlah_item' => $value['jumlah_item'],
                        'subtotal_harga' => $value['harga_item'] * $value['jumlah_item'],
                    );
                    $i++;
                }
                $this->builderJual->insertBatch($dataItem);
                $model = $this->itemModel->findAll();
                foreach ($model as $itemkey => $itemvalue) {

                    if ($itemvalue['stok_item'] != 0) {
                        $items[] = $itemvalue;
                        $itemkey = $itemkey;
                    }
                }
                $j = 0;
                foreach ($dataItem as $key => $value) {

                    foreach ($items as $keyItem => $item) {
                        if ($item['id_item'] == $value['id_item']) {
                            $updateStok = $item['stok_item'] - $value['jumlah_item'];
                            $this->builderItem->where('id_item', $item['id_item']);
                            $this->builderItem->update([
                                'stok_item' => $updateStok,
                            ]);
                        }
                        $j++;
                    }
                }
                $cart->destroy();
                session()->setFlashdata('sukses', 'Data Keranjang Berhasil di Simpan !');
                return redirect()->to(base_url('Orders/input'));

            case 'update':
                $cart = \Config\Services::cart();
                $i = 1;
                $j = 0;
                $model = $this->itemModel->findAll();

                foreach ($model as $itemkey => $itemvalue) {

                    if ($itemvalue['stok_item'] != 0) {
                        $items[] = $itemvalue;
                        $itemkey = $itemkey;
                    }
                }

                foreach ($cart->contents() as $key => $value) {

                    foreach ($items as $keyItem => $item) {
                        if ($item['id_item'] == $value['id_item']) {
                            if ($item['stok_item'] >= $this->request->getPost('jumlah_item' . $i)) {
                                $cart->update(array(
                                    'rowid' => $value['rowid'],
                                    'jumlah_item' => $this->request->getPost('jumlah_item' . $i),
                                ));
                            } elseif ($item['stok_item'] < $this->request->getPost('jumlah_item' . $i)) {
                                session()->setFlashdata('peringatan',
                                'Jumlah Barang <b>' . $item['nama_item'] . '</b> Melebih Stok !');
                                return redirect()->back()->withInput();
                            }
                        } else $j++;
                    }
                    $i++;
                }
                session()->setFlashdata('pesan', 'Data Keranjang Berhasil di Perbaharui !');
                return redirect()->back()->withInput();

            case 'saveupdate':
                $cart = \Config\Services::cart();

                $id = $this->request->getPost('id_order');
                $id_pembeli = $this->request->getPost('pembeli');
                $pembeli2 = $this->request->getPost('nonanggota');
                // print_r($pembeli);
                if (isset($pembeli) && empty($pembeli2)) {
                    session()->setFlashdata('peringatan', 'Harap pembeli diisi terlebih dahulu');
                    return redirect()->back()->withInput();
                    break;
                } elseif (!empty($pembeli) && !empty($pembeli2)) {
                    session()->setFlashdata('peringatan', 'Harap pilih jenis pembeli terlebih dahulu');
                    return redirect()->back()->withInput();
                    break;
                } elseif (empty($cart->contents())) {
                    session()->setFlashdata('peringatan', 'Harap barang diisi terlebih dahulu');
                    return redirect()->back()->withInput();
                    break;
                }

                if ($id_pembeli == 0) {
                    $dataOrder = array(
                        'id_pembelian' => $id,
                        'nama_pembeli' => $pembeli2,
                        'total_item' => $cart->totalItems(),
                        'total_harga' => $cart->total(),
                        'penanggung_jawab' => session()->get()['username'],
                    );
                    $this->orderModel->edit($dataOrder);
                    // return print_r('oke masbroww');
                } else {
                    $pembeli = $this->pembeliModel->getById($id_pembeli);

                    $dataOrder = array(
                        'id_pembelian' => $id,
                        'id_pembeli' => $pembeli[0]['id_pembeli'],
                        'nama_pembeli' => $pembeli[0]['nama_pembeli'],
                        'total_item' => $cart->totalItems(),
                        'total_harga' => $cart->total(),
                        'penanggung_jawab' => session()->get()['username'],
                    );
                    // return print_r($dataOrder);
                    $this->orderModel->edit($dataOrder);
                }
                $id_order = $id;

                $i = 0;
                foreach ($cart->contents() as $value) {
                    $dataItem[] = array(
                        'id_item' => $value['id_item'],
                        'id_order' => $id_order,
                        'nama_item' => $value['nama_item'],
                        'harga_item' => $value['harga_item'],
                        'jumlah_item' => $value['jumlah_item'],
                        'subtotal_harga' => $value['harga_item'] * $value['jumlah_item'],
                    );
                    $i++;
                }
                // return print_r($dataItem);
                $model = $this->itemModel->findAll();
                foreach ($model as $itemkey => $itemvalue) {

                    if ($itemvalue['stok_item'] != 0) {
                        $items[] = $itemvalue;
                        $itemkey = $itemkey;
                    }
                }
                $orderan = $this->itemJualModel->getByOrder($id_order);
                $j = 0;
                foreach ($dataItem as $itemchange) {

                    foreach ($orderan as $perorder) {
                        foreach ($items as $item) {
                            $selisih = 0;
                            if (($item['id_item'] == $itemchange['id_item']) && ($itemchange['id_item'] ==
                                 $perorder['id_item'])) {
                                // return print_r($perorder['jumlah_item']);
                                if ($perorder['jumlah_item'] > $itemchange['jumlah_item']) {
                                    $selisih = $perorder['jumlah_item'] - $itemchange['jumlah_item'];
                                    $updateStok = $item['stok_item'] + $selisih;
                                    $this->builderItem->where('id_item', $item['id_item']);
                                    $this->builderItem->update([
                                        'stok_item' => $updateStok,
                                    ]);
                                    // return print_r('ngurang');
                                    break;
                                } elseif ($perorder['jumlah_item'] < $itemchange['jumlah_item']) {
                                    $selisih = $itemchange['jumlah_item'] - $perorder['jumlah_item'];
                                    $updateStok = $item['stok_item'] - $selisih;
                                    $this->builderItem->where('id_item', $item['id_item']);
                                    $this->builderItem->update([
                                        'stok_item' => $updateStok,
                                    ]);
                                    // return print_r('nambah');
                                    break;
                                } else {
                                    $updateStok = $item['stok_item'] - $itemchange['jumlah_item'];
                                    $this->builderItem->where('id_item', $item['id_item']);
                                    $this->builderItem->update([
                                        'stok_item' => $updateStok,
                                    ]);
                                    // return print_r($selisih);
                                }
                            }
                        }
                        break;
                        $j++;
                    }
                }
                $this->builderJual->delete(['id_order' => $id_order]);
                $this->builderJual->insertBatch($dataItem);
                // $this->builderJual->updateBatch($dataItem);

                $cart->destroy();

                session()->setFlashdata('pesan', 'Data Keranjang Berhasil di Simpan !');
                return redirect()->to(base_url('Orders'));
        }
    }
}
