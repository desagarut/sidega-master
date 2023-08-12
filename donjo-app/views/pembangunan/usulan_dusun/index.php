<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
	<section class="content-header">
		<h1>Daftar Program/Kegiatan Usulan Tingkat Dusun</h1>
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="<?= site_url() ?>beranda">Beranda</a></li>
			<li class="breadcrumb-item"><a href="#!">Perencanaan Desa</a></li>
			<li class="breadcrumb-item active"><a href="#!">Daftar Usulan Dusun</a></li>
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
									<div class="col-md-12">
										<div class="row">
										<h5>Daftar Program/Kegiatan Usulan Tingkat Dusun</h5>
										<div class="col-md-3">	
										<a href="<?= site_url('perencanaan_desa_polling/daftar_polling') ?>" class="btn btn-success btn-sm mb-2 mr-2" title="Lihat Daftar Penentuan Prioritas"><i class="feather icon-plus"></i> Daftar Penentuan Prioritas</a>
										</div>
										<div class="col-md-3">
												<div class="input-group">
												<select class="form-control input-sm select2" disabled hidden id="tahun" name="tahun" style="width:100%;">
												<option selected value="semua">Semua Tahun</option>
												<?php foreach ($list_tahun as $list) : ?>
													<option value="<?= $list->tahun ?>"><?= $list->tahun ?></option>
												<?php endforeach; ?>
											</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="box-body table-border-style">
									<div class="table-responsive">
										<!-- <table id="example1" class="table table-hover">-->
										<table id="example1" class="table table-bordered table-striped table-hover">
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
		$('#example1').DataTable({
			'processing': true,
			'serverSide': true,
			'autoWidth': false,
			'pageLength': 10,
			'responsive': true,
			'ordering': true,
			'order': [
				[7, 'desc'],
			],
			'columnDefs': [{
				'orderable': false,
				'targets': [0, 1, 10],
			}],
			'ajax': {
				'url': "<?= site_url('pembangunan/usulan_dusun') ?>",
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
							status = `<a href="<?= site_url('pembangunan/lock/') ?>${data.id}" class="btn btn-icon btn-success btn-sm mb-2 mr-2 disabled" title="Non Aktifkan Usulan">Status Aktif</a>`
						} else {
							status = `<a href="<?= site_url('pembangunan/unlock/') ?>${data.id}" class="btn btn-icon btn-secondary btn-sm mb-2 mr-2 disabled" title="Aktifkan Usulan">Status Tidak Aktif</a>`
						}

						let status_usulan;
						if (data.status_usulan == 1) {
							status_usulan = `<a href="<?= site_url('pembangunan/ajukan/') ?>${data.id}" class="btn btn-icon btn-success btn-sm mb-2 mr-2 disabled" title="Non Aktifkan Usulan">Usulan Aktif</a>`
						} else {
							status_usulan = `<a href="<?= site_url('pembangunan/batalkan/') ?>${data.id}" class="btn btn-icon btn-secondary btn-sm mb-2 mr-2 disabled" title="Aktifkan Usulan">Usulan Non Aktif</a>`
						}

						let status_vote;
						if (data.status_vote == 1) {
							status_vote = `<a href="<?= site_url('perencanaan_desa_polling/tanggapan_per_item/') ?>${data.id}" id="status_vote" class="btn btn-icon btn-success btn-sm mb-2 mr-2 disabled" title="Penentuan Prioritas Aktif">Penentuan Prioritas Telah Aktiv</a>`
						} else {
							status_vote = `<a href="#" id="status_vote" class="btn btn-icon btn-secondary btn-sm mb-2 mr-2 disabled" title="Penentuan Prioritas Tidak Aktif">Penentuan Prioritas Non Aktif</a>`
						}

						return `
						<div class="btn-group mb-2 mr-2">
						
						<a href="#" class="btn bg-aqua btn-box btn-sm" data-toggle="dropdown" title="Pilih Aksi"><i class="fa fa-list-ol"></i> Aksi</a>
						<ul class="dropdown-menu" role="menu">
								<li><a href="<?= site_url('pembangunan/vote/'); ?>${data.id}">Daftarkan Ke Penentuan Prioritas Desa</a></li>
								<li><a href="<?= site_url('pembangunan/unvote/'); ?>${data.id}">Tutup Penentuan Prioritas Desa</a></li>
							</ul>
						</div><br/>
						${status}<br/>${status_usulan} <br/>${status_vote}
							`
					}
				},
				{
					'data': function(data) {
						return `<div class="user-panel">
									<div class="image2">
										<img src="<?= base_url(LOKASI_GALERI) ?>${data.foto}" class="img-logo" style="width:150px; height:150px" alt="Gambar 0%">
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

		tabelPerencanaan_desa.on('draw.dt', function() {
			let PageInfo = $('#example1').DataTable().page.info();
			tabelPerencanaan_desa.column(0, {
				page: 'current'
			}).nodes().each(function(cell, i) {
				cell.innerHTML = i + 1 + PageInfo.start;
			});
		});

		$('#tahun').on('select2:select', function(e) {
			tabelPerencanaan_desa.ajax.reload();
		});
	});
</script>
<script>
	$(function() {
		$("#table_isi").DataTable({
			"responsive": true,
			"lengthChange": false,
			"autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
		});
	});
</script>