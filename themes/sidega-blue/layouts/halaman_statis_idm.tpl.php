<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view($folder_themes . '/commons/meta') ?>
	<?php $this->load->view($folder_themes . '/commons/for_css') ?>
</head>
<body>

	<?php $this->load->view($folder_themes .'/commons/header') ?>
	<?php // $this->load->view($folder_themes .'/partials/newsticker') ?>
<section id="blog" class="blog">
    <div class="container">
        <div class="row">
                    <?php $this->load->view($folder_themes . '/partials/idm_web') ?>
        </div>
    </div>
    <?php //$this->load->view($folder_themes .'/partials/sidebar.php') ?>
</section>
	<?php $this->load->view($folder_themes .'/commons/footer') ?>
	<?php $this->load->view($folder_themes . '/commons/for_js') ?>

	<?php //$this->load->view($folder_themes . '/partials/tawkto') ?>

</body>
</html>