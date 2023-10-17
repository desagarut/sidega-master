<style>
	.input-sm {
		padding: 4px 4px;
	}

	@media (max-width:780px) {
		.btn-group-vertical {
			display: block;
		}
	}

	.table-responsive {
		min-height: 275px;
	}

	.padat {
		width: 1%;
	}

	th.horizontal {
		width: 20%;
	}
</style>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Rincian Letter-C</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('home') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('letterc') ?>"> Daftar Letter-C</a></li>
			<li class="active">Rincian Letter-C</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="row">
			<div class="col-md-4 col-lg-3">
				<?php $this->load->view('data_persil/menu_kiri.php') ?>
			</div>
			<div class="col-md-8 col-lg-9">
				<div class="box box-info">
					<div class="box-header with-border">
						<a href="<?= site_url("letterc/create_mutasi/" . $letterc['id']) ?>" class="btn btn-social btn-box btn-success btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Persil">
							<i class="fa fa-plus"></i>Tambah Mutasi Persil
						</a>
						<a href="<?= site_url('letterc') ?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Daftar Letter-C"><i class="fa fa-arrow-circle-o-left"></i> Kembali Ke Daftar Letter-C</a>
						<a href="<?= site_url("letterc/form_letterc/" . $letterc['id']) ?>" class="btn btn-social btn-box bg-purple btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Cetak Data" target="_blank">
							<i class="fa fa-print"></i>Cetak Letter-C
						</a>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
									<form id="mainform" name="mainform" action="" method="post">
										<input type="hidden" name="id" value="<?php echo $this->uri->segment(4) ?>">
										<div class="row">
											<div class="col-sm-12">
												<div class="box-header with-border">
													<h3 class="box-title">Rincian Letter-C</h3>
												</div>
												<div class="box-body">
													<div class="col-md-8">
														<table class="table table-bordered  table-striped table-hover">
															<tbody>
																<tr>
																	<th class="horizontal">Nama Pemilik</td>
																	<td> : <?= $pemilik["namapemilik"] ?></td>
																</tr>
																<tr>
																	<th class="horizontal">NIK</td>
																	<td> : <?= $pemilik["nik"] ?></td>
																</tr>
																<tr>
																	<th class="horizontal">Alamat</td>
																	<td> : <?= $pemilik["alamat"] ?></td>
																</tr>
																<tr>
																	<th class="horizontal">Nomor Letter-C</td>
																	<td> : <?= sprintf("%04s", $letterc['nomor']) ?></td>
																</tr>
																<tr>
																	<th class="horizontal">Nama Pemilik Tertulis di Letter-C</td>
																	<td> : <?= $letterc["nama_kepemilikan"] ?></td>
																</tr>
															</tbody>
														</table>
													</div>
													<div class="col-md-3">
														<!--<div class="box box-primary">
															<div class="box-body box-profile">
																<img class="img-responsive" src="<?= gambar_desa($main['kantor_desa'], TRUE); ?>" alt="Kantor <?= $desa; ?>">
																<br />
																<p class="text-center text-bold">Kantor <?= $desa; ?></p>
																<p class="text-muted text-center text-red">(Kosongkan, jika kantor <?= $desa; ?> tidak berubah)</p>
																<br />
																<div class="input-group input-group-sm">
																	<input type="text" class="form-control" id="file_path2">
																	<input type="file" class="hidden" id="file2" name="kantor_desa">
																	<input type="hidden" name="old_kantor_desa" value="<?= $main['kantor_desa']; ?>">
																	<span class="input-group-btn">
																		<button type="button" class="btn btn-info btn-box" id="file_browser2"><i class="fa fa-search"></i> Browse</button>
																	</span>
																</div>
															</div>
														</div>-->
													</div>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="row">
													<div class="col-sm-9">
														<div class="box-header with-border">
															<h3 class="box-title">Daftar Persil Letter-C</h3>
														</div>
													</div>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="table-responsive">
													<table class="table table-bordered table-striped dataTable table-hover">
														<thead class="bg-gray disabled color-palette">
															<tr>
																<th>No</th>
																<th>Aksi</th>
																<th>No. Persil : No. Urut Bidang</th>
																<th>Kelas Tanah</th>
																<th>Lokasi</th>
																<th>Luas Keseluruhan Persil (M2)</th>
																<th>Jumlah Mutasi</th>
															</tr>
														</thead>
														<tbody>
															<?php $nomer = 0 ?>
															<?php foreach ($persil as $key => $item) : $nomer++; ?>
																<tr>
																	<td class="text-center padat"><?= $nomer ?></td>
																	<td nowrap class="padat">
																		<a href='<?= site_url("letterc/mutasi/$letterc[id]/$item[id]") ?>' class="btn bg-maroon btn-box btn-sm" title="Daftar Mutasi"><i class="fa fa-exchange"></i></a>
																	</td>
																	<td>
																		<a href="<?= site_url("data_persil/rincian/" . $item["id"]) ?>">
																			<?= $item['nomor'] . ' : ' . $item['nomor_urut_bidang'] ?>
																			<?php if ($letterc['id'] == $item['letterc_awal']) : ?>
																				<code>( Pemilik awal )</code>
																			<?php endif; ?>
																		</a>
																	</td>
																	<td><?= $item['kelas_tanah'] ?></td>
																	<td><?= $item['alamat'] ?: $item['lokasi'] ?></td>
																	<td><?= $item['luas_persil'] ?></td>
																	<td><?= $item['jml_mutasi'] ?></td>
																</tr>
															<?php endforeach; ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>