<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="col-md-4">
    <!--<div class="blog sidebar" data-aos="fade-left">
            <h3 class="sidebar-title">Search</h3>
            <div class="sidebar-item search-form" method="get">
                <form action="<?= site_url('first') ?>">
                <input type="text">
                <button type="submit"><i class="icofont-search"></i></button>
                </form>
            </div>
	</div> -->
    <div class="blog sidebar" data-aos="fade-left" >
		<?php $this->load->view($folder_themes .'/widgets/menu_kelompok.php') ?>
    </div>
    <div class="blog sidebar" data-aos="fade-left" >
		<?php $this->load->view($folder_themes .'/partials/layanan_online.php') ?>
    </div>
    <div class="about-us sidebar" data-aos="fade-left" >
		<?php $this->load->view($folder_themes .'/widgets/aparatur_desa.php') ?>
    </div>
    <div class="about-us sidebar" data-aos="fade-left" >
		<?php $this->load->view($folder_themes .'/widgets/statistik_pengunjung.php') ?>
    </div>
</div>
