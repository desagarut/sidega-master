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
            <div class="row" data-aos="fade-up">
                <div class="col-lg-12 d-flex justify-content-center">
                    <ul id="portfolio-flters">
                      <li data-filter="*" class="filter-active">All</li>
                      <li data-filter=".filter-app">App</li>
                      <li data-filter=".filter-card">Card</li>
                      <li data-filter=".filter-web">Web</li>
                    </ul>
                  </div>				
			  </div>
            <div class="row" data-aos="fade-up">
			  <?php $this->load->view($folder_themes . '/partials/gallery') ?>
				<?php // $data['paging_page'] = 'arsip' ?>
				<?php // $this->load->view($folder_themes .'/commons/paging', $data) ?>
            
				<?php $this->load->view($folder_themes .'/partials/sidebar.php') ?>
            </div>
        </div>
    </section>
    
	<?php $this->load->view($folder_themes .'/commons/footer') ?>
	<?php $this->load->view($folder_themes . '/commons/for_js') ?>
	<?php //$this->load->view($folder_themes . '/partials/tawkto') ?>
    
</body>
</html>