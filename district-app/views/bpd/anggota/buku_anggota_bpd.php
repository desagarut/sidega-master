<script>
	$(function() {
		var keyword = <?= $keyword ?>;
		$("#cari").autocomplete({
			source: keyword,
			maxShowItems: 10,
		});
	});
</script>
<style type="text/css">
	.table-responsive {
		min-height: 350px;
	}

	td.nowrap {
		white-space: nowrap;
	}
</style>
<div class="content-wrapper">
	<section class="content-header">
		<h1>Administrasi BPD - <?= $subtitle ?></h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active"><?= $subtitle ?></li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<?php if ($this->CI->cek_hak_akses('h')): ?>
							<a href="<?= site_url('bpd_buku_anggota/form') ?>" class="btn btn-social btn-box btn-success btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Angota BPD">
								<i class="fa fa-plus"></i>Tambah BPD
							</a>
						<?php endif; ?>
						<?php if ($this->CI->cek_hak_akses('h')): ?>
							<div class="btn-group btn-group-vertical">
								<a class="btn btn-social btn-box btn-info btn-sm" data-toggle="dropdown"><i class='fa fa-arrow-circle-down'></i> Aksi Data Terpilih</a>
								<ul class="dropdown-menu" role="menu">
									<li>
										<a href="#confirm-delete" class="btn btn-social btn-box btn-block btn-sm hapus-terpilih" title="Hapus Data" onclick="deleteAllBox('mainform', '<?= site_url("bpd_buku_anggota/delete_all") ?>')"><i class="fa fa-trash-o"></i> Hapus Data Terpilih</a>
									</li>

								</ul>
							</div>
						<?php endif; ?>
						<a href="<?= site_url("bpd_buku_anggota/dialog/cetak") ?>" class="btn btn-social btn-box bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Cetak Data" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Data"><i class="fa fa-print "></i> Cetak</a>
						<a href="<?= site_url("bpd_buku_anggota/dialog/unduh") ?>" title="Unduh Data" class="btn btn-social btn-box bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Data"><i class="fa fa-download"></i> Unduh</a>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-sm-12">
								<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
									<form id="mainform" name="mainform" action="" method="post">
										<div class="row">
											<div class="col-sm-6">
												<select class="form-control input-sm" name="status" onchange="formAction('mainform','<?= site_url('bpd_buku_anggota/filter/status') ?>')">
													<option value="">Semua</option>
													<option value="1" <?php selected($status, 1); ?>>Aktif</option>
													<option value="2" <?php selected($status, 2); ?>>Tidak Aktif</option>
												</select>
											</div>
											<div class="col-sm-6">
												<div class="box-tools">
													<div class="input-group input-group-sm pull-right">
														<input name="cari" id="cari" class="form-control" placeholder="Cari..." type="text" value="<?= html_escape($cari) ?>" onkeypress="if (event.keyCode == 13) {$('#'+'mainform').attr('action','<?= site_url('bpd_buku_anggota/filter/cari') ?>');$('#'+'mainform').submit();}">
														<div class="input-group-btn">
															<button type="submit" class="btn btn-default" onclick="$('#'+'mainform').attr('action','<?= site_url("bpd_buku_anggota/filter/cari") ?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<div class="table-responsive">
													<table class="table table-bordered table-striped dataTable table-hover">
														<thead class="bg-gray color-palette">
															<tr>
																<th class="padat"><input type="checkbox" id="checkall"></th>
																<th class="padat">No</th>
																<?php if ($this->CI->cek_hak_akses('h')): ?>
																	<th class="padat">Aksi</th>
																<?php endif; ?>
																<th class="text-center">Foto</th>
																<th>Nama Lengkap, NIK</th>
																<th nowrap>Tempat, <p>Tanggal Lahir</p>
																</th>
																<th>Jenis Kelamin</th>
																<th>Agama</th>
																<th>Jabatan</th>
																<th>Pendidikan Terakhir</th>
																<th>Nomor SK Pengangkatan</th>
																<th>Tanggal SK Pengangkatan</th>
																<th>Nomor SK Pemberhentian</th>
																<th>Tanggal SK Pemberhentian</th>
																<th>Masa/Periode Jabatan</th>
															</tr>
														</thead>
														<tbody>
															<?php foreach ($main as $key => $data): ?>
																<tr>
																	<td class="text-center">
																		<input type="checkbox" name="id_cb[]" value="<?= $data['pamong_id'] ?>" />
																	</td>
																	<td class="text-center"><?= $data['no'] ?></td>
																	<?php if ($this->CI->cek_hak_akses('h')): ?>
																		<td nowrap>
																			<a href="<?= site_url("bpd_buku_anggota/urut/$paging->page/$data[pamong_id]/1") ?>" class="btn bg-olive btn-box btn-sm <?php ($data['no'] == $paging->num_rows) and print('disabled'); ?>" title="Pindah Posisi Ke Bawah"><i class="fa fa-arrow-down"></i></a>
																			<a href="<?= site_url("bpd_buku_anggota/urut/$paging->page/$data[pamong_id]/2") ?>" class="btn bg-olive btn-box btn-sm <?php ($data['no'] == 1 and $paging->page == $paging->start_link) and print('disabled'); ?>" title="Pindah Posisi Ke Atas"><i class="fa fa-arrow-up"></i></a>
																			<a href="<?= site_url("bpd_buku_anggota/form/$data[pamong_id]") ?>" class="btn bg-orange btn-box btn-sm" title="Ubah Data"><i class="fa fa-edit"></i></a>
																			<a href="#" data-href="<?= site_url("bpd_buku_anggota/delete/$data[pamong_id]") ?>" class="btn bg-maroon btn-box btn-sm" title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
																			<?php if ($data['pamong_status'] == '1'): ?>
																				<a href="<?= site_url("bpd_buku_anggota/lock/$data[pamong_id]/2") ?>" class="btn bg-navy btn-box btn-sm" title="Non Aktifkan"><i class="fa fa-unlock"></i></a>
																			<?php else: ?>
																				<a href="<?= site_url("bpd_buku_anggota/lock/$data[pamong_id]/1") ?>" class="btn bg-navy btn-box btn-sm" title="Aktifkan"><i class="fa fa-lock"></i></a>
																			<?php endif ?>
																		</td>
																	<?php endif; ?>
																	<td class="text-center">
																		<div class="user-panel">
																			<div class="image2">
																				<?php if ($data['foto']): ?>
																					<img src="<?= AmbilFoto($data['foto']) ?>" class="img-circle" alt="User Image" />
																				<?php else: ?>
																					<img src="<?= base_url() ?>assets/files/user_pict/kuser.png" class="img-circle" alt="User Image" />
																				<?php endif ?>
																			</div>
																		</div>
																	</td>
																	<td nowrap>
																		<strong><?= $data['nama'] ?></strong>
																		<p class='text-blue'>
																			<i>NIK :<?= $data['nik'] ?></i>
																		</p>
																	</td>
																	<td nowrap><?= $data['tempatlahir'] . ', <p>' . tgl_indo_out($data['tanggallahir']) ?></p>
																	</td>
																	<td><?= $data['sex'] ?></td>
																	<td><?= $data['agama'] ?></td>
																	<td><?= $data['jabatan'] ?></td>
																	<td><?= $data['pendidikan_kk'] ?></td>
																	<td><?= $data['pamong_nosk'] ?></td>
																	<td><?= tgl_indo_out($data['pamong_tglsk']) ?></td>
																	<td><?= $data['pamong_nohenti'] ?></td>
																	<td><?= tgl_indo_out($data['pamong_tglhenti']) ?></td>
																	<td><?= $data['pamong_masajab'] ?></td>
																</tr>
															<?php endforeach; ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</form>
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