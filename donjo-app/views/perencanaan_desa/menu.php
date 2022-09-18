
<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="box box-info">
	<div class="box-header">
		<h5 class="box-title">Menu Musdus</h5>
		<div class="box-tools">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>
	<div class="box-body no-padding">
		<ul class="nav nav-pills nav-stacked">
			<li class=" <?php ($this->tab_ini == 1) and print('active') ?>"><a href="<?= site_url('perencanaan_desa') ?>"> Usulan Masyarakat</a></li>
			<li class=" <?php ($this->tab_ini == 2) and print('active') ?>"><a href="<?= site_url('perencanaan_desa_program_masuk_desa') ?>"> Program Kegiatan Masuk Ke Desa</a></li>
			<li class=" <?php ($this->tab_ini == 3) and print('active') ?>"><a href="<?= site_url('perencanaan_desa_pembiayaan') ?>"> Rencana Pembiayaan</a></li>
			<li class=" <?php ($this->tab_ini == 4) and print('active') ?>"><a href="<?= site_url('perencanaan_desa/kerjasama_antar_desa') ?>"> Kerjasama Antar Desa</a></li>
			<li class=" <?php ($this->tab_ini == 5) and print('active') ?>"><a href="<?= site_url('perencanaan_desa/kerjasama_pihak_ketiga') ?>"> Kerjasama Pihak Ketiga</a></li>
		</ul>
	</div>
</div>


<div class="box">
	<div class="box-header">
		<h5 class="box-title">Menu Penentuan Prioritas</h5>
		<div class="box-tools">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>
	<div class="box-body no-padding">
		<ul class="nav nav-pills nav-stacked">
			<li class="<?php ($this->tab_ini == 6) and print('active') ?>"><a href="<?= site_url('perencanaan_desa/usulan_dusun') ?>"> Daftar Usulan Dusun</a></li>
			<li class="<?php ($this->tab_ini == 7) and print('active') ?>"><a href="<?= site_url('perencanaan_desa_polling/daftar_polling') ?>"> Penentuan Prioritas Desa</a></li>
			<li class="<?php ($this->tab_ini == 8) and print('active') ?>"><a href="<?= site_url('perencanaan_desa/hasil_polling') ?>"> Hasil Penentuan Prioritas Desa</a></li>
		</ul>
	</div>
</div>

<div class="box">
	<div class="box-header">
		<h5 class="box-title">Menu RKP Desa</h5>
		<div class="box-tools">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
		</div>
	<div class="box-body no-padding">
		<ul class="nav nav-pills nav-stacked">
			<li class="<?php ($this->tab_ini == 9) and print('active') ?>"><a href="<?= site_url('perencanaan_desa/penetapan_rkpdes') ?>">Penetapan RKPDes</a></li>
			<li class="<?php ($this->tab_ini == 10) and print('active') ?>"><a href="<?= site_url('perencanaan_desa/rkpdes') ?>"> RKP Desa</a></li>
			<li class="<?php ($this->tab_ini == 11) and print('active') ?>"><a href="<?= site_url('perencanaan_desa/durkpdes') ?>"> DU-RKP Desa</a></li>
		</ul>
	</div>
</div>


