<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view($folder_themes . '/commons/meta') ?>
	<?php $this->load->view($folder_themes . '/commons/for_css') ?>
</head>
<body>
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Status IDM <?= ucwords($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa'])?></h2>
                <ol>
                    <li><a href="<?= site_url('first') ?>">Home</a></li>
                    <li>Status IDM</li>
                </ol>
            </div>
        </div>
    </section><!-- End Breadcrumbs -->
	<?php $this->load->view($folder_themes .'/commons/header') ?>
	<?php // $this->load->view($folder_themes .'/partials/newsticker') ?>
    <main id="main">
        <section>
            <div class="container">
				<?php $this->load->view($folder_themes . '/partials/idm_web') ?>
				<?php // $this->load->view($folder_themes .'/partials/sidebar.php') ?>
			</div>
        </section>
    </main>
	<?php $this->load->view($folder_themes .'/commons/footer') ?>
	<?php $this->load->view($folder_themes . '/commons/for_js') ?>

	<?php $this->load->view($folder_themes . '/widgets/chat') ?>

</body>
</html>