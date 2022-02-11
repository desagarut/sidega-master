<?php if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php
	$title = (!empty($judul_kategori))? $judul_kategori: "Berita Terkini";
	if(is_array($title)){
		foreach($title as $item){
			$title = $item;
		}
	}
?>
<?php //$this->load->view($folder_themes .'/partials/cek_ktp') ?>
<?php
	if (empty($this->input->get('cari')) AND
		((count($slide_galeri) > 0 || count($slide_artikel) > 0)) AND 
			$this->uri->segment(2) != 'kategori') {
		$this->load->view($folder_themes .'/partials/slider');
	}
?>

<?php if(empty($this->input->get('cari')) AND $headline AND $this->uri->segment(2) != 'kategori') : ?>
	<?php $this->load->view($folder_themes .'/partials/headline') ?>
<?php endif ?>
<?php $this->load->view($folder_themes .'/partials/stat-modul') ?>
	<section id="news-list">
		<h3 class="content__heading --mb-4 <?php empty($this->input->get('cari')) AND $headline AND $this->uri->segment(2) != 'kategori' AND print('--mt-5') ?>"><i class="fa fa-newspaper-o"></i> <?= $title ?></h3>
		<ul class="content__list">
			<?php if($artikel) : ?>
				<?php foreach($artikel as $article) : ?>
					<?php $data['article'] = $article ?>
					<?php $this->load->view($folder_themes .'/partials/article_list', $data) ?>
				<?php endforeach ?>
				<?php else : ?>
					<?php $data['title'] = $title ?>
					<?php $this->load->view($folder_themes .'/partials/empty_article', $data) ?>
			<?php endif ?>
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		</ul>
		<?php $this->load->view($folder_themes .'/commons/paging') ?>
            <!-- IKLAN DESAGARUT DISPLAY -->
            <ins class="adsbygoogle"
                 style="display:block"
                 data-ad-client="ca-pub-1823410826720847"
                 data-ad-slot="2361238529"
                 data-ad-format="auto"
                 data-full-width-responsive="true"></ins>
            <script>
                 (adsbygoogle = window.adsbygoogle || []).push({});
            </script>
	</section>		
	<?php if ($this->setting->covid_data) $this->load->view($folder_themes."/partials/covid.php")?>
	<?php if ($this->setting->covid_desa) $this->load->view($folder_themes."/partials/covid_local.php");?>
