<?php

namespace App\Controllers;

use App\Models\Model_admin;

use function PHPUnit\Framework\isEmpty;

class Admin extends BaseController
{
    private $findAll;

    public function __construct()
    {
        helper('number');
        helper('email');
        helper('form');

        $this->db = \Config\Database::connect();
        $this->validation =  \Config\Services::validation();

        $this->adminModel = new Model_admin();

        $this->builderAdmin = $this->db->table('tbl_admin');
        $this->session = session();
    }

    //Halaman Admin
    public function index()
    {
        $data = [
            'title' => 'Akun Admin',
            'admin' => $this->adminModel->findAll(),
            'logged_in' => session()->get(),
            'imageDefault' => base_url('assets/images/user_default.png'),
        ];
        echo view('header');
        echo view('Admin/viewAdmin', $data);
        echo view('footer');
    }

    //Halaman menambah akun admin
    public function add()
    {
        $data = [
            'title' => 'Tambah Admin',
            'admin' => $this->adminModel->findAll(),
        ];

        echo view('header');
        echo view('Admin/addAdmin', $data);
        echo view('footer');
    }

    //Fungsi menambah akun admin
    public function create()
    {
        if ($this->request->getMethod() === 'post') {
            if (!$this->validate(
                [
                    'nama' => 'required',
                    'username' => 'required|is_unique[tbl_admin.username]',
                    'password' => 'required|min_length[6]|max_length[40]',
                    'email' => 'required|valid_emails|valid_email|is_unique[tbl_admin.email]',
                    'gambar' => [
                        'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
                        'max_size[gambar,4096]',
                    ],
                ]
            )) {
                $data = ['errors' => implode($this->validator->getErrors())];
                session()->setFlashdata('peringatan',  $data['errors']);
                return redirect()->back()->withInput();
            } else {

                if (!$this->request->getFile('gambar')->getName()) {
                    $data = array(
                        'username' => $this->request->getPost('username'),
                        'nama' => $this->request->getPost('nama'),
                        'email' => $this->request->getPost('email'),
                        'password' => sha1($this->request->getPost('password')),

                    );
                } elseif ($this->request->getFile('gambar')->getName()) {
                    $foto = $this->request->getFile('gambar');
                    $namabaru = str_replace(' ', '-', $foto->getName());
                    $foto->move(WRITEPATH . '../public/assets/images/upload/');
                    $data = array(
                        'username' => $this->request->getPost('username'),
                        'nama' => $this->request->getPost('nama'),
                        'email' => $this->request->getPost('email'),
                        'password' => sha1($this->request->getPost('password')),
                        'foto' => $foto->getName(),
                    );
                }
            }
        }
        $this->builderAdmin->insert($data);
        session()->setFlashdata('pesan', 'Data Admin Berhasil di tambah');
        return redirect()->to(base_url('Admin'));
    }

    //fungsi mengubah akun admin
    public function edit($id)
    {
        $adminData = $this->adminModel->getDataByID($id);

        if ($this->request->getMethod() === 'post') {
            if (!$this->validate(
                [
                    'nama' => 'required',
                    'email' => 'required|valid_email|valid_emails',
                    // 'password' => 'min_length[6]|max_length[40]',
                    'gambar' => [
                        'mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
                        'max_size[gambar,4096]',
                    ],
                ]
            )) {
                $data = ['errors' => implode($this->validator->getErrors())];
                session()->setFlashdata('peringatan',  $data['errors']);
                return redirect()->back()->withInput();
            } else {
                $email = $this->request->getPost('email');
                $getAll = $this->adminModel->getAllExceptOne($adminData['id_admin']);
                foreach ($getAll as $val) {
                    if ($email == $val['email']) {
                        session()->setFlashdata('peringatan',  'Email sudah terdaftar, silakan masukkan
                        email lain');
                        return redirect()->back()->withInput();
                    } else {
                        $updateEmail = TRUE;
                    }
                }
                if ($email == $adminData['email'] || $updateEmail == TRUE) {
                    if (!$this->request->getFile('gambar')->getName() == '' &&
                        !$this->request->getPost('password') == '') {
                        $foto = $this->request->getFile('gambar');
                        $namabaru = str_replace(' ', '-', $foto->getName());
                        $foto->move(WRITEPATH . '../public/assets/images/upload/');
                        $data = array(
                            'nama' => $this->request->getPost('nama'),
                            'email' => $this->request->getPost('email'),
                            'password' => sha1($this->request->getPost('password')),
                            'foto' => $foto->getName(),
                        );
                    } elseif ($this->request->getFile('gambar')->getName() == '' &&
                              $this->request->getFile('gambar')->getName() == '') {

                        $data = array(
                            'nama' => $this->request->getPost('nama'),
                            'email' => $this->request->getPost('email'),
                            // 'password' => sha1($this->request->getPost('password')),
                        );
                    }
                    $this->builderAdmin->update($data, ['id_admin' => $id]);
                    session()->setFlashdata('pesan', 'Data Admin Berhasil di perbaharui');
                    return redirect()->to(base_url('Admin'));
                }
            }
        }
        $data = [
            'title' => 'Edit Admin',
            'key' => $id,
            'admin' => $adminData,
            'imageDefault' => base_url('assets/images/user_default.png'),
        ];

        echo view('header');
        echo view('Admin/editAdmin', $data);
        echo view('footer');
    }

    //fungsi menghapus akun admin
    public function delete($id)
    {
        $this->builderAdmin->delete(['id_admin' => $id]);
        session()->setFlashdata('pesan', 'Akun admin Berhasil dihapus');
        return redirect()->to(base_url('Admin'));
    }
}
