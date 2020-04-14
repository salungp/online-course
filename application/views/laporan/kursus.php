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
        <div class="col-md-6">
          <div class="box">
            <!-- /.box-header -->
            <table class="table table-bordered">
              <tr>
                <th style="width: 10px">No</th>
                <th>Nama kursus</th>
                <th>Pembimbing</th>
                <th>Jumlah murid</th>
                <th>Tanggal</th>
              </tr>
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
            </table>
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->