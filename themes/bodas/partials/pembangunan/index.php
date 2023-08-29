<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<!-- ======= Gallery Youtube ======= -->

<div class="container-xxl py-0">
	<div class="container">
		<div class="text-center wow fadeInUp" data-wow-delay="0.1s">
			<h6 class="section-title bg-white text-center text-primary px-3">DAFTAR KEGIATAN PEMBANGUNAN </h6>
			<h3 class="mb-5"><?= strtoupper($this->setting->sebutan_desa) . ' ' . strtoupper($desa['nama_desa']) . ' ' . KECAMATAN . ' ' . strtoupper($desa['nama_kecamatan']) ?></h3>
		</div>

		<div class="row g-4 justify-content-center">
			<?php if ($pembangunan) : ?>
				<?php foreach ($pembangunan as $data) : ?>
					<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
						<div class="course-item bg-light">
							<div class="position-relative overflow-hidden text-center">
								<?php if (is_file(LOKASI_GALERI . $data['foto'])) : ?>
									<a href="<?= site_url("first/pembangunan_detail/{$data['id']}") ?>">
										<img class="img-fluid" style="object-fit: cover; width:100%; height:300px; padding: 10px 10px 10px 10px" src="<?= base_url() . LOKASI_GALERI . $data['foto'] ?>" alt="Foto Pembangunan" />
									</a>
								<?php else : ?>
									<a href="<?= site_url("first/pembangunan_detail/{$data['id']}") ?>">
										<img class="img-fluid" style="object-fit: cover; width:100%; height:300px; padding: 10px 10px 10px 10px" src="<?= base_url() ?>themes/bodas/assets/img/noimage.png" alt="Foto Pembangunan" />
									</a>
								<?php endif; ?>
								<div class="text-start p-4 pb-3">
									<table>
										<tbody>
											<tr>
												<th width="auto"><small>Nama Kegiatan</small></th>
												<td width="1%">:</td>
												<td><?= $data['nama_program_kegiatan'] ?></td>
											</tr>
											<tr>
												<th><small>Alamat</small></th>
												<td>:</td>
												<td><?= $data['lokasi'] ?></td>
											</tr>
											<tr>
												<th><small>Tahun</small></th>
												<td>:</td>
												<td>
													<?= $data['tahun'] ?></td>
											</tr>
											<tr>
												<th><small>Keterangan</small></th>
												<td>:</td>
												<td><?= $data['keterangan'] ?></td>
											</tr>
										</tbody>
									</table>
									<a href="<?= site_url("first/pembangunan_detail/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-success px-3" style="border-radius: 8px 8px 8px 8px;">Selengkapnya</a>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
				<?php $this->load->view($folder_themes . '/commons/paging') ?>
			<?php else : ?>
				<h5>Data pembangunan tidak tersedia.</h5>
			<?php endif; ?>
		</div>

	</div>
</div>