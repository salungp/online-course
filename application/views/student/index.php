<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <b>Siswa</b>
    </h1>
    <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Siswa</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">
    <!-- /.row -->
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Table siswa</h3>

              <div class="box-tools">
                <form action="<?php echo base_url('student/search'); ?>" method="GET">
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
              <table class="table  table-striped">
                <tr>
                  <th>No</th>
                  <th>Nama</th>
                  <th>Alamat</th>
                  <th>Email</th>
                  <th>Status</th>
                  <th>Tanggal daftar</th>
                </tr>
                <?php $i = 1; ?>
                <?php foreach($students as $student) : ?>
                <tr>
                  <td><?php echo $i++.'.'; ?></td>
                  <td><?php echo $student['name']; ?></td>
                  <td><?php echo $student['address']; ?></td>
                  <td><?php echo $student['email']; ?></td>
                  <td><span class="label label-success">active</span></td>
                  <td><?php echo date('m-d-Y', strtotime($student['created_at'])); ?></td>
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