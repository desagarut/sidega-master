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
    <div class="user-panel">
      <div class="pull-left image">
        <?php if ($penduduk['foto']): ?>
        <img class="img-circle" src="<?= AmbilFoto($penduduk['foto'])?>" alt="Foto">
        <?php else: ?>
        <img class="img-circle" src="<?= base_url()?>assets/files/user_pict/kuser.png" alt="Foto">
        <?php endif; ?>
      </div>
      <div class="pull-left info">
        <p style="font-size: larger; ">
          <?= $_SESSION['nama'];?>
        </p>
        NIK: <strong>
        <?= $_SESSION['nik'];?>
        </strong><br>
        No KK:
        <?= $_SESSION['no_kk']?>
      </div>
    </div>
    &nbsp;
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Menu</li>
      <li> <a href="<?= site_url("mandiri_web/cetak_kk/$penduduk[id]/1"); ?>"><i class="fa fa-print"></i> <span> Cetak Kartu Keluarga</span>  </a> </li>
      <li> <a href="<?= site_url();?>mandiri_web/mandiri/1/1"><i class="fa fa-user"></i> <span> Profil</span> </a> </li>
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