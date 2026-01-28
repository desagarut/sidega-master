<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title> <?= $this->setting->login_title
				. ' ' . ucwords($this->setting->sebutan_desa)
				. (($header['nama_desa']) ? ' ' . $header['nama_desa'] : '')
				. get_dynamic_title_page_from_path();
			?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">

	<?php //if (is_file("desa/css/insidega.css")) : 
	?>
	<!--<link type='text/css' href="<?= base_url() ?>desa/css/insidega.css" rel='Stylesheet' />-->
	<?php //endif; 
	?>

	<?php if (is_file(LOKASI_LOGO_DESA . "favicon.ico")) : ?>
		<link rel="shortcut icon" href="<?= base_url() ?><?= LOKASI_LOGO_DESA ?>favicon.ico" />
	<?php else : ?>
		<link rel="shortcut icon" href="<?= base_url() ?>favicon.ico" />
	<?php endif; ?>


	<link rel="stylesheet" href="<?= base_url() ?>assets/able/assets/css/style.css">

	<script src="<?= base_url() ?>assets/bootstrap/js/jquery.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/js/validasi.js"></script>
	<script type="text/javascript" src="<?= base_url() ?>assets/js/localization/messages_id.js"></script>
	<script src="<?= base_url() ?>assets/able/assets/js/vendor-all.min.js"></script>
	<script src="<?= base_url() ?>assets/able/assets/js/plugins/bootstrap.min.js"></script>
	<script src="<?= base_url() ?>assets/able/assets/js/pcoded.min.js"></script>

	<?php require __DIR__ . '/head_tags.php' ?>

	<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>

</head>

<body>

	<div class="auth-wrapper">
		<div class="auth-content">
			<div class="card">
				<div class="row align-items-center text-center">
					<div class="col-md-7" >
						<?php $this->load->view('peta') ?>
					</div>
					<div class="col-md-5">
						<div class="card-body">
							<div class="text-center">
								<a href="<?= site_url('first'); ?>"><img src="<?= gambar_desa($header['logo']); ?>" alt="<?= $header['nama_desa'] ?>" class="img-responsive" style="max-width: 60px; max-height: 60px" /></a>
							</div>
							<h4 class="mb-4 f-w-300"><?= ucwords($this->setting->sebutan_desa) ?> <?= $header['nama_desa'] ?></h4>
							<form id="validasi" class="login-form" action="<?= site_url('insidega/auth') ?>" method="post">
								<?php if ($this->session->insidega_wait == 1) : ?>
									<div class="error login-footer-top">
										<p id="countdown" style="color:red; text-transform:uppercase"></p>
									</div>
								<?php else : ?>
									<div class="form-group mb-3">
										<label class="floating-label" for="username">Username</label>
										<input name="username" type="text" placeholder="" <?php jecho($this->session->insidega_wait, 1, "disabled") ?> value="" class="form-username form-control required">
									</div>
									<div class="form-group">
										<div class="form-group mb-4">
											<label class="floating-label" for="password">Password</label>
											<input name="password" id="password" type="password" placeholder="" <?php jecho($this->session->insidega_wait, 1, "disabled") ?> value="" class="form-username form-control required">
										</div>
										<div class="form-group">
											<input type="checkbox" id="checkbox" class="form-checkbox"> Tampilkan kata sandi
										</div>
										<hr />
										<!-- Cloudflare Turnstile widget -->
										<div class="cf-turnstile" data-sitekey="0x4AAAAAACUYeHOFo92Kxjzr" data-theme="light" data-size="flexible"></div>
										<br/>
										<button type="submit" class="btn btn-block btn-success">MASUK</button>
										<?php if ($this->session->insidega == -1 && $this->session->insidega_try < 4) : ?>
											<div class="error">
												<p style="color:red; text-transform:uppercase">Login Gagal.<br />Nama pengguna atau kata sandi yang Anda masukkan salah!<br />
													<?php if ($this->session->insidega_try) : ?>
														Kesempatan mencoba <?= ($this->session->insidega_try - 1); ?> kali lagi.</p>
											<?php endif; ?>
											</div>
										<?php elseif ($this->session->insidega == -2) : ?>
											<div class="error">
												Redaksi belum boleh masuk, SID belum memiliki sambungan internet!
											</div>
										<?php endif; ?>
									<?php endif; ?>
									<script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="card-footer">
						<marquee><a href="https://desagarut.id" target="_blank">SIDeGa <?= AmbilVersi() ?> </a>Inspirasi untuk desa & kelurahan di <a href="https://garutkab.go.id" target="_blank">Kabupaten Garut</a></marquee>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>

</html>
<script>
	function start_countdown() {
		var times = eval(<?= json_encode($this->session->insidega_timeout) ?>) - eval(<?= json_encode(time()) ?>);
		var menit = Math.floor(times / 60);
		var detik = times % 60;
		timer = setInterval(function() {
			detik--;
			if (detik <= 0 && menit >= 1) {
				detik = 60;
				menit--;
			}
			if (menit <= 0 && detik <= 0) {
				clearInterval(timer);
				location.reload();
			} else {
				document.getElementById("countdown").innerHTML = "<b>Anda telah gagal sebanyak 3 kali percobaan login, silakan coba kembali dalam " + menit + " MENIT " + detik + " DETIK </b>";
			}
		}, 1000)
	}

	$('document').ready(function() {
		var pass = $("#password");
		$('#checkbox').click(function() {
			if (pass.attr('type') === "password") {
				pass.attr('type', 'text');
			} else {
				pass.attr('type', 'password')
			}
		});

		if ($('#countdown').length) {
			start_countdown();
		}
	});
</script>
<?php
// Ambil token Turnstile dari form
$token = $_POST['cf-turnstile-response'];
$secret = '0x4AAAAAACUYeNJJzXAu5glJyGGLo6zUixs'; // dari Cloudflare

// Kirim request verifikasi ke Cloudflare
$response = file_get_contents("https://challenges.cloudflare.com/turnstile/v0/siteverify", false, stream_context_create([
    'http' => [
        'method' => 'POST',
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'content' => http_build_query([
            'secret' => $secret,
            'response' => $token,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        ]),
    ]
]));
