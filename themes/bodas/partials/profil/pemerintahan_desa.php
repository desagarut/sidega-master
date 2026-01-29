<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Service Start -->
<div class="container">
	<div class="row justify-content-center">
		<h3 class="p-2 text-center">PEMERINTAHAN DESA</h3>
		<?php foreach ($aparatur_desa['daftar_perangkat'] as $data) : ?>
			<div class="course-item p-4 wow fadeInUp" data-wow-delay="0.1s">
				<div class="row g-2 p-4 shadow justify-content-center">
					<div class="col-lg-4 col-md-4 wow fadeInUp" data-wow-delay="0.1s">
						<div class="course-item">
							<div class="position-relative overflow-hidden text-center" style="padding: 10px 10px 10px 10px; height: 100%">
								<?php if ($data['foto']): ?>
									<img class="img-fluid" src="<?= $data['foto'] ?>" alt="<?= $data['nama'] ?>" style="object-fit: cover; height:auto; width:auto" />
								<?php else: ?>
									<img class="img-fluid" src="<?= base_url() ?>assets/files/user_pict/kuser.png" alt="<?= $data['nama'] ?>" sstyle="object-fit: cover; height:600px; width:auto" />
								<?php endif ?>
							</div>
						</div>
					</div>
					<div class="col-lg-8 col-md-8 wow fadeInUp" data-wow-delay="0.1s">
						<div class="row">
							<div class="col-sm-12">
								<div class="table-responsive">
									<table class="table table-responsive table-borderless">
										<thead>
											<th>
												<h5> POFILE </h5>
											</th>
										</thead>
										<tbody>
											<tr>
												<td style="width: 20%;">NAMA</td>
												<td style="width: 2%;">:</td>
												<td class="width: 78%"><?= strtoupper($data['nama']) ?></td>
											</tr>
											<tr>
												<td style="width: 20%;">JABATAN</td>
												<td style="width: 2%;">:</td>
												<td class="width: 78%"><?= strtoupper($data['jabatan']) ?></td>
											</tr>
											<tr>
												<td style="width: 20%;">TUPOKSI</td>
												<td style="width: 2%;">:</td>
												<td class="width: 78%"><?= strtoupper($data['tupoksi']) ?></td>
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
</div>