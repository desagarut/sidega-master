<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper"> 
  
  <!-- Content Header (Page header) -->
  
  <section class="content-header">
    <h1> Mailbox </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Mailbox</li>
    </ol>
  </section>
  
  <!-- Main content -->
  
  <section class="content">
    <div class="row">
    <div class="col-md-3">
      <?php $this->load->view('web/mandiri/mailbox_menu.php');?>
    </div>
    
    <!-- /.col -->
    
    <div class="col-md-9">
      <div class="box box-info">
        <div class="box-header">
          <h3 class="box-title">Pesan</h3>
          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
        </div>
        
        <!-- /.box-header -->
        
        <div class="box-body table-responsive">
          <table class="table table-hover">
            <tr>
              <th>ID</th>
              <th>Aksi</th>
              <th>Subyek</th>
              <th>Status</th>
              <th>Waktu</th>
            </tr>
            <?php foreach($main_list as $data) : ?>
            <tr class="<?php ($data['status']!=1) and print('unread')?>">
              <td><?=$data['no']?></td>
              <td nowrap><a href="<?=site_url("mailbox_web/baca_pesan/{$kat}/{$data['id']}")?>" class="btn btn-social bg-navy btn-box btn-sm" title="Baca pesan"><i class="fa fa-envelope-o"></i> Baca</a>
                <?php if($kat != 2) : ?>
                <?php if ($data['status'] == 1): ?>
                <a href="<?=site_url('mailbox_web/pesan_unread/'.$data['id'])?>" class="btn bg-navy btn-box btn-sm" title="Tandai sebagai belum dibaca"><i class="fa fa-envelope-o"></i></a>
                <?php else : ?>
                <a href="<?=site_url('mailbox_web/pesan_read/'.$data['id'])?>" class="btn bg-navy btn-box btn-sm" title="Tandai sebagai sudah dibaca"><i class="fa fa-envelope-open-o"></i></a>
                <?php endif; ?>
                <?php endif ?></td>
              <td width="40%"><?=$data['subjek']?></td>
              <td><?=$data['status'] == 1 ? 'Sudah Dibaca' : 'Belum Dibaca' ?></td>
              <td nowrap><?=tgl_indo2($data['tgl_upload'])?></td>
            </tr>
            <?php endforeach ?>
          </table>
        </div>
        
        <!-- /.box-body --> 
        
      </div>
      
      <!-- /.box --> 
      
    </div>
    <!-- /.col --> 
    
    <!-- /.row --> 
    
  </section>
  
  <!-- /.content --> 
  
</div>

<!-- /.content-wrapper --> 

<!--

<section class="content no-padding">

	<div class="row">

		<div class="col-sm-12">

			<div class="box-header">

				<a href="<?= site_url('mailbox_web/form') ?>" class="btn text-white btn-box btn-social btn-success btn-md inline-block" title="Tulis Pesan"><i class="fa fa-plus"></i> Tulis Pesan</a>

			</div>

			<div class="box-body">

				<ul class="nav nav-tabs">

					<?php foreach($submenu as $id => $nama_menu) : ?>

						<li class="<?php ($_SESSION['mailbox'] == $id) and print('active') ?>">

							<a href="<?= site_url("mandiri_web/mandiri/1/3/$id") ?>"><?= $nama_menu ?></a>

						</li>

					<?php endforeach ?>

				</ul>

			</div>

		</div>

		<div class="col-sm-12">

			<div class="box-body">

				<div class="table-responsive">

					<table class="table table-bordered dataTable">

						<thead class="bg-gray disabled color-palette">

							<tr>

								<th>No</th>

								<th>Aksi</th>

								<th>Subjek Pesan</th>

								<th>Status Pesan</th>

								<th>Dikirimkan Pada</th>

							</tr>

						</thead>

						<tbody>

							<?php foreach($main_list as $data) : ?>

								<tr class="<?php ($data['status']!=1) and print('unread')?>">

									<td><?=$data['no']?></td>

									<td nowrap>

										<a href="<?=site_url("mailbox_web/baca_pesan/{$kat}/{$data['id']}")?>" class="btn bg-navy btn-box btn-sm" title="Baca pesan"><i class="fa fa-list">&nbsp;</i></a>

										<?php if($kat != 2) : ?>

											<?php if ($data['status'] == 1): ?>

												<a href="<?=site_url('mailbox_web/pesan_unread/'.$data['id'])?>" class="btn bg-navy btn-box btn-sm" title="Tandai sebagai belum dibaca"><i class="fa fa-envelope-o"></i></a>

												<?php else : ?>

													<a href="<?=site_url('mailbox_web/pesan_read/'.$data['id'])?>" class="btn bg-navy btn-box btn-sm" title="Tandai sebagai sudah dibaca"><i class="fa fa-envelope-open-o"></i></a>

											<?php endif; ?>

										<?php endif ?>

									</td>

									<td width="40%"><?=$data['subjek']?></td>

									<td><?=$data['status'] == 1 ? 'Sudah Dibaca' : 'Belum Dibaca' ?></td>

									<td nowrap><?=tgl_indo2($data['tgl_upload'])?></td>

								</tr>

							<?php endforeach ?>

						</tbody>

					</table>

				</div>

			</div>

		</div>

	</div>

</section>-->