<?php

class Activity extends CI_Controller {
  public function __construct() {
    parent::__construct();

    $this->load->model('Activity_model', '_activity');
    $this->load->model('Course_model', '_course');
  }

  public function index() {
    $id = $this->session->userdata('user_logged');
    $activities = $this->_activity->where('user_id', $id)->orderBy('id', 'desc')->getAll();
    $courses = $this->_course->orderBy('id', 'desc')->getAll();

    $this->load->view('templates/header', ['title' => 'Kegiatan']);
    $this->load->view('activity/index', ['activities' => $activities, 'courses' => $courses]);
    $this->load->view('templates/footer');
  }

  public function create() {
    $text = htmlspecialchars($this->input->post('text'));
    $date = $this->input->post('date');
    $course = $this->input->post('course');
    $user = $this->session->userdata('user_logged');

    $this->_activity->create([
      'text' => $text,
      'date' => $date,
      'user_id' => $user,
      'course_id' => $course
    ]);

    $this->session->set_flashdata('message', '<div class="alert alert-success">Kegiatan berhasil ditambah!</div>');
    redirect($this->agent->referrer());
  }

  public function delete($id) {
    $this->_activity->delete('id', $id);

    $this->session->set_flashdata('message', '<div class="alert alert-success">Kegiatan berhasil dihapus!</div>');
    redirect($this->agent->referrer());
  }
}