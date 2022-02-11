<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- ======= Header ======= -->

<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">
  <img src="<?= gambar_desa($desa['logo']) ?>" alt="Logo <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?>" class="img-fluid" width="35px" height="35px">&nbsp;&nbsp;
    <p class="logo mr-auto" style="color:#FFC; font-size:10px"> 
    <a href="<?= site_url('first') ?>"> 
    <span><?= ucfirst($this->setting->sebutan_desa)?> <?= $desa['nama_desa']; ?></span>
      <br/><?= ucfirst($this->setting->sebutan_kecamatan_singkat)?> <?= $desa['nama_kecamatan']; ?> <?= ucfirst($this->setting->sebutan_kabupaten_singkat)?> <?= $desa['nama_kabupaten']; ?>
      <br/>Prov. Jawa Barat, Indonesia
      </p></a>
    <?php $this->load->view($folder_themes .'/commons/nav') ?>
  </div>
</header>
<!-- End Header --> 

