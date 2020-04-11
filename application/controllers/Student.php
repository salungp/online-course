<?php

class Student extends CI_Controller {
  public function __construct() {
    parent::__construct();
    if (!$this->session->has_userdata('user_logged')) {
      redirect('login');
      exit;
    }

    $this->load->model('User_model', '_user');
  }

  public function index() {
    $student = $this->_user->where('level >', 1)->orderBy('id', 'desc')->getAll();

    $this->load->view('templates/header', ['title' => 'Student page']);
    $this->load->view('student/index', ['students' => $student]);
    $this->load->view('templates/footer');
  }

  public function search() {
    $student = $this->_user->where('level >', 1)->like('name', $this->input->get('input_search'))->orderBy('id', 'desc')->getAll();

    $this->load->view('templates/header', ['title' => 'Student page']);
    $this->load->view('student/index', ['students' => $student]);
    $this->load->view('templates/footer');
  }
}