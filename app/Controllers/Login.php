<?php

namespace App\Controllers;

use App\Models\Model_admin;

class Login extends BaseController
{
    public function __construct()
    {
        helper('form');

        $this->db = \Config\Database::connect();

        $this->m_admin = new Model_admin();
        $this->builderAdmin = $this->db->table('tbl_admin');
    }
    public function index()
    {
        $data = [
            'title' => "Login",
        ];

        echo view('Login', $data);
    }

    public function process()
    {
        $users = new Model_admin();
        $username = $this->request->getVar('username');
        $password = sha1($this->request->getVar('password'));
        $dataUser = $users->where([
            'username' => $username,
        ])->first();
        $hash = password_hash($dataUser['password'], PASSWORD_DEFAULT);
        if ($dataUser) {
            if (password_verify($password, $hash)) {
                session()->set([
                    'id_admin' => $dataUser['id_admin'],
                    'username' => $dataUser['username'],
                    'nama' => $dataUser['nama'],
                    'logged_in' => TRUE
                ]);
                return redirect()->to(base_url('Home'));
            } else {
                session()->setFlashdata('error', 'Username & Password Salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Username & Password Salah');
            return redirect()->back();
        }
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to('/Login');
    }

    public function forget()
    {
        $m_admin = new Model_admin();
        $validationRule = [
            'email' => 'required|valid_email',
        ];
        if ($this->request->getMethod() === 'post') {
            if (!$this->validate($validationRule)) {
                $data = ['errors' => implode($this->validator->getErrors())];
                session()->setFlashdata('error', $data['errors']);
                return redirect()->to(current_url());
            } else {
                $getEmail = $this->request->getPost('email');
                $getUser = $m_admin->getDataByEmail($getEmail);
                if (!$getUser) {
                    session()->setFlashdata('error', 'alamat email salah atau tidak terdaftar');
                    return redirect()->to(current_url());
                }
                $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                $token = substr(str_shuffle($str_result), 0, 16);
                $message = 'Akun anda, <b>' . $getUser['username'] . '</b> <br><br>'
                    . 'Permintaan reset password telah diterima. Silahkan klik'
                    . 'link dibawah untuk reset password.<br>'
                    . '<a href="' . base_url() . '/Login/reset?t=' . $token . '">Link disini</a>'
                    . '<br><br> Terima Kasih, <br> Koperasi RRI Bogor';

                $email = \Config\Services::email();
                $email->setTo($getEmail);
                $email->setFrom('rsdcity3@gmail.com', 'Koperasi RRI Bogor');
                $email->setSubject('Reset Password');
                $email->setMessage($message);


                if ($email->send()) {
                    session()->setFlashdata('success', 'Link reset password telah dikirim ke email anda.');
                    session()->setFlashdata('info', 'Link hanya berlaku dalam 5 menit.');
                    $_SESSION['token_request_time'] = $_SERVER['REQUEST_TIME'];
                    $_SESSION['token'] = $token;
                    $_SESSION['email'] = $getEmail;
                } else {
                    print_r($email->printDebugger(['headers']));
                }
            }
        };
        $data = [
            'title' => 'Lupa Password',
        ];

        echo view('forget_password/index', $data);
    }

    public function reset()
    {
        $duration = 600;
        if (($_SERVER['REQUEST_TIME'] - $_SESSION['token_request_time']) > $duration) {
            session()->setFlashdata('error', 'Limit waktu telah habis, silakan masukkan email kembali');
            return redirect()->to(base_url('Login/forget'));
        }
        if (isset($_GET['t'])) {
            if ($_GET['t'] != $_SESSION['token']) {
                session()->setFlashdata('error', 'Link sudah kadaluarsa');
                return redirect()->to(base_url('Login/forget'));
            }
        } elseif (!isset($_GET['t'])) {
            session()->setFlashdata('error', 'Token link tidak sesuai');
            return redirect()->to(base_url('Login'));
        }

        if ($this->request->getMethod() === 'post') {
            $validationRule = [
                'password' => 'required|min_length[6]|max_length[32]',
                'password2' => 'required|min_length[6]|max_length[32]',
            ];
            $password = $this->request->getPost('password');
            $password2 = $this->request->getPost('password2');
            if (!$this->validate($validationRule)) {
                $data = ['errors' => implode($this->validator->getErrors())];
                session()->setFlashdata('error', $data['errors']);
                return redirect()->to(base_url('Login/reset?t='.$_GET['t']));
            } else {
                if ($password != $password2) {
                    session()->setFlashdata('error', 'Password tidak sesuai');
                    return redirect()->to(base_url('Login/reset?t='.$_GET['t']));
                }
                $getEmail = $_SESSION['email'];
                $getUser = $this->m_admin->getDataByEmail($getEmail);
                $data = array(
                    'password' => sha1($password),
                );
                // return print_r($getUser['id_admin']);
                $this->builderAdmin->update($data, ['id_admin' => $getUser['id_admin']]);

                session()->setFlashdata('success', 'Password berhasil diubah, silahkan login kembali');
                return redirect()->to(base_url('Login'));
            }
        }
        $data = [
            'title' => 'Reset Password',
        ];

        echo view('forget_password/resetpw', $data);
    }
}
