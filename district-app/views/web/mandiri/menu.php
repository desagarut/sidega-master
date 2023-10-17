<style type="text/css">
#mandiri i.fa {
	margin-right: 10px;
}
#mandiri button.nowrap {
	white-space: nowrap;
}
#mandiri .badge {
	background-color: red;
	color: white;
	margin-left: 0px;
}
</style>
<aside class="main-sidebar">
  <section class="sidebar">
		<div class="user-panel" style="padding-top:10px">
			<div class="pull-left image">
				<img src="<?= gambar_desa($desa['logo']); ?>" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<strong><?= ucwords($this->setting->sebutan_desa . " " . $desa['nama_desa']); ?></strong>
				</br>
				<?php
					$seb_kec = $this->setting->sebutan_kecamatan;
					$nam_kec = $desa['nama_kecamatan'];
					$seb_kab = $this->setting->sebutan_kabupaten;
					$nam_kab = $desa['nama_kabupaten'];
				?>
				<?php	if (strlen($nam_kec)<=12 AND strlen($nam_kab)<=12): ?>
					<?= ucwords($seb_kec . " ".$nam_kec); ?>
					</br>
					<?= ucwords($seb_kab." ".$nam_kab); ?>
				<?php	else: ?>
					<?= ucwords(substr($seb_kec, 0, 3) . ". " . $nam_kec); ?>
					</br>
					<?= ucwords(substr($seb_kab, 0, 3).". " . $nam_kab); ?>
				<?php	endif; ?><br/>
                <?php $this->load->view('jam.php');?>
            </div>		
        </div>
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Menu</li>
      <li> <a href="<?= site_url();?>mandiri_web/mandiri/1/1"><i class="fa fa-tachometer"></i> <span> Home</span> </a> </li>
      <li> <a href="<?= site_url();?>mandiri_web/mandiri/1/6"><i class="fa fa-user"></i> <span> Profil</span> </a> </li>
      <li> <a href="<?= site_url();?>mandiri_web/mandiri_dokumen"><i class="fa fa-user"></i> <span> Dokumen</span> </a> </li>
      <li> <a href="<?= site_url("mandiri_web/cetak_kk/$penduduk[id]/1"); ?>" target="_blank"><i class="fa fa-print"></i> <span> Cetak Kartu Keluarga</span>  </a> </li>
      <li> <a href="<?= site_url();?>mandiri_web/mandiri/1/2"><i class="fa fa-pencil"></i> <span> Layanan Surat</span>  </a> </li>
      <li> <a href="<?= site_url();?>mandiri_web/mandiri/1/3"><i class="fa fa-envelope-o"></i> <span> Kotak Pesan</span> <span class="pull-right-container"><small class="label pull-right bg-green" id="b_pesan"></small></span> </a> </li>
      <li> <a href="<?= site_url();?>mandiri_web/mandiri/1/4"><i class="fa fa-handshake-o"></i> <span> Program Bantuan</span>  </a> </li>
      <li> <a href="<?= site_url();?>mandiri_web/ganti_pin"><i class="fa fa-key"></i> <span> Ganti Password</span>  </a> </li>
      <li> <a href="<?= site_url();?>mandiri_web/logout"><i class="fa fa-sign-out"></i> <span> Keluar</span>  </a> </li>
    </ul>
  </section>
</aside>
<script type="text/javascript">

  $('document').ready(function()
  {
    setTimeout(function()
    {
      refresh_badge($("#b_pesan"), "<?= site_url('notif_web/inbox'); ?>");
    }, 500);
  });

</script> 