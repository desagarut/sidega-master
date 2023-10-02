<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>
		<?= $this->setting->website_title . ' ' . ucwords($this->setting->sebutan_desa) . (($desa['nama_desa']) ? ' ' . $desa['nama_desa'] : '') . get_dynamic_title_page_from_path(); ?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<!-- Google Web Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

	<!-- Icon Font Stylesheet -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

	<!-- Libraries Stylesheet -->
	<link href="<?= base_url("$this->theme_folder/$this->theme/assets/lib/animate/animate.min.css") ?>" rel="stylesheet">
	<link href="<?= base_url("$this->theme_folder/$this->theme/assets/lib/lightbox/css/lightbox.min.css") ?>" rel="stylesheet">

	<link href="<?= base_url("$this->theme_folder/$this->theme/assets/lib/owlcarousel/assets/owl.carousel.min.css") ?>" rel="stylesheet">

	<!-- Customized Bootstrap Stylesheet -->
	<link href="<?= base_url("$this->theme_folder/$this->theme/assets/css/bootstrap.min.css") ?>" rel="stylesheet">

	<!-- Template Stylesheet -->
	<link href="<?= base_url("$this->theme_folder/$this->theme/assets/css/style.css") ?>" rel="stylesheet">


</head>

<body>
	<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
		<div class="navbar-brand d-flex align-items-center px-4 px-lg-5">
			<h2 class="m-0 text-primary">
				<a href="<?= site_url('first') ?>">
					<img src="<?= gambar_desa($desa['logo']) ?>" style="padding-bottom: 5px; width:30px;" alt="<?= ucwords($this->setting->sebutan_desa . ' ' . $desa['nama_desa']); ?>" title="<?= ucwords($this->setting->sebutan_desa . ' ' . $desa['nama_desa']); ?>">
					<?= ucwords($this->setting->sebutan_desa . ' ' . $desa['nama_desa']); ?>
				</a>
			</h2>
		</div>
		<button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<div class="navbar-nav ms-auto p-4 p-lg-0">
				<a href="<?= site_url('first') ?>" class="nav-item nav-link active">Home</a>
				<?php if (menu_atas) : ?>
					<?php foreach ($menu_atas as $menu) : ?>

						<div class="nav-item dropdown">
							<a href="<?= $menu['link'] ?>" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><?= $menu['nama'] ?></a>

							<?php if (count($menu['submenu']) > 0) : ?>
								<div class="dropdown-menu fade-down m-0">
									<?php foreach ($menu['submenu'] as $submenu) : ?>
										<a href="<?= $submenu['link'] ?>" class="dropdown-item"><?= $submenu['nama'] ?></a>
									<?php endforeach ?>
								</div>
							<?php endif ?>

						</div>
					<?php endforeach ?>
				<?php endif ?>
			</div>
			<a href="<?= site_url('mandiri_web') ?>" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">LOGIN<i class="fa fa-arrow-right ms-3"></i></a>
		</div>
	</nav>
	<!-- Navbar End -->

	<div class="container-xxl py-4  wow fadeInUp" data-wow-delay="0.2s">
		<div class="container">
			<div class="row">
				<div class="text-center">
					<img class="logo" src="<?= gambar_desa($config['logo']); ?>" alt="logo-desa" style="width: 50px">
					<h4 class="mb-5">Pemerintah <?= ucwords($this->setting->sebutan_kabupaten . ' ' . $desa['nama_kabupaten']); ?><br />
						<?= ucwords($this->setting->sebutan_kecamatan . ' ' . $desa['nama_kecamatan']); ?><br />
						<?= ucwords($this->setting->sebutan_desa . ' ' . $desa['nama_desa']); ?>
					</h4>
				</div>
				<div class="row">
					<hr style="border-bottom: 2px solid #000000; height:0px;">
					<div class="container">

						<table>
							<tbody>
								<tr>
									<td colspan="3"><u><b>Menyatakan Bahwa :</b></u></td>
								</tr>
								<tr>
									<td width="30%">Nomor Surat</td>
									<td width="1%">:</td>
									<td><?= $surat->nomor_surat; ?></td>
								</tr>
								<tr>
									<td>Tanggal Surat</td>
									<td>:</td>
									<td><?= tgl_indo($surat->tanggal); ?></td>
								</tr>
								<tr>
									<td>Perihal</td>
									<td>:</td>
									<td><?= "Surat " . $surat->perihal; ?></td>
								</tr>
								<tr>
									<td></td>
									<td></td>
									<td><?= "a/n " . $surat->nama_penduduk ?? $surat->nama_non_warga; ?></td>
								</tr>
								<tr>
									<td colspan="3"><u><b>Ditandatangani oleh :</b></u></td>
								</tr>
								<tr>
									<td>Nama</td>
									<td>:</td>
									<td><?= $surat->pamong_nama; ?></td>
								</tr>
								<tr>
									<td>Jabatan</td>
									<td>:</td>
									<td><?= $surat->pamong_jabatan; ?></td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="btn btn-success btn-box py-2">
						<h5>Surat tersebut adalah benar dan tercatat dalam database sistem informasi kami.</h5>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- JavaScript Libraries -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url("$this->theme_folder/$this->theme/assets/lib/wow/wow.min.js") ?>"></script>
	<script src="<?= base_url("$this->theme_folder/$this->theme/assets/lib/easing/easing.min.js") ?>"></script>
	<script src="<?= base_url("$this->theme_folder/$this->theme/assets/lib/waypoints/waypoints.min.js") ?>"></script>
	<script src="<?= base_url("$this->theme_folder/$this->theme/assets/lib/owlcarousel/owl.carousel.min.js") ?>"></script>
	<script src="<?= base_url("$this->theme_folder/$this->theme/assets/lib/counterup/counterup.min.js") ?>"></script>
	<script src="<?= base_url("$this->theme_folder/$this->theme/assets/lib/easing/easing.min.js") ?>"></script>
	<script src="<?= base_url("$this->theme_folder/$this->theme/assets/lib/lightbox/js/lightbox.min.js") ?>"></script>
	<!-- Template Javascript -->
	<script src="<?= base_url("$this->theme_folder/$this->theme/assets/js/main.js") ?>"></script>

	<script src="<?= base_url('assets/bootstrap/js/jquery.min.js') ?>"></script>
	<script src="<?= base_url('assets/bootstrap/js/bootstrap.min.js') ?>"></script>
	<link rel="stylesheet" href="<?= base_url("$this->theme_folder/$this->theme/assets/css/bootstrap.min.css") ?>">
</body>

</html>