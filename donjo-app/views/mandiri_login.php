<style>
.fa-keyboard-o {
	position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
}
</style>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>
			<?=$this->setting->login_title
				. ' ' . ucwords($this->setting->sebutan_desa)
				. (($header['nama_desa']) ? ' ' . $header['nama_desa']: '')
				. get_dynamic_title_page_from_path();
			?>
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="robots" content="noindex">
		<!-- Jquery UI -->
		<link rel="stylesheet" href="<?= base_url()?>assets/bootstrap/css/jquery-ui.min.css">
		<!-- Font Awesome -->
		<!--<link rel="stylesheet" href="<?= base_url()?>assets/bootstrap/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?= base_url()?>assets/css/login-style.css" media="screen" type="text/css" />
		<link rel="stylesheet" href="<?= base_url()?>assets/css/login-form-elements.css" media="screen" type="text/css" />-->
		<link rel="stylesheet" href="<?= base_url()?>assets/bootstrap/css/bootstrap.bar.css" media="screen" type="text/css" />
		<?php if (is_file("desa/css/insidega.css")): ?>
			<link type='text/css' href="<?= base_url()?>desa/css/insidega.css" rel='Stylesheet' />
		<?php endif; ?>
		<?php if (is_file(LOKASI_LOGO_DESA ."favicon.ico")): ?>
			<link rel="shortcut icon" href="<?= base_url()?><?=LOKASI_LOGO_DESA?>favicon.ico" />
		<?php else: ?>
			<link rel="shortcut icon" href="<?= base_url()?>favicon.ico" />
		<?php endif; ?>
		<!-- Keyboard Default (Ganti dengan keyboard-dark.min.css untuk tampilan lain)-->
		<link rel="stylesheet" href="<?= base_url("assets/css/keyboard.min.css")?>">
		<link rel="stylesheet" href="<?= base_url("assets/front/css/mandiri-keyboard.css")?>">

		<script src="<?= base_url()?>assets/bootstrap/js/jquery.min.js"></script>
		<script src="<?= base_url()?>assets/bootstrap/js/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.validate.min.js"></script>
		<script type="text/javascript" src="<?= base_url() ?>assets/js/validasi.js"></script>
		<script type="text/javascript" src="<?= base_url()?>assets/js/localization/messages_id.js"></script>
        
        <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
        
        <link rel="stylesheet" href="<?= base_url() ?>assets/css/login.css">
        <link rel="stylesheet" href="http://cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

		<?php if ($cek_anjungan): ?>
			<!-- keyboard widget css & script -->
			<script src="<?= base_url("assets/js/jquery.keyboard.min.js")?>"></script>
			<script src="<?= base_url("assets/js/jquery.mousewheel.min.js")?>"></script>
			<script src="<?= base_url("assets/js/jquery.keyboard.extension-all.min.js")?>"></script>
			<script src="<?= base_url("assets/front/js/mandiri-keyboard.js")?>"></script>
		<?php endif; ?>
		<?php require __DIR__ .'/head_tags.php' ?>
	</head>
<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-8" style="padding-top:15px; padding-left:10px; padding-right:10px; padding-bottom:5px">
          <!-- AWAL INFO LAYANAN -->
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner">
                    <div class="carousel-item active">
                      <img class="d-block w-100" src="<?= base_url()?>assets/bootstrap/1.png" alt="First slide">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="<?= base_url()?>assets/bootstrap/2.png" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                      <img class="d-block w-100" src="<?= base_url()?>assets/bootstrap/3.png" alt="Third slide">
                    </div>
                  </div>
                  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                  </a>
                  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                  </a>
				</div>
            <!-- AKHIR LAYANAN -->
          </div>
          <div class="col-md-4">
            <div class="card-body">
              <div class="brand-wrapper" align="center">
                <a href="<?=site_url('first'); ?>"><img src="<?=gambar_desa($header['logo']);?>" alt="<?=$header['nama_desa']?>" class="img-responsive"/></a>
              </div>
              <h1 align="center" style="font-size:18px">Layanan Masyarakat <?=ucwords($this->setting->sebutan_desa)?> <?=$header['nama_desa']?></h1>

								<form id="validasi" class="login-form" action="<?= site_url('mandiri_web/auth'); ?>" method="post" >
									<?php if ($this->session->mandiri_wait == 1): ?>
										<div class="error login-footer-top">
											<p id="countdown" style="color:red; text-transform:uppercase"></p>
										</div>
									<?php else: ?>
										<div class="form-group">
											<input class="form-username form-control input-sm required <?= jecho($cek_anjungan, TRUE, 'kbvnumber'); ?>" name="nik" id="nik" type="text" placeholder="NIK" <?= jecho($this->session->mandiri_wait, 1, "disabled") ?> value="">
										</div>
										<div class="form-group">
											<input class="form-username form-control input-sm required <?= jecho($cek_anjungan, TRUE, 'kbvnumber'); ?>" name="pin" id="pin" type="password" placeholder="PIN" <?= jecho($this->session->mandiri_wait, 1, "disabled") ?> value="">
										</div>
										<div class="form-group">
											<input type="checkbox" id="checkbox" class="form-checkbox"> Tampilkan PIN
										</div>
										<button type="submit" class="btn btn-block btn-warning login-btn bg-success">MASUK</button>
                                        
										
										<?php if ($this->session->mandiri == -1 && $this->session->mandiri_try < 4): ?>
											<div class="error">
												<p style="color:red; text-transform:uppercase">Login Gagal.<br />NIK atau PIN yang Anda masukkan salah!<br />
												<?php if ($this->session->mandiri_try): ?>
													Kesempatan mencoba <?= ($this->session->mandiri_try - 1); ?> kali lagi.</p>
												<?php endif; ?>
											</div>
										<?php elseif ($this->session->mandiri == -2): ?>
											<div class="error">
												Redaksi belum boleh masuk, SID belum memiliki sambungan internet!
											</div>
										<?php endif; ?>
									<?php endif; ?>
								</form>
                                <div class="col-md-12" align="center">
											<a href="<?= site_url('insidega'); ?>">login Manajemen </a> |
                                            
                                            <a href="<?= site_url('first'); ?>"> Ke Beranda</a>
										</div>
            </div>
          </div>
        </div>
      </div>	  
		<div class="credit pull-center" style="color:black">
    <a href="https://desagarut.net" target="_blank">SIDeGa (Sistem Informasi Desa Garut)  - </a> Inspirasi untuk desa & kelurahan di 
    <strong><a href="https://garutkab.go.id" target="_blank">Kabupaten Garut</a></a>.</strong> 
		</div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
</body>
</html>
<script>

	function start_countdown(){
		var times = eval(<?= json_encode($this->session->mandiri_timeout)?>) - eval(<?= json_encode(time())?>);
		var menit = Math.floor(times / 60);
		var detik = times % 60;
		timer = setInterval(function(){
			detik--;
			if (detik <= 0 && menit >=1){
				detik = 60;
				menit--;
			}
			if (menit <= 0 && detik <= 0){
				clearInterval(timer);
				location.reload();
			} else {
				document.getElementById("countdown").innerHTML = "<b>Gagal 3 kali silakan coba kembali dalam "+menit+" MENIT "+detik+" DETIK </b>";
			}
		}, 1000)
	}

	$('document').ready(function()
	{
		var pass = $("#pin");
		$('#checkbox').click(function(){
			if (pass.attr('type') === "password"){
				pass.attr('type', 'text');
			} else {
				pass.attr('type', 'password')
			}
		});

		if ($('#countdown').length)
		{
			start_countdown();
		}
	});

</script>
