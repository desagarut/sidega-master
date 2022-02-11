<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php $this->load->view($folder_themes .'/commons/meta') ?>
	<?php $this->load->view($folder_themes .'/commons/for_css') ?>


    <!-- =======================================================
    * Template Name: Gampil - v1
    * Template URL: https://desagarut.net
    * Author: https://desagarut.net
    * License: https://desagarut.net
    ======================================================== -->
</head>

<body>
	<?php $this->load->view($folder_themes .'/commons/header') ?>
	<?php if($this->uri->segment(2) == 'kategori' && empty($judul_kategori)) : ?>
		<?php // $this->load->view($folder_themes .'/commons/404') ?>
	<?php else : ?>
        <main id="main">
        <?php $this->load->view($folder_themes .'/layouts/beranda.tpl.php') ?>
        </main><!-- End #main -->
	<?php endif;?>
  
	<?php $this->load->view($folder_themes .'/commons/footer') ?>
	<?php $this->load->view($folder_themes .'/commons/for_js') ?>
	<?php //$this->load->view($folder_themes . '/widgets/chat') ?>


</body>
</html>