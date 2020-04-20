<?php
$user = $this->db->get_where('users', ['id' => $this->session->userdata('user_logged')])->row_array();
$notif = $this->Notification_model->orderBy('id', 'desc')->getAll();
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Load meta component -->
  <?php $this->load->view('templates/meta'); ?>
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'); ?>">
  <title>Laporan kursus</title>
</head>
<body class="hold-transition skin-blue fixed sidebar-mini">
<!-- Load navbar component -->
<?php $this->load->view('templates/navbar', ['user' => $user, 'notif' => $notif]); ?>

<!-- Load Sidebar component -->
<?php $this->load->view('templates/sidebar', ['user' => $user]); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <b>Laporan kursus</b>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>">Laporan</a></li>
        <li class="active">Kursus</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    
    <a href="" class="btn btn-default btn-print"><i class="fa fa-print"></i> Print</a>
    <a href="<?php echo base_url('laporan/kursus_export_excel'); ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</a>

    <div style="margin-bottom: 20px;"></div>
    <div class="row">
        <div class="col-md-8">
          <div class="box table-responsive box-body">
            <!-- /.box-header -->
            <table id="kursus-table" class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">No</th>
                  <th>Nama kursus</th>
                  <th>Pembimbing</th>
                  <th>Jumlah murid</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach($courses as $key) : ?>
                <?php $author = $this->_user->where('id', $key['author'])->getSingle(); ?>
                <tr>
                  <td><?php echo $i++; ?>.</td>
                  <td><?php echo $key['title']; ?></td>
                  <td><?php echo $author['name']; ?></td>
                  <td><?php echo $student_total; ?></td>
                  <td><?php echo date('d-m-Y', strtotime($key['created_at'])); ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th style="width: 10px">No</th>
                  <th>Nama kursus</th>
                  <th>Pembimbing</th>
                  <th>Jumlah murid</th>
                  <th>Tanggal</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
<footer class="main-footer">
  <!-- Default to the left -->
  <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="<?php echo 'https://mandesa.co.id'; ?>">Mandesa</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

  <?php $this->load->view('templates/scripts'); ?>
  <!-- DataTables -->
  <script src="<?php echo base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
  <script>
    $(function() {
      $('#kursus-table').DataTable()
    })
  </script>
  </body>
  </html>