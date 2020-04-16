<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <b>Detail kursus</b>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li><a href="<?php echo base_url(); ?>">Course</a></li>
      <li class="active">Detail</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="box box-solid">
          <!-- /.box-header -->
          <div class="box-body">
            <h2 style="margin-top: 0;"><b><?php echo $course['title']; ?></b></h2>

            <!-- File content -->
            <?php if($course['type'] === 'upload') : ?>
              <?php $file = explode('/', $course['media']); $file = $file[count($file)-1]; ?>
              <?php
                $ekstensi = explode('.', $file); $ekstensi = $ekstensi[count($ekstensi)-1];
                $image = ['jpg', 'png', 'gif'];
                $video = ['mp4', 'wav', 'avi', 'mkv'];
              ?>
              <div class="card">
                <div class="card-body">
                  <?php if(in_array($ekstensi, $image)) { ?>
                    <img style="max-width: 400px;" src="<?php echo base_url($course['media']); ?>" alt="file" class="img img-thumbnail">
                    <h4><b>File : </b><?php echo $file; ?> <a href="<?php echo base_url($course['media']); ?>" download="<?php echo $file ?>" class="badge bg-green">Download</a></h4>
                  <?php } else if(in_array($ekstensi, $image)) { ?>
                    <video controls class="img-thumbnail" style="max-width: 400px;">
                      <source src="<?php echo base_url($course['media']); ?>" type="video/mp4"></source>
                    </video>
                    <h4><b>File : </b><?php echo $file; ?> <a href="<?php echo base_url($course['media']); ?>" download="<?php echo $file ?>" class="badge bg-green">Download</a></h4>
                  <?php } ?>
                </div>
              </div>
            <?php else : ?>
              <a href="<?php echo $course['media']; ?>"><?php echo $course['media']; ?></a>
            <?php endif; ?>
            <dl>
              <dt>Keterangan</dt>
              <dd><?php echo $course['description']; ?></dd>
              <dt>Tanggal</dt>
              <dd><?php echo date('M, d Y', strtotime($course['created_at'])); ?></dd>
            </dl>

            <h4 style="padding-bottom: 10px;"><b>Komentar</b></h4>

            <!-- Give a width -->
            <div class="row">
              <div class="col-md-8">
                <form action="<?php echo base_url('add_comment/'.$course['id']); ?>" method="POST">
                  <div class="input-group">
                    <input type="text" name="comment" placeholder="Tambahkan komentar" class="form-control">
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default">Comment</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <br>

            <?php $comment = $this->_comment->where('post_id', $course['id'])->getAll(); ?>
            <?php if(count($comment) < 1) : ?>
              <p style="padding-left: 15px;">Tidak ada komentar</p>

            <?php else : ?>
              <?php foreach($comment as $key) : ?>
              <?php $user_comment = $this->_user->where('id', $key['user_id'])->getSingle(); ?>

              <div class="comment" style="border-bottom: 1px solid rgba(0,0,0,.1);padding: 10px 15px;border-top: 1px solid rgba(0,0,0,.1)">
                <div class="comment-image-wrapper">
                  <img src="<?php echo base_url($user_comment['profile_picture']); ?>" class="comment-user-image" alt="User profile">
                </div>
                <div class="comment-text">
                  <h4><b><?php echo $user_comment['name']; ?></b></h4>
                  <p><?php echo $key['text']; ?></p>
                </div>
              </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
    <!-- /.row -->
    <!-- END TYPOGRAPHY -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->