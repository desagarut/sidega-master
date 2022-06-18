<style type="text/css">
	.text-white {
		color: white;
	}
	.pengaturan {
		float: left;
		padding-left: 10px;
	}
	.modal-body
	{
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
			<li><a href='<?=site_url()?>beranda'><i class='fa fa-home'></i> Home</a></li>
		</ol>
	</section>
    
	<section class='content' id="maincontent">
        <div class='row'>
			<?php $this->load->view('home/peta.php');?>
            <?php $this->load->view('home/umkm.php');?>
            <?php //$this->load->view('home/program_bantuan.php');?>
			<?php $this->load->view('home/layanan.php');?>
            
        </div>
        <div class='row'>
            <?php //$this->load->view('home/info.php');?>
			<?php //$this->load->view('home/layanan.php');?>
        </div>
        <div class='row'>
		<?php $this->load->view('home/rekap_sppt.php');?>
            <?php $this->load->view('home/warga_login.php');?>
			<?php $this->load->view('home/aparat_login.php');?>
			<?php $this->load->view('home/pengunjung.php');?>
		</div>
        <div class='row'>
            <?php $this->load->view('home/helpdesk.php');?>
            <?php $this->load->view('home/changelog.php');?>
        </div>
	</section>
</div>



