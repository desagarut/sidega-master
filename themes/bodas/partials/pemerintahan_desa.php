<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Service Start -->
<div class="row justify-content-center">
	<h3 class="mb-5 text-center">PEMERINTAHAN DESA</h3>


	<?php foreach ($aparatur_desa['daftar_perangkat'] as $data) : ?>
		<div class="course-item p-4">
			<div class="row g-4 p-4 shadow justify-content-center">
				<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
					<div class="course-item bg-success">
						<div class="position-relative overflow-hidden text-center" style="padding: 10px 10px 10px 10px; ">
							<?php if ($data['foto']): ?>
								<img class="img-fluid" src="<?= $data['foto'] ?>" alt="<?= $data['nama'] ?>" />
							<?php else: ?>
								<img class="img-fluid" src="<?= base_url() ?>assets/files/user_pict/kuser.png" alt="<?= $data['nama'] ?>" />
							<?php endif ?>
						</div>
					</div>
				</div>
				<div class="col-md-8 wow fadeInUp" data-wow-delay="0.1s" style="padding: 10px 10px 10px 50px">
					<div class="row">
						<div class="col-md-4">
							<h6 class="text-left">BIODATA:</h6>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<h4>NAMA </h4>
						</div>
						<div class="col-md-8">
							<h4 class="nama-pejabat">: <?= strtoupper($data['nama']) ?></h4>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<h5 class="text-left">JABATAN</h5>
						</div>
						<div class="col-md-7">
							<h5 class="text-left">: <?= strtoupper($data['jabatan']) ?> <?= strtoupper($desa['nama_desa']) ?></h5>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5">
							<h5 class="text-left">NIP/NIPD </h5>
						</div>
						<div class="col-md-7">
							<h5 class="text-left">: <?= $data['pamong_nip'] ?></h5>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<h5 class="text-left">MASA JABATAN</h5>
						</div>
						<div class="col-md-7">
							<h5 class="text-left">: <?= strtoupper($data['pamong_masajab']) ?></h5>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4">
							<h5 class="text-left">JENIS KELAMIN</h5>
						</div>
						<div class="col-md-7">
							<h5 class="text-left">: <?= $data['pamong_sex'] ?></h5>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-md-4">
							<h6 class="text-left">TUGAS POKOK DAN FUNGSI:</h6>
						</div>
					</div>
					<div class="row mt-4">
						<div class="col-md-4">
							<p class="text-justify">Melaksananakan....</p>
						</div>
					</div>

				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>