<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="single-block">
  <div class="row">
    <?php $this->load->view($folder_themes .'/partials/layanan_online.php') ?>
  </div>
</div>
<div class="single-block">
  <div class="row">
    <?php //$this->load->view($folder_themes .'/widgets/aparatur_desa.php') ?>
    <?php $this->load->view($folder_themes .'/widgets/agenda.php') ?>
  </div>
</div>
<div class="single-block">
  <div class="row">
    <?php $this->load->view($folder_themes .'/widgets/komentar.php') ?>
  </div>
</div>
<div class="single-block">
  <div class="row">
    <?php $this->load->view($folder_themes .'/widgets/menu_kategori.php') ?>
  </div>
</div>
