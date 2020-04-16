<?php

class Email extends CI_Model {
  public function __construct() {
    parent::__construct();
  }

  public function send($data) {
    $config['mailtype'] = $data['mailtype'];
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'smtp.mailtrap.io';
    $config['smtp_user'] = '1d0e533cc9d22a';
    $config['smtp_password'] = 'fba1576ffc632c';
    $config['smtp_port'] = 2525;
    $config['newline'] = '\r\n';

    $this->load->library('email', $config);

    $this->email->from($data['from'], $data['begining']);
    $this->email->to($data['to']);
    $this->email->subject($data['subject']);
    $this->email->message($data['message']);

    return $this->email->send();
  }
}