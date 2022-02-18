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
          <h2>Gallery</h2>
          <ol>
            <li><a href="<?= site_url("first"); ?>">Home</a></li>
            <li>Gallery</li>
          </ol>
        </div>
    
      </div>
    </section><!-- End Breadcrumbs -->
    
    <section id="portfolio" class="portfolio blog">
        <div class="container">
        	<div class="row">
            <div class="col-lg-8 entries">
                  <?php $this->load->view($folder_themes . '/partials/gallery') ?>
            </div>
				<?php $this->load->view($folder_themes .'/partials/sidebar.php') ?>
        </div>
        </div>
    </section>
    
	<?php $this->load->view($folder_themes .'/commons/footer') ?>
	<?php $this->load->view($folder_themes . '/commons/for_js') ?>
    
</body>
</html>