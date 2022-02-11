<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php /*
	$title = (!empty($judul_kategori))? $judul_kategori: "Berita Terkini";
	if(is_array($title)){
		foreach($title as $item){
			$title = $item;
		}
	}
?>
<?php //$this->load->view($folder_themes .'/partials/cek_ktp') ?>
<?php /*
	if (empty($this->input->get('cari')) AND
		((count($slide_galeri) > 0 || count($slide_artikel) > 0)) AND 
			$this->uri->segment(2) != 'kategori') {
		$this->load->view($folder_themes .'/partials/slider');
	}*/
?>

<?php if(empty($this->input->get('cari')) AND $headline AND $this->uri->segment(2) != 'kategori') : ?>
	<?php $this->load->view($folder_themes .'/partials/headline') ?>
<?php endif ?>
<?php $this->load->view($folder_themes .'/partials/about_us') ?>
<?php $this->load->view($folder_themes .'/partials/portal') ?>
<?php $this->load->view($folder_themes .'/partials/counts_section') ?>
<?php $this->load->view($folder_themes .'/partials/service') ?>
<?php $this->load->view($folder_themes .'/partials/news_list') ?>
<?php //$this->load->view($folder_themes .'/partials/testimonials') ?>
<?php //$this->load->view($folder_themes .'/partials/portofolio') ?>
<?php $this->load->view($folder_themes .'/partials/team') ?>
<?php //$this->load->view($folder_themes .'/partials/pricing') ?>
<?php //$this->load->view($folder_themes .'/partials/faq') ?>
<?php $this->load->view($folder_themes .'/partials/contact') ?>
<?php $this->load->view($folder_themes .'/partials/client') ?>

<?php // if ($this->setting->covid_data) $this->load->view($folder_themes."/partials/covid.php")?>
<?php // if ($this->setting->covid_desa) $this->load->view($folder_themes."/partials/covid_local.php");?>
