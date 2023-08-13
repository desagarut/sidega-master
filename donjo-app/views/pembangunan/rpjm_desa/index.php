<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h5>Usulan Masyarakat (SDGS Desa)</h5>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= site_url() ?>beranda">Beranda</a></li>
						<li class="breadcrumb-item"><a href="#!">Pembangunan Desa</a></li>
						<li class="breadcrumb-item active"><a href="#!">Daftar Usulan Masyarakat</a></li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- /.content-header -->
	<section class="content" id="maincontent">
		<div class="row">
			<div class="col-md-3">
				<?php $this->load->view('pembangunan/menu'); ?>
			</div>

			<div class="col-md-9">
				<div class="card">
					<form id="mainformexcel" name="mainformexcel" method="post" class="form-horizontal">
						<div class="row">
							<div class="col-md-12">
								<div class="card-header">
									<div class="col-md-12">
										<div class="row">
											<a href="<?= site_url('rpjm_desa/form') ?>" class="btn btn-success btn-sm mb-2 mr-2" title="Tambah Data Baru"><i class="feather icon-plus"></i> Tambah Usulan</a>
											<a href="<?= site_url("rpjm_desa/dialog_daftar/{$desa_dpurpp->id}/cetak") ?>" class="btn btn-secondary btn-sm mb-2 mr-2" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Data" title="Cetak Data <?= $desa_dpurpp->judul ?> "><i class="fa fa-print "></i> Cetak</a>
											<a href="<?= site_url("rpjm_desa/dialog_daftar/{$desa_dpurpp->id}/unduh") ?>" class="btn btn-secondary btn-sm mb-2 mr-2" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Data " title="Unduh Data <?= $desa_dpurpp->judul ?> "><i class="fa fa-download "></i> Unduh</a>
											<!--<a href="<?= site_url('rpjm_desa') ?>" class="btn btn-info btn-sm mb-2 mr-2" title="Kembali Ke Daftar Pembagunan"><i class="fa fa-arrow-circle-left"></i> Kembali Ke Daftar Pembangunan</a>-->
											<div class="col-md-3">
												<div class="input-group">
													<select class="form-control" id="tahun" name="tahun" style="width:100%;">
														<option selected value="semua">Semua Tahun</option>
														<?php foreach ($list_tahun as $list) : ?>
															<option value="<?= $list->tahun_anggaran ?>"><?= $list->tahun_anggaran ?></option>
														<?php endforeach; ?>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body table-border-style">
									<div class="table-responsive">
										<table id="tabel-tbl_rpjm_desa" class="table table-hover">
											<thead>
												<tr>
													<th width="230px" class="text-center">Aksi</th>
													<th class="text-center">Tahun</th>
													<th class="text-center">Nama Desa</th>
													<th class="text-center">Bidang </th>
													<th class="text-center">Urutan Prioritas </th>
													<th class="text-center">Nama Program/Kegiatan </th>
													<th class="text-center">Mendukung SDGS Ke- </th>
													<th class="text-center">Data Eksisting Tahun Berjalan </th>
													<th class="text-center">Lokasi (RT/RW/Dusun)</th>
													<th class="text-center">Perkiraan Volume & Satuan</th>
													<th class="text-center">Laki-laki</th>
													<th class="text-center">Perempuan</th>
													<th class="text-center">RTM</th>
													<th class="text-center">Jumlah (Rp)</th>
													<th class="text-center">Sumber Dana</th>
													<th class="text-center">Persentase</th>
													<th class="text-center">Gambar</th>
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
			$('#tabel-tbl_rpjm_desa').DataTable({
				'processing': true,
				'serverSide': true,
				'autoWidth': false,
				'pageLength': 10,
				'order': [
					[7, 'desc'],
				],
				'columnDefs': [{
					'orderable': false,
					'targets': [0, 1, 10],
				}],
				'ajax': {
					'url': "<?= site_url('desa_dpurpp') ?>",
					'method': 'POST',
					'data': function(d) {
						d.tahun = $('#tahun').val();
					}
				},
				'columns': [{
						'data': function(data) {
							let status;
							if (data.status == 1) {
								status = `<a href="<?= site_url('desa_dpurpp/lock/') ?>${data.id}" class="btn btn-icon btn-success btn-sm mb-2 mr-2" title="Non Aktifkan Pembangunan"><i class="feather icon-unlock"></i></a>`
							} else {
								status = `<a href="<?= site_url('desa_dpurpp/unlock/') ?>${data.id}" class="btn btn-icon btn-secondary btn-sm mb-2 mr-2" title="Aktifkan Pembangunan"><i class="feather icon-lock"></i></a>`
							}

							return `
						<div class="btn-group mb-2 mr-2">
						<a href="<?= site_url('desa_dpurpp/info_desa_dpurpp/'); ?>${data.id}" target="_blank" title="Lihat Usulan"><button type="button" class="btn btn-success">Lihat</button></a>
							<button type="button" class="btn  btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="sr-only">Toggle Dropdown</span></button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="<?= site_url('desa_dpurpp/form/'); ?>${data.id}">Edit Data RPJM</a>
								<a class="dropdown-item" href="<?= site_url('desa_dpurpp/lokasi_maps/'); ?>${data.id}">Peta lokasi</a>
								<a class="dropdown-item" href="<?= site_url('desa_dpurpp_dok/show/'); ?>${data.id}">Tahap Pelaksanaan</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#" data-href="<?= site_url('desa_dpurpp/delete/'); ?>${data.id}" data-toggle="modal" data-target="#confirm-delete"">Hapus</a>
							</div>
						</div>
							${status}
							`
						}
					},
					{
						'data': 'tahun_anggaran'
					},
					{
						'data': 'desa'
					},
					{
						'data': 'bidang_desa'
					},
					{
						'data': 'urutan_prioritas'
					},
					{
						'data': 'nama_program_kegiatan'
					},
					{
						'data': 'sdgs_ke'
					},
					{
						'data': 'data_eksisting'
					},
					{
						'data': 'lokasi'
					},
					{
						'data': 'volume'
					},
					{
						'data': 'laki'
					},
					{
						'data': 'perempuan'
					},
					{
						'data': 'rtm'
					},
					{
						'data': 'anggaran',
						'render': $.fn.dataTable.render.number(',', '.', 0, 'Rp ')
					},
					{
						'data': 'sumber_dana'
					},
					{
						'data': 'max_persentase'
					},
					{
						'data': function(data) {
							return `<div class="user-panel">
									<div class="image2">
										<img src="<?= base_url(LOKASI_GALERI) ?>${data.foto}" class="img-user wid-80 align-top m-r-15" alt="Gambar Dokumentasi">
									</div>
								</div>`
						}
					},
				],
				'language': {
					'url': "<?= base_url('/assets/bootstrap/js/dataTables.indonesian.lang') ?>"
				}
			});

			tabelDpurpp_desa.on('draw.dt', function() {
				let PageInfo = $('#tabel-tbl_rpjm_desa').DataTable().page.info();
				tabelDpurpp_desa.column(0, {
					page: 'current'
				}).nodes().each(function(cell, i) {
					cell.innerHTML = i + 1 + PageInfo.start;
				});
			});

			$('#tahun').on('select2:select', function(e) {
				tabelDpurpp_desa.ajax.reload();
			});
		});
	</script>