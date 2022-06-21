<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php /*
	$title = (!empty($judul_kategori))? $judul_kategori: "Berita Terkini";
	if(is_array($title)){
		foreach($title as $item){
			$title = $item;
		}
	}*/
?>
<?php /*
	if (empty($this->input->get('cari')) AND
		((count($slide_galeri) > 0 || count($slide_artikel) > 0)) AND 
			$this->uri->segment(2) != 'kategori') {
		$this->load->view($folder_themes .'/partials/slider');
	}*/
?>
<?php $this->load->view($folder_themes .'/partials/running_text') ?>
<?php $this->load->view($folder_themes .'/partials/slider') ?>
<?php // $this->load->view($folder_themes .'/partials/toko_warga/slider') ?>
<?php $this->load->view($folder_themes .'/partials/tentang') ?>
<?php if(empty($this->input->get('cari')) AND $headline AND $this->uri->segment(2) != 'kategori') : ?>
	<?php $this->load->view($folder_themes .'/partials/headline') ?>
<?php endif ?>
<?php $this->load->view($folder_themes .'/partials/aparatur') ?>
<?php $this->load->view($folder_themes .'/partials/statistik') ?>
<?php $this->load->view($folder_themes .'/partials/portal') ?>
<?php $this->load->view($folder_themes .'/partials/gallery') ?>
<?php $this->load->view($folder_themes .'/partials/sinergi') ?>

<?php //$this->load->view($folder_themes. '/partials/apbdesa-tema.php');?>

<?php // if ($this->setting->covid_data) $this->load->view($folder_themes."/partials/covid.php")?>
<?php // if ($this->setting->covid_desa) $this->load->view($folder_themes."/partials/covid_local.php");?>
<?php //$this->load->view($folder_themes .'/partials/news_list') ?>
<?php //$this->load->view($folder_themes .'/partials/testimonials') ?>
<?php //$this->load->view($folder_themes .'/partials/client') ?>
<?php //$this->load->view($folder_themes .'/partials/pricing') ?>
<?php //$this->load->view($folder_themes .'/partials/faq') ?>
<?php //$this->load->view($folder_themes .'/partials/running_text') ?>
<?php // $this->load->view($folder_themes .'/partials/contact') ?>
