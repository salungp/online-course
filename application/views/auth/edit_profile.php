<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Edit profile
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active"><i class="fa fa-user"></i> User</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">
    <?php echo $this->session->flashdata('message'); ?>

    <div class="row">
      <div class="col-md-8">
        <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Profile</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" action="<?php echo base_url('profile/edit_profile'); ?>" method="POST" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label"></label>

              <div class="col-sm-10">
                <?php $user = $this->_user->where('id', $this->session->userdata('user_logged'))->getSingle(); ?>
                <?php if ($user['profile_picture'] == '') : ?>
                <div class="image-upload-wrapper" style="background: rgba(0,0,0,.2);">
                <?php else : ?>
                <div class="image-upload-wrapper" style="background: url(<?php echo base_url($user['profile_picture']); ?>) center center no-repeat !important;background-size: cover !important;"> 
                <?php endif; ?>
                  <label for="image-upload"><i class="fa fa-pencil"></i></label>
                  <input type="file" name="profile_picture" onchange="previewImage()" id="image-upload" placeholder="Password">
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="name" class="col-sm-2 control-label">Nama</label>

              <div class="col-sm-10">
                <input type="text" name="name" class="form-control" id="name" value="<?php echo $user['name']; ?>" placeholder="Nama">
              </div>
            </div>

            <div class="form-group">
              <label for="address" class="col-sm-2 control-label">Alamat</label>

              <div class="col-sm-10">
                <input type="text" name="address" class="form-control" value="<?php echo $user['address']; ?>" id="address" placeholder="Alamat">
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail3" class="col-sm-2 control-label">Username</label>

              <div class="col-sm-10">
                <input type="text" name="email" class="form-control" id="inputEmail3" value="<?php echo $user['email']; ?>" placeholder="Username">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword3" class="col-sm-2 control-label">Password baru?</label>

              <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="inputPassword3" placeholder="Password">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword4" class="col-sm-2 control-label">Password lama anda</label>

              <div class="col-sm-10">
                <input type="password" name="password_confirmation" class="form-control" id="inputPassword4" placeholder="Password">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword4" class="col-sm-2 control-label"></label>

              <div class="col-sm-10">
                <a href="<?php echo base_url('delete_account'); ?>" onclick="return window.confirm('Yakin mau dihapus?')" style="color: red">Delete account</a>
              </div>
            </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-info pull-right">Simpan</button>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>
      <!-- /.box -->
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->