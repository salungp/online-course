<?php

class Admin extends CI_Controller {
  public function __construct() {
    parent::__construct();
    if (!$this->session->has_userdata('user_logged')) {
      redirect('login');
    }

    $this->load->model('User_model', 'user');
    $this->load->model('Comment_model', 'comment');
  }

  public function index() {
    $user = $this->user->orderBy('id', 'desc')->getAll();

    $this->load->view('templates/header', ['title' => 'Admin users']);
    $this->load->view('admin/index', ['users' => $user]);
    $this->load->view('templates/footer');
  }

  public function search() {
    $input_search = $this->input->get('input_search');
    $user = $this->user->like('name', $input_search)->orderBy('id', 'desc')->getAll();

    $this->load->view('templates/header', ['title' => 'Admin users']);
    $this->load->view('admin/index', ['users' => $user]);
    $this->load->view('templates/footer');
  }

  public function delete($id) {
    $user = $this->user->where('id', $id)->getSingle();

    if ($user['name'] == 'admin') {
      $this->session->set_flashdata('message', '<div class="alert alert-danger">Maaf tidak bisa hapus akun admin.</div>');
      redirect($this->agent->referrer());
      die;
    }

    
    if ($user) {
      if ($user['profile_picture'] != './assets/dist/img/avatar5.png') {
        $clear_url = explode('.', $user['profile_picture']);
        unlink($_SERVER['DOCUMENT_ROOT'].'/new-project'.$clear_url[1]);
      }

      $this->user->delete($id);
      $this->comment->delete('user_id', $id);
      $this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil dihapus.</div>');
      redirect($this->agent->referrer());
    } else {
      show_404();
    }
  }

  public function create() {
    $name = htmlspecialchars($this->input->post('name'));
    $address = htmlspecialchars($this->input->post('address'));
    $email = htmlspecialchars($this->input->post('username'));
    $password = $this->input->post('password');
    $password_confirm = $this->input->post('password_confirm');
    $user = $this->user->where('email', $email)->getSingle();
    $level = $this->input->post('level');

    if ($user) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger">Maaf email sudah.</div>');
      redirect('register');
    }

    if ($password !== $password_confirm) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger">Password tidak sama.</div>');
      redirect('register');
    }

    $this->user->create([
      'name' => $name,
      'address' => $address,
      'email' => $email,
      'status' => 0,
      'level' => $level,
      'profile_picture' => './assets/dist/img/avatar5.png',
      'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    $this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil ditambah.</div>');
    redirect($this->agent->referrer());
  }

  public function edit($id) {
    $user = $this->user->where('id', $id)->getSingle();

    if ($user) {
      $this->load->view('templates/header', ['title' => 'Edit user']);
      $this->load->view('admin/edit', ['user' => $user]);
      $this->load->view('templates/footer');
    } else {
      show_404();
    }
  }

  public function update($id) {
    $name = htmlspecialchars($this->input->post('name'));
    $email = htmlspecialchars($this->input->post('username'));
    $address = htmlspecialchars($this->input->post('address'));
    $password = $this->input->post('password');
    $profile_picture = '';
    $password_confirm = $this->input->post('password_confirmation');
    $user = $this->user->where('id', $this->session->userdata('user_logged'))->getSingle();

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


    if ($password != '') {
      if (!password_verify($password_confirm, $user['password'])) {
        $this->session->set_flashdata('message', '<div class="alert alert-danger">Maaf password tidak sama!</div>');
        redirect($this->agent->referrer());
      }

      $this->user->update([
        'id' => $this->session->userdata('user_logged'),
        'name' => $name,
        'address' => $address,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT),
        'profile_picture' => $profile_picture
      ]);

      $this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil di update!</div>');
      redirect('admin');
    } else {
      $this->user->update([
        'id' => $this->session->userdata('user_logged'),
        'name' => $name,
        'address' => $address,
        'email' => $email,
        'profile_picture' => $profile_picture
      ]);

      $this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil di update!</div>');
      redirect('admin');
    }
  }
}