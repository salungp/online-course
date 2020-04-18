<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <b>Kursus</b>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Course</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">
    <?php if ($user['level'] <= 1) : ?>
      <button type="button" style="margin-bottom: 20px;" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
        Tambah kursus
      </button>
    <?php endif; ?>

    <?php echo $this->session->flashdata('message'); ?>
      
    <div class="row" style="margin-bottom: 20px;">
      <div class="col-md-6">
        <form action="<?php echo base_url('course/search'); ?>" method="GET">
          <div class="input-group">
            <input type="text" name="input_search" class="form-control" placeholder="Cari...">
            <div class="input-group-btn">
              <button class="btn btn-success" type="submit">
                <i class="fa fa-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div>  
    </div>

      <div class="row">

      <input type="text" value="<?php echo base_url() ?>" style="display: none;">

      <?php foreach($courses as $course) : ?>
        <?php $author = $this->_user->where('id', $course['author'])->getSingle(); ?>
        <div class="col-md-4">
        <div class="small-box bg-<?php echo $course['theme']; ?>">
        <?php if ($user['level'] <= 1) : ?>
          <a onclick="return window.confirm('Yakin mau dihapus?');" href="<?php echo base_url('course/delete/'.$course['id']); ?>" style="margin: 20px;" class="btn btn-default delete-btn">
            <i class="fa fa-trash"></i>

            <span>Delete</span>
          </a>
        <?php endif; ?>
          <div class="inner">
              <h4 style="font-size: 26px;font-weight: 600;"><?php echo $course['title']; ?></h4>
              <small><?php echo date('M, d Y', strtotime($course['created_at'])); ?></small>
              <b>Oleh <?php echo $author['name']; ?></b>
            </div>
            <a href="<?php echo base_url('course/detail/'.$course['slug']); ?>" class="small-box-footer">Lihat kursus <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <?php echo $this->pagination->create_links(); ?>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php if ($user['level'] <= 1) : ?>
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah kursus</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo base_url('course/create'); ?>" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="title">Judul</label>
            <input type="text" name="title" class="form-control" placeholder="Judul" required>
          </div>

          <div class="form-group">
            <label for="description">Keterangan</label>
            <textarea type="text" name="description" class="form-control" placeholder="Keterangan" required></textarea>
          </div>

          <div class="form-group">
            <label for="media">Media</label>
            <select name="form_media" id="media" class="form-control">
              <option value="">-pilih-</option>
              <option value="upload">Upload</option>
              <option value="link">Link</option>
            </select>
            <div class="media-target"></div>
          </div>

          <div class="form-group">
            <label for="theme">Tema</label>
            <select name="theme" name="tema" id="tema" class="form-control">
              <option value="red">Merah</option>
              <option value="yellow">Kuning</option>
              <option value="blue">Biru</option>
              <option value="green">Hijau</option>
              <option value="purple">Ungu</option>
            </select>
          </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php endif; ?>