<?php

class Auth extends CI_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->model('User_model', '_user');
    $this->load->model('Email');
  }

  public function loginPage() {
    $this->load->view('auth/login', ['title' => 'Silahkan login terlebih dahulu.']);
  }

  // public function registerPage() {
  //   $this->load->view('auth/register', ['title' => 'Daftar untuk memiliki akses kursus.']);
  // }

  // public function registerNewUser() {
  //   $name = htmlspecialchars($this->input->post('name'));
  //   $address = htmlspecialchars($this->input->post('address'));
  //   $email = htmlspecialchars($this->input->post('email'));
  //   $password = $this->input->post('password');
  //   $password_confirm = $this->input->post('password_confirm');
  //   $user = $this->_user->where('email', $email)->getSingle();

  //   if ($user) {
  //     $this->session->set_flashdata('message', '<div class="alert alert-danger">Maaf email sudah.</div>');
  //     redirect('register');
  //   }

  //   if ($password !== $password_confirm) {
  //     $this->session->set_flashdata('message', '<div class="alert alert-danger">Password tidak sama.</div>');
  //     redirect('register');
  //   }

  //   $this->_user->create([
  //     'name' => $name,
  //     'address' => $address,
  //     'email' => $email,
  //     'status' => 0,
  //     'level' => 3,
  //     'profile_picture' => './assets/dist/img/avatar5.png',
  //     'password' => password_hash($password, PASSWORD_BCRYPT)
  //   ]);

  //   $this->session->set_flashdata('message', '<div class="alert alert-success">Daftar berhasil silahkan login.</div>');
  //   redirect('login');
  // }

  public function loginAction() {
    $email = $this->input->post('email');
    $password = $this->input->post('password');
    $user = $this->_user->where('email', $email)->getSingle();
    
    if($user) {
      if (password_verify($password, $user['password'])) {
        $this->session->set_userdata([
          'user_logged' => $user['id'] 
        ]);

        redirect();
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Password salah.</div>');
        redirect('login');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-danger">Email/username tidak terdaftar.</div>');
      redirect('login');
    }
  }

  public function profileEdit() {
    $user = $this->_user->where('email', $this->session->userdata('user_logged'))->getSingle();

    $this->load->view('templates/header', ['title' => 'Edit profile']);
    $this->load->view('auth/edit_profile', ['user' => $user]);
    $this->load->view('templates/footer');
  }

  public function logout() {
    $this->session->unset_userdata(['id', 'user_logged']);
    redirect('login');
  }

  public function edit() {
    $name = htmlspecialchars($this->input->post('name'));
    $email = htmlspecialchars($this->input->post('email'));
    $address = htmlspecialchars($this->input->post('address'));
    $password = $this->input->post('password');
    $profile_picture = '';
    $password_confirm = $this->input->post('password_confirmation');
    $user = $this->_user->where('id', $this->session->userdata('user_logged'))->getSingle();

    if ($_FILES['profile_picture']['name'] != '') {
      $file_name = $_FILES['profile_picture']['name'];
      $ekstensi = end(explode('.', $file_name));
      $open_ekstensi = ['jpg', 'png', 'gif'];
      $dir_from = $_FILES['profile_picture']['tmp_name'];

      if (!in_array($ekstensi, $open_ekstensi)) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Maaf ekstensi '.$ekstensi.' tidak diperbolehkan!</div>');
        redirect($this->agent->referrer());
      }

      $dir = './assets/users/images/';
      $picture_name = 'online-course-'.md5(uniqid()).'.'.$ekstensi;
      $profile_picture = $dir.$picture_name;

      if ($user['profile_picture'] !== './assets/dist/img/avatar5.png') {
        unlink($_SERVER['DOCUMENT_ROOT'].$user['profile_picture']);
      }

      move_uploaded_file($dir_from, $profile_picture);
    } else {
      $profile_picture = $user['profile_picture'];
    }

    if ($password !== '') {
      if (!password_verify($password_confirm, $user['password'])) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Maaf password tidak sama!</div>');
        redirect($this->agent->referrer());
      }

      $this->_user->update([
        'id' => $this->session->userdata('user_logged'),
        'name' => $name,
        'address' => $address,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT),
        'profile_picture' => $profile_picture
      ]);

      $this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil di update!</div>');
      redirect($this->agent->referrer());
    } else {
      $this->_user->update([
        'id' => $this->session->userdata('user_logged'),
        'name' => $name,
        'address' => $address,
        'email' => $email,
        'profile_picture' => $profile_picture
      ]);

      $this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil di update!</div>');
      redirect($this->agent->referrer());
    }
  }

  public function deleteAccount() {
    $id = $this->session->userdata('user_logged');
    $user = $this->_user->where('id', $id)->getSingle();
    $dir_root = $_SERVER['DOCUMENT_ROOT'];
    
    if (unlink($dir_root.$user['profile_picture'])) {
      $this->_user->delete($id);
      $this->session->unset_userdata('user_logged');
      $this->session->set_flashdata('message', '<div class="alert alert-success">Selamat tinggal!</div>');
      redirect($this->agent->referrer());
    }
  }

  public function sendToken() {
    $data = [
      'mailtype' => 'text',
      'from' => 'salungprastyo@gmail.com',
      'begining' => 'Send token',
      'subject' => 'Test kirim email',
      'to' => 'salungprastyo99@gmail.com',
      'message' => 'ini tokennya '.md5(uniqid())
    ];

    if ($this->Email->send($data)) {
      echo 'Emailnya sudah dikirim kok.';
    } else {
      echo 'Maaf terjadi kendala saat pengiriman email.';
    }
  }
}