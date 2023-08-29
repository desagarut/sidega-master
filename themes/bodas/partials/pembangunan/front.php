<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<div class="container-fluid p-0 mb-5">
	<div class="container">
		<div class="text-center wow fadeInUp" data-wow-delay="0.1s">
			<h6 class="section-title bg-white text-center text-primary px-3">Program/Kegiatan</h6>
			<h1 class="mb-5">Pembangunan</h1>
		</div>
		<div class="row g-4 owl-carousel testimonial-carousel">
			<?php if ($pembangunan) : ?>
				<?php foreach ($pembangunan as $data) : ?>
					<div class="col-md-12 wow fadeInUp testimonial-item text-center" data-wow-delay="0.1s">
						<div class="team-item bg-light">
							<div class="overflow-hidden" style="padding:10px 10px 10px 10px">
								<?php if (is_file(LOKASI_GALERI . $data['foto'])) : ?>
									<img class="img-fluid" style="object-fit: cover; width:100%; height:300px; padding: 10px 10px 10px 10px" src="<?= base_url() . LOKASI_GALERI . $data['foto'] ?>" alt="Foto Program/Kegiatan" />
								<?php else : ?>
									<img class="img-fluid" style="object-fit: cover; width:100%; height:300px; padding: 10px 10px 10px 10px" src="<?= base_url() ?>themes/bodas/assets/img/noimage.png" alt="Foto Program/Kegiatan" />
								<?php endif; ?>
								<div class="text-center p-4 pb-0">
									<h5 class="mb-4"><a href="<?= site_url("first/pembangunan_detail/") ?><?= $data['id']; ?>"><?= $data['nama_program_kegiatan'] ?> (<small><?= $data['tahun'] ?>)</small></a></h5>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
