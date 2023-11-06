<style>
	.input-sm {
		padding: 4px 4px;
	}
</style>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Pendataan Balita </h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Kesehatan</li>
			<li class="active">Data Balita</li>
		</ol>
	</section>

	<section class="content" id="maincontent">
		<div class="row">
			<div id="kesehatan" class="col-sm-2">
				<?php $this->load->view('kesehatan/balita/menu') ?>
			</div>
			<div class="col-md-10">
				<div class="box box-info">
					<div class="box-header with-border">
						<a href="<?= site_url("kesehatan_balita/form_balita") ?>" title="Tambah Data Balita" class="btn btn-social btn-box bg-olive btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-plus"></i> Tambah Data Balita</a>
						<a href="<?= site_url("kesehatan_balita/daftar/cetak") ?>" class="btn btn-social btn-box bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Cetak" target="_blank"><i class="fa fa-print"></i> Cetak</a>
						<a href="<?= site_url("kesehatan_balita/daftar/unduh") ?>" class="btn btn-social btn-box bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Unduh" target="_blank"><i class="fa fa-download"></i> Unduh</a>
						<a href="<?= site_url("kesehatan_balita/pantau") ?>" class="btn btn-box btn-info btn-sm" title="Pemantauan Balita">Ke Pemantauan Balita</a>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
									<form id="mainform" name="mainform" action="" method="post">
										<div class="row">
											<div class="col-sm-12">
												<div class="table-responsive">
													<table class="table table-bordered dataTable table-striped table-hover">
														<thead class="bg-gray disabled color-palette">
															<tr>
																<th>No</th>
																<th>Aksi</th>
																<th>Foto</th>

																<th>Nama / NIK</th>
																<th class="text-center">Usia Saat Ini</th>
																<th>JK</th>
																<th>Ayah - Ibu</th>

																<th>Alamat</th>
																<th>Tanggal Terdaftar</th>
																<th>BB/TB</th>
																<th>Kontak</th>
																<th>Riwayat Penyakit</th>
																<th>Wajib Pantau</th>
															</tr>
														</thead>
														<tbody>
															<?php
															$nomer = $paging->offset;
															foreach ($balita_list as $key => $item) :
																$nomer++;
															?>
																<tr>
																	<td align="center" width="2"><?= $nomer; ?></td>
																	<td nowrap>
																		<?php if ($this->CI->cek_hak_akses('h')) : ?>
																			<a href="<?= site_url("kesehatan_balita/edit_balita_form/$item[id]") ?>" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Ubah Data Balita" title="Ubah Data Pemudik" class="btn btn-warning btn-box btn-sm"><i class="fa fa-edit"></i></a>
																			<a href="#" data-href="<?= site_url("kesehatan_balita/hapus_balita/$item[id]") ?>" class="btn bg-maroon btn-box btn-sm" title="Hapus Data" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
																		<?php endif; ?>
																	</td>
																	<td>
																		<img class="img img-circle" style="with:100px; height:100px" src="<?= AmbilFoto($item['foto'], '', $item['id_sex']) ?>" alt="foto <?= strtoupper($item['nama']); ?>" title="foto <?= strtoupper($item['nama']); ?>" />
																	</td>
																	<td nowrap><a href="<?= site_url('kesehatan_balita/detil_balita/' . $item["id"]) ?>" title="Data terdata"><?= $item['terdata_info']; ?> /<br> <?= $item["terdata_nama"] ?></a></td>
																	<td class="text-center"><?= $item["umur"] ?></td>
																	<?php
																	$jk = (strtoupper($item['sex']) === "PEREMPUAN") ? "P" : "L";
																	?>
																	<td><?= $jk ?></td>
																	<td><?= $item["nama_ayah"]; ?> - <?= $item["nama_ibu"]; ?></td>

																	<td><?= $item["info"]; ?></td>
																	<td><?= $item["tanggal_terdaftar"]; ?></td>
																	<td nowrap><?= $item["bb_lahir"]; ?> / <?= $item["tb_lahir"]; ?></td>
																	<td><?= $item["hp_ortu"]; ?> - <?= $item["email_ortu"]; ?> </td>
																	<td><?= $item["riwayat_penyakit"]; ?></td>
																	<td><?= ($item["is_wajib_pantau"] === '1' ? "Ya" : "Tidak"); ?></td>
																</tr>
															<?php endforeach; ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</form>
									<div class="row">
										<div class="col-sm-6">
											<div class="dataTables_length">
												<form id="paging" action="" method="post" class="form-horizontal">
													<label>
														Tampilkan
														<select name="per_page" class="form-control input-sm" onchange="$('#paging').submit()">
															<option value="10" <?php selected($per_page, 10); ?>>10</option>
															<option value="100" <?php selected($per_page, 100); ?>>100</option>
															<option value="200" <?php selected($per_page, 200); ?>>200</option>
														</select>
														Dari
														<strong><?= $paging->num_rows ?></strong>
														Total Data
													</label>
												</form>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="dataTables_paginate paging_simple_numbers">
												<ul class="pagination">
													<?php if ($paging->start_link) : ?>
														<li>
															<a href="<?= site_url('kesehatan_balita/data_balita/' . $paging->start_link) ?>" aria-label="First"><span aria-hidden="true">Awal</span></a>
														</li>
													<?php endif; ?>
													<?php if ($paging->prev) : ?>
														<li>
															<a href="<?= site_url('kesehatan_balita/data_balita/' . $paging->prev) ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
														</li>
													<?php endif; ?>
													<?php for ($i = $paging->start_link; $i <= $paging->end_link; $i++) : ?>
														<li <?= jecho($p, $i, "class='active'") ?>>
															<a href="<?= site_url('kesehatan_balita/data_balita/' . $i) ?>"><?= $i ?></a>
														</li>
													<?php endfor; ?>
													<?php if ($paging->next) : ?>
														<li>
															<a href="<?= site_url('kesehatan_balita/data_balita/' . $paging->next) ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
														</li>
													<?php endif; ?>
													<?php if ($paging->end_link) : ?>
														<li>
															<a href="<?= site_url('kesehatan_balita/data_balita/' . $paging->end_link) ?>" aria-label="Last"><span aria-hidden="true">Akhir</span></a>
														</li>
													<?php endif; ?>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php $this->load->view('global/confirm_delete'); ?>

<div class="modal fade" id="modalBox" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
				<h4 class='modal-title' id='myModalLabel'></h4>
			</div>
			<div class="fetched-data"></div>
		</div>
	</div>
</div>