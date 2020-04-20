<?php

class Course extends CI_Controller {
  public function __construct() {
    parent::__construct();
    if (!$this->session->has_userdata('user_logged')) {
      redirect('login');
      exit;
    }

    $this->load->library('pagination');
    $this->load->model('Course_model', '_course');
    $this->load->model('User_model', '_user');
    $this->load->model('Comment_model', '_comment');
  }

  public function index() {
    $courses = $this->db->order_by('id', 'desc')->get('courses')->result_array();
    $this->load->view('templates/header', ['title' => 'Student page']);
    $this->load->view('course/index', ['courses' => $courses]);
    $this->load->view('templates/footer');
  }

  public function search() {
    $title = $this->input->get('input_search');
    $courses = $this->_course->like('title', $title)->orderBy('id', 'desc')->getAll();

    $this->load->view('templates/header', ['title' => 'Student page']);
    $this->load->view('course/index', ['courses' => $courses]);
    $this->load->view('templates/footer');
  }

  public function delete($id) {
    $this->_course->delete('id', $id);
    $this->_comment->delete('post_id', $id);

    $this->session->set_flashdata('message', '<div class="alert alert-success">Kursus berhasil dihapus!</div>');
    redirect();
  }

  public function detail($slug) {
    $course = $this->_course->where('slug', $slug)->getSingle();

    $this->load->view('templates/header', ['title' => $course['title']]);
    $this->load->view('course/detail', ['course' => $course]);
    $this->load->view('templates/footer');
  }

  public function comment($id) {
    $text = htmlspecialchars($this->input->post('comment'));
    $post_id = $id;
    $user_id = $this->session->userdata('user_logged');

    $this->_comment->create([
      'text' => $text,
      'post_id' => $post_id,
      'user_id' => $user_id
    ]);

    redirect($this->agent->referrer());
  }

  public function create() {
    $title = htmlspecialchars($this->input->post('title'));
    $description = htmlspecialchars($this->input->post('description'));
    $theme = htmlspecialchars($this->input->post('theme'));
    $media = htmlspecialchars($this->input->post('media'));
    $author = $this->session->userdata('user_logged');
    $form_media = $this->input->post('form_media');
    $output_media = '';

    if ($form_media == 'upload') {
      $file_name = $_FILES['media']['name'];
      $tmp_name = $_FILES['media']['tmp_name'];
      $file_eks = end(explode('.', $file_name));
      $dir = './assets/users/media/';
      $output_media = $dir.strtolower(str_replace(' ', '-', $title)).'-'.uniqid().'.'.$file_eks;

      move_uploaded_file($tmp_name, $output_media);

      $this->_course->create([
        'title' => $title,
        'description' => $description,
        'slug' => strtolower(str_replace(' ', '-', $title)),
        'theme' => $theme,
        'media' => $output_media,
        'author' => $author,
        'type' => 'upload'
      ]);
    } else {
      $this->_course->create([
        'title' => $title,
        'description' => $description,
        'slug' => strtolower(str_replace(' ', '-', $title)),
        'theme' => $theme,
        'media' => $media,
        'author' => $author,
        'type' => 'link'
      ]);
    }

    $this->session->set_flashdata('message', '<div class="alert alert-success">Kursus berhasil ditambah!</div>');
    redirect();
  }
}
    