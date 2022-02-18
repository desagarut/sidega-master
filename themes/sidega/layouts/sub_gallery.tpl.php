<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view($folder_themes . '/commons/meta') ?>
	<?php $this->load->view($folder_themes . '/commons/for_css') ?>
</head>
<body>

	<?php $this->load->view($folder_themes .'/commons/header') ?>
	<?php //$this->load->view($folder_themes .'/partials/newsticker') ?>
    
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
    
        <div class="d-flex justify-content-between align-items-center">
          <h2><small>Sub Gallery</small></h2>
          <ol>
            <li><a href="<?= site_url("first"); ?>">Home</a></li>
            <li><a href="<?= site_url("first/gallery"); ?>">Gallery</a></li>
            <li>Sub Gallery</li>
          </ol>
        </div>
    
      </div>
    </section><!-- End Breadcrumbs -->
    
			  <?php $this->load->view($folder_themes . '/partials/sub_gallery') ?>
    
	<?php $this->load->view($folder_themes .'/commons/footer') ?>
	<?php $this->load->view($folder_themes . '/commons/for_js') ?>
    
</body>
</html>