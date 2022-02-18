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

<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">

	<div class="d-flex justify-content-between align-items-center">
	  <h5>Statistik</h5>
	  <ol>
		<li><a href="<?= site_url("first"); ?>">Home</a></li>
		<li><?= $heading ?></li>
	  </ol>
	</div>

  </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Blog Section ======= -->
<section id="blog" class="blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-8" data-aos="fade-up">
            <?php 
                switch ($tipe) {
                    case '0':
                        $page = '/partials/statistics/default';
                        break;
                    case '2':
                        $page = '/partials/statistics/default';
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
            <?php $this->load->view($folder_themes .'/partials/sidebar.php') ?>
        </div>
    </div>
</section>
	<?php $this->load->view($folder_themes .'/commons/footer') ?>
	<?php $this->load->view($folder_themes . '/commons/for_js') ?>
    
</body>
</html>