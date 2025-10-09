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
		<h1>Administrasi BPD - Data Aspirasi Masyarakat</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('beranda') ?>"> Administrasi BPD</a></li>
			<li class="active">Aspirasi Masyarakat</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="mainform" name="mainform" action="" method="post">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<a href="<?= site_url("bpd_buku_aspirasi/form") ?>" class="btn btn-social btn-box btn-success btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Artikel">
								<i class="fa fa-plus"></i> Tambah Kegiatan
							</a>
							<a href="#confirm-delete" title="Hapus Data" onclick="deleteAllBox('mainform', '<?= site_url("bpd_buku_aspirasi/delete_all/$p/$o") ?>')" class="btn btn-social btn-box btn-danger btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block hapus-terpilih"><i class='fa fa-trash-o'></i> Hapus Data Terpilih</a>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-sm-12">
									<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
										<form id="mainform" name="mainform" action="" method="post">
											<div class="row">
												<div class="col-sm-6">
													<select class="form-control input-sm " name="filter" onchange="formAction('mainform', '<?= site_url('bpd_buku_aspirasi/filter') ?>')">
														<option value="">Semua</option>
														<option value="1" <?php if ($filter == 1) : ?>selected<?php endif ?>>Aktif</option>
														<option value="2" <?php if ($filter == 2) : ?>selected<?php endif ?>>Tidak Aktif</option>
													</select>
												</div>
												<div class="col-sm-6">
													<div class="box-tools">
														<div class="input-group input-group-sm pull-right">
															<input name="cari" id="cari" class="form-control" placeholder="Cari..." type="text" value="<?= html_escape($cari) ?>" onkeypress="if (event.keyCode == 13):$('#'+'mainform').attr('action', '<?= site_url('bpd_buku_aspirasi/search') ?>');$('#'+'mainform').submit();endif">
															<div class="input-group-btn">
																<button type="submit" class="btn btn-default" onclick="$('#'+'mainform').attr('action', '<?= site_url("bpd_buku_aspirasi/search") ?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
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
																	<th class="text-center"><input type="checkbox" id="checkall" /></th>
																	<th class="text-center">NO</th>
																	<th class="text-center">AKSI</th>
																	<th class="text-center">TANGGAL</th>
																	<th>FOTO</th>
																	<?php if ($o == 2) : ?>
																		<th nowrap class="text-center"><a href="<?= site_url("bpd_buku_aspirasi/index/$p/1") ?>">NAMA/LEMBAGA PIHAK PENYAMPAI ASPIRASI<i class='fa fa-sort-asc fa-sm'></i></a></th>
																	<?php elseif ($o == 1) : ?>
																		<th nowrap class="text-center"><a href="<?= site_url("bpd_buku_aspirasi/index/$p/2") ?>">NAMA/LEMBAGA PIHAK PENYAMPAI ASPIRASI<i class='fa fa-sort-desc fa-sm'></i></a></th>
																	<?php else : ?>
																		<th nowrap class="text-center"><a href="<?= site_url("bpd_buku_aspirasi/index/$p/1") ?>">NAMA/LEMBAGA PIHAK PENYAMPAI ASPIRASI <i class='fa fa-sort fa-sm'></i></a></th>
																	<?php endif; ?>
																	<th class="text-center">ASPIRASI YANG DISAMPAIKAN</th>
																	<th class="text-center">TINDAK LANJUT</th>
																	<?php if ($o == 4) : ?>
																		<th nowrap class="text-center"><a href="<?= site_url("bpd_buku_aspirasi/index/$p/3") ?>">Aktif <i class='fa fa-sort-asc fa-sm'></i></a></th>
																	<?php elseif ($o == 3) : ?>
																		<th class="text-center"><a href="<?= site_url("bpd_buku_aspirasi/index/$p/4") ?>">Aktif <i class='fa fa-sort-desc fa-sm'></i></a></th>
																	<?php else : ?>
																		<th class="text-center"><a href="<?= site_url("bpd_buku_aspirasi/index/$p/3") ?>">Aktif <i class='fa fa-sort fa-sm'></i></a></th>
																	<?php endif; ?>
																</tr>
															</thead>
															<tbody>
																<?php foreach ($main as $data) : ?>
																	<tr>
																		<td><input type="checkbox" name="id_cb[]" value="<?= $data['id'] ?>" /></td>
																		<td><?= $data['no'] ?></td>
																		<td>
																			<div class="btn-group-vertical">
																				<a class="btn btn-social btn-box btn-info btn-sm" data-toggle="dropdown"><i class='fa fa-arrow-circle-down'></i> Aksi </a>
																				<ul class="dropdown-menu" role="menu">
																					<li>
																						<a href="<?= site_url("bpd_buku_aspirasi/table_dokumentasi/$data[id]") ?>" class="btn btn-social bg-purple btn-box btn-sm" title="Dokumentasi Kegiatan"><i class="fa fa-bars"></i>Detail Tindak Lanjut</a>
																					</li>
																					<li>
																						<a href="<?= site_url("bpd_buku_aspirasi/form/$p/$o/$data[id]") ?>" class="btn btn-social btn-warning btn-box btn-sm" title="Ubah"><i class="fa fa-edit"></i>Ubah</a>
																					</li>
																					<li>
																						<?php if ($data['enabled'] == '2') : ?>
																							<a href="<?= site_url("bpd_buku_aspirasi/kunci_kegiatan/" . $data['id']) ?>" class="btn btn-social bg-navy btn-box btn-sm" title="Aktifkan Album"><i class="fa fa-lock"></i>Aktifkan</a>
																						<?php elseif ($data['enabled'] == '1') : ?>
																							<a href="<?= site_url("bpd_buku_aspirasi/buka_kunci_kegiatan/" . $data['id']) ?>" class="btn btn-social bg-navy btn-box btn-sm" title="Non Aktifkan Album"><i class="fa fa-unlock"></i>Non Aktifkan</a>
																						<?php endif ?>
																					</li>
																					<li>
																						<?php if ($this->CI->cek_hak_akses('h')) : ?>
																							<a href="#" data-href="<?= site_url("bpd_buku_aspirasi/delete/$p/$o/$data[id]") ?>" class="btn btn-social bg-maroon btn-box btn-sm" title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i>Hapus</a>
																						<?php endif; ?>
																					</li>
																				</ul>
																			</div>
																		</td>
																		<td class="text-center"><?= $data['tanggal'] ?></td>
																		<td class="padat">
																			<div class="user-panel">
																				<div class="image1">
																					<img class="img" style="width:100px; height:70px" alt="Gambar" src="<?= AmbilGaleri($data['gambar'], 'kecil') ?>" />
																				</div>
																			</div>
																		</td>
																		<td>
																			<label data-rel="popover" data-content="<img width=200 height=134 src=<?= AmbilGaleri($data['gambar'], 'kecil') ?>>"><?= $data['nama'] ?></label>
																		</td>
																		<td><?= $data['isi_aspirasi'] ?></td>
																		<td width="20%"><?= $data['tindaklanjut'] ?></td>
																		<td width="5%"><?= $data['aktif'] ?></td>
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
													<form id="paging" action="<?= site_url("bpd_buku_aspirasi") ?>" method="post" class="form-horizontal">
														<label>
															Tampilkan
															<select name="per_page" class="form-control input-sm" onchange="$('#paging').submit()">
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
															<li><a href="<?= site_url("bpd_buku_aspirasi/index/$paging->start_link/$o") ?>" aria-label="First"><span aria-hidden="true">Awal</span></a></li>
														<?php endif; ?>
														<?php if ($paging->prev) : ?>
															<li><a href="<?= site_url("bpd_buku_aspirasi/index/$paging->prev/$o") ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
														<?php endif; ?>
														<?php for ($i = $paging->start_link; $i <= $paging->end_link; $i++) : ?>
															<li <?= jecho($p, $i, "class='active'") ?>><a href="<?= site_url("bpd_buku_aspirasi/index/$i/$o") ?>"><?= $i ?></a></li>
														<?php endfor; ?>
														<?php if ($paging->next) : ?>
															<li><a href="<?= site_url("bpd_buku_aspirasi/index/$paging->next/$o") ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
														<?php endif; ?>
														<?php if ($paging->end_link) : ?>
															<li><a href="<?= site_url("bpd_buku_aspirasi/index/$paging->end_link/$o") ?>" aria-label="Last"><span aria-hidden="true">Akhir</span></a></li>
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