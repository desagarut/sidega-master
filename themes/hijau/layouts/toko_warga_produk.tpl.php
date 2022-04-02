<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view($folder_themes . '/commons/meta') ?>
	<?php $this->load->view($folder_themes . '/commons/for_css') ?>
</head>
<body>

	<?php $this->load->view($folder_themes .'/commons/header') ?>
    
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <h5>Artikel</h5>
      <ol>
        <li><a href="<?= site_url("first"); ?>">Home</a></li>
        <li><?= $heading ?></li>
      </ol>
    </div>
  </div>
</section><!-- End Breadcrumbs -->
<section id="team" class="team section-bg" style="padding-top:60px">
  <div class="container">
        	<div class="row">
            <div class="col-lg-12 entries">
                  <?php $this->load->view($folder_themes . '/partials/toko_warga/index_produk.php') ?>
            </div>
				<?php // $this->load->view($folder_themes .'/partials/sidebar.php') ?>
            </div>
        </div>
    </section>
    
	<?php $this->load->view($folder_themes .'/commons/footer_min') ?>
	<?php $this->load->view($folder_themes . '/commons/for_js') ?>
    
</body>
</html>