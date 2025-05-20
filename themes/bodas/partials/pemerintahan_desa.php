<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Service Start -->
<div class="row justify-content-center">
	<h4 class="mb-5 text-center">Pemerintahan Desa</h4>

	<div class="course-item">
		<div class="position-relative overflow-hidden text-center" style="padding: 10px 10px 10px 10px">
			<?php foreach ($aparatur_desa['daftar_perangkat'] as $data) : ?>
				<div class="row p-4 justify-content-center" style="padding: 2px 2px 2px 2px">
					<div class="col-md-4 wow fadeInUp" data-wow-delay="0.1s">
						<div class="course-item bg-light">
							<div class="position-relative overflow-hidden">
								<?php if ($data['foto']): ?>
									<img class="img-fluid" src="<?= AmbilFoto($data['foto'], "besar") ?>" alt="User Image" />
								<?php else: ?>
									<img class="img-fluid" src="<?= base_url() ?>assets/files/user_pict/kuser.png" alt="User Image" />
								<?php endif ?>
							</div>
						</div>
					</div>
					<div class="col-md-8 wow fadeInUp" data-wow-delay="0.1s">
						<div class="row">
							<div class="col-md-4">
								<div>Nama :</div>
							</div>
							<div class="col-md-8">
								<div class="nama-pejabat"><?= $data['nama'] ?></div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="text-left">Jabatan :</div>
							</div>
							<div class="col-md-7">
								<div class="text-left"><?= $data['jabatan'] ?></div>
							</div>
						</div>
						<div class="row">
							<?php if (!empty($data['pamong_nip']) and $data['pamong_nip'] != '-'): ?>
								<div class="col-md-5">
									<div class="text-left">NIP :</div>
								</div>
								<div class="col-md-7">
									<div class="text-left"><?= $data['pamong_nip'] ?></div>
								</div>
							<?php else: ?>
								<div class="col-md-5">
									<div class="text-left">NIAP :</div>
								</div>
								<div class="col-md-7">
									<div class="text-left"><?= $data['pamong_niap'] ?></div>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>