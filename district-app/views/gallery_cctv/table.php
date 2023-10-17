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
		<h1> Daftar CCTV <?= ucfirst($this->setting->sebutan_desa) ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Daftar CCTV <?= ucfirst($this->setting->sebutan_desa) ?></li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="mainform" name="mainform" action="" method="post">
			<div class="row">
				<div id="umum-sidebar" class="col-md-3">
					<?php $this->load->view('gallery_cctv/menu') ?>
				</div>
				<div class="col-md-9">
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Daftar CCTV <?= ucfirst($this->setting->sebutan_desa) ?></h3>
							<div class="box-tools">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i> </button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i> </button>
							</div>

						</div>
						<div class="box-body">
							<div class="col-sm-12">
								<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
									<form id="mainform" name="mainform" action="" method="post">
										<div class="row">
											<div class="col-sm-6">
												<select class="form-control input-sm " name="filter" onchange="formAction('mainform', '<?= site_url('gallery_cctv/filter') ?>')">
													<option value="">Semua</option>
													<option value="1" <?php if ($filter == 1) : ?>selected<?php endif ?>>Aktif</option>
													<option value="2" <?php if ($filter == 2) : ?>selected<?php endif ?>>Tidak Aktif</option>
												</select>
												<a href="<?= site_url("gallery_cctv/form") ?>" class="btn btn-social btn-box btn-success btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Artikel">
													<i class="fa fa-plus"></i> Tambah CCTV
												</a>
												<a href="#confirm-delete" title="Hapus Data" onclick="deleteAllBox('mainform', '<?= site_url("gallery_cctv/delete_all/$p/$o") ?>')" class="btn btn-social btn-box btn-danger btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block hapus-terpilih"><i class='fa fa-trash-o'></i> Hapus Data Terpilih</a>

											</div>
											<div class="col-sm-6">
												<div class="box-tools">
													<div class="input-group input-group-sm pull-right">
														<input name="cari" id="cari" class="form-control" placeholder="Cari..." type="text" value="<?= html_escape($cari) ?>" onkeypress="if (event.keyCode == 13):$('#'+'mainform').attr('action', '<?= site_url('gallery_cctv/search') ?>');$('#'+'mainform').submit();endif">
														<div class="input-group-btn">
															<button type="submit" class="btn btn-default" onclick="$('#'+'mainform').attr('action', '<?= site_url("gallery_cctv/search") ?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
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
																<th class="text-center">No</th>
																<th class="text-center">CCTV</th>
																<?php if ($o == 2) : ?>
																	<th class="text-center" width=25%><a href="<?= site_url("gallery_cctv/index/$p/1") ?>">Sumber CCTV <i class='fa fa-sort-asc fa-sm'></i></a></th>
																<?php elseif ($o == 1) : ?>
																	<th class="text-center" width=25%><a href="<?= site_url("gallery_cctv/index/$p/2") ?>">Sumber CCTV <i class='fa fa-sort-desc fa-sm'></i></a></th>
																<?php else : ?>
																	<th class="text-center" width=25%><a href="<?= site_url("gallery_cctv/index/$p/1") ?>">Sumber CCTV <i class='fa fa-sort fa-sm'></i></a></th>
																<?php endif; ?>
																<th width=20% class="text-center">Deskripsi</th>
																<th>Aksi</th>
															</tr>
														</thead>
														<tbody>
															<?php foreach ($main as $data) : ?>
																<tr>
																	<td><input type="checkbox" name="id_cb[]" value="<?= $data['id'] ?>" /></td>
																	<td><?= $data['no'] ?></td>
																	<td width=15% class="padat">
																		<iframe width="250" height="160" src="<?= $data["link"]; ?>" frameborder="0" allowfullscreen></iframe>
																	</td>
																	<td width=15%>
																		<strong><?= $data['nama'] ?></strong>
																	</td>
																	<td width=15%>
																		<?= $data['deskripsi'] ?><br/>
																		<?= tgl_indo2($data['tgl_upload']) ?>
																	</td>
																	<td align="center">
																		<a href="<?= site_url("gallery_cctv/urut/$data[id]/1") ?>" class="btn bg-olive btn-box btn-sm" title="Pindah Posisi Ke Bawah"><i class="fa fa-arrow-down"></i></a>
																		<a href="<?= site_url("gallery_cctv/urut/$data[id]/2") ?>" class="btn bg-olive btn-box btn-sm" title="Pindah Posisi Ke Atas"><i class="fa fa-arrow-up"></i></a>
																		<a href="<?= site_url("gallery_cctv/sub_cctv/$data[id]") ?>" class="btn bg-purple btn-box btn-sm" title="Rincian Album"><i class="fa fa-bars"></i></a></br>
																		<a href="<?= site_url("gallery_cctv/form/$p/$o/$data[id]") ?>" class="btn btn-warning btn-box btn-sm" title="Ubah"><i class="fa fa-edit"></i></a>
																		<?php // if ($data['slider'] == '1') : ?>
																			<!--<a href="<?= site_url("gallery_cctv/slider_off/" . $data['id']) ?>" class="btn bg-maroon btn-box btn-sm" title="Keluarkan Dari Slider"><i class="fa fa-play"></i></a>-->
																		<?php // else : ?>
																			<!--<a href="<?= site_url("gallery_cctv/slider_on/" . $data['id']) ?>" class="btn bg-gray btn-box btn-sm" title="Tampilkan Di Slider"><i class="fa fa-eject"></i></a>-->
																		<?php // endif; ?>
																		<?php if ($data['enabled'] == '2') : ?>
																			<a href="<?= site_url("gallery_cctv/gallery_lock/" . $data['id']) ?>" class="btn bg-navy btn-box btn-sm" title="Aktifkan Album"><i class="fa fa-lock"></i></a>
																		<?php elseif ($data['enabled'] == '1') : ?>
																			<a href="<?= site_url("gallery_cctv/gallery_unlock/" . $data['id']) ?>" class="btn bg-navy btn-box btn-sm" title="Non Aktifkan Album"><i class="fa fa-unlock"></i></a>
																		<?php endif ?>
																		</br>
																		<?php if ($this->CI->cek_hak_akses('h')) : ?>
																			<a href="#" data-href="<?= site_url("gallery_cctv/delete/$p/$o/$data[id]") ?>" class="btn bg-maroon btn-box btn-sm" title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
																		<?php endif; ?>
																		<!--<a href="<?= $data['link'] ?>" class="btn btn-info btn-box btn-sm" target="_blank" title="Buka Link CCTV">Buka Link CCTV</a>-->
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
												<form id="paging" action="<?= site_url("gallery") ?>" method="post" class="form-horizontal">
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
														<li><a href="<?= site_url("gallery_cctv/index/$paging->start_link/$o") ?>" aria-label="First"><span aria-hidden="true">Awal</span></a></li>
													<?php endif; ?>
													<?php if ($paging->prev) : ?>
														<li><a href="<?= site_url("gallery_cctv/index/$paging->prev/$o") ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
													<?php endif; ?>
													<?php for ($i = $paging->start_link; $i <= $paging->end_link; $i++) : ?>
														<li <?= jecho($p, $i, "class='active'") ?>><a href="<?= site_url("gallery_cctv/index/$i/$o") ?>"><?= $i ?></a></li>
													<?php endfor; ?>
													<?php if ($paging->next) : ?>
														<li><a href="<?= site_url("gallery_cctv/index/$paging->next/$o") ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
													<?php endif; ?>
													<?php if ($paging->end_link) : ?>
														<li><a href="<?= site_url("gallery_cctv/index/$paging->end_link/$o") ?>" aria-label="Last"><span aria-hidden="true">Akhir</span></a></li>
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