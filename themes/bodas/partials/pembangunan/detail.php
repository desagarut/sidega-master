<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>


<div class="container-xxl py-4">
	<div class="container">
		<?php if ($detail_pembangunan) : ?>
			<div class="text-center wow fadeInUp" data-wow-delay="0.1s">
				<h6 class="section-title bg-white text-center text-primary px-3">DETAIL PELAKSANAAN PEMBANGUNAN </h6>
				<h4 class="mb-1"><?= strtoupper($detail_pembangunan['nama_program_kegiatan']); ?></h4>
				<h4 class="mb-5 text-end"><a href="<?= site_url("first/kegiatan_pembangunan/") ?>" class="flex-shrink-0 btn btn-sm btn-success px-3" style="border-radius: 8px 8px 8px 8px;">kembali</a></h4>
			</div>

			<div class="row g-4 bg-light">
				<div class="col-lg-6 col-md-6 wow zoomIn bg-light" data-wow-delay="0.5s">
					<?php if (is_file(LOKASI_GALERI . $detail_pembangunan['foto'])) : ?>
						<img class="img-fluid" style="object-fit: cover; width:100%; height:350px;" src="<?= base_url(LOKASI_GALERI . $detail_pembangunan['foto']); ?>" alt="<?= $detail_pembangunan['slug']; ?>" />
					<?php else : ?>
						<img class="img-fluid" style="object-fit: cover; width:100%; height:350px;" src="<?= base_url() ?>themes/bodas/assets/img/noimage.png" alt="<?= $detail_pembangunan['slug']; ?>" />
					<?php endif; ?>
				</div>
				<div class="col-lg-6 col-md-6 wow zoomIn bg-light" data-wow-delay="0.7s">
					<?php $this->load->view($folder_themes . '/partials/pembangunan/maps') ?>
					<br /><a href="https://www.google.com/maps/search/<?= $detail_pembangunan['lat'] ?>,<?= $detail_pembangunan['lng'] ?>" class="btn btn-box btn-warning btn-social btn-sm" target="_blank"><i class="fa fa-map-marker"></i> Buka di Google Maps</a>
				</div>
			</div>
			<div class="row g-4 bg-light py-4">
				<div class="col-md-6">
					<div class="col-lg-12 col-md-12 wow zoomIn bg-light" data-wow-delay="0.5s">
						<h4 class="mb-3 text-center">Data Pembangunan</h4>
						<table class="table table-responsive">
							<tr>
								<th width="150px">Nama Program/Kegiatan</th>
								<td width="20px">:</td>
								<td><?= $detail_pembangunan->nama_program_kegiatan ?></td>
							</tr>
							<tr>
								<th>Alamat</th>
								<td width="20px">:</td>
								<td><?= $detail_pembangunan['lokasi'] ?></td>
							</tr>
							<tr>
								<th>Sumber Dana</th>
								<td width="20px">:</td>
								<td><?= $detail_pembangunan['sumber_dana'] ?></td>
							</tr>
							<tr>
								<th>Anggaran</th>
								<td width="20px">:</td>
								<td>Rp. <?= number_format($detail_pembangunan['anggaran']) ?></td>
							</tr>
							<tr>
								<th>Volume</th>
								<td width="20px">:</td>
								<td><?= $detail_pembangunan['volume'] ?></td>
							</tr>
							<tr>
								<th>Pelaksana</th>
								<td width="20px">:</td>
								<td><?= $detail_pembangunan['pelaksana_kegiatan'] ?></td>
							</tr>
							<tr>
								<th>Pengusul</th>
								<td width="20px">:</td>
								<td><?= $detail_pembangunan['pengusul'] ?></td>
							</tr>

							<tr>
								<th>Tahun</th>
								<td width="20px">:</td>
								<td><?= $detail_pembangunan['tahun'] ?></td>
							</tr>
							<tr>
								<th>Keterangan</th>
								<td width="20px">:</td>
								<td><?= $detail_pembangunan['keterangan'] ?></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
					<div class="course-item bg-light">
						<div class="position-relative overflow-hidden text-center" style="padding: 10px 10px 10px 10px">
							<h4 class="mb-3">Progres Pembangunan</h4>
							<?php if ($detail_pembangunan) :
							?>
								<div class="row">
									<?php foreach ($detail_pembangunan as $data) : ?>
										<div class="col-sm-6 text-center">
											<?php if (is_file(LOKASI_GALERI . $data['foto'])) : ?>
												<img width="auto" class="img-fluid img-thumbnail" src="<?= base_url(LOKASI_GALERI . $data['gambar']); ?>" alt="<?= $data['slug'] . '-' . $data['persentase']; ?>" />
											<?php else : ?>
												<img width="auto" class="img-fluid img-thumbnail" src="<?= base_url() ?>themes/bodas/assets/img/noimage.png" alt="<?= $data['slug'] . '-' . $data['persentase']; ?>" />
											<?php endif; ?>
											<b>Foto Pembangunan <?= $data['persentase']; ?> <?= $data['keterangan']; ?></b>
										</div>
									<?php endforeach; ?>
								</div>
							<?php else :
							?>
								<div class="text-center">Belum ada progres</div>
							<?php endif;
							?>
						</div>
					</div>
				</div>
			</div>
			<?php $this->load->view("$folder_themes/commons/share", $share);	?>
		<?php else : ?>
			<?php $this->load->view("$folder_themes/commons/404"); ?>
		<?php endif; ?>
	</div>
</div>