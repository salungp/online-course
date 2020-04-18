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
  <title>Laporan pembayaran</title>
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
        <b>Laporan pembayaran</b>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>">Laporan</a></li>
        <li class="active">Pembayaran</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    
    <a href="" class="btn btn-default btn-print"><i class="fa fa-print"></i> Print</a>
    <a href="<?php echo base_url('laporan/pembayaran_export_excel'); ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</a>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-filter">
      <i class="fa fa-exchange"></i>
      Filter
    </button>

    <div style="margin-bottom: 20px;"></div>
      <div class="row">
        <div class="col-md-8">
          <div class="box table-responsive box-body">
            <!-- /.box-header -->
            <table id="invoice-table" class="table table-bordered">
              <thead>
                <tr>
                  <th style="width: 10px">No</th>
                  <th>Nama siswa</th>
                  <th>Keterangan</th>
                  <th>Status</th>
                  <th>Jumlah</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach($invoices as $key) : ?>
                <tr>
                  <td><?php echo $i++; ?>.</td>
                  <td><?php echo $key['name']; ?></td>
                  <td><?php echo $key['title']; ?></td>
                  <td>
                    <?php if($key['status'] == 1) : ?>
                      <span class="label label-success">Sudah bayar</span>
                    <?php else : ?>
                      <span class="label label-danger">Belum bayar</span>
                    <?php endif; ?>
                  </td>
                  <td>Rp.<?php echo number_format($key['total'], 0, ',', '.'); ?></td>
                  <td><?php echo date('d-m-Y', strtotime($key['date'])); ?></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
              <tfoot>
                <tr>
                  <th style="width: 10px">No</th>
                  <th>Nama siswa</th>
                  <th>Keterangan</th>
                  <th>Status</th>
                  <th>Jumlah</th>
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

<div class="modal fade" id="modal-filter">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Filter data</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url('laporan/filter'); ?>" method="GET">
          <input type="hidden" name="data" value="pembayaran">
          <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
              <option value="">all</option>
              <option value="1">Sudah bayar</option>
              <option value="0">Belum bayar</option>
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Filter</button>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Main Footer -->
<footer class="main-footer">
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">Nothing</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane active" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:;">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

  <?php $this->load->view('templates/scripts'); ?>
  <!-- DataTables -->
  <script src="<?php echo base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
  <script>
    $(function() {
      $('#invoice-table').DataTable()
    })
  </script>
  </body>
  </html>