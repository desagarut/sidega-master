<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>Alur Proses Kegiatan Pembangunan</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('pembangunan') ?>"> Rencana Pembangunan</a></li>
			<li class="active">Daftar Usulan Kegiatan</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="row">
			<div class="col-md-3">
				<?php $this->load->view('pembangunan/menu'); ?>
			</div>
			<div class="col-md-9">
				<div class="box">
					<form id="mainformexcel" name="mainformexcel" method="post" class="form-horizontal">
						<div class="row">
							<div class="col-md-12">
								<div class="box-header">
									<h4>Daftar Usulan Masyarakat</h4>
									<div class="row">
										<div class="col-sm-4">

											<a href="<?= site_url('pembangunan/form_usulan_masyarakat') ?>" class="btn btn-success btn-sm" title="Tambah Data Baru"><i class="feather icon-plus"></i> Tambah Usulan</a>
											<a href="<?= site_url("pembangunan/dialog_daftar/{$desa_musdus->id}/cetak") ?>" class="btn btn-info btn-sm mb-2 mr-2" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Data" title="Cetak Data <?= $desa_musdus->judul ?> "><i class="fa fa-print "></i> Cetak</a>
											<a href="<?= site_url("pembangunan/dialog_daftar/{$desa_musdus->id}/unduh") ?>" class="btn bg-navy btn-sm mb-2 mr-2" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Data " title="Unduh Data <?= $desa_musdus->judul ?> "><i class="fa fa-download "></i> Unduh</a>

										</div>
										<div class="col-sm-2">
											<select class="form-control input-sm select2" disabled hidden id="tahun" name="tahun" style="width:100%;">
												<option selected value="semua">Semua Tahun</option>
												<?php foreach ($list_tahun as $list) : ?>
													<option value="<?= $list->tahun ?>"><?= $list->tahun ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="box-body">
									<div class="row">
										<div class="col-sm-12">
											<div class="table-responsive">
												<table id="tabel-isi" class="table table-bordered table-hover">
													<thead>
														<tr>
															<th class="text-center">No</th>
															<th class="text-center">Aksi</th>
															<th class="text-center">Gambar</th>
															<th class="text-center">Tahun</th>
															<th class="text-center">Nama Dusun</th>
															<th class="text-center">Bidang </th>
															<th class="text-center">Nama Program/Kegiatan </th>
															<th class="text-center">Lokasi (RT/RW/Dusun)</th>
															<th class="text-center">Perkiraan Volume & Satuan</th>
															<th class="text-center">Jumlah (Rp)</th>
															<th class="text-center">Sumber Dana</th>
															<th class="text-center">Data Eksisting</th>
															<th class="text-center">Prioritas Desa</th>
															<th class="text-center">Prioritas SDGS</th>
															<th class="text-center">Pengusul</th>
															<th class="text-center">Pelaksana </th>
															<th class="text-center">Tgl dibuat</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('global/confirm_delete'); ?>
<?php $this->load->view('global/konfirmasi'); ?>
<script>
	$(document).ready(function() {
		$('#tabel-isi').DataTable({
			'processing': true,
			'serverSide': true,
			'autoWidth': false,
			'pageLength': 10,
			'responsive': true,
			'ordering': true,
			'order': [
				[12, 'desc'],
			],
			'columnDefs': [{
				'orderable': false,
				'targets': [0, 1, 12],
			}],
			'ajax': {
				'url': "<?= site_url('pembangunan') ?>",
				'method': 'POST',
				'data': function(d) {
					d.tahun = $('#tahun').val();
				}
			},
			'columns': [{
					"data": null,
					"sortable": false,
					render: function(data, type, row, meta) {
						return meta.row + meta.settings._iDisplayStart + 1;
					}
				},
				{
					'data': function(data) {
						let status;
						if (data.status == 1) {
							status = `<a href="<?= site_url('pembangunan/lock/') ?>${data.id}" class="btn btn-success btn-sm" title="Non Aktifkan Usulan">Aktif</a>`
						} else {
							status = `<a href="<?= site_url('pembangunan/unlock/') ?>${data.id}" class="btn btn-danger btn-sm" title="Aktifkan Usulan">Tidak Aktif</a>`
						}

						let status_usulan;
						if (data.status_usulan == 1) {
							status_usulan = `<a href="<?= site_url('pembangunan/ajukan/') ?>${data.id}" class="btn btn-success btn-sm disabled" title="Non Aktifkan Usulan">Sudah Diajukan</a>`
						} else {
							status_usulan = `<a href="<?= site_url('pembangunan/batalkan/') ?>${data.id}" class="btn btn-danger btn-sm disabled" title="Aktifkan Usulan">Belum Diajukan</a>`
						}

						return `
						<div class="btn-group text-center">
						<a href="#" class="btn bg-aqua btn-box btn-sm" data-toggle="dropdown" title="Pilih Aksi"> Aksi <i class="fa fa-arrow-down"></i></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?= site_url('pembangunan/detail_usulan/'); ?>${data.id}">Lihat Usulan</a></li>
								<li><a href="<?= site_url('pembangunan/form_usulan_masyarakat/'); ?>${data.id}">Ubah Usulan</a></li>
								<li><a href="<?= site_url('pembangunan/lokasi_maps/'); ?>${data.id}">Peta lokasi</a></li>
								<li><a href="<?= site_url('pembangunan_dok/show/'); ?>${data.id}">Dokumen Usulan</a></li>
								<li><a href="<?= site_url('pembangunan/ajukan/'); ?>${data.id}">Ajukan Usulan</a></li>
								<li><a href="<?= site_url('pembangunan/batalkan/'); ?>${data.id}">Batalkan Usulan</a></li>
								<li class="divider"></li>
								<li><a href="#" data-href="<?= site_url('pembangunan/delete/'); ?>${data.id}" data-toggle="modal" data-target="#confirm-delete"">Hapus</a></li>
							</ul>
						</div>
						${status}<br/>${status_usulan}
							`
					}
				},
				{
					'data': function(data) {
						return `<div class="user-panel">
									<div class="image1">
										<img src="<?= base_url(LOKASI_GALERI) ?>${data.foto}" class="img-" style="width:120px; height:70px" alt="Gambar 0%">
									</div>
								</div>`
					}
				},
				{
					'data': 'tahun'
				},
				{
					'data': 'dusun'
				},
				{
					'data': 'bidang_desa'
				},
				{
					'data': 'nama_program_kegiatan'
				},
				{
					'data': 'lokasi'
				},
				{
					'data': 'volume'
				},
				{
					'data': 'anggaran',
					'render': $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
				},
				{
					'data': 'sumber_dana'
				},
				{
					'data': 'data_eksisting'
				},
				{
					'data': 'urutan_prioritas'
				},
				{
					'data': 'sdgs_ke'
				},
				{
					'data': 'pengusul'
				},
				{
					'data': 'pelaksana_kegiatan'
				},
				{
					'data': 'created_at'
				},
			],
			'language': {
				'url': "<?= base_url('/assets/bootstrap/js/dataTables.indonesian.lang') ?>"
			}
		});

		tabelpembangunan.on('draw.dt', function() {
			let PageInfo = $('#tabel-isi').DataTable().page.info();
			tabelpembangunan.column(0, {
				page: 'current'
			}).nodes().each(function(cell, i) {
				cell.innerHTML = i + 1 + PageInfo.start;
			});
		});

		$('#tahun').on('select2:select', function(e) {
			tabelpembangunan.ajax.reload();
		});
	});
</script>