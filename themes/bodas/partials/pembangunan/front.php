<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<div class="container-fluid p-0 mb-5">
	<div class="container">
		<div class="text-center wow fadeInUp" data-wow-delay="0.1s">
			<h6 class="section-title bg-white text-center text-primary px-3">Pembangunan</h6>
			<h1 class="mb-5">Kegiatan Pembangunan</h1>
		</div>
		<div class="row g-4 owl-carousel testimonial-carousel">
			<?php if ($pembangunan) : ?>
				<?php foreach ($pembangunan as $data) : ?>
					<div class="col-md-12 wow fadeInUp testimonial-item text-center" data-wow-delay="0.1s">
						<div class="team-item bg-light">
							<div class="overflow-hidden" style="padding:10px 10px 10px 10px">

								<?php if (is_file(LOKASI_GALERI . $data->foto)) : ?>
									<img class="img-fluid" style="object-fit: cover; height:200px" src="<?= base_url() . LOKASI_GALERI . $data->foto ?>" alt="Foto Pembangunan" />
								<?php else : ?>
									<img class="img-fluid" style="object-fit: cover; height:200px" src="<?= base_url('assets/images/404-image-not-found.jpg') ?>" alt="Foto Pembangunan" />
								<?php endif; ?>
								<div class="text-start p-4">
									<table>
										<tbody>
											<tr>
												<th width="auto"><small>Nama Kegiatan</small></th>
												<td width="1%">:</td>
												<td><?= $data->judul ?></td>
											</tr>
											<tr>
												<th><small>Alamat</small></th>
												<td>:</td>

												<td><?= ($data->alamat == "=== Lokasi Tidak Ditemukan ===") ? 'Lokasi tidak diketahui' : $data->alamat; ?></td>
											</tr>
											<tr>
												<th><small>Tahun</small></th>
												<td>:</td>
												<td>
													<?= $data->tahun_anggaran ?></td>
											</tr>
											<tr>
												<th><small>Keterangan</small></th>
												<td>:</td>
												<td><?= $data->keterangan ?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<!--<a href="<? //= site_url("first/pembangunan_detail/{$data['id']}") ?>" class="btn btn-primary">Selengkapnya</a>-->
								<a href="<?= site_url("first/pembangunan/") ?>" class="btn btn-primary">Selengkapnya</a>

							</div>
						</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</div>