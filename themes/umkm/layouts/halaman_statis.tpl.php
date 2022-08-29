<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view($folder_themes . '/commons/meta') ?>
	<?php $this->load->view($folder_themes . '/commons/for_css') ?>
</head>
<body>

	<?php $this->load->view($folder_themes .'/commons/header') ?>
	<?php // $this->load->view($folder_themes .'/partials/newsticker') ?>
<div class="breadcrumbs">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-6 col-12">
        <div class="breadcrumbs-content">
          <h1 class="page-title"><?= $heading ?></h1>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-12">
        <ul class="breadcrumb-nav">
          <li><a href="<?= site_url("first"); ?>"><i class="lni lni-home"></i> Home</a></li>
          <li><?= $heading ?></li>
        </ul>
      </div>
    </div>
  </div>
</div>
    
<!-- ======= Blog Section ======= -->
<section id="blog" class="blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 entries">
                <article class="entry entry-single" data-aos="fade-up">
            
					<?php if ($halaman_statis == 'informasi_publik'): ?>
                        <?php $this->load->view(Web_Controller::fallback_default($this->theme, '/partials/informasi_publik.php'));?>
                    <?php else: ?>
                        <?php $this->load->view($halaman_statis); ?>
                    <?php endif; ?>
            
                </article>
            </div>
            <div class="col-lg-4 col-12 custom-padding-left">
              <div class="row">
                <?php $this->load->view($folder_themes .'/partials/sidebar.php') ?>
                </div>
                </div>
        </div>
    </div>
</section>
	<?php $this->load->view($folder_themes .'/commons/footer') ?>
	<?php $this->load->view($folder_themes . '/commons/for_js') ?>
</body>
</html>