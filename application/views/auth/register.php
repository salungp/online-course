<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Load meta component -->
  <?php $this->load->view('templates/meta'); ?>
  <title><?php echo $title; ?></title>
</head>
<body class="hold-transition login-page">  
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url(); ?>"><b>ONLINE</b> COURSE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <?php echo $this->session->flashdata('message'); ?>

    <div class="alert alert-warning">
      Silahkan daftar untuk memiliki akses ke dalam aplikasi ini.
    </div>

    <form action="<?php echo base_url('register_new_user'); ?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="name" class="form-control" placeholder="Nama" required>
      </div>

      <div class="form-group has-feedback">
        <input type="text" name="address" class="form-control" placeholder="Alamat" required>
      </div>

      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
      </div>

      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password">
      </div>

      <div class="form-group has-feedback">
        <input type="password" name="password_confirm" class="form-control" placeholder="Konfirmasi password">
      </div>

      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <a href="<?php echo base_url('login'); ?>" class="text-center">Have an account?, Login</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- Load script component -->
<?php $this->load->view('templates/scripts'); ?>
</body>
</html>