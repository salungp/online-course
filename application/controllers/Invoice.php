<?php

class Invoice extends CI_Controller {
  public function __construct() {
    parent::__construct();
    if (!$this->session->has_userdata('user_logged')) {
      redirect('login');
    }

    $this->load->model('Invoice_model', 'invoice');
    $this->load->model('User_model', '_user');
    $this->load->model('Notification_model', '_notification');
  }

  public function index() {
    $months = [
      1 => 'January',
      2 => 'February',
      3 => 'March',
      4 => 'April',
      5 => 'May',
      6 => 'June',
      7 => 'July',
      8 => 'August',
      9 => 'September',
      10 => 'October',
      11 => 'November',
      12 => 'December'
    ];
    $invoices = $this->invoice->orderBy('id', 'desc')->getAll();
    $user_invoice = $this->db->order_by('id', 'desc')->get('user_invoices')->result_array();

    $this->load->view('templates/header', ['title' => 'Pembayaran']);
    $this->load->view('invoice/index', ['invoices' => $invoices, 'months' => $months, 'user_invoice' => $user_invoice]);
    $this->load->view('templates/footer');
  }

  public function create() {
    $title = htmlspecialchars($this->input->post('title'));
    $date = $this->input->post('date');
    $ammount = $this->input->post('ammount');

    $this->invoice->create([
      'title' => $title,
      'date' => $date,
      'total' => $ammount,
      'author' => $this->session->userdata('user_logged')
    ]);

    $this->_notification->create([
      'text' => $title,
      'author' => $this->session->userdata('user_logged')
    ]);

    $this->session->set_flashdata('message', '<div class="alert alert-success">Pembayaran ditambahkan!</div>');
    redirect($this->agent->referrer());
  }

  public function next($invoice_id) {
    $user_id = $this->session->userdata('user_logged');
    $this->db->insert('user_invoices', [
      'user_id' => $user_id,
      'invoice_id' => $invoice_id
    ]);

    $this->session->set_flashdata('message', '<div class="alert alert-success">Silahkan melakukan pembayaran, jika sudah maka status berwarna hijau!</div>');
    redirect($this->agent->referrer());
  }

  public function acc($user_invoice_id) {
    $this->db->where('id', $user_invoice_id)->update('user_invoices', ['status' => 1]);
    $this->session->set_flashdata('message', '<div class="alert alert-success">Pembayaran sudah selesai!</div>');
    redirect($this->agent->referrer());
  }

  public function delete($id) {
    $this->db->delete('user_invoices', ['id' => $id]);
    $this->session->set_flashdata('message', '<div class="alert alert-success">Pembayaran berhasil dihapus!</div>');
    redirect($this->agent->referrer());
  }
}