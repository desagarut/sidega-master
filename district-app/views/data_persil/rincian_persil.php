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
</style>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Rincian Persil</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('home') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('data_persil/clear') ?>"> Daftar Persil</a></li>
			<li class="active">Rincian Persil</li>
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
						<a href="<?= site_url('data_persil/clear') ?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali Ke Daftar PersilA"><i class="fa fa-arrow-circle-o-left"></i> Kembali Ke Daftar Persil</a>
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
													<h3 class="box-title">Rincian Persil</h3>
												</div>
												<div class="box-body">
													<table class="table table-bordered  table-striped table-hover">
														<tbody>
															<tr>
																<th>No. Persil : No. Urut Bidang</td>
																<td> : <?= $persil['nomor'] . ' : ' . $persil['nomor_urut_bidang'] ?></td>
															</tr>
															<tr>
																<th>Kelas Tanah</td>
																<td> : <?= $persil["kode"] . ' - ' . $persil["ndesc"] ?></td>
															</tr>
															<tr>
																<th>Alamat</td>
																<td> : <?= $persil["alamat"] ?: $persil["lokasi"] ?></td>
															</tr>
															<?php if ($persil['letterc_awal']) : ?>
																<tr>
																	<td>Letter-C Pemilik Awal</td>
																	<td> : <a href="<?= site_url("letterc/mutasi/$persil[letterc_awal]/$persil[id]") ?>"><?= $persil["nomor_letterc_awal"] ?></a></td>
																</tr>
															<?php endif; ?>
														</tbody>
													</table>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="row">
													<div class="col-sm-9">
														<div class="box-header with-border">
															<h3 class="box-title">Daftar Mutasi Persil</h3>
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
																<th>Letter-C Masuk</th>
																<th>Letter-C Keluar</th>
																<th>No. Bidang Mutasi</th>
																<th>Luas (M2)</th>
																<th>NOP</th>
																<th>Tanggal Mutasi</th>
																<th>Keterangan</th>
															</tr>
														</thead>
														<tbody>
															<?php $nomer = 0; ?>
															<?php foreach ($mutasi as $key => $item) : $nomer++; ?>
																<tr>
																	<td class="text-center"><?= $nomer ?></td>
																	<td><a href="<?= site_url("letterc/rincian/" . $item["id_letterc_masuk"]) ?>"><?= $item['cdesa_masuk'] ?></a></td>
																	<td><a href="<?= site_url("letterc/rincian/" . $item["letterc_keluar"]) ?>"><?= $item['letterc_keluar'] ?></a></td>
																	<td><?= $item['no_bidang_persil'] ?></td>
																	<td><?= $item['luas'] ?></td>
																	<td><?= $item['no_objek_pajak'] ?></td>
																	<td><?= tgl_indo_out($item['tanggal_mutasi']) ?></td>
																	<td><?= $item['keterangan'] ?></td>
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