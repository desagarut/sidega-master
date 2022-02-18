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
                        <?php if ($tipe == 2): ?>
							<?php $this->load->view($folder_themes.'/partials/statistik_sos.php'); ?>
    					<?php elseif ($tipe == 3): ?>
    						<?php $this->load->view(Web_Controller::fallback_default($this->theme, '/partials/statistics/wilayah.php')); ?>
    					<?php elseif ($tipe == 4): ?>
    						<?php $this->load->view(Web_Controller::fallback_default($this->theme, '/partials/dpt.php')); ?>
    					<?php else: ?>
    					<?php $this->load->view(Web_Controller::fallback_default($this->theme, '/partials/statistik.php')); ?>
    					<?php endif; ?>
            </div>
            <?php $this->load->view($folder_themes .'/partials/sidebar.php') ?>
        </div>
    </div>
</section>
	<?php $this->load->view($folder_themes .'/commons/footer') ?>
	<?php $this->load->view($folder_themes . '/commons/for_js') ?>
    
</body>
</html>