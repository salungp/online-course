<?php

class Email extends CI_Model {
  public function __construct() {
    parent::__construct();
  }

  public function send($data) {
    $config['mailtype'] = $data['mailtype'];
    $config['protocol'] = 'smtp';
    $config['smtp_host'] = 'ssl://smtp.mailtrap.io';
    $config['smtp_user'] = 'salungprastyo99@gmail.com';
    $config['smtp_password'] = '089698425864';
    $config['smtp_port'] = 2525;
    $config['newline'] = "\r\n";

    $this->load->library('email', $config);

    $this->email->from($data['from'], $data['begining']);
    $this->email->to($data['to']);
    $this->email->subject($data['subject']);
    $this->email->message($data['message']);

    return $this->email->send();
  }
}