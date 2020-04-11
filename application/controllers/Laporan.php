<?php 

class Laporan extends CI_Controller {
  public function __construct() {
    parent::__construct();
    if (!$this->session->has_userdata('user_logged')) {
      redirect('login');
      exit;
    }
  }

  public function kursus() {
    $this->load->view('templates/header', ['title' => 'Laporan kursus']);
    $this->load->view('templates/footer');
  }
}