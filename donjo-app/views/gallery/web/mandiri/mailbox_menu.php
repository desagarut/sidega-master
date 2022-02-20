<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<a href="<?= site_url('mailbox_web/form') ?>" class="btn btn-success btn-block margin-bottom">Buat Pesan</a>
<div class="box box-solid">
  <div class="box-header with-border">
    <h4 class="box-title box-warning">Menu</h4>
    <div class="box-tools">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>
    </div>
  </div>
  <div class="box-body no-padding">
    <ul class="nav nav-pills nav-stacked">
      <?php foreach($submenu as $id => $nama_menu) : ?>
      <li class="<?php ($_SESSION['mailbox'] == $id) and print('active') ?>"><a href="<?= site_url("mandiri_web/mandiri/1/3/$id") ?>"><i class="fa fa-inbox"></i>
        <?= $nama_menu ?>
        <span class="label label-danger pull-right"></span></a></li>
      <?php endforeach ?>
    </ul>
  </div>
  
  <!-- /.box-body --> 
  
</div>
