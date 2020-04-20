  <?php
  $user = $this->_user->where('id', $this->session->userdata('user_logged'))->getSingle();
  $total_nunggak = $this->db->where('user_id', $this->session->userdata('user_logged'))->where('status', 0)->get('user_invoices')->result_array();
  $total_ammount = 0;
  $total_siswa_beyar = 0;
  $siswa_belum_bayar = $this->db->where('status', 1)->get('user_invoices')->result_array();
  $beyar = $this->db->where('status', 0)->get('user_invoices')->result_array();
  $siswa_beyar = 0;
  $siswa_result = 0;
  $userAll = $this->_user->where('level', 3)->getAll();

  foreach($siswa_belum_bayar as $k) {
    $invoice_select = $this->invoice->where('id', $k['invoice_id'])->getSingle();
    $total_siswa_beyar += $invoice_select['total'];
  }

  foreach($beyar as $k) {
    $user = $this->_user->where('id', $k['user_id'])->getAll();
    
    foreach($user as $user_id) {
      $siswa_beyar += 1;
    }
  }

  $siswa_beyar = count($userAll) - $siswa_beyar;

  foreach($total_nunggak as $k) {
    $invoice_select = $this->invoice->where('id', $k['invoice_id'])->getSingle();
    $total_ammount += $invoice_select['total'];
  }
  ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <b>Pembayaran</b>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo base_url(); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Invoice</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content container-fluid">
    <?php $user = $this->_user->where('id', $this->session->userdata('user_logged'))->getSingle(); ?>
    <?php if ($user['level'] <= 1) : ?>
    <div class="row">
      <div class="col-md-3">
        <div class="small-box bg-green" style="height: 105px;">
          <div class="inner">
            <h3 style="font-size: 26px;"><sup style="font-size: 20px">Rp.</sup><?php echo number_format($total_siswa_beyar, 0, ',', '.'); ?></h3>

            <p>Pemasukan</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo $siswa_beyar; ?></h3>

            <p>Siswa belum bayar</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-8">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
          Tambah tagihan
        </button>

        <div class="box" style="margin-top: 20px">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style="width: 10px">No</th>
                <th>Nama</th>
                <th style="width: 100px">Status</th>
                <th style="width: 130px">Jumlah</th>
                <th style="width: 140px">Tandai sudah lunas</th>
                <th style="width: 100px">Tanggal</th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 1; ?>
              <?php foreach($user_invoice as $k) : ?>
              <?php $invoice = $this->invoice->where('id', $k['invoice_id'])->getSingle(); ?>
              <?php $siswa = $this->_user->where('id', $k['user_id'])->getSingle(); ?>
              <div class="modal fade" id="modal-<?php echo $k['id']; ?>">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title">Pesan</h4>
                    </div>
                    <div class="modal-body">
                      <p>Dengan klik tombol lanjut maka anda siswa sudah membayar.</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                      <a href="<?php echo base_url('invoice/acc/'.$k['id']); ?>" class="btn btn-primary">Lanjut</a>
                    </div>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->
              <tr>
                <td><?php echo $i++; ?>.</td>
                <td><?php echo $siswa['name']; ?></td>
                <td>
                  <?php if($k['status'] == 1) : ?>
                    <span class="label label-success">Tuntas</span>
                  <?php else : ?>
                    <span class="label label-danger">Belum tuntas</span>
                  <?php endif; ?>
                </td>
                <td>Rp.<?php echo number_format($invoice['total'], 0, ',', '.'); ?></td>
                <td>
                  <?php if($k['status'] == 0) : ?>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-<?php echo $k['id']; ?>">
                    ACC
                  </button>
                  <?php else : ?>
                    <span class="label label-success" disabled>Sudah ter<b>ACC</b></span>
                  <?php endif; ?>
                </td>
                <td><?php echo date('d-m-Y'); ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

      <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Tambah tagihan</h4>
            </div>
            <div class="modal-body">
              <form action="<?php echo base_url('invoice/create'); ?>" method="POST">
                <div class="form-group">
                  <label for="title">Judul</label>
                  <input type="text" name="title" id="title" class="form-control" placeholder="Masukkan judul" required>
                </div>

                <div class="form-group">
                  <label for="date">Tanggal</label>
                  <input type="date" name="date" id="date" class="form-control" required>
                </div>

                <div class="form-group">
                  <label for="ammount">Jumlah</label>
                  <input type="number" name="ammount" id="ammount" class="form-control" placeholder="Masukkan jumlah nominal" required>
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
    <?php else : ?>
    <div class="row">
      <div class="col-md-8">
      <?php echo $this->session->flashdata('message'); ?>
      <div class="box">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th style="width: 10px;">No</th>
              <th>Judul</th>
              <th style="width: 120px;">Pembimbing</th>
              <th style="width: 120px;">Jumlah</th>
              <th style="width: 80px;">Aksi</th>
              <th style="width: 90px;">Tanggal</th>
            </tr>
          </thead>
          <tbody>
          <?php $i = 1; ?>
          <?php foreach($invoices as $key) : ?>
          <?php $author = $this->_user->where('id', $key['author'])->getSingle(); ?>
            <div class="modal fade" id="modal-<?php echo $key['id']; ?>">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Pesan</h4>
                  </div>
                  <div class="modal-body">
                    <p>Dengan klik tombol lanjut maka anda sudah siap untuk membayar uang kursus.</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <a href="<?php echo base_url('invoice/next/'.$key['id']); ?>" class="btn btn-primary">Lanjut</a>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
              <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <tr>
              <td><?php echo $i++; ?>.</td>
              <td><?php echo $key['title']; ?></td>
              <td><?php echo $author['name']; ?></td>
              <td>Rp.<?php echo number_format($key['total'], 2, ',', '.'); ?></td>
              <?php $check = $this->db->where('invoice_id', $key['id'])->where('user_id', $this->session->userdata('user_logged'))->get('user_invoices')->row_array(); ?>
              <td>
                <?php if (!$check) : ?>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-<?php echo $key['id']; ?>">
                  ACC
                </button>
                <?php else : ?>
                  <?php if ($check['status'] == 1) { ?>
                    <span class="label label-success">Selesai</span>
                  <?php } else if($check['status'] == 0) { ?>
                    <span class="label label-warning">Pending</span>
                  <?php } ?>
                <?php endif; ?>
              </td>
              <td><?php echo date('d-m-Y', strtotime($key['date'])); ?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      </div>
      </div>
    </div>
    <?php endif; ?>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->