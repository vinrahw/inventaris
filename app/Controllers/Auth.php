<?php

namespace App\Controllers;

use App\Models\Auth_Model;


class Auth extends BaseController
{
  public function index()
  {
    $data = [
      'title' => 'Login'
    ];
    return view('login', $data);
  }

  public function valid_login()
  {
    $session = session();
    $model = new Auth_Model();
    $email = $this->request->getVar('username');
    $password = $this->request->getVar('password');
    $data = $model->where('username', $email)->first();
    if ($data) {
      $pass = $data['password'];
      $verify_pass = password_verify($password, $pass);
      if ($verify_pass) {
        $ses_data = [
          'user_id'       => $data['user_id'],
          'user_name'     => $data['user_name'],
          'user_email'    => $data['user_email'],
          'logged_in'     => TRUE
        ];
        $session->set($ses_data);
        return redirect()->to('/dashboard');
      } else {
        $session->setFlashdata('msg', 'Wrong Password');
        return redirect()->to('/login');
      }
    } else {
      $session->setFlashdata('msg', 'Email not Found');
      return redirect()->to('/login');
    }
  }
}
