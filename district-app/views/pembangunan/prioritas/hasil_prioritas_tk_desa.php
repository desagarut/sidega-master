<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>Hasil Penentuan Prioritas Tingkat Desa</h1>
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="<?= site_url() ?>beranda">Beranda</a></li>
			<li class="breadcrumb-item"><a href="#!">Pembangunan</a></li>
			<li class="breadcrumb-item active"><a href="#!">Hasil Penentuan Prioritas</a></li>
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
									<div class="row">
										<div class="col-md-10">

											<!--<a href="<?= site_url('pembangunan_polling/tanggapan_per_item') ?>" class="btn btn-success btn-sm mb-2 mr-2" title="Lihat Daftar Polling"><i class="feather icon-plus"></i> Daftar Polling</a> -->
										</div>
										<div class="col-md-2">
											<div class="input-group input-group-sm pull-right">
												<select class="form-control select2" id="tahun" name="tahun" style="width:100%;">
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
													<th class="text-center">Nama Program/Kegiatan </th>
													<th class="text-center">Jumlah Responden </th>
													<th class="text-center">Skor Total</th>
													<th class="text-center">Sangat Tidak Penting</th>
													<th class="text-center">Tidak Penting</th>
													<th class="text-center">Netral</th>
													<th class="text-center">Penting</th>
													<th class="text-center">Sangat Penting</th>
													<th class="text-center">Awal Rekam </th>
													<th class="text-center">Akhir Rekam </th>
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
			'responsive': false,
			'ordering': true,
			'order': [
				[10, 'desc'],
			],
			'columnDefs': [{
				'orderable': false,
				'targets': [0, 1, 10],
			}],
			'ajax': {
				'url': "<?= site_url('pembangunan/hasil_prioritas_tk_desa') ?>",
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
							status = `TK. Wilayah: <i class="fa fa-check" style="color: green"></i>`
						} else {
							status = `TK. Wilayah: <i class="fa fa-times" style="color: red"></i>`
						}

						let status_usulan;
						if (data.status_usulan == 1) {
							status_usulan = `TK. Des/Kel : <i class="fa fa-check" style="color: green"></i>`
						} else {
							status_usulan = `TK. Des/Kel : <i class="fa fa-times" style="color: red"></i>`
						}

						let status_vote;
						if (data.status_vote == 1) {
							status_vote = `Penentuan prioritas : <i class="fa fa-check" style="color: green"></i>`
						} else {
							status_vote = `Penentuan prioritas : <i class="fa fa-times" style="color: red"></i>`
						}

						let status_rkp;
						if (data.status_rkp == 1) {
							status_rkp = `Status RKPDes : <i class="fa fa-check" style="color: green"></i>`
						} else if (data.status_rkp == 0) {
							status_rkp = `Status RKPDes : <i class="fa fa-times" style="color: red"></i>`
						} else {
							status_rkp = `Status RKPDes : <i class="fa fa-minus" style="color: yellow"></i>`
						}

						let status_pelaksanaan;
						if (data.status_pelaksanaan == 1) {
							status_pelaksanaan = `Pelaksanaan : <i class="fa fa-check" style="color: green"></i>`
						} else if (data.status_pelaksanaan == 0) {
							status_pelaksanaan = `Pelaksanaan : <i class="fa fa-times" style="color: red"></i>`
						} else {
							status_pelaksanaan = `Pelaksanaan : <i class="fa fa-minus" style="color: yellow"></i>`
						}

						return `
						<div class="btn-group mb-2 mr-2">
							<a href="<?= site_url('pembangunan/penetapan_rkp/') ?>${data.id}" class="btn btn-block btn-social btn-sm btn-success"><i class="fa fa-check"></i>Lanjut ke Penetapan </a>
							<a href="<?= site_url('pembangunan_polling/tanggapan/') ?>${data.id}" class="btn btn-block btn-social btn-sm btn-success"><i class="fa fa-check"></i>Detail Tanggapan</a>
						</div>
						${status}<br/>${status_usulan}<br/>${status_vote}<br/>${status_rkp}<br/>${status_pelaksanaan}
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
					'data': 'nama_program_kegiatan'
				},
				{
					'data': 'count_id_pilihan',
					'class': 'text-center'
				},
				{
					'data': 'sum_id_pilihan',
					'class': 'text-primary'
				},
				{
					'data': 'sum_stp',
					'class': 'text-center'
				},
				{
					'data': 'sum_tp',
					'class': 'text-center'
				},
				{
					'data': 'sum_n',
					'class': 'text-center'
				},
				{
					'data': 'sum_p',
					'class': 'text-center'
				},
				{
					'data': 'sum_sp',
					'class': 'text-center'
				},
				{
					'data': 'min_updated',
					'class': 'text-center'
				},
				{
					'data': 'max_updated',
					'class': 'text-center'
				},
				{
					'data': 'created_at',
					'class': 'text-center'
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