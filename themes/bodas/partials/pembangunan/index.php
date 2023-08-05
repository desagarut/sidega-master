<?php defined('BASEPATH') || exit('No direct script access allowed'); ?>

<!-- ======= Gallery Youtube ======= -->

<div class="container-xxl py-0">
	<div class="container">
		<div class="text-center wow fadeInUp" data-wow-delay="0.1s">
			<h4 class="mb-5 text-start">Pembangunan <a href="<?= site_url("first/pembangunan/{$data['id']}") ?>" class="flex-shrink-0 btn btn-sm btn-light px-3" style="border-radius: 8px 8px 8px 8px;">Perencanaan</a> | <a href="#" class="flex-shrink-0 btn btn-sm btn-warning px-3" style="border-radius: 8px 8px 8px 8px;">Pelaksanaan</a> | <a href="#" class="flex-shrink-0 btn btn-sm btn-light px-3" style="border-radius: 8px 8px 8px 8px;">Progres</a></h4>
		</div>
		<div class="row g-4">
			<?php if ($pembangunan) : ?>
				<div class="row">
					<?php foreach ($pembangunan as $data) : ?>
						<div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
							<div class="course-item bg-light">
								<div class="position-relative overflow-hidden text-center" style="padding: 10px 10px 10px 10px">
									<?php if (is_file(LOKASI_GALERI . $data->foto)) : ?>
										<img width="auto" class="img-fluid" style="object-fit: cover; height:200px" src="<?= base_url() . LOKASI_GALERI . $data->foto ?>" alt="Foto Pembangunan" />
									<?php else : ?>
										<img width="auto" class="img-fluid" style="object-fit: cover; height:200px" src="<?= base_url('assets/images/404-image-not-found.jpg') ?>" alt="Foto Pembangunan" />
									<?php endif; ?>
									<div class="text-start p-4 pb-0">
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
										<!--<a href="#" class="btn btn-primary">Selengkapnya</a>-->
									</div>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
				<?php $this->load->view($folder_themes . '/commons/paging') ?>
			<?php else : ?>
				<h5>Data pembangunan tidak tersedia.</h5>
			<?php endif; ?>
		</div>
	</div>
</div>