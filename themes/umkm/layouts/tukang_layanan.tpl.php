<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view($folder_themes . '/commons/meta') ?>
<?php $this->load->view($folder_themes . '/commons/for_css') ?>
</head>
<body>
<?php $this->load->view($folder_themes .'/commons/header') ?>
<section class="trending-product section" style="margin-top: 12px;">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="section-title">
          <h2>Informasi Usaha Jasa Pertukangan
          </h2>
          <p>Informasi usaha jasa pertukangan yang ada di <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?></p>
        </div>
      </div>
    </div>
<!-- End Breadcrumbs -->

	<?php $this->load->view($folder_themes . '/partials/tukang/index_layanan.php') ?>
    <?php $this->load->view($folder_themes .'/partials/umkm_list') ?>

	<?php $this->load->view($folder_themes .'/commons/footer') ?>
    <?php $this->load->view($folder_themes . '/commons/for_js') ?>
</body>
</html>