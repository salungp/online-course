  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    <b>Kegiatan</b>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Activity</li>
  </ol>
</section>

<!-- Main content -->
<section class="content container-fluid">
  <button type="button" style="margin-bottom: 20px;" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
    Tambah kegiatan
  </button>

  <?php echo $this->session->flashdata('message'); ?>

  <!-- row -->
  <div class="row">
    <div class="col-md-12">
      <!-- The time line -->
      <?php if (count($activities) > 0) : ?>
      <ul class="timeline">
        <!-- timeline time label -->
        <?php foreach($activities as $key) : ?>
        <?php $course = $this->_course->where('id', $key['course_id'])->getSingle(); ?>
        <li class="time-label">
          <span class="bg-red">
            <?php echo date('d, M Y', strtotime($key['date'])); ?>
          </span>
        </li>
        <!-- /.timeline-label -->
        <!-- timeline item -->
        <li>
          <i class="fa fa-edit bg-blue"></i>

          <div class="timeline-item">
            <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>

            <h3 class="timeline-header"><a href="#">Kursus</a> <?php echo $course['title']; ?></h3>

            <div class="timeline-body">
              <?php echo $key['text']; ?>
            </div>
            <div class="timeline-footer">
              <a onclick="return window.confirm('Yakin mau dihapus?');" href="<?php echo base_url('activity/delete/'.$key['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
            </div>
          </div>
        </li>
        <?php endforeach; ?>
        <!-- END timeline item -->
      </ul>
      <?php else : ?>
        <p>Tulis kegiatanmu disini.</p>
      <?php endif; ?>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
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
        <h4 class="modal-title">Tambah kegiatan</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url('activity/create'); ?>" method="POST">
          <div class="form-group">
            <label for="course">Kursus</label>
            <select name="course" id="course" class="form-control">
              <?php foreach($courses as $key) : ?>
                <option value="<?php echo $key['id']; ?>"><?php echo $key['title']; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="text">Keterangan</label>
            <textarea name="text" class="form-control" id="text" placeholder="Masukkan keterangan"></textarea>
          </div>

          <div class="form-group">
            <label for="date">Tanggal</label>
            <input type="date" name="date" class="form-control">
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