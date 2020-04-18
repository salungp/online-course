  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <b>Admin users</b>
      </h1>
      <ol class="breadcrumb">
  <!-- /.content-wrapper -->
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Admin user</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    <?php echo $this->session->flashdata('message'); ?>
      <div class="row">
        <div class="col-xs-12">
          <button type="button" style="margin-bottom: 20px;" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
            Tambah user
          </button>

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data user</h3>

              <div class="box-tools">
                <form action="<?php echo base_url('admin/search'); ?>" method="GET">
                  <div class="input-group input-group-sm hidden-xs" style="width: 150px;">
                    <input type="text" name="input_search" class="form-control pull-right" placeholder="Search">

                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-striped">
                <tr>
                  <th style="width: 10px;">No</th>
                  <th style="width: 80px;">Aksi</th>
                  <th>Nama</th>
                  <th style="width: 80px;">Level</th>
                  <th>Alamat</th>
                  <th>Username</th>
                </tr>
                <?php $i = 1; ?>
                <?php foreach($users as $key) : ?>
                <tr>
                  <td><?php echo $i++; ?>.</td>
                  <td>
                    <div class="btn-group">
                      <a href="<?php echo base_url('admin/edit/'.$key['id']); ?>" class="btn btn-sm btn-primary">
                        <i class="fa fa-pencil"></i>
                      </a>
                      <a onclick="return window.confirm('Semua data photo profile, komentar dan pembayaran akan dihapus.')" href="<?php echo base_url('admin/delete/'.$key['id']); ?>" class="btn btn-sm btn-danger">
                        <i class="fa fa-trash"></i>
                      </a>
                    </div>
                  </td>
                  <td><?php echo $key['name']; ?></td>
                  <td>
                    <?php if ($key['level'] == 1) : ?>
                      <span class="label label-success">Admin</span>
                    <?php else : ?>
                      <span class="label label-warning">Siswa</span>
                    <?php endif; ?>
                  </td>
                  <td><?php echo $key['address']; ?></td>
                  <td><?php echo $key['email']; ?></td>
                </tr>
                <?php endforeach; ?>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Tambah user</h4>
        </div>
        <div class="modal-body">
          <form action="<?php echo base_url('admin/create'); ?>" method="POST">
            <div class="form-group">
              <label for="name">Nama</label>
              <input type="text" name="name" id="name" class="form-control" placeholder="Masukkan nama" required>
            </div>

            <div class="form-group">
              <label for="address">Alamat</label>
              <input type="text" name="address" id="address" class="form-control" placeholder="Masukkan alamat" required>
            </div>

            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required>
            </div>

            <div class="form-group">
              <label for="level">Level</label>
              <select name="level" id="level" class="form-control">
                <option value="">-pilih-</option>
                <option value="1">Admin</option>
                <option value="3">Siswa</option>
              </select>
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <div class="form-group">
              <label for="password_confirm">Password confirmation</label>
              <input type="password" name="password_confirm" id="password_confirm" class="form-control" placeholder="Masukkan password" required>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->