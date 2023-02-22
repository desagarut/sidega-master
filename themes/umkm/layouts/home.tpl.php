<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php // $this->load->view($folder_themes .'/partials/running_text') ?>
<?php //$this->load->view($folder_themes .'/partials/slider_berita') ?>
<?php
	if (empty($this->input->get('cari')) AND
		((count($slide_galeri) > 0 || count($slide_artikel) > 0)) AND 
			$this->uri->segment(2) != 'kategori') {
		$this->load->view($folder_themes .'/partials/slider_berita');
	}
?>

<?php $this->load->view($folder_themes .'/partials/umkm_list') ?>
<?php $this->load->view($folder_themes .'/partials/tentang') ?>
<?php if(empty($this->input->get('cari')) AND $headline AND $this->uri->segment(2) != 'kategori') : ?>
	<?php $this->load->view($folder_themes .'/partials/headline') ?>
<?php endif ?>
<?php $this->load->view($folder_themes .'/partials/aparatur') ?>
<?php $this->load->view($folder_themes .'/partials/sinergi') ?>
<?php if (!is_null($transparansi)) $this->load->view("$folder_themes/partials/apbdesa-tema", $transparansi); ?>
<?php $this->load->view($folder_themes .'/partials/gallery') ?>
<?php $this->load->view($folder_themes .'/partials/gallery_youtube_front') ?>
