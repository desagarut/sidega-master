<script type="text/javascript">
	$(function() {
		var keyword = <?= $keyword ?>;
		$("#cari").autocomplete({
			source: keyword,
			maxShowItems: 10,
		});
	});
</script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Detail Rekanan</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('rekanan') ?>"><i class="fa fa-dashboard"></i> Rekanan</a></li>
			<li class="active">Detail Rekanan</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="mainform" name="mainform" action="" method="post">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<a href="<?= site_url("rekanan/form_dokumen_rekanan/$rekanan") ?>" class="btn btn-social btn-box btn-success btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Album">
								<i class="fa fa-plus"></i> Tambah Dokumen
							</a>
							<?php if ($this->CI->cek_hak_akses('h')) : ?>
								<a href="#confirm-delete" title="Hapus Data" onclick="deleteAllBox('mainform', '<?= site_url("rekanan/delete_all_dokumen_rekanan/$rekanan") ?>')" class="btn btn-social btn-box btn-danger btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block hapus-terpilih"><i class='fa fa-trash-o'></i> Hapus Data Terpilih</a>
							<?php endif; ?>
							<a href="<?= site_url("rekanan") ?>" class="btn btn-social btn-box btn-info btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Daftar Album">
								<i class="fa fa-arrow-circle-left "></i>Kembali ke Daftar Rekanan
							</a>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-sm-6">
									<h4><strong>Detail Data Rekanan</strong></h4>
									<div class="col-md-12">
										<div class="form-group row">
											<label class="col-sm-3 control-label" style="text-align:left;">Kode Rekanan</label>
											<div class="col-sm-9">
												<?= $data_rekanan['kode_rekanan'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 control-label" style="text-align:left;" for="jenis_rekanan">Jenis Rekanan</label>
											<div class="col-sm-3">
												<?= $data_rekanan['jenis_rekanan'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 control-label" style="text-align:left;">NIK Rekanan</label>
											<div class="col-sm-9">
												<?= $data_rekanan['nik_rekanan'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 control-label" style="text-align:left;">NPWP Rekanan</label>
											<div class="col-sm-9">
												<?= $data_rekanan['npwp_rekanan'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 control-label" style="text-align:left;">Nama Rekanan</label>
											<div class="col-sm-9">
												<?= $data_rekanan['nama_rekanan'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 control-label" style="text-align:left;">Nama Instansi</label>
											<div class="col-sm-9">
												<?= $data_rekanan['nama_instansi'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 control-label" style="text-align:left;">Jenis Usaha</label>
											<div class="col-sm-9">
												<?= $data_rekanan['jenis_usaha'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 control-label" style="text-align:left;">Nama Bank</label>
											<div class="col-sm-9">
												<?= $data_rekanan['nama_bank'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 control-label" style="text-align:left;">Nama Cabang</label>
											<div class="col-sm-9">
												<?= $data_rekanan['nama_cabang'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 control-label" style="text-align:left;">No. Rekening</label>
											<div class="col-sm-9">
												<?= $data_rekanan['no_rek'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 control-label" style="text-align:left;">Nama Rekening</label>
											<div class="col-sm-9">
												<?= $data_rekanan['nama_rekening'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 control-label" style="text-align:left;">Telepon</label>
											<div class="col-sm-9">
												<?= $data_rekanan['telepon'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 control-label" style="text-align:left;">Email</label>
											<div class="col-sm-9">
												<?= $data_rekanan['email'] ?>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-3 control-label" style="text-align:left;">Alamat</label>
											<div class="col-sm-9">
												<?= $data_rekanan['alamat'] ?>
											</div>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
								<h4><strong>Dokumen Rekanan</strong></h4>

									<?php if ($data_rekanan['gambar']) : ?>
										<div class="form-group">
											<label class="control-label col-sm-4" for="nama_rekanan"></label>
											<div class="col-sm-6">
												<img class="img img-responsive" style="width:400px" src="<?= AmbilGaleri($data_rekanan['gambar'], 'sedang') ?>" alt="Gambar Album">
											</div>
										</div>
									<?php endif; ?>

									<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
										<form id="mainform" name="mainform" action="" method="post">
											<div class="row">
												<div class="col-sm-6">
													<select class="form-control input-sm " name="filter" onchange="formAction('mainform', '<?= site_url("rekanan/filter/$rekanan") ?>')">
														<option value="">Semua</option>
														<option value="1" <?php if ($filter == 1) : ?>selected<?php endif ?>>Aktif</option>
														<option value="2" <?php if ($filter == 2) : ?>selected<?php endif ?>>Tidak Aktif</option>
													</select>
												</div>
												<div class="col-sm-6">
													<div class="box-tools">
														<div class="input-group input-group-sm pull-right">
															<input name="cari" id="cari" class="form-control" placeholder="Cari..." type="text" value="<?= html_escape($cari) ?>" onkeypress="if (event.keyCode == 13):$('#'+'mainform').attr('action', '<?= site_url('rekanan/search/$rekanan') ?>');$('#'+'mainform').submit();endif">
															<div class="input-group-btn">
																<button type="data_rekananmit" class="btn btn-default" onclick="$('#'+'mainform').attr('action', '<?= site_url("rekanan/search/$rekanan") ?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<div class="table-responsive">
														<table class="table table-bordered table-striped dataTable table-hover">
															<thead class="bg-gray disabled color-palette">
																<tr>
																	<th><input type="checkbox" id="checkall" /></th>
																	<th>No</th>
																	<th>Gambar</th>
																	<?php if ($o == 2) : ?>
																		<th><a href="<?= site_url("rekanan/dokumen_rekanan/$rekanan/$p/1") ?>">Nama Dokumen <i class='fa fa-sort-asc fa-sm'></i></a></th>
																	<?php elseif ($o == 1) : ?>
																		<th><a href="<?= site_url("rekanan/dokumen_rekanan/$rekanan/$p/2") ?>">Nama Dokumen <i class='fa fa-sort-desc fa-sm'></i></a></th>
																	<?php else : ?>
																		<th><a href="<?= site_url("rekanan/dokumen_rekanan/$rekanan/$p/1") ?>">Nama Dokumen <i class='fa fa-sort fa-sm'></i></a></th>
																	<?php endif; ?>
																	<th>Deskripsi</th>
																	<th>Aksi</th>
																</tr>
															</thead>
															<tbody>
																<?php foreach ($dokumen_rekanan as $data) : ?>
																	<tr>
																		<td><input type="checkbox" name="id_cb[]" value="<?= $data['id'] ?>" /></td>
																		<td><?= $data['no'] ?></td>
																		<td class="padat">
																			<div class="user-panel">
																				<div class="image2">
																					<img class="img-circle" alt="Foto Penduduk" src="<?= AmbilGaleri($data['gambar'], 'kecil') ?>" />
																				</div>
																			</div>
																		</td>
																		<td width="60%">
																			<label data-rel="popover" data-content="<img width=200 height=134 src=<?= AmbilGaleri($data['gambar'], 'kecil') ?>>"><?= $data['nama_rekanan'] ?></label>
																		</td>
																		<td><?= $data['deskripsi'] ?><br /><?= tgl_indo2($data['tgl_upload']) ?></td>
																		<td nowrap>
																			<a href="<?= site_url("rekanan/urut/$data[id]/1/$data_rekanan[id]") ?>" class="btn bg-olive btn-box btn-sm" title="Pindah Posisi Ke Bawah"><i class="fa fa-arrow-down"></i></a>
																			<a href="<?= site_url("rekanan/urut/$data[id]/2/$data_rekanan[id]") ?>" class="btn bg-olive btn-box btn-sm" title="Pindah Posisi Ke Atas"><i class="fa fa-arrow-up"></i></a>
																			<br />
																			<a href="<?= site_url("rekanan/form_dokumen_rekanan/$rekanan/$data[id]") ?>" class="btn btn-warning btn-box btn-sm" title="Ubah"><i class="fa fa-edit"></i></a>
																			<?php if ($this->CI->cek_hak_akses('h')) : ?>
																				<?php if ($data['enabled'] == '2') : ?>
																					<a href="<?= site_url("rekanan/rekanan_lock/" . $data['id'] . "/$rekanan") ?>" class="btn bg-navy btn-box btn-sm" title="Aktifkan Gambar"><i class="fa fa-lock">&nbsp;</i></a>
																				<?php elseif ($data['enabled'] == '1') : ?>
																					<a href="<?= site_url("rekanan/rekanan_unlock/" . $data['id'] . "/$rekanan") ?>" class="btn bg-navy btn-box btn-sm" title="Non Aktifkan Gambar"><i class="fa fa-unlock"></i></a>
																				<?php endif ?>
																				<a href="#" data-href="<?= site_url("rekanan/delete_dokumen_rekanan/$rekanan/$data[id]") ?>" class="btn bg-maroon btn-box btn-sm" title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
																			<?php endif; ?>
																		</td>
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
													<form id="paging" action="<?= site_url("rekanan/dokumen_rekanan/$rekanan") ?>" method="post" class="form-horizontal">
														<label>
															Tampilkan
															<select name="per_page" class="form-control input-sm" onchange="$('#paging').data_rekananmit()">
																<option value="20" <?php selected($per_page, 20); ?>>20</option>
																<option value="50" <?php selected($per_page, 50); ?>>50</option>
																<option value="100" <?php selected($per_page, 100); ?>>100</option>
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
															<li><a href="<?= site_url("rekanan/dokumen_rekanan/$rekanan/$paging->start_link/$o") ?>" aria-label="First"><span aria-hidden="true">Awal</span></a></li>
														<?php endif; ?>
														<?php if ($paging->prev) : ?>
															<li><a href="<?= site_url("rekanan/dokumen_rekanan/$rekanan/$paging->prev/$o") ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
														<?php endif; ?>
														<?php for ($i = $paging->start_link; $i <= $paging->end_link; $i++) : ?>
															<li <?= jecho($p, $i, "class='active'") ?>><a href="<?= site_url("rekanan/dokumen_rekanan/$rekanan/$i/$o") ?>"><?= $i ?></a></li>
														<?php endfor; ?>
														<?php if ($paging->next) : ?>
															<li><a href="<?= site_url("rekanan/dokumen_rekanan/$rekanan/$paging->next/$o") ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
														<?php endif; ?>
														<?php if ($paging->end_link) : ?>
															<li><a href="<?= site_url("rekanan/dokumen_rekanan/$rekanan/$paging->end_link/$o") ?>" aria-label="Last"><span aria-hidden="true">Akhir</span></a></li>
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
		</form>
	</section>
</div>
<?php $this->load->view('global/confirm_delete'); ?>