<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Service Start -->
<div class="row justify-content-center">
	<h3 class="mb-5 text-center">BADAN PERMUSYAWARATAN DESA </h3>


	<?php foreach ($bpd as $data) : ?>
		<div class="course-item p-4">
			<div class="row g-4 p-4 shadow justify-content-center">
				<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
					<div class="course-item bg-info">
						<div class="position-relative overflow-hidden text-center" style="padding: 5px 5px 5px 5px; height: 100%">
							<?php if ($data['foto']): ?>
								<img class="img-fluid" src="<?= AmbilFoto($data['foto']) ?>" alt="<?= $data['nama'] ?>" style="object-fit: cover; height:600px; width:auto" />
							<?php else: ?>
								<img class="img-fluid" src="<?= base_url() ?>assets/files/user_pict/kuser.png" alt="<?= $data['nama'] ?>" sstyle="object-fit: cover; height:600px; width:auto" />
							<?php endif ?>
						</div>
					</div>
				</div>
				<div class="col-md-8 wow fadeInUp" data-wow-delay="0.1s">
					<div class="row">
						<div class="col-sm-12">
							<div class="table-responsive">
								<table class="table table-responsive table-borderless">
									<thead>
										<tr>
											<th colspan="3">BIODATA:</th>
									</thead>
									<tbody>
										<tr>
											<td style="width: 20%;">NAMA</td>
											<td style="width: 2%;">:</td>
											<td class="width: 78%"><?= strtoupper($data['nama']) ?></td>
										<tr>
										</tr>
										<td style="width: 20%;">JABATAN</td>
										<td style="width: 2%;">:</td>
										<td class="width: 78%"><?= strtoupper($data['jabatan']) ?></td>
										</tr>
									</tbody>
								</table>
								<table class="table table-responsive table-borderless">
									<thead>
										<tr>
											<th colspan="3">TUGAS POKOK DAN FUNGSI:</th>
									</thead>
									<tbody>
										<tr>
											<td>
												<div class="card card-body"><?= $data['tupoksi'] ?></div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
</div>