<!-- widget Layanan Mandiri -->

<?php

	if( ! isset($_SESSION['mandiri']) OR $_SESSION['mandiri']<>1) {



		if($_SESSION['mandiri_wait'] == 1) { ?>

<h4>Layanan
  <?= ucwords($this->setting->sebutan_desa . " " . $desa['nama_desa']); ?>
</h4>
<p>Silakan datang atau hubungi operator <?php echo $this->setting->sebutan_desa?> untuk mendapatkan kode PIN anda.</p>
<h4>Gagal 3 kali, silakan coba kembali dalam <?php echo waktu_ind((time()- $_SESSION['mandiri_timeout'])*(-1));?> detik lagi</h4>
<div id="note"> Login Gagal. Username atau Password yang anda masukkan salah! </div>
<?php } else { ?>
<h4>Layanan
  <?= ucwords($this->setting->sebutan_desa . " " . $desa['nama_desa']); ?>
</h4>
<p>Silakan datang atau hubungi operator <?php echo $this->setting->sebutan_desa?> untuk mendapatkan kode PIN anda. atau klik link di bawah untuk login</p>
<a href="<?=site_url('mandiri_web'); ?>" class="btn btn-box btn-success btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"  title="Masuk Layanan Mandiri">Login Layanan</a>
<?php }

	} else {

	?>
<h5><small>Hai, </small><?php echo $_SESSION['nama'];?><br/>
<small>Selamat datang di layanan
  <?= ucwords($this->setting->sebutan_desa . " " . $desa['nama_desa']); ?></small>
</h5>
<div class="row ">
<p>Berikut ini adalah identitas anda:</p>
<ul id="ul-mandiri">
<table id="mandiri" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="25%">Nama</td>
    <td width="2%" class="titik">:</td>
    <td width="73%"><?php echo $_SESSION['nama'];?></td>
  </tr>
  <tr>
    <td bgcolor="#eee">NIK</td>
    <td class="titik" bgcolor="#eee">:</td>
    <td bgcolor="#eee"><?php echo $_SESSION['nik'];?></td>
  </tr>
  <tr>
    <td>No KK</td>
    <td class="titik">:</td>
    <td ><?php echo $_SESSION['no_kk']?></td>
  </tr>
</table>
</ul>
<br/>
<a href="<?php echo site_url();?>mandiri_web/mandiri/1/1" class="btn btn-box btn-warning btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">Profil</a> 
<a href="<?php echo site_url();?>mandiri_web/mandiri/1/2" class="btn btn-box btn-warning btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">Buat Surat</a>
<a href="<?php echo site_url();?>mandiri_web/mandiri/1/3" class="btn btn-box btn-warning btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">Pesan Masuk</a>
<a href="<?php echo site_url();?>mandiri_web/mandiri/1/4" class="btn btn-box btn-warning btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">Program Bantuan</a>
<a href="<?php echo site_url('mandiri_web');?>"  class="btn btn-box btn-warning btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block">Kembali</a>
</div>

<?php if(isset($_SESSION['lg']) AND $_SESSION['lg'] == 1) { ?>
<h5 class="sidebar-title"><i class="fa fa-user"></i> Layanan
  <?= ucwords($this->setting->sebutan_desa . " " . $desa['nama_desa']); ?>
</h5>
<br />
Untuk keamanan silahkan ubah kode PIN Anda.
<h4>Masukkan PIN Baru</h4>
<form action="<?php echo site_url('ganti')?>" method="post">
  <input name="pin1" type="password" placeholder="PIN" value="" style="margin-left:0px">
  <input name="pin2" type="password" placeholder="Ulangi PIN" value="" style="margin-left:0px">
  <button type="submit" id="but" style="margin-left:0px">Ganti</button>
</form>
<?php if ($flash_message) { ?>
<div id="notification" class='box-header label-danger'><?php echo $flash_message ?></div>
<script type="text/javascript">

						$('document').ready(function(){

							$('#notification').delay(4000).fadeOut();

						});

						</script>
<?php } ?>
<div id="note"> Silahkan coba login kembali setelah PIN baru disimpan. </div>
<?php } else if(isset($_SESSION['lg']) AND $_SESSION['lg'] == 2) { ?>
<h3 class="box-title"><i class="fa fa-user"></i> Layanan
  <?= ucwords($this->setting->sebutan_desa . " " . $desa['nama_desa']); ?>
</h3>
<br />
Untuk keamanan silahkan ubah kode PIN Anda.
<div id="note"> PIN Baru berhasil Disimpan! </div>
<?php unset($_SESSION['lg']);

		}

	}

?>
