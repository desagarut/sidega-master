<div class="box box-info">
	<div class="box-header with-border">
		<h3 class="box-title">Menu SPPT PBB</h3>
		<div class="box-tools">
			<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
		</div>
	</div>
	<div class="box-body no-padding">
		<ul class="nav nav-pills nav-stacked">
			<li <?php if ($this->tab_ini == 19): ?>class="active"<?php endif; ?>><a href="<?= site_url('data_sppt/rekap')?>"><i class='fa fa-list'></i>Rekapitulasi</a></li>
            <?php if ($this->CI->cek_hak_akses('u')): ?>
			<li <?php if ($this->tab_ini == 20): ?>class="active"<?php endif; ?>><a href="<?= site_url('data_sppt/clear')?>"><i class='fa fa-list'></i>Master Data</a></li>
            <?php endif;?>
			<li <?php if ($this->tab_ini == 21): ?>class="active"<?php endif; ?>><a href="<?= site_url('data_sppt/tagihan_daftar')?>"><i class='fa fa-list'></i>Tagihan & Pembayaran</a></li>
			
<!--            <li <?php if ($this->tab_ini == 22): ?>class="active"<?php endif; ?>><a href="<?= site_url('data_sppt/pembayaran_daftar')?>"><i class='fa fa-list'></i>Data Pembayaran</a></li>
			<li <?php if ($this->tab_ini == 23): ?>class="active"<?php endif; ?>><a href="<?= site_url('data_sppt/laporan')?>"><i class='fa fa-list'></i>Laporan</a></li>
            <?php if ($this->CI->cek_hak_akses('u')): ?>
            <li <?php if ($this->tab_ini == 28): ?>class="active"<?php endif; ?>><a href="<?= site_url('data_sppt/import')?>" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Impor Data SPPT"><i class='fa fa-upload'></i>Impor Data SPPT PBB</a></li>
			<?php endif ?>-->
            <li <?php if ($this->tab_ini == 29): ?>class="active"<?php endif; ?>><a href="<?= site_url('data_sppt/panduan')?>"><i class='fa fa-question-circle'></i>Panduan SPPT PBB</a></li>
		</ul>
	</div>
</div>
