<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>Daftar Rencana Kerja Pemerintah <?= ucwords($this->setting->sebutan_desa); ?></h1>
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="<?= site_url() ?>beranda">Beranda</a></li>
			<li class="breadcrumb-item"><a href="#!">Pembangunan</a></li>
			<li class="breadcrumb-item active"><a href="#!">Daftar RKP <?= ucwords($this->setting->sebutan_desa); ?></a></li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="mainformexcel" name="mainformexcel" method="post" class="form-horizontal">
			<div class="row">
				<div class="col-md-3">
					<?php $this->load->view('pembangunan/menu'); ?>
				</div>
				<div class="col-md-9">
					<div class="box">
						<div class="row">
							<div class="col-md-12">
								<div class="box-header">
									<div class="row">
										<div class="col-sm-10">
											<a href="<?= site_url($this->controller . '/dialog_rkpdes/cetak'); ?>" class="btn btn-social btn-flat bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Cetak Buku Rencana Kerja Pembangunan" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Buku Rencana Kerja Pembangunan"><i class="fa fa-print "></i> Cetak</a>
										</div>
										<div class="input-group col-md-2">
											<select class="form-control input-sm select2" id="tahun" name="tahun" style="width:100%;">
												<option selected value="semua">Semua Tahun</option>
												<?php foreach ($list_tahun as $list) : ?>
													<option value="<?= $list->tahun ?>"><?= $list->tahun ?></option>
												<?php endforeach; ?>
											</select>
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
													<th class="text-center">Foto Lokasi</th>
													<th class="text-center">Tahun</th>
													<th class="text-center">Nama Dusun</th>
													<th class="text-center">Bidang </th>
													<th class="text-center">Nama Program/Kegiatan </th>
													<th class="text-center">Target Capaian Tahun </th>
													<th class="text-center">Lokasi</th>
													<th class="text-center">Perkiraan Volume & Satuan</th>
													<th class="text-center">Penerima Manfaat</th>
													<th class="text-center">Waktu Pelaksanaan</th>
													<th class="text-center">Biaya Jumlah (Rp)</th>
													<th class="text-center">Sumber Dana</th>
													<th class="text-center">Pola Pelaksanaan (Swakelola / Kerjasama antar Desa / Kerjasama Pihak Ketiga</th>
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
			</div>
		</form>
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
				'url': "<?= site_url('pembangunan/daftar_rkp') ?>",
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
							status_vote = `Status prioritas : <i class="fa fa-check" style="color: green"></i>`
						} else {
							status_vote = `Status prioritas : <i class="fa fa-times" style="color: red"></i>`
						}

						let status_rkp;
						if (data.status_rkp == 1) {
							status_rkp = `Status RKP : <i class="fa fa-check" style="color: green"></i>`
						} else if (data.status_rkp == 0) {
							status_rkp = `Status RKP : <i class="fa fa-times" style="color: red"></i>`
						} else {
							status_rkp = `Status RKP : <i class="fa fa-minus" style="color: yellow"></i>`
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
							<a href="#" class="btn btn-block btn-social btn-sm btn-success float-center" data-toggle="dropdown" title="Pilih Aksi"><i class="fa fa-arrow-down"></i> Pilih Aksi </a>
							<ul class="dropdown-menu" role="menu">
								<li> <a  href="<?= site_url('pembangunan_dok/show/'); ?>${data.id}">Lihat</a></li>
								<li class="divider"></li>
								<li> <a  href="<?= site_url('pembangunan/pelaksanaan_aktiv/'); ?>${data.id}" >Laksanakan</a></li>
								<li> <a href="<?= site_url('pembangunan/pelaksanaan_non_aktiv/'); ?>${data.id}">Batalkan</a><li/>
							</ul>
						</div><br/>

						${status}<br/>${status_usulan}<br/>${status_vote}<br/>${status_rkp}<br/>${status_pelaksanaan}
							`
					}
				},

				{
					'data': function(data) {
						return `<div class="user-panel">
									<div class="image1">
										<img src="<?= base_url(LOKASI_GALERI) ?>${data.foto}" class="img-" style="width:120px; height:70px" alt="Gambar 0%">
									</div>
								</div>
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
					'data': 'target_capaian_tahun'
				},
				{
					'data': 'lokasi'
				},
				{
					'data': 'volume'
				},
				{
					'data': 'manfaat',
					'render': $.fn.dataTable.render.number('.', ',', 0, 'Laki-Laki ')
				},
				{
					'data': 'waktu_pelaksanaan'
				},
				{
					'data': 'anggaran',
					'render': $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
				},
				{
					'data': 'sumber_dana'
				},
				{
					'data': 'pola_pelaksanaan'
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