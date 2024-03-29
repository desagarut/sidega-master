<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<style type="text/css">
	.text-white {
		color: white;
	}

	.pengaturan {
		float: left;
		padding-left: 10px;
	}

	.modal-body {
		overflow-y: auto;
		height: 400px;
		margin-left: 5px;
		margin-right: 5px;
	}
</style>
<div class="content-wrapper">
	<section class='content-header'>
		<h1>Home</h1>
		<ol class='breadcrumb'>
			<li><a href='<?= site_url() ?>beranda'><i class='fa fa-home'></i> Home</a></li>
		</ol>
	</section>

	<section class='content' id="maincontent">
		<div class='row'>
			<div class="col-md-8">
				<?php $this->load->view('home/peta.php'); ?>
			</div>
			<div class="col-md-4">
				<?php $this->load->view('home/selamat_datang.php'); ?>
				<?php $this->load->view('home/link_tupoksi.php'); ?>
				<?php $this->load->view('home/umkm.php'); ?>


			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<?php $this->load->view('home/umkm.php'); ?>
			</div>
			<div class="col-md-8">
				<?php $this->load->view('home/layanan.php'); ?>
			</div>
		</div>

		<div class='row'>
			<div class="col-md-3">
				<?php $this->load->view('home/pertanahan.php'); ?>
			</div>
			<div class="col-md-3">
				<?php $this->load->view('home/rekap_sppt.php'); ?>
			</div>
			<div class="col-md-3">
				<?php $this->load->view('home/pembangunan.php'); ?>
			</div>
			<div class="col-md-3">
				<?php $this->load->view('home/kependudukan_2.php'); ?>
			</div>
		</div>
		<div class='row'>
			<div class="col-md-4">
				<?php $this->load->view('home/artikel.php'); ?>
			</div>
			<div class="col-md-4">
				<?php $this->load->view('home/gallery.php'); ?>
			</div>
			<div class="col-md-4">
				<?php $this->load->view('home/gallery_youtube.php'); ?>
			</div>
		</div>
		<div class='row'>
			<div class="col-md-3">
				<?php $this->load->view('home/aparat_login.php'); ?>
			</div>
			<div class="col-md-3">
				<?php $this->load->view('home/warga_login.php'); ?>
			</div>
			<div class="col-md-3">
				<?php $this->load->view('home/pengunjung.php'); ?>
			</div>
			<?php $this->load->view('home/video.php'); ?>
		</div>
		<div class='row'>
			<?php $this->load->view('home/helpdesk.php'); ?>
			<div class="col-md-4">
				<?php $this->load->view('home/changelog.php'); ?>
			</div>
			<div class="col-md-4">
				<?php $this->load->view('home/cctv.php'); ?>
			</div>
		</div>
	</section>
</div>