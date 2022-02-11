<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view($folder_themes . '/commons/meta') ?>
	<?php $this->load->view($folder_themes . '/commons/for_css') ?>
</head>
<body>
<main>
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <div class="d-flex justify-content-between align-items-center">
          <h2>Arsip Artikel </h2>
          <ol>
            <li><a href="<?= site_url('first') ?>">Home</a></li>
            <li>Arsip Artikel</li>
          </ol>
        </div>

      </div>
    </section><!-- End Breadcrumbs -->
	<?php $this->load->view($folder_themes .'/commons/header') ?>
	<?php // $this->load->view($folder_themes .'/partials/newsticker') ?>
				<?php $this->load->view($folder_themes . '/partials/archive') ?>
				<?php $data['paging_page'] = 'arsip' ?>
				<?php $this->load->view($folder_themes .'/commons/paging', $data) ?>
		<?php // $this->load->view($folder_themes .'/partials/sidebar.php') ?>
	<?php $this->load->view($folder_themes .'/commons/footer') ?>
	<?php $this->load->view($folder_themes . '/commons/for_js') ?>
	<?php $this->load->view($folder_themes . '/widgets/chat') ?>
</main>

</body>
</html>