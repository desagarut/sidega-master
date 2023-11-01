<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>Daftar Usulan Program / Kegiatan Tingkat <?= ucwords($this->setting->sebutan_dusun); ?> </h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('pembangunan') ?>"> Pembangunan</a></li>
			<li class="active">Daftar Usulan Program / Kegiatan</li>
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
											<?php if ($this->CI->cek_hak_akses('u')) : ?>
												<a href="<?= site_url('pembangunan/form_usulan_masyarakat') ?>" class="btn btn-success btn-sm" title="Tambah Data Baru"><i class="feather icon-plus"></i> Tambah Usulan</a>
											<?php endif; ?>
											<a href="<?= site_url($this->controller . '/dialog/cetak'); ?>" class="btn btn-social btn-flat bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Cetak Buku Rencana Kerja Pembangunan" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Buku Rencana Kerja Pembangunan"><i class="fa fa-print "></i> Cetak</a>
											<a href="<?= site_url($this->controller . '/dialog/unduh'); ?>" class="btn btn-social btn-flat bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Unduh Buku Rencana Kerja Pembangunan" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Buku Rencana Kerja Pembangunan"><i class="fa fa-download"></i> Unduh</a>
										</div>
										<div class="col-sm-2">
											<select class="form-control input-sm select2 pull-right" id="tahun" name="tahun">
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
				'url': "<?= site_url($this->controller) ?>",
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
								<li><a href="<?= site_url('pembangunan/detail_usulan/'); ?>${data.id}">Lihat Usulan</a></li>
								<li><a href="<?= site_url('pembangunan/form_usulan_masyarakat/'); ?>${data.id}">Ubah Usulan</a></li>
								<li><a href="<?= site_url('pembangunan/lokasi_maps/'); ?>${data.id}">Peta lokasi</a></li>
								<li class="divider"></li>
								<li><a href="<?= site_url('pembangunan/unlock/'); ?>${data.id}">Aktifkan Usulan</a></li>
								<li><a href="<?= site_url('pembangunan/lock/'); ?>${data.id}">Non Aktivkan Usulan</a></li>
								<li class="divider"></li>
								<li><a href="<?= site_url('pembangunan/ajukan/'); ?>${data.id}">Ajukan Usulan Ke TK. <?= ucwords($this->setting->sebutan_desa); ?></a></li>
								<li><a href="<?= site_url('pembangunan/batalkan/'); ?>${data.id}">Batalkan Usulan dari TK. <?= ucwords($this->setting->sebutan_desa); ?></a></li>
								<li class="divider"></li>
								<li><a href="#" data-href="<?= site_url('pembangunan/delete/'); ?>${data.id}" data-toggle="modal" data-target="#confirm-delete"">Hapus</a></li>
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