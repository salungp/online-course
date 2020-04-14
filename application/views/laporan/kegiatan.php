<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <b>Laporan kegiatan</b>
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo base_url(); ?>">Laporan</a></li>
        <li class="active">Kegiatan</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">
    
    <a href="" class="btn btn-default btn-print"><i class="fa fa-print"></i> Print</a>
    <a href="<?php echo base_url('laporan/kegiatan_export_excel'); ?>" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Excel</a>

    <div style="margin-bottom: 20px;"></div>
    <div class="row">
        <div class="col-md-6">
          <div class="box">
            <!-- /.box-header -->
            <table class="table table-bordered">
              <tr>
                <th style="width: 10px">No</th>
                <th>Kursus</th>
                <th>Kegiatan</th>
                <th>Tanggal</th>
              </tr>
              <?php $i = 1; ?>
              <?php foreach($activities as $key) : ?>
              <?php $course = $this->_course->where('id', $key['course_id'])->getSingle(); ?>
              <tr>
                <td><?php echo $i++; ?>.</td>
                <td><?php echo $course['title']; ?></td>
                <td><?php echo $key['text']; ?></td>
                <td><?php echo date('d-m-Y', strtotime($key['date'])); ?></td>
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