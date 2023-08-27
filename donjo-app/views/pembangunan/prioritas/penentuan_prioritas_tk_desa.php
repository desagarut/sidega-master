<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>Daftar Penentuan Prioritas Tingkat <?= ucwords($this->setting->sebutan_desa); ?></h1>
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
									<div class="row">
										<div class="col-md-9">
											<a href="<?= site_url('pembangunan/hasil_prioritas_tk_desa') ?>" class="btn btn-success btn-sm mb-2 mr-2" title="Daftar Penentuan Prioritas"><i class="feather icon-plus"></i> Hasil Penentuan Prioritas</a>
											<a href="<?= site_url("pembangunan/dialog_daftar/{$desa_musdus->id}/cetak") ?>" class="btn btn-info btn-sm mb-2 mr-2" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Data" title="Cetak Data <?= $desa_musdus->judul ?> "><i class="fa fa-print "></i> Cetak</a>
											<a href="<?= site_url("pembangunan/dialog_daftar/{$desa_musdus->id}/unduh") ?>" class="btn bg-navy btn-sm mb-2 mr-2" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Data " title="Unduh Data <?= $desa_musdus->judul ?> "><i class="fa fa-download "></i> Unduh</a>
										</div>
										<div class="col-md-3">
											<div class="input-group input-group-sm pull-right">
												<select class="form-control form-control-sm select2" id="tahun" name="tahun" style="width:100%;">
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
				'url': "<?= site_url('pembangunan/penentuan_prioritas_tk_desa') ?>",
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
							status_rkp = `Status RKPDes : <i class="fa fa-minus" style="color: grey"></i>`
						}

						let status_pelaksanaan;
						if (data.status_pelaksanaan == 1) {
							status_pelaksanaan = `Pelaksanaan : <i class="fa fa-check" style="color: green"></i>`
						} else if (data.status_pelaksanaan == 0) {
							status_pelaksanaan = `Pelaksanaan : <i class="fa fa-times" style="color: red"></i>`
						} else {
							status_pelaksanaan = `Pelaksanaan : <i class="fa fa-minus" style="color: grey"></i>`
						}
						return `
						<div class="btn-group text-center">
						<a href="#" class="btn btn-block btn-social btn-sm btn-success" data-toggle="dropdown" title="Pilihan Aksi"><i class="fa fa-arrow-down"></i> Pilihan Aksi </a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?= site_url('pembangunan_polling/tanggapan/') ?>${data.id}"><i class="fa fa-eye" style="color: blue"></i>Lihat Detail </a></li>
								<li class="divider"></li>
								<li><a href="<?= site_url('pembangunan/vote/'); ?>${data.id}"><i class="fa fa-arrow-right" style="color: green"></i>Daftarkan Ke Prioritas Usulan</a></li>

								<li><a href="<?= site_url('pembangunan/unvote/'); ?>${data.id}"><i class="fa fa-arrow-left" style="color: red"></i>Keluarkan dari Prioritas Usulan</a></li>
							</ul>
							<a href="<?= site_url('pembangunan_polling/tanggapan/') ?>${data.id}" id="status_vote" class="btn btn-block btn-social btn-sm btn-primary" title="Berikan Tanggapan"><i class="fa fa-bullhorn"></i>Beri Tanggapan </a><br/>
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