<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php // $this->load->view($folder_themes .'/partials/running_text') ?>
<?php $this->load->view($folder_themes .'/partials/slider_berita') ?>
<?php $this->load->view($folder_themes .'/partials/umkm_list') ?>

<?php if(empty($this->input->get('cari')) AND $headline AND $this->uri->segment(2) != 'kategori') : ?>
	<?php $this->load->view($folder_themes .'/partials/headline') ?>
<?php endif ?>
<?php $this->load->view($folder_themes .'/partials/tentang') ?>
<?php $this->load->view($folder_themes .'/partials/gallery') ?>
<?php $this->load->view($folder_themes .'/partials/sinergi') ?>
