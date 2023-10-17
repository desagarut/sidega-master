<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>
<?=$this->setting->admin_title . ' ' . ucwords($this->setting->sebutan_deskel) . ' '. $deskel['nama_deskel'] ?: '' . 'Layanan Mandiri';
			?>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
</title>
<!-- css -->
<?php $this->load->view('web/mandiri/sets/css.php') ?>
</head>

<body class="hold-transition <?= $this->setting->warna_tema_admin; ?> sidebar-mini fixed<?php if ($minsidebar==1): ?>sidebar-collapse <?php endif ?>">
<div class="wrapper">
  <header class="main-header"> <a href="<?=site_url()?>mandiri_web"  target="_blank" class="logo"> <span class="logo-mini logo-text" style="padding-top:7px"><img src="<?php echo base_url().'deskel/logo/logo.png'; ?>" class="img-circle logo-deskel" alt="User Image" width="30px"></span> <span class="logo-lg logo-text"><img src="<?php echo base_url().'deskel/logo/logo.png'; ?>" class="img-circle logo-deskel" alt="User Image" width="30px"> SIDeGa </span> </a>
    <nav class="navbar navbar-static-top"> <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"> <span class="sr-only">Toggle navigation</span> </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li><span>
            <?php $this->load->view('jam.php');?>
            </span></li>
          <li> <a href="<?= site_url();?>mandiri_web/mandiri/1/3"><i class="fa fa-envelope-o" title="Pesan Masuk"></i> <span></span> <span class="pull-right-container"><small class="label pull-right bg-maroon" id="b_pesan" title="Pesan Masuk"></small></span> </a> </li>
          <li class="dropdown user user-menu"> <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <?php if ($penduduk['foto']): ?>
            <img class="user-image" src="<?= AmbilFoto($penduduk['foto'])?>" alt="Foto">
            <?php else: ?>
            <img class="user-image" src="<?= base_url()?>assets/files/user_pict/kuser.png" alt="Foto">
            <?php endif; ?>
            <span class="hidden-xs">
            <?= $_SESSION['nama'];?>
            </span> </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <?php if ($penduduk['foto']): ?>
                <img class="img-circle" src="<?= AmbilFoto($penduduk['foto'])?>" alt="Foto">
                <?php else: ?>
                <img class="img-circle" src="<?= base_url()?>assets/files/user_pict/kuser.png" alt="Foto">
                <?php endif; ?>
                <p> Anda Login Sebagai </br>
                  <strong>
                  <?= $_SESSION['nama'];?>
                  </strong> </p>
              </li>
              <li class="user-footer">
                <div class="pull-left"> <a href="<?= site_url('mandiri_web/mandiri/1/1'); ?>" class="btn bg-purple btn-box btn-sm">Profil</a> </div>
                <div class="pull-right"> <a href="<?= site_url('first'); ?>" class="btn bg-maroon btn-box btn-sm">Keluar</a> </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
</div>
<script type="text/javascript">

  $('document').ready(function()
  {
    setTimeout(function()
    {
      refresh_badge($("#b_pesan"), "<?= site_url('notif_web/inbox'); ?>");
    }, 500);
  });

</script> 