<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>Daftar Penentuan Prioritas Tingkat</h1>
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="<?= site_url() ?>beranda">Beranda</a></li>
			<li class="breadcrumb-item"><a href="#!">Pembangunan</a></li>
			<li class="breadcrumb-item active"><a href="#!">Penentuan Prioritas Usulan</a></li>
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
											<h5>Daftar Penentuan Prioritas Tingkat <?= ucwords($this->setting->sebutan_desa); ?></h5>
											<!--<a href="<?= site_url('pembangunan_polling/tanggapan_per_item') ?>" class="btn btn-success btn-sm mb-2 mr-2" title="Lihat Daftar Polling"><i class="feather icon-plus"></i> Daftar Polling</a> -->
											<div class="col-md-3">
												<div class="input-group">
													<select class="form-control" hidden="	" disabled="disabled" id="tahun" name="tahun" style="width:100%;">
														<option selected value="semua">Semua Tahun</option>
														<?php foreach ($list_tahun as $list) : ?>
															<option value="<?= $list->tahun ?>">
																<?= $list->tahun ?>
															</option>
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
													<th class="text-center">Tahun</th>
													<th class="text-center">Nama Dusun</th>
													<th class="text-center">Bidang </th>
													<th class="text-center">Nama Program/Kegiatan </th>
													<th class="text-center">Jumlah Responden </th>
													<th class="text-center">Skor Total</th>
													<th class="text-center">Perkiraan Volume & Satuan</th>
													<th class="text-center">Jumlah (Rp)</th>
													<th class="text-center">Sumber Dana</th>
													<th class="text-center">Data Eksisting</th>
													<th class="text-center">Prioritas Desa</th>
													<th class="text-center">Prioritas SDGS</th>
													<th class="text-center">Pengusul</th>
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
				[10, 'desc'],
			],
			'columnDefs': [{
				'orderable': false,
				'targets': [0, 1, 10],
			}],
			'ajax': {
				'url': "<?= site_url('pembangunan/penentuan_prioritas') ?>",
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
						let status_vote;
						if (data.status_vote == 1) {
							status_vote = `<a href="<?= site_url('pembangunan_polling/tanggapan_per_item/') ?>${data.id}" id="status_vote" class="btn btn-sm btn-success mb-2 mr-2" title="Penentuan Prioritas Aktif">Beri Tanggapan</a>`
						} else {
							status_vote = `<a href="#" id="status_vote" class="btn btn-icon btn-secondary btn-sm mb-2 mr-2 disabled" title="Penentuan Prioritas Tidak Aktif">Penentuan Prioritas Non Aktif</a>`
						}

						return `
						${status_vote}
							`
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
					'data': 'count_id_pilihan'
				},
				{
					'data': 'sum_id_pilihan'
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