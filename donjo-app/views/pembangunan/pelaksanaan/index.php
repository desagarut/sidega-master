<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>Pelaksanaan Kegiatan</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('pembangunan') ?>"> Pelaksanaan Kegiatan</a></li>
			<li class="active">Daftar Kegiatan</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="row">
			<div class="col-md-2">
				<?php $this->load->view('pembangunan/menu'); ?>
			</div>
			<div class="col-md-10">
				<div class="box">
					<form id="mainformexcel" name="mainformexcel" method="post" class="form-horizontal">
						<div class="row">
							<div class="col-md-12">
								<div class="box-header">
									<h4>Daftar Pelaksanaan Kegiatan Pembangunan</h4>
									<div class="row">
										<div class="col-sm-2">Pilih Tahun :</div>
										<div class="col-sm-2">
											<select class="form-control input-sm select2" id="tahun" name="tahun" style="width:100%;">
												<option selected value="semua">Semua Tahun</option>
												<?php foreach ($list_tahun as $list) : ?>
													<option value="<?= $list->tahun ?>"><?= $list->tahun ?></option>
												<?php endforeach; ?>
											</select>
											</p>
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
															<th class="text-center">Status Usulan</th>
															<th class="text-center">Gambar</th>
															<th class="text-center">Prioritas Desa</th>
															<th class="text-center">Persentase Pelaksanaan</th>
															<th class="text-center">Tahun</th>
															<th class="text-center">Nama Program/Kegiatan </th>
															<th class="text-center">Lokasi (RT/RW/Dusun)</th>
															<th class="text-center">Perkiraan Volume & Satuan</th>
															<th class="text-center">Jumlah (Rp)</th>
															<th class="text-center">Sumber Dana</th>
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
				[9, 'desc'],
			],
			'columnDefs': [{
				'orderable': false,
				'targets': [0, 1, 9],
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
						return `
						<div class="text-center">
						<a href="<?= site_url('pembangunan_dok/show/'); ?>${data.id}" class="btn btn-sm btn-box btn-success"> Dokumen</a><br/>
						<!--<a href="<?= site_url('pembangunan/ajukan/'); ?>${data.id}" class="btn btn-sm btn-box btn-default">Ajukan Usulan</a><br/>
						<a href="<?= site_url('pembangunan/batalkan/'); ?>${data.id}" class="btn btn-sm btn-box btn-default">Batalkan Usulan</a>-->
						</div><br/>
						`
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

						return `<div class="text-center" style="width: 75px">${status}<br/>${status_usulan}<br/>${status_vote}<br/>${status_rkpdes}<br/>${status_pelaksanaan}</div>`
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
					'data': function(data) {
						return `<div class="text-center" style="width: 50px">${data.urutan_prioritas}
								</div>`
					
					}
				},

				{
					
					'data': function(data) {
						return `<div class="text-center" style="color: blue"><strong>${data.max_persentase}</strong>
								</div>`
					
					}
				},

				{
					'data': 'tahun'
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