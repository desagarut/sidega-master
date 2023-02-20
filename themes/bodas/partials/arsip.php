<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Courses Start -->
<div class="container-xxl py-5">
	<div class="container">
		<div class="text-center wow fadeInUp" data-wow-delay="0.1s">
			<h6 class="section-title bg-white text-center text-primary px-3">Blog</h6>
			<h1 class="mb-5">Arsip Artikel</h1>
		</div>
		<div class="row g-4 justify-content-center">
			<?php if (count($farsip) > 0) : ?>
				<?php foreach ($farsip as $data) : ?>

					<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
						<div class="course-item bg-light">
							<div class="position-relative overflow-hidden">
								<img class="img-fluid" src="<?= AmbilFotoArtikel($data['gambar' . $i], 'sedang') ?>" alt="<?= $data['judul'] ?>">
								<div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mb-4">
									<a href="<?= site_url('artikel/' . buat_slug($data)) ?>" class="flex-shrink-0 btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>
									<a href="<?= site_url('artikel/' . buat_slug($data)) ?>" class="flex-shrink-0 btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Join Now</a>
								</div>
							</div>
							<div class="text-center p-4 pb-0">
								<h5 class="mb-4"><?= $data['judul'] ?></h5>
							</div>
							<div class="text-justify" style="padding-left: 15px; padding-right:15px;">
								<p><?= potong_teks($data['isi'], 150) ?></p>
							</div>
							<div class="d-flex border-top">
								<small class="flex-fill text-center border-end py-2"><i class="fa fa-user-tie text-primary me-2"></i><?= $data['owner'] ?></small>
								<small class="flex-fill text-center border-end py-2"><i class="fa fa-clock text-primary me-2"></i><?= tgl_indo($data['tgl_upload']) ?></small>
								<small class="flex-fill text-center py-2"><i class="fa fa-user text-primary me-2"></i><?= $data['hit'] ?></small>
							</div>
						</div>
					</div>

				<?php endforeach; ?>
			<?php endif; ?>

		</div>
	</div>
</div>