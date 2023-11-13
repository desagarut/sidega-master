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
							<a href="<?= site_url('bidang_bencana_darurat_mendesak/form_laporan_kejadian') ?>" class="btn btn-social btn-box bg-olive btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Program Bantuan"><i class="fa fa-plus"></i> Tambah</a>
							<a href="<?= site_url('bidang_bencana_darurat_mendesak/impor') ?>" class="btn btn-social btn-box bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Impor Program Bantuan" data-target="#impor" data-remote="false" data-toggle="modal" data-backdrop="false" data-keyboard="false"><i class="fa fa-upload"></i> Impor</a>
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
												<select class="form-control input-sm" name="sasaran" onchange="formAction('mainform', '<?= site_url('bidang_bencana_darurat_mendesak/filter/sasaran') ?>')">
													<option value="">Pilih Sasaran</option>
													<?php foreach ($list_sasaran as $key => $value) : ?>
														<option value="<?= $key; ?>" <?= selected($set_sasaran, $key); ?>><?= $value ?></option>
													<?php endforeach; ?>
												</select>
											</form>
										</div>
										<div class="col-sm-12">
											<div class="table-responsive">
												<table class="table table-bordered table-striped dataTable table-hover" id="table-program">
													<thead class="bg-gray disabled color-palette">
														<tr>
															<th width="1%">No</th>
															<?php if ($this->CI->cek_hak_akses('h')) : ?>
																<th width="5%" class="text-center">Aksi</th>
															<?php endif ?>
															<th class="text-center">Jenis Bencana</th>
															<th class="text-center">Tanggal Kejadian</th>
															<th class="text-center">Waktu Kejadian</th>
															<th class="text-center">Lokasi Bencana</th>
															<th class="text-center">Penyebab Bencana</th>
															<th class="text-center">Deskripsi </th>
															<th class="text-center">Korban Jiwa</th>
															<th class="text-center">Kerusakan</th>
															<th class="text-center">Sumber Informasi</th>
														</tr>
													</thead>
													<tbody>
														<?php $nomer = $paging->offset; ?>
														<?php foreach ($program as $item) : ?>
															<?php $nomer++; ?>
															<tr>
																<td class="text-center"><?= $nomer ?></td>
																<?php if ($this->CI->cek_hak_akses('h')) : ?>
																	<td nowrap>
																		<div class="btn-group">
																			<a href="#" class="btn btn-social bg-aqua btn-box btn-sm" data-toggle="dropdown" title="Aksi">Aksi <i class="fa fa-arrow-circle-down"></i></a>
																			<ul class="dropdown-menu" role="menu">
																				<li class="text-left">
																					<a href="<?= site_url("penduduk/detail/$p/$o/$data[id]"); ?>" class="btn btn-social btn-box btn-block btn-sm"><i class="fa fa-eye"></i>Detail Kejadian</a>
																				</li>
																				<li>
																					<a href="<?= site_url("bidang_bencana_darurat_mendesak/detail/$item[id]") ?>" class="btn btn-social btn-box btn-block btn-sm" title="Detail Warga Terdampak"><i class="fa fa-list-ul"></i>Detail Warga terdampak</a>
																				</li>
																				<li>
																					<?php if ($item['jml_peserta'] != 0) : ?>
																						<a href="<?= site_url("bidang_bencana_darurat_mendesak/expor/$item[id]"); ?>"class="btn btn-social btn-box btn-block btn-sm" title="Download"><i class="fa fa-download"></i>Download</a>
																					<?php endif ?>
																				</li>
																				<li>
																					<a href="<?= site_url("bidang_bencana_darurat_mendesak/edit_laporan_kejadian/$item[id]") ?>" class="btn btn-social btn-box btn-block btn-sm" title="Ubah"><i class="fa fa-edit"></i>Edit Kejadian</a>
																				</li>
																				<li>
																					<?php if ($item['jml_peserta'] != 0) : ?>
																						<a href="#" class="btn bg-maroon btn-social btn-box btn-block btn-sm disabled" title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i>Hapus</a>
																					<?php endif ?>
																				</li>
																			</ul>
																		</div>

																		<?php if ($item['jml_peserta'] == 0) : ?>
																			<a href="#" data-href="<?= site_url("bidang_bencana_darurat_mendesak/hapus/$item[id]") ?>" class="btn bg-maroon btn-box btn-sm" title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
																		<?php endif ?>
																	</td>
																<?php endif; ?>
																<td nowrap><a href="<?= site_url("bidang_bencana_darurat_mendesak/detail/$item[id]") ?>"><?= $item["nama"] ?></a></td>
																<td nowrap><?= $item['penyelenggara'] ?></td>
																<td nowrap><?= $item['asaldana'] ?></td>
																<td nowrap><?= Rupiah($item['anggaran']) ?></td>
																<td align="center"><?= $item['jml_peserta'] ?></td>
																<td align="center"><?= fTampilTgl($item["sdate"], $item["edate"]); ?></td>
																<td align="center"><?= $sasaran[$item["sasaran"]] ?></td>
																<td align="center"><?= $item['status'] ?></td>
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