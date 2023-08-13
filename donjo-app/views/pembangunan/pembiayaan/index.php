<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
	<section class="content-header">
		<h1>Rencana Pembiayaan Pembangunan Desa</h1>
		<ol class="breadcrumb float-sm-right">
			<li class="breadcrumb-item"><a href="<?= site_url() ?>beranda">Beranda</a></li>
			<li class="breadcrumb-item"><a href="<?= site_url() ?>pembangunan">Perencanaan Desa</a></li>
			<li class="breadcrumb-item"><a href="<?= site_url() ?>pembangunan_pembiayaan">Rencana Pembiayaan Pembangunan Desa</a></li>
			<li class="breadcrumb-item active"><a href="#!">Daftar</a></li>
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
									<h5>Rencana Pembiayaan Pembangunan Desa</h5>
									<div class="row">
										<div class="col-md-4">
											<a href="<?= site_url('pembangunan_pembiayaan/form') ?>" class="btn btn-success btn-sm" title="Tambah Data Baru"><i class="feather icon-plus"></i> Tambah</a>
											<a href="#" class="btn btn-info btn-sm mb-2 mr-2" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Data" title="Cetak Data <?= $desa_musdus->judul ?> "><i class="fa fa-print "></i> Cetak</a>
											<a href="#" class="btn bg-navy btn-sm mb-2 mr-2" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Data " title="Unduh Data <?= $desa_musdus->judul ?> "><i class="fa fa-download "></i> Unduh</a>
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
															<th class="text-center">Aksi </th>
															<th class="text-center">Tahun </th>
															<th class="text-center">Nama Dusun </th>
															<th class="text-center">Bidang </th>
															<th class="text-center">Nama Program/Kegiatan </th>
															<th class="text-center">PADes </th>
															<th class="text-center">Dana Desa (APBN)</th>
															<th class="text-center">Alokasi Dana Desa (bagian dana perimbangan kab./kota)</th>
															<th class="text-center">Dana bagian dari hasil pajak dan retribusi </th>
															<th class="text-center">APBD Prov. </th>
															<th class="text-center">APBD Kab. </th>
															<th class="text-center">Sumber Keuangan Lainnya yang Sah dan Tidak Mengikat </th>
															<th class="text-center">Tanggal dibuat </th>
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
				'url': "<?= site_url('pembangunan_pembiayaan') ?>",
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
						return `
						<div class="btn-group mb-2 mr-2">
						<a href="#" class="btn btn-success btn-box btn-sm" data-toggle="dropdown" title="Pilih Aksi">Aksi <i class="fa fa-circle-o"></i></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?= site_url('pembangunan_pembiayaan/detail_program/'); ?>${data.id}" title="Lihat Detail Program Kegiatan">Lihat</a></li>
								<li><a class="dropdown-item" href="<?= site_url('pembangunan_pembiayaan/form/'); ?>${data.id}">Ubah</a></li>
								<li><a class="dropdown-item" href="#" data-href="<?= site_url('pembangunan_pembiayaan/delete/'); ?>${data.id}" data-toggle="modal" data-target="#confirm-delete"">Hapus</a></li>
							</ul>
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
					'data': 'pades',
					'render': $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
				},
				{
					'data': 'apbn',
					'render': $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
				},
				{
					'data': 'add',
					'render': $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
				},
				{
					'data': 'bagi_hasil_pajak',
					'render': $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
				},
				{
					'data': 'apbd_prov',
					'render': $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
				},
				{
					'data': 'apbd_kab',
					'render': $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
				},
				{
					'data': 'lainnya',
					'render': $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
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