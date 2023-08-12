
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
			<li class=" <?php ($this->tab_ini == 1) and print('active') ?>"><a href="<?= site_url('pembangunan') ?>">Daftar Usulan Kegiatan</a></li>
			<li class=" <?php ($this->tab_ini == 2) and print('active') ?>"><a href="<?= site_url('pembangunan_program_masuk_desa') ?>"> Program Masuk Ke <?= ucwords($this->setting->sebutan_desa); ?></a></li>
			<li class=" <?php ($this->tab_ini == 3) and print('active') ?>"><a href="<?= site_url('pembangunan_pembiayaan') ?>"> Rencana Pembiayaan</a></li>
			<li class=" <?php ($this->tab_ini == 4) and print('active') ?>"><a href="<?= site_url('pembangunan/kerjasama_antar_desa') ?>"> Kerjasama Antar Desa/Kelurahan</a></li>
			<li class=" <?php ($this->tab_ini == 5) and print('active') ?>"><a href="<?= site_url('pembangunan/kerjasama_pihak_ketiga') ?>"> Kerjasama Pihak Ketiga</a></li>
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
			<li class="<?php ($this->tab_ini == 6) and print('active') ?>"><a href="<?= site_url('pembangunan/usulan_dusun') ?>"> Daftar Usulan TK. <?= ucwords($this->setting->sebutan_dusun); ?></a></li>
			<li class="<?php ($this->tab_ini == 7) and print('active') ?>"><a href="<?= site_url('pembangunan_polling/daftar_polling') ?>"> Penentuan Prioritas / Polling</a></li>
			<li class="<?php ($this->tab_ini == 8) and print('active') ?>"><a href="<?= site_url('pembangunan/hasil_polling') ?>"> Hasil Penentuan Prioritas <?= ucwords($this->setting->sebutan_desa); ?></a></li>
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
			<li class="<?php ($this->tab_ini == 9) and print('active') ?>"><a href="<?= site_url('pembangunan/penetapan_rkpdes') ?>">Penetapan RKP <?= ucwords($this->setting->sebutan_desa); ?></a></li>
			<li class="<?php ($this->tab_ini == 10) and print('active') ?>"><a href="<?= site_url('pembangunan/rkpdes') ?>"> Daftar RKP <?= ucwords($this->setting->sebutan_desa); ?></a></li>
			<li class="<?php ($this->tab_ini == 11) and print('active') ?>"><a href="<?= site_url('pembangunan/durkpdes') ?>"> DU-RKP <?= ucwords($this->setting->sebutan_desa); ?></a></li>
		</ul>
	</div>
</div>

<div class="box">
	<div class="box-header">
		<h5 class="box-title">Pelaksanaan Pembangunan</h5>
		<div class="box-tools">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
		</div>
	<div class="box-body no-padding">
		<ul class="nav nav-pills nav-stacked">
			<li class="<?php ($this->tab_ini == 12) and print('active') ?>"><a href="<?= site_url('pembangunan/pelaksanaan') ?>">Pelaksanaan Pembangunan</a></li>
		</ul>
	</div>
</div>



