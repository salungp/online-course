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

    unlink($_SERVER['DOCUMENT_ROOT'].$user['media']);
    if ($user) {
      $this->user->delete('id', $id);
      $this->_comment->delete('user_id', $id);
      $this->session->set_flashdata('message', '<div class="alert alert-success">Data berhasil dihapus.</div>');
      redirect($this->agent->referrer());
    } else {
      show_404();
    }
  }

  public function create() {
    $name = htmlspecialchars($this->input->post('name'));
    $address = htmlspecialchars($this->input->post('address'));
    $email = htmlspecialchars($this->input->post('email'));
    $password = $this->input->post('password');
    $password_confirm = $this->input->post('password_confirm');
    $user = $this->_user->where('email', $email)->getSingle();
    $level = $this->input->post('level');

    if ($user) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger">Maaf email sudah.</div>');
      redirect('register');
    }

    if ($password !== $password_confirm) {
      $this->session->set_flashdata('message', '<div class="alert alert-danger">Password tidak sama.</div>');
      redirect('register');
    }

    $this->_user->create([
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
}