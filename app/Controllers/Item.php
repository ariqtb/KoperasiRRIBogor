<?php

namespace App\Controllers;

use App\Models\Model_item;

use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

use function PHPUnit\Framework\isEmpty;

class Item extends BaseController
{
    public function __construct()
    {
        helper('number');
        helper('form');

        $this->db = \Config\Database::connect();

        $this->m_item = new Model_item();
        $this->builder_item = $this->db->table('tbl_item');

        $this->validation =  \Config\Services::validation();
    }

    //Halaman Data Barang
    public function index()
    {
        $this->m_item = new Model_item();

        $data = [
            'title' => 'Daftar Barang',
            'item' => $this->m_item->getAll(),
            'judul' => 'Koperasi | List Data Item',
        ];
        echo view('header', $data);
        echo view('Item/index', $data);
        echo view('footer');
    }

    //Fungsi menambah data barang
    public function create()
    {
        $validationRule = [
            'nama' => 'required',
            'harga' => 'required',
            'gambar' => [
                'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
                'max_size[gambar,409600]',
            ],
        ];
        if (!$this->validate($validationRule)) {
            $data = ['errors' => implode($this->validator->getErrors())];
            session()->setFlashdata('peringatan', $data['errors']);
            return redirect()->to(base_url('Item'));

        } else {
            if ($this->request->getFile('gambar')->getName() == "") {
                $data = array(
                    'nama_item' => $this->request->getPost('nama'),
                    'harga_item' => $this->request->getPost('harga'),
                    'stok_item' => $this->request->getPost('stok'),
                    // 'kode_item' => $this->request->getPost('kode'),
                );

            } elseif (!$this->request->getFile('gambar')->getName() == "") {
                $foto = $this->request->getFile('gambar');
                $foto->move(WRITEPATH . '../public/assets/images/upload/');
                $data = array(
                    'nama_item' => $this->request->getPost('nama'),
                    'harga_item' => $this->request->getPost('harga'),
                    'stok_item' => $this->request->getPost('stok'),
                    // 'kode_item' => $this->request->getPost('kode'),
                    'foto_item' => $foto->getName(),
                );
            }
            $query = $this->m_item->insert_model($data);
        }
        if ($query) {
            session()->setFlashdata('pesan', 'Data Berhasil ditambah');
            return redirect()->to(base_url('Item'));
        } else {
            echo json_encode(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    //Halaman ubah data barang
    public function viewEdit($id_item)
    {
        $data = [
            'title' => 'Edit Barang',
            'key' => $id_item,
            'item' => $this->m_item->getByID($id_item),
        ];
        echo view('header');
        echo view('Item/viewEdit', $data);
        echo view('footer');
    }

    //Fungsi mengubah data barang
    public function edit()
    {
        $id = $this->request->getPost('id_item');

        if ($this->validation->setRules(
            [
                'nama_item' => 'required',
                'harga_item' => 'required',
                'gambar' => [
                    'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
                    'max_size[gambar,4096]',
                ],
            ]
        )) {
            if ($this->request->getFile('gambar')->getName() == "") {
                $data = array(
                    'nama_item' => $this->request->getPost('nama'),
                    'harga_item' => $this->request->getPost('harga'),
                    'stok_item' => $this->request->getPost('stok'),
                );
            } elseif (!$this->request->getFile('gambar')->getName() == "") {
                $foto = $this->request->getFile('gambar');
                $namabaru = str_replace(' ', '-', $foto->getName());
                $foto->move(WRITEPATH . '../public/assets/images/upload/');
                $data = array(
                    'nama_item' => $this->request->getPost('nama'),
                    'harga_item' => $this->request->getPost('harga'),
                    'stok_item' => $this->request->getPost('stok'),
                    'foto_item' => $foto->getName(),
                );
            }
        }
        $this->builder_item->update($data, ['id_item' => $id]);
        session()->setFlashdata('pesan', 'Data Berhasil di perbaharui');
        return redirect()->to(base_url('Item'));
    }

    //Fungsi menghapus data barang
    public function delete($id_item)
    {
        $this->builder_item = $this->db->table('tbl_item');
        $this->builder_item->delete(['id_item' => $id_item]);
        session()->setFlashdata('pesan', 'Data Berhasil di hapus');
        return redirect()->to(base_url('Item'));
    }
}
