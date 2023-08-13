<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
	<section class="content-header">
		<h1>Daftar Usulan Tingkat Dusun</h1>
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="<?= site_url() ?>beranda">Beranda</a></li>
			<li class="breadcrumb-item"><a href="#!">Pembangunan</a></li>
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
										<a href="<?= site_url('pembangunan_polling/daftar_polling') ?>" class="btn btn-success btn-sm mb-2 mr-2" title="Lihat Daftar Penentuan Prioritas"><i class="feather icon-plus"></i> Daftar Penentuan Prioritas</a>
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
							status = `Status : <i class="fa fa-check" style="color: green"></i>`
						} else {
							status = `Status : <i class="fa fa-times" style="color: red"></i>`
						}

						let status_usulan;
						if (data.status_usulan == 1) {
							status_usulan = `Ajuan : <i class="fa fa-check" style="color: green"></i>`
						} else {
							status_usulan = `Ajuan : <i class="fa fa-times" style="color: red"></i>`
						}

						let status_vote;
						if (data.status_vote == 1) {
							status_vote = `Polling : <i class="fa fa-check" style="color: green"></i>`
						} else {
							status_vote = `Polling : <i class="fa fa-times" style="color: red"></i>`
						}

						let status_rkpdes;
						if (data.status_rkpdes == 1) {
							status_rkpdes = `RKPDes : <i class="fa fa-check" style="color: green"></i>`
						} else if (data.status_rkpdes == 0) {
							status_rkpdes = `RKPDes : <i class="fa fa-times" style="color: red"></i>`
						} else {
							status_rkpdes = `RKPDes : <i class="fa fa-minus" style="color: yellow"></i>`
						}

						let status_pelaksanaan;
						if (data.status_pelaksanaan == 1) {
							status_rkpdes = `Pelaksanaan : <i class="fa fa-check" style="color: green"></i>`
						} else if (data.status_pelaksanaan == 0) {
							status_pelaksanaan = `Pelaksanaan : <i class="fa fa-check" style="color: green"></i>`
						} else {
							status_pelaksanaan = `Pelaksanaan : <i class="fa fa-info" style="color: red"></i>`
						}
						return `
						<div class="btn-group mb-2 mr-2">
						
						<a href="#" class="btn bg-aqua btn-box btn-sm" data-toggle="dropdown" title="Pilih Aksi"><i class="fa fa-list-ol"></i> Aksi</a>
						<ul class="dropdown-menu" role="menu">
								<li><a href="<?= site_url('pembangunan/vote/'); ?>${data.id}">Daftarkan Ke Prioritas/Polling</a></li>
								<li><a href="<?= site_url('pembangunan/unvote/'); ?>${data.id}">Keluarkan dari Prioritas/Polling</a></li>
							</ul>
						</div><br/>
						${status}<br/>${status_usulan}<br/>${status_vote}<br/>${status_rkpdes}<br/>${status_pelaksanaan}
							`
					}
				},
				{
					'data': function(data) {
						return `<div class="user-panel">
									<div class="image2">
										<img src="<?= base_url(LOKASI_GALERI) ?>${data.foto}" class="img-logo" style="max-width:100px; max-height:100px" alt="Gambar 0%">
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
			let PageInfo = $('#example1').DataTable().page.info();
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
<script>
	$(function() {
		$("#table_isi").DataTable({
			"responsive": true,
			"lengthChange": false,
			"autoWidth": true,
			"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": true,
			"responsive": true,
		});
	});
</script>