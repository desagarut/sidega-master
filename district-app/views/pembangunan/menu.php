
<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<div class="box box-info">
	<div class="box-header">
		<h5 class="box-title">Perencanaan</h5>
		<div class="box-tools">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>
	<div class="box-body no-padding">
		<ul class="nav nav-pills nav-stacked">
			<li class=" <?php ($this->tab_ini == 1) and print('active') ?>"><a href="<?= site_url('pembangunan') ?>">Daftar Usulan TK <?= ucwords($this->setting->sebutan_dusun); ?><span class="badge bg-orange">1</span></a></li>
			<!--<li class=" <?php ($this->tab_ini == 2) and print('active') ?>"><a href="<?= site_url('pembangunan_program_masuk_desa') ?>"> Program Masuk Ke <?= ucwords($this->setting->sebutan_desa); ?></a></li>
			<li class=" <?php ($this->tab_ini == 3) and print('active') ?>"><a href="<?= site_url('pembangunan_pembiayaan/') ?>"> Rencana Pembiayaan</a></li>
			<li class=" <?php ($this->tab_ini == 4) and print('active') ?>"><a href="<?= site_url('pembangunan/kerjasama_antar_desa') ?>"> Kerjasama Antar Desa/Kelurahan</a></li>
			<li class=" <?php ($this->tab_ini == 5) and print('active') ?>"><a href="<?= site_url('pembangunan/kerjasama_pihak_ketiga') ?>"> Kerjasama Pihak Ketiga</a></li>-->
			<li class=""><a href="<?= site_url('rekanan') ?>"> Data Rekanan</a></li>
		</ul>
	</div>
</div>


<div class="box">
	<div class="box-header">
		<h5 class="box-title">Penentuan Prioritas</h5>
		<div class="box-tools">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>
	<div class="box-body no-padding">
		<ul class="nav nav-pills nav-stacked">
			<li class="<?php ($this->tab_ini == 6) and print('active') ?>"><a href="<?= site_url('pembangunan/daftar_usulan_tk_desa') ?>"> Daftar Usulan TK. <?= ucwords($this->setting->sebutan_desa); ?> <span class="badge bg-orange">2</span></a></li>
			<li class="<?php ($this->tab_ini == 7) and print('active') ?>"><a href="<?= site_url('pembangunan/penentuan_prioritas_tk_desa') ?>"> Penentuan Prioritas <span class="badge bg-orange">3</span></a> </li>
			<li class="<?php ($this->tab_ini == 8) and print('active') ?>"><a href="<?= site_url('pembangunan/hasil_prioritas_tk_desa') ?>"> Hasil Penentuan Prioritas <?= ucwords($this->setting->sebutan_desa); ?> <span class="badge bg-orange">4</span></a></li>
		</ul>
	</div>
</div>

<div class="box">
	<div class="box-header">
		<h5 class="box-title">Penetapan</h5>
		<div class="box-tools">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
		</div>
	<div class="box-body no-padding">
		<ul class="nav nav-pills nav-stacked">
			<li class="<?php ($this->tab_ini == 9) and print('active') ?>"><a href="<?= site_url('pembangunan/penetapan_rkp') ?>">Penetapan RKP <?= ucwords($this->setting->sebutan_desa); ?><span class="badge bg-orange">5</span></a></li>
			<li class="<?php ($this->tab_ini == 10) and print('active') ?>"><a href="<?= site_url('pembangunan/daftar_rkp') ?>"> Daftar RKP <?= ucwords($this->setting->sebutan_desa); ?></a></li>
			<li class="<?php ($this->tab_ini == 11) and print('active') ?>"><a href="<?= site_url('pembangunan/durkpdes') ?>"> DU-RKP <?= ucwords($this->setting->sebutan_desa); ?></a></li>
		</ul>
	</div>
</div>

<div class="box">
	<div class="box-header">
		<h5 class="box-title">Pelaksanaan</h5>
		<div class="box-tools">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
		</div>
	<div class="box-body no-padding">
		<ul class="nav nav-pills nav-stacked">
			<li class="<?php ($this->tab_ini == 12) and print('active') ?>"><a href="<?= site_url('pembangunan/pelaksanaan_rkp') ?>">Pelaksanaan RKP <?= ucwords($this->setting->sebutan_desa); ?><span class="badge bg-orange">6</span></a></li>
			<li class="<?php ($this->tab_ini == 13) and print('active') ?>"><a href="<?= site_url('pembangunan/pelaksanaan_durkp') ?>">Pelaksanaan DU RKP <?= ucwords($this->setting->sebutan_desa); ?></a></li>
		</ul>
	</div>
</div>



