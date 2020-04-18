<?php 

require APPPATH . '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends CI_Controller {
  public function __construct() {
    parent::__construct();
    if (!$this->session->has_userdata('user_logged')) {
      redirect('login');
      exit;
    }

    $this->load->model('Course_model', '_course');
    $this->load->model('User_model', '_user');
    $this->load->model('Activity_model', '_activity');
    $this->load->model('Invoice_model', '_invoice');
  }

  public function kursus() {
    $courses = $this->_course->orderBy('id', 'desc')->getAll();
    $users_count = count($this->_user->where('level >', 1)->getAll());

    $this->load->view('laporan/kursus', ['courses' => $courses, 'student_total' => $users_count]);
  }

  public function kursus_export_excel() {
    $courses = $this->_course->orderBy('id', 'desc')->getAll();
    $users_count = count($this->_user->where('level >', 1)->getAll());
    $spreadsheet = new Spreadsheet;

    $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'No')
                ->setCellValue('B1', 'Nama kursus')
                ->setCellValue('C1', 'Pembimbing')
                ->setCellValue('D1', 'Jumlah murid')
                ->setCellValue('E1', 'Tanggal');

    $nomor = 1;
    $kolom = 2;

    foreach($courses as $key) {
      $author = $this->_user->where('id', $key['author'])->getSingle();

      $spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A'.$kolom, $nomor.'.')
                  ->setCellValue('B'.$kolom, $key['title'])
                  ->setCellValue('C'.$kolom, $author['name'])
                  ->setCellValue('D'.$kolom, $users_count)
                  ->setCellValue('D'.$kolom, $users_count.' siswa')
                  ->setCellValue('D'.$kolom, $users_count.' siswa')
                  ->setCellValue('E'.$kolom, date('d-m-Y', strtotime($key['created_at'])));

      $kolom++;
      $nomor++;

    }
    
    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="file-kursus-'.date('d-m-Y').'.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function kegiatan_export_excel() {
    $spreadsheet = new Spreadsheet;
    $activities = $this->_activity->orderBy('id', 'desc')->getAll();

    $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'No')
                ->setCellValue('B1', 'Kursus')
                ->setCellValue('C1', 'Kegiatan')
                ->setCellValue('E1', 'Tanggal');

    $nomor = 1;
    $kolom = 2;

    foreach($activities as $key) {
    $course = $this->_course->where('id', $key['course_id'])->getSingle();

      $spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A'.$kolom, $nomor.'.')
                  ->setCellValue('B'.$kolom, $course['title'])
                  ->setCellValue('C'.$kolom, $key['text'])
                  ->setCellValue('D'.$kolom, date('d-m-Y', strtotime($key['date'])));

      $kolom++;
      $nomor++;

    }
    
    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="file-kegiatan-'.date('d-m-Y').'.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function pembayaran_export_excel() {
    $spreadsheet = new Spreadsheet;
    $invoices = $this->returnInvoice();

    $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A1', 'No')
                ->setCellValue('B1', 'Nama')
                ->setCellValue('C1', 'Keterangan')
                ->setCellValue('E1', 'Status')
                ->setCellValue('F1', 'Jumlah')
                ->setCellValue('G1', 'Tanggal');

    $nomor = 1;
    $kolom = 2;

    foreach($invoices as $key) {
      $spreadsheet->setActiveSheetIndex(0)
                  ->setCellValue('A'.$kolom, $nomor.'.')
                  ->setCellValue('B'.$kolom, $key['name'])
                  ->setCellValue('C'.$kolom, $key['title'])
                  ->setCellValue('D'.$kolom, $key['status'] == 1 ? 'Sudah bayar' : 'Belum bayar')
                  ->setCellValue('F'.$kolom, number_format($key['total'], 0, ',', '.'))
                  ->setCellValue('G'.$kolom, date('d-m-Y', strtotime($key['date'])));

      $kolom++;
      $nomor++;

    }
    
    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="file-pembayaran-'.date('d-m-Y').'.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }

  public function kegiatan() {
    $activities = $this->_activity->where('user_id', $this->session->userdata('user_logged'))->orderBy('id', 'desc')->getAll();
    $this->load->view('laporan/kegiatan', ['activities' => $activities]);
  }

  public function pembayaran() {
    $invoices = $this->returnInvoice();
    $this->load->view('laporan/pembayaran', ['invoices' => $invoices]);
  }

  public function filter() {
    $data = $this->input->get('data');
    $where = $this->input->get('status');

    switch($data) {
      case 'kursus' :
        // kursus
      break;

      case 'kegiatan' :
        // kegiatan
      break;

      case 'pembayaran' :
        // pembayaran
        $this->filterInvoice($where);
      break;
    }
  }

  public function returnInvoice() {
    $this->db->select('*');
    $this->db->from('user_invoices');
    $this->db->join('invoice', 'invoice.id=user_invoices.invoice_id', 'left');
    $this->db->join('users', 'users.id=user_invoices.user_id', 'left');
    $this->db->order_by('user_invoices.id','asc');

    return $this->db->get()->result_array();
  }

  public function filterInvoice($where) {
    $inputYear = $this->input->get('year');
    $inputMonth = $this->input->get('month');
    $day = $this->input->get('day');

    $this->db->select('*');
    $this->db->from('user_invoices');
    $this->db->join('invoice', 'invoice.id=user_invoices.invoice_id', 'left');
    $this->db->join('users', 'users.id=user_invoices.user_id', 'left');
    $this->db->like('status', $where);
    $this->db->order_by('user_invoices.id','asc');

    $invoices = $this->db->get()->result_array();

    $this->load->view('templates/header', ['title' => 'Laporan pembayaran']);
    $this->load->view('laporan/pembayaran', ['invoices' => $invoices]);
    $this->load->view('templates/footer');
  }
}
