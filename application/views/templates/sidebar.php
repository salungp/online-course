<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

  <!-- Sidebar user panel (optional) -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="<?php echo base_url($user['profile_picture']); ?>" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p><?php echo $user['name']; ?></p>
      <!-- Status -->
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">HEADER</li>
    <!-- Optionally, you can add icons to the links -->
    <li><a href="<?php echo base_url(); ?>"><i class="fa fa-graduation-cap"></i> <span>KURSUS</span></a></li>
    <li><a href="<?php echo base_url('student'); ?>"><i class="fa fa-users"></i> <span>SISWA</span></a></li>
    <li><a href="<?php echo base_url('activity'); ?>"><i class="fa fa-pencil-square-o"></i> <span>KEGIATAN</span></a></li>
    <li><a href="<?php echo base_url('invoice'); ?>"><i class="fa fa-money"></i> <span>PEMBAYARAN</span></a></li>
    <?php if ($user['level'] == 1) : ?>
    <li><a href="<?php echo base_url('admin'); ?>"><i class="fa fa-user"></i> <span>ADMIN USER</span></a></li>
    <?php endif; ?>
    <li class="treeview">
      <a href="#"><i class="fa fa-file-text"></i> <span>LAPORAN</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="<?php echo base_url('laporan/kursus'); ?>">KURSUS</a></li>
        <li><a href="<?php echo base_url('laporan/kegiatan'); ?>">KEGIATAN</a></li>
        <li><a href="<?php echo base_url('laporan/pembayaran'); ?>">PEMBAYARAN</a></li>
      </ul>
    </li>
  </ul>
  <!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>