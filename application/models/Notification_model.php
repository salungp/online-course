<?php

class Notification_model extends CI_Model {
  private $table = 'notifications';

  public function __construct() {
    parent::__construct();
  }

  public function create($data) {
    $this->db->insert($this->table, $data);
    return true;
  }

  public function like($key, $val) {
    $this->db->like($key, $val);
    return $this;
  }

  public function where($key, $val) {
    $this->db->where($key, $val);
    return $this;
  }

  public function orderBy($key, $val) {
    $this->db->order_by($key, $val);
    return $this;
  }

  public function get() {
    return $this->db->get($this->table);
  }

  public function getSingle() {
    return $this->get()->row_array();
  }

  public function getAll() {
    return $this->get()->result_array();
  }

  public function update($data) {
    $this->where('id', $data['id']);
    $this->db->update($this->table, $data);
  }

  public function delete($key, $val) {
    $this->db->delete($this->table, [$key => $val]);
  }
}