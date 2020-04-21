<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <b>Edit user</b>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url('admin'); ?>">User</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

    <?php echo $this->session->flashdata('message'); ?>
      <div class="row">
        <div class="col-md-8">
          <div class="box">
            <div class="box-header with-border">
              <h4>Edit user</h4>
            </div>
            <div class="box-body">
              <form action="<?php echo base_url('admin/update/'.$user['id']); ?>" method="POST" enctype="multipart/form-data">
                  <div class="image-upload-wrapper" style="background: url(<?php echo base_url($user['profile_picture']); ?>) center center no-repeat !important;background-size: cover !important;">
                    <label for="image-upload"><i class="fa fa-pencil"></i></label>
                    <input type="file" name="profile_picture" onchange="previewImage()" id="image-upload" placeholder="Password">
                </div>

                <div class="form-group">
                  <label for="name">Nama</label>
                  <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama" required value="<?php echo $user['name']; ?>">
                </div>

                <div class="form-group">
                  <label for="address">Alamat</label>
                  <input type="text" name="address" id="address" class="form-control" placeholder="Masukkan alamat" required value="<?php echo $user['address']; ?>">
                </div>

                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required value="<?php echo $user['email']; ?>">
                </div>

                <div class="form-group">
                  <label for="level">Level</label>
                  <select name="level" id="level" class="form-control">
                    <option value="">-pilih-</option>
                    <option value="1" <?php echo $user['level'] == 1 ? 'selected' : ''; ?>>Admin</option>
                    <option value="3" <?php echo $user['level'] == 3 ? 'selected' : ''; ?>>Siswa</option>
                  </select>
                </div>

                <div class="form-group">
                  <label for="password">New password</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password">
                </div>

                <div class="form-group">
                  <label for="password_confirm">Password confirmation</label>
                  <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Masukkan password">
                </div>
              </div>
              <div class="box-footer">
                <a href="<?php echo base_url('admin'); ?>" class="btn btn-default">Kembali</a>
                <button type="submit" class="btn btn-primary">Update</button>
              </form>
              </div>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->