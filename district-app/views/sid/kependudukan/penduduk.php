<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<script>
	$(document).ready(function() {
		$('#cari').focus();
	});

	$(function() {
		$("#cari").autocomplete({
			source: function(request, response) {
				$.ajax({
					type: "POST",
					url: '<?= site_url("penduduk/autocomplete"); ?>',
					dataType: "json",
					data: {
						cari: request.term
					},
					success: function(data) {
						response(JSON.parse(data));
					}
				});
			},
			minLength: 2,
		});
	});
</script>
<!--
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
		min-height: 400px;
	}
</style>
-->

<div class="content-wrapper">
	<section class="content-header">
		<h1>Data Penduduk</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda'); ?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Data Penduduk</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<?php if ($this->CI->cek_hak_akses('h')) : ?>
							<a href="<?= site_url('penduduk/form'); ?>" class="btn btn-social btn-box btn-success btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Data"><i class="fa fa-plus"></i> Penduduk Domisili</a>
							<a href="#confirm-delete" title="Hapus Data Terpilih" onclick="deleteAllBox('mainform', '<?= site_url("penduduk/delete_all/$p/$o"); ?>')" class="btn btn-social btn-box btn-danger btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block hapus-terpilih"><i class='fa fa-trash-o'></i> Hapus Data Terpilih</a>
						<?php endif; ?>
						<div class="btn-group-vertical">
							<a class="btn btn-social btn-box btn-info btn-sm" data-toggle="dropdown"><i class='fa fa-arrow-circle-down'></i> Laporan </a>
							<ul class="dropdown-menu" role="menu">
								<li>
									<a href="<?= site_url("penduduk/ajax_cetak/$o/cetak"); ?>" class="btn btn-social btn-box btn-block btn-sm" title="Cetak Data" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Data"><i class="fa fa-print"></i> Cetak Penduduk</a>
								</li>
								<li>
									<a href="<?= site_url("penduduk/ajax_cetak/$o/unduh"); ?>" class="btn btn-social btn-box btn-block btn-sm" title="Unduh Data" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Data"><i class="fa fa-download"></i> Unduh Penduduk</a>
								</li>
								<li>
									<a href="<?= site_url("laporan"); ?>" class="btn btn-social btn-box btn-block btn-sm"><i class="fa fa-file"></i>Laporan Bulanan</a>
								</li>
								<li>
									<a href="<?= site_url("laporan_rentan"); ?>" class="btn btn-social btn-box btn-block btn-sm"><i class="fa fa-file"></i> Kelompok Rentan</a>
								</li>
								<li>
									<a href="<?= site_url("penduduk/search_kumpulan_nik"); ?>" class="btn btn-social btn-box btn-block btn-sm" title="Pilihan Kumpulan NIK" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Pilihan Kumpulan NIK"><i class="fa fa-users"></i> Pilihan Kumpulan NIK</a>
								</li>
							</ul>
						</div>
						<a href="<?= site_url("penduduk/ajax_adv_search"); ?>" class="btn btn-social btn-box btn-primary btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Pencarian Spesifik" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Pencarian Spesifik"><i class="fa fa-search"></i> Pencarian Spesifik</a>
						<a href="<?= site_url("penduduk_log/clear"); ?>" class="btn btn-social btn-box btn-primary btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Log Data Penduduk"><i class="fa fa-book"></i> Log Penduduk</a>
						<a href="<?= site_url('keluarga/clear'); ?>" class="btn btn-social btn-box btn-primary btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-users"></i>Master Keluarga</a>
						<a href="<?= site_url('statistik'); ?>" class="btn btn-social btn-box bg-orange btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-bar-chart"></i>Statistik Penduduk</a>
						<a href="<?= site_url("{$this->controller}/clear"); ?>" class="btn btn-social btn-box bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-refresh"></i>Bersihkan Filter</a>
					</div>
					<div class="box-body">
						<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
							<form id="mainform" name="mainform" action="" method="post">
								<div class="row">
									<div class="col-sm-8">
										<select class="form-control input-sm" name="filter" onchange="formAction('mainform', '<?= site_url('penduduk/filter/filter'); ?>')">
											<option value="">Status Penduduk</option>
											<?php foreach ($list_status_penduduk as $data) : ?>
												<option value="<?= $data['id']; ?>" <?= selected($filter, $data['id']); ?>><?= set_ucwords($data['nama']); ?></option>
											<?php endforeach; ?>
										</select>
										<select class="form-control input-sm" name="status_dasar" onchange="formAction('mainform', '<?= site_url('penduduk/filter/status_dasar'); ?>')">
											<option value="">Status Dasar</option>
											<?php foreach ($list_status_dasar as $data) : ?>
												<option value="<?= $data['id']; ?>" <?= selected($status_dasar, $data['id']); ?>><?= set_ucwords($data['nama']); ?></option>
											<?php endforeach; ?>
										</select>
										<select class="form-control input-sm" name="sex" onchange="formAction('mainform', '<?= site_url('penduduk/filter/sex'); ?>')">
											<option value="">Jenis Kelamin</option>
											<?php foreach ($list_jenis_kelamin as $data) : ?>
												<option value="<?= $data['id']; ?>" <?= selected($sex, $data['id']); ?>><?= set_ucwords($data['nama']); ?></option>
											<?php endforeach; ?>
										</select>
										<?php $this->load->view('global/filter_wilayah', ['form' => 'mainform']); ?>
									</div>
									<div class="col-sm-4">
										<div class="input-group input-group-sm pull-right">
											<input name="cari" id="cari" class="form-control" placeholder="Cari..." type="text" title="Pencarian berdasarkan nama penduduk" value="<?= html_escape($cari); ?>" onkeypress="if (event.keyCode == 13){$('#'+'mainform').attr('action', '<?= site_url("penduduk/filter/cari"); ?>');$('#'+'mainform').submit();}">
											<div class="input-group-btn">
												<button type="submit" class="btn btn-default" onclick="$('#'+'mainform').attr('action', '<?= site_url("penduduk/filter/cari"); ?>');$('#'+'mainform').submit();"><i class="fa fa-search"></i></button>
											</div>
										</div>
									</div>
								</div>
								<div class="table-responsive table-min-height">
									<?php if ($judul_statistik) : ?>
										<h5 class="box-title text-center"><b><?= $judul_statistik; ?></b></h5>
									<?php endif; ?>
									<table class="table table-bordered dataTable table-striped table-hover tabel-daftar">
										<thead class="bg-gray disabled color-palette">
											<tr>
												<th><input type="checkbox" id="checkall" /></th>
												<th>No</th>
												<th>Aksi</th>
												<th>Foto</th>
												<th><?= url_order($o, "{$this->controller}/{$func}/$p", 5, 'No. KK'); ?></th>
												<th><?= url_order($o, "{$this->controller}/{$func}/$p", 1, 'NIK'); ?></th>
												<th><?= url_order($o, "{$this->controller}/{$func}/$p", 3, 'Nama'); ?></th>
												<th><?= url_order($o, "{$this->controller}/{$func}/$p", 7, 'Umur'); ?></th>
												<th>Alamat</th>
												<th>Pendidikan</th>
												<th>Pekerjaan</th>
												<th>Perkawinan</th>
												<th><?= url_order($o, "{$this->controller}/{$func}/$p", 11, 'Di Input Oleh'); ?></th>
											</tr>
										</thead>
										<tbody>
											<?php if ($main) : ?>
												<?php foreach ($main as $key => $data) : ?>
													<tr>
														<td class="padat"><input type="checkbox" name="id_cb[]" value="<?= $data['id']; ?>" /></td>
														<td class="padat"><?= ($key + $paging->offset + 1); ?></td>
														<td class="aksi text-center">
															<a href="<?= site_url("penduduk/detail/$p/$o/$data[id]"); ?>" class="btn bg-purple btn-box btn-sm" title="Lihat Detail">Lihat</i></a><br />
															<div class="btn-group">
																<a href="#" class="btn btn-social bg-aqua btn-box btn-sm" data-toggle="dropdown" title="Lihat Detail">Aksi <i class="fa fa-arrow-circle-down"></i></a>
																<ul class="dropdown-menu" role="menu">
																	<li>
																		<a href="<?= site_url("penduduk/detail/$p/$o/$data[id]"); ?>" class="btn btn-social btn-box btn-block btn-sm"><i class="fa fa-list-ol"></i> Lihat Detail Biodata Penduduk</a>
																	</li>
																	<?php if ($data['status_dasar'] == 9) : ?>
																		<li>
																			<a href="#" data-href="<?= site_url("penduduk/kembalikan_status/$p/$o/$data[id]"); ?>" class="btn btn-social btn-box btn-block btn-sm" data-remote="false" data-toggle="modal" data-target="#confirm-status"><i class="fa fa-undo"></i> Kembalikan ke Status HIDUP</a>
																		</li>
																	<?php endif; ?>
																	<?php if ($data['status_dasar'] == 1) : ?>
																		<li>
																			<?php if ($this->CI->cek_hak_akses('u')) : ?>
																				<a href="<?= site_url("penduduk/form/$p/$o/$data[id]"); ?>" class="btn btn-social btn-box btn-block btn-sm"><i class="fa fa-edit"></i> Ubah Biodata Penduduk</a>
																			<?php endif; ?>
																		</li>
																		<li>
																			<a href="<?= site_url("penduduk/ajax_penduduk_maps_google/$p/$o/$data[id]/0"); ?>" data-remote="false" data-toggle="modal" data-target="#modalBox" title="Lokasi <?= $data['nama'] ?> " data-title="Lokasi <?= $data['nama'] ?> - <?= strtoupper($data['dusun']); ?>, RW <?= $data['rw']; ?> / RT <?= $data['rt']; ?>" class="btn btn-social btn-box btn-block btn-sm"><i class='fa fa-map-marker'></i> Lokasi Tempat Tinggal</a>
																			<!--<a href="<? //= site_url("penduduk/ajax_penduduk_maps_google/$p/$o/$data[id]/0"); ?>" title="Lokasi <? //= $data['nama'] ?> - <? //= strtoupper($data['dusun']); ?>, RW <? //= $data['rw']; ?> / RT <? //= $data['rt']; ?>" class="btn btn-social btn-box btn-block btn-sm"><i class='fa fa-map-marker'></i> Lokasi Tempat Tinggal</a>-->
																		</li>
																		<li>
																			<?php if ($this->CI->cek_hak_akses('h')) : ?>
																				<a href="<?= site_url("penduduk/edit_status_dasar/$p/$o/$data[id]"); ?>" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Ubah Status Dasar" class="btn btn-social btn-box btn-block btn-sm"><i class='fa fa-sign-out'></i> Ubah Status Dasar</a>
																			<?php endif; ?>
																		</li>
																		<li>
																			<a href="<?= site_url("penduduk/dokumen/$data[id]"); ?>" class="btn btn-social btn-box btn-block btn-sm"><i class="fa fa-upload"></i> Upload Dokumen Penduduk</a>
																		</li>
																		<li>
																			<a href="<?= site_url("penduduk/rumah_form/$data[id]"); ?>" title="Tambah rumah" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Tambah rumah" class="btn btn-social btn-box btn-block btn-sm "><i class='fa fa-plus'></i> Tambah Rumah</a>
																		</li>
																		<li>
																			<a href="<?= site_url("penduduk/cetak_biodata/$data[id]"); ?>" target="_blank" class="btn btn-social btn-box btn-block btn-sm"><i class="fa fa-print"></i> Cetak Biodata Penduduk</a>
																		</li>
																		<?php if ($this->CI->cek_hak_akses('h')) : ?>
																			<li>
																				<a href="#" data-href="<?= site_url("penduduk/delete/$p/$o/$data[id]"); ?>" class="btn btn-social btn-box btn-block btn-sm" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i> Hapus</a>
																			</li>
																		<?php endif; ?>
																	<?php endif; ?>
																</ul>
															</div>
														</td>
														<td class="padat">
															<div class="user-panel">
																<div class="image2">
																	<img class="img-circle" src="<?= AmbilFoto($data['foto'], '', $data['id_sex']) ?>" alt="foto <?= strtoupper($data['nama']); ?>" title="foto <?= strtoupper($data['nama']); ?>" />
																</div>
															</div>
														</td>
														<td><a href="<?= site_url("keluarga/kartu_keluarga/$p/$o/$data[id_kk]"); ?>"><?= $data['no_kk']; ?> </a></td>
														<td>
															<a href="<?= site_url("penduduk/detail/$p/$o/$data[id]"); ?>" id="test" name="<?= $data['id']; ?>"><?= $data['nik']; ?></a>
														</td>
														<td nowrap>
															<label data-rel="popover" data-content="<img width=200 height=230 src=<?= AmbilFoto($data['foto'], '', $data['id_sex']) ?>>">
																<strong><?= strtoupper($data['nama']); ?></strong>
															</label>
															</br>
															Ayah : <?= $data['nama_ayah']; ?></br>
															Ibu : <?= $data['nama_ibu']; ?>
														</td>
														<td align="center"><strong><?= $data['umur']; ?></strong> <small>tahun</small><br /><small style="color:#F60"><?= $data['sex']; ?></small><br /><small style="color:#03F"><?= $data['tempatlahir']; ?>, <?= strtoupper($data['tanggallahir']); ?></small></td>
														<td>
															<?= strtoupper($data['alamat']); ?>, RT <?= $data['rt']; ?> / RW <?= $data['rw']; ?> Dusun <?= strtoupper($data['dusun']); ?>
														</td>
														<td><?= $data['pendidikan']; ?></td>
														<td><?= $data['pekerjaan']; ?></td>
														<td nowrap><?= $data['kawin']; ?></td>
														<td><?= $data['nama_pendaftar']; ?><br /><?= $data['created_at']; ?></td>
													</tr>
												<?php endforeach; ?>
											<?php else : ?>
												<tr>
													<td class="text-center" colspan="20">Data Tidak Tersedia</td>
												</tr>
											<?php endif; ?>
										</tbody>
									</table>
								</div>
							</form>
							<?php $this->load->view('global/paging'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

<?php $this->load->view('global/confirm_delete'); ?>
<?php $this->load->view('global/konfirmasi'); ?>

<div class='modal fade' id='confirm-status' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
	<div class='modal-dialog'>
		<div class='modal-content'>
			<div class='modal-header'>
				<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
				<h4 class='modal-title' id='myModalLabel'><i class='fa fa-exclamation-triangle text-red'></i> Konfirmasi</h4>
			</div>
			<div class='modal-body btn-info'>
				Apakah Anda yakin ingin mengembalikan status data penduduk ini?
			</div>
			<div class='modal-footer'>
				<button type="button" class="btn btn-social btn-box btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-sign-out'></i> Tutup</button>
				<a class='btn-ok'>
					<button type="button" class="btn btn-social btn-box btn-info btn-sm" id="ok-status"><i class='fa fa-check'></i> Simpan</button>
				</a>
			</div>
		</div>
	</div>
</div>