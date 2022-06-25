<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view($folder_themes . '/commons/meta') ?>
<?php $this->load->view($folder_themes . '/commons/for_css') ?>
</head>
<body data-theme="light">
<?php $this->load->view($folder_themes . '/commons/header') ?>
<script>
	const enable3d = <?=$this->setting->statistik_chart_3d ?> ? true : false;
</script>
<div class="breadcrumbs">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-6 col-12">
        <div class="breadcrumbs-content">
          <h1 class="page-title">Statistik</h1>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-12">
        <ul class="breadcrumb-nav">
          <li><a href="<?= site_url("first"); ?>"><i class="lni lni-home"></i> Home</a></li>
          <li>statistik</li>
        </ul>
      </div>
    </div>
  </div>
</div>

<!-- ======= Blog Section ======= -->
<section class="item-details section">
  <div class="container">
    <div class="product-details-info">
      <div class="row">
        <div class="col-lg-8 col-12 custom-padding-left">
          <div class="single-block">
            <div class="row">
              <div class="col-lg-8" data-aos="fade-up">
                <?php if ($tipe == 2): ?>
                <?php $this->load->view($folder_themes.'/partials/statistik_sos.php'); ?>
                <?php elseif ($tipe == 3): ?>
                <?php $this->load->view(Web_Controller::fallback_default($this->theme, '/partials/statistics/wilayah.php')); ?>
                <?php elseif ($tipe == 4): ?>
                <?php $this->load->view(Web_Controller::fallback_default($this->theme, '/partials/statistics/dpt.php')); ?>
                <?php else: ?>
                <?php $this->load->view(Web_Controller::fallback_default($this->theme, '/partials/statistik.php')); ?>
                <?php endif; ?>
              </div>
              <?php $this->load->view($folder_themes .'/partials/sidebar_statistik.php') ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php $this->load->view($folder_themes .'/commons/footer') ?>
<?php $this->load->view($folder_themes .'/commons/for_js') ?>
</body>
</html>