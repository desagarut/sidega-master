<style>
	.input-sm
	{
		padding: 4px 4px;
	}
</style>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Pendataan Peserta Vaksin Covid19</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Data Peserta Vaksin Covid19</li>
		</ol>
	</section>

	<section class="content" id="maincontent">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<a href="<?= site_url("covid19_vaksin/form_peserta_vaksin")?>" title="Tambah Data Warga" class="btn btn-social btn-box bg-olive btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-plus"></i> Tambah Data Warga Vaksin</a>
						<a href="<?= site_url("covid19_vaksin/daftar/cetak")?>" class="btn btn-social btn-box bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Cetak" target="_blank"><i class="fa fa-print"></i> Cetak
						</a>
						<a href="<?= site_url("covid19_vaksin/daftar/unduh")?>" class="btn btn-social btn-box bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Unduh" target="_blank"><i class="fa fa-download"></i> Unduh
						</a>
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
																<th>NIK</th>
																<th>Nama</th>
																<th>Usia</th>
																<th>JK</th>
																<th>Alamat</th>
																<th>Kelompok Masyarakat</th>
																<th>Tanggal</th>
																<th>No Hp</th>
																<th>Dosis</th>
																<th>Nama/Jenis/Merek Vaksin***</th>
																<th>Wajib Pantau</th>
																<th>KIPI</th>
																<th>Keterangan</th>
															</tr>
														</thead>
														<tbody>
															<?php
															$nomer = $paging->offset;
															foreach ($peserta_vaksin_list as $key=>$item):
																$nomer++;
															?>
															<tr>
																<td align="center" width="2"><?= $nomer; ?></td>
																<td nowrap>
                                                                        <a href="<?= site_url('covid19_vaksin/edit_peserta_vaksin_form/'.$item[id])?>" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Ubah Data Peserta Vaksin" title="Ubah Data Peserta Vaksin" class="btn btn-warning btn-box btn-sm"><i class="fa fa-edit"></i></a>
																		<a href="#" data-href="<?= site_url('covid19_vaksin/hapus_peserta_vaksin/'.$item[id])?>" class="btn bg-maroon btn-box btn-sm" title="Hapus Data" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
						<a href="<?= site_url('covid19_vaksin/detil_peserta_vaksin/'.$item[id])?>" title="Detil Data Warga" class="btn btn-box bg-olive btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-eye"></i></a>
																</td>
																<td><?= $item["terdata_nama"] ?></td>
																<td nowrap><a href="<?= site_url('covid19_vaksin/detil_peserta_vaksin/'.$item["id"])?>" title="Data terdata"><?= $item['terdata_info'];?></a></td>
																<td><?= $item["umur"] ?></td>
																<?php
																$jk = (strtoupper($item['sex']) === "PEREMPUAN") ? "Pr" : "Lk";
																?>
																<td><?= $jk?></td>
																<td><?= $item["info"];?></td>
																<td><?= $item["pokmas"];?></td>
																<td><?= $item["tanggal"];?></td>
																<td><?= $item["no_hp"];?> - <?= $item["email"];?> </td>
																<td>1: <?= $item["dosis1"];?> <br/>2: <?= $item["dosis2"];?></td>
																<td><?= $item["jenis_vaksin"];?></td>
																<td><?= ($item["is_wajib_pantau"] === '1' ? "Ya" : "Tidak"); ?></td>
																<td><?= $item["kipi"];?></td>
																<td><?= $item["keterangan"];?></td>
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
															<option value="10" <?php selected($per_page,10); ?> >10</option>
															<option value="100" <?php selected($per_page,100); ?> >100</option>
															<option value="200" <?php selected($per_page,200); ?> >200</option>
														</select>
														Dari
														<strong><?= $paging->num_rows?></strong>
														Total Data
													</label>
												</form>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="dataTables_paginate paging_simple_numbers">
												<ul class="pagination">
												<?php if ($paging->start_link): ?>
														<li>
															<a href="<?=site_url('covid19_vaksin/data_peserta_vaksin/'.$paging->start_link)?>" aria-label="First"><span aria-hidden="true">Awal</span></a>
														</li>
													<?php endif; ?>
													<?php if ($paging->prev): ?>
														<li>
															<a href="<?=site_url('covid19_vaksin/data_peserta_vaksin/'.$paging->prev)?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
														</li>
													<?php endif; ?>
													<?php for ($i=$paging->start_link;$i<=$paging->end_link;$i++): ?>
														<li <?=jecho($p, $i, "class='active'")?>>
															<a href="<?= site_url('covid19_vaksin/data_peserta_vaksin/'.$i)?>"><?= $i?></a>
														</li>
													<?php endfor; ?>
													<?php if ($paging->next): ?>
														<li>
															<a href="<?=site_url('covid19_vaksin/data_peserta_vaksin/'.$paging->next)?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
														</li>
													<?php endif; ?>
													<?php if ($paging->end_link): ?>
														<li>
															<a href="<?=site_url('covid19_vaksin/data_peserta_vaksin/'.$paging->end_link)?>" aria-label="Last"><span aria-hidden="true">Akhir</span></a>
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

<?php $this->load->view('global/confirm_delete');?>

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
