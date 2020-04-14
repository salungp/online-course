<?php
$user = $this->db->get_where('users', ['id' => $this->session->userdata('user_logged')])->row_array();
$notif = $this->Notification_model->orderBy('id', 'desc')->getAll();
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Load meta component -->
  <?php $this->load->view('templates/meta'); ?>
  <title><?php echo $title; ?></title>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
  <!-- Load navbar component -->
  <?php $this->load->view('templates/navbar', ['user' => $user, 'notif' => $notif]); ?>

  <!-- Load Sidebar component -->
  <?php $this->load->view('templates/sidebar', ['user' => $user]); ?>