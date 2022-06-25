<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view($folder_themes . '/commons/meta') ?>
<?php $this->load->view($folder_themes . '/commons/for_css') ?>
</head>
<body data-theme="light">
<?php $this->load->view($folder_themes . '/commons/header') ?>
<?php // $this->load->view($folder_themes .'/partials/newsticker') ?>
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
              <?php 
                    switch ($tipe) {
                        case '0':
                            $page = '/partials/statistics/default';
                            break;
                        case '2':
                            $page = '/partials/statistics/wilayah';
                            break;
                        case '3':
                            $page = '/partials/statistics/regions';
                            break;
                        case '4':
                            $page = '/partials/statistics/dpt';
                        default:
                            $page = '/commons/404';
                            break;
                    }
                ?>
              <?php $this->load->view($folder_themes . $page) ?>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-12 custom-padding-left">
          <div class="row">
            <?php $this->load->view($folder_themes .'/partials/sidebar_statistik.php') ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php $this->load->view($folder_themes .'/commons/footer') ?>
<?php $this->load->view($folder_themes . '/commons/for_js') ?>
</body>
</html>