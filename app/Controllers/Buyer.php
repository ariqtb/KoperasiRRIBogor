<?php

namespace App\Controllers;

use App\Models\Model_pembeli;

class Buyer extends BaseController
{
    public $findAll;

    public $orderModel;
    public $itemModel;
    public $pembeliModel;

    public $data;

    public function __construct()
    {
        helper('form');

        $this->pembeliModel = new Model_pembeli();

        $this->db = \Config\Database::connect();
        $this->table = $this->db->table('tbl_pembeli');
    }

    //Halaman Data Anggota
    public function index()
    {

        $data = [
            'title' => 'Daftar Anggota',
            'pembeli' => $this->pembeliModel->findAll(),
        ];

        echo view('header');
        echo view('Buyer/viewBuyer', $data);
        echo view('footer');
    }

    //Fungsi menambah data anggota
    public function create()
    {
        foreach ($this->pembeliModel->findAll() as $key => $value) {
            if (!$this->request->getPost('nama')) {
                session()->setFlashdata('peringatan', 'Nama anggota harus diisi');
                return redirect()->to(base_url('Buyer'));
            }
            if (!$this->request->getPost('nomor_anggota')) {
                session()->setFlashdata('peringatan', 'Nomor anggota harus diisi');
                return redirect()->to(base_url('Buyer'));
            }
            elseif($value['nomor_anggota'] == $this->request->getPost('nomor_anggota')) {
                session()->setFlashdata('peringatan', 'Nomor anggota tidak boleh sama');
                return redirect()->to(base_url('Buyer'));
            }
        }

        $data = array(
            'nama_pembeli' => $this->request->getPost('nama'),
            'nomor_anggota' => $this->request->getPost('nomor_anggota'),
        );

        $this->table->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambah');
        return redirect()->to(base_url('Buyer'));
    }

    //Halaman ubah data anggota
    public function viewEdit($id)
    {
        $data = [
            'title' => 'Edit Anggota',
            'pembeli' => $this->pembeliModel->findAll(),
            'id' => $id,
        ];

        echo view('header');
        echo view('Buyer/viewEdit', $data);
        echo view('footer');
    }

    //Fungsi ubah data anggota
    public function edit()
    {
        $id = $this->request->getPost('id_pembeli');

        foreach ($this->pembeliModel->findAll() as $key => $value) {
            $i = 0;
            if ($value['id_pembeli'] == $id) {
                $row = $i;
                break;
            }
            $i++;
        };

        if (!$this->request->getPost('nama')) {
            session()->setFlashdata('peringatan', 'Gagal memperbaharui, nama anggota tidak boleh kosong');
            return redirect()->to(base_url('Buyer/viewEdit/' . $row));
        } elseif (!$this->request->getPost('nomor_anggota')) {
            session()->setFlashdata('peringatan', 'Gagal memperbaharui, Harap nomor anggota
                                    tidak boleh kosong');
            return redirect()->to(base_url('Buyer/viewEdit/' . $row));
        }



        $data = array(
            'id_pembeli' => $id,
            'nama_pembeli' => $this->request->getPost('nama'),
            'nomor_anggota' => $this->request->getPost('nomor_anggota'),
        );


        $this->table->update($data, ['id_pembeli' => $id]);
        session()->setFlashdata('pesan', 'Data Berhasil di perbaharui');
        return redirect()->to(base_url('Buyer'));
    }

    //Fungsi menghapus data anggota
    public function delete($id)
    {
        $this->table->delete(['id_pembeli' => $id]);

        session()->setFlashdata('pesan', 'Data Anggota berhasil dihapus');
        return redirect()->to(base_url('Buyer'));
    }

}
