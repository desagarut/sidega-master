<div class="content-wrapper">
	<section class="content-header">
		<h1>Data Kejadian Bencana, Kedaruratan dan Mendesak</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Data Kejadian Bencana, Kedaruratan dan Mendesak</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<?php if ($this->CI->cek_hak_akses('h')) : ?>
							<a href="<?= site_url('bidang_bencana_darurat_mendesak/form_kejadian') ?>" class="btn btn-social btn-box bg-olive btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Program Bantuan"><i class="fa fa-plus"></i> Tambah</a>
						<?php endif; ?>
						<a href="<?= site_url('bidang_bencana_darurat_mendesak/panduan') ?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Panduan"><i class="fa fa-question-circle"></i> Panduan</a>
						<?php if ($tampil != 0) : ?>
							<a href="<?= site_url('bidang_bencana_darurat_mendesak') ?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Daftar Program Bantuan"><i class="fa fa-arrow-circle-o-left"></i> Kembali Ke Daftar Program Bantuan</a>
						<?php endif; ?>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
									<div class="row">
										<div class="col-sm-9">
											<form id="mainform" name="mainform" action="" method="post">
												<select class="form-control input-sm" name="kelompok_bencana" onchange="formAction('mainform', '<?= site_url('bidang_bencana_darurat_mendesak/filter/kelompok_bencana') ?>')">
													<option value="">Pilih Jenis Bencana</option>
													<?php foreach ($list_kelompok_bencana as $key => $value) : ?>
														<option value="<?= $key; ?>" <?= selected($set_kelompok_bencana, $key); ?>><?= $value ?></option>
													<?php endforeach; ?>
												</select>
											</form>
										</div>
										<div class="col-sm-12">
											<div class="table-responsive">
												<table class="table table-bordered table-striped dataTable table-hover" id="table-laporan-kejadian-bencana">
													<thead class="bg-gray disabled color-palette">
														<tr>
															<th width="1%">No</th>
															<?php if ($this->CI->cek_hak_akses('h')) : ?>
																<th width="5%" class="text-center">Aksi</th>
															<?php endif ?>
															<th class="text-center">Tanggal Kejadian</th>
															<th class="text-center">Jenis Bencana</th>
															<th class="text-center">Lokasi Bencana</th>
															<th class="text-center">Penyebab Bencana</th>
															<th class="text-center">Deskripsi </th>
															<th class="text-center">Jumlah Korban</th>
															<th class="text-center">Kerusakan</th>
															<th class="text-center">Sumber Informasi</th>
															<th class="text-center">Status</th>
														</tr>
													</thead>
													<tbody>
														<?php $nomer = $paging->offset; ?>
														<?php foreach ($kejadian_bencana as $item) : ?>
															<?php $nomer++; ?>
															<tr>
																<td class="text-center"><?= $nomer ?></td>
																<?php if ($this->CI->cek_hak_akses('h')) : ?>
																	<td>
																		<div class="btn-group">
																			<a href="#" class="btn btn-social bg-aqua btn-box btn-sm" data-toggle="dropdown" title="Aksi">Aksi <i class="fa fa-arrow-circle-down"></i></a>
																			<ul class="dropdown-menu" role="menu">
																				<li class="text-left">
																					<a href="<?= site_url("bidang_bencana_darurat_mendesak/detail_kejadian/$item[id]") ?>" class="btn btn-social btn-box btn-block btn-sm"><i class="fa fa-eye"></i>Detail Kejadian</a>
																				</li>
																				<li>
																					<a href="<?= site_url("bidang_bencana_darurat_mendesak/warga_terdampak_daftar/$item[id]") ?>" class="btn btn-social btn-box btn-block btn-sm" title="Detail Warga Terdampak"><i class="fa fa-list-ul"></i>Warga terdampak</a>
																				</li>
																				<!--<li>
																					<?php if ($item['jumlah_korban'] != 0) : ?>
																						<a href="<?= site_url("bidang_bencana_darurat_mendesak/expor/$item[id]"); ?>" class="btn btn-social btn-box btn-block btn-sm" title="Download"><i class="fa fa-download"></i>Download</a>
																					<?php endif ?>
																				</li>
																				<li>-->
																					<a href="<?= site_url("bidang_bencana_darurat_mendesak/form_kejadian/$item[id]") ?>" class="btn btn-social btn-box btn-block btn-sm" title="Ubah"><i class="fa fa-edit"></i>Edit Kejadian</a>
																				</li>
																				<li>
																					<?php if ($item['jumlah_korban'] != 0) : ?>
																						<a href="#" class="btn bg-maroon btn-social btn-box btn-block btn-sm disabled" title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i>Hapus</a>
																					<?php endif ?>
																				</li>
																			</ul>
																		</div>

																		<?php if ($item['jumlah_korban'] == 0) : ?>
																			<a href="#" data-href="<?= site_url("bidang_bencana_darurat_mendesak/hapus/$item[id]") ?>" class="btn bg-maroon btn-box btn-sm" title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
																		<?php endif ?>
																	</td>
																<?php endif; ?>
																<td nowrap><a href="<?= site_url("bidang_bencana_darurat_mendesak/detail/$item[id]") ?>"><?= $item["tanggal_kejadian"] ?><br/><?= $item["waktu_kejadian"] ?></a></td>
																<td nowrap><?= $list_kelompok_bencana[$item["kelompok_bencana"]]?><br /><?= $item['jenis_bencana'] ?></td>
																<td width="10%"><?= $item['lokasi_bencana'] ?></td>
																<td><?= $item['penyebab_bencana'] ?></td>
																<td><?= $item['deskripsi_bencana'] ?></td>
																<td width="8%">Meninggal: <?= $item['korban_meninggal'] ?><br />
																	Hilang: <?= $item['korban_hilang'] ?><br />
																	Luka Berat: <?= $item['korban_lukaberat'] ?><br />
																	Lukas Ringan :<?= $item['korban_lukarigan'] ?><br />
																</td>
																<td>bangunan: <?= $item['kerusakan_bangunan'] ?><br />
																	Lintas sektor: <?= $item['kerusakan_ls'] ?></td>
																<td width="10%"><?= $item['nama_pelapor'] ?> - <br/>
																<?= $item['alamat_pelapor'] ?> - <br/>
																<?= $item['nomor_pelapor'] ?></td>
																<td nowrap><?= $item['status'] ?></td>

															</tr>
														<?php endforeach; ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<?php $this->load->view('global/paging'); ?>
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

<?php include('district-app/views/bidang_bencana_darurat_mendesak/impor.php'); ?>