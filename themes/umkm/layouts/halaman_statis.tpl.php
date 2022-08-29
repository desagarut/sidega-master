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
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <h5><?= $heading ?></h5>
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
            <div class="col-lg-8 entries">
                <article class="entry entry-single" data-aos="fade-up">
            
					<?php if ($halaman_statis == 'informasi_publik'): ?>
                        <?php $this->load->view(Web_Controller::fallback_default($this->theme, '/partials/informasi_publik.php'));?>
                    <?php else: ?>
                        <?php $this->load->view($halaman_statis); ?>
                    <?php endif; ?>
            
                </article>
            </div>
            <?php $this->load->view($folder_themes .'/partials/sidebar.php') ?>
        </div>
    </div>
</section>
	<?php $this->load->view($folder_themes .'/commons/footer') ?>
	<?php $this->load->view($folder_themes . '/commons/for_js') ?>
</body>
</html>