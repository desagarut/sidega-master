<div class="content-wrapper">
	<section class="content-header">
		<h1>Dokumentasi Potensi Umum</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('hom_sid') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Dokumentasi Potensi Umum</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="mainformexcel" name="mainformexcel"method="post" class="form-horizontal">
			<div class="row">
				<div class="col-md-12">
					<div class="box box-info">
						<div class="box-header with-border">
							<a href="<?= site_url('potensi_umum_dokumentasi/form') ?>" class="btn btn-social btn-box btn-success btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Data Baru">
								<i class="fa fa-plus"></i>Tambah Data
							</a>
							<a href="<?= site_url("potensi_umum/dialog_daftar/{$potensi_umum->id}/cetak")?>" class="btn btn-social btn-box bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Data Pembangunan" title="Cetak Data Pembangunan <?= $potensi_umum->judul ?> "><i class="fa fa-print "></i> Cetak</a>
							<a href="<?= site_url("potensi_umum/dialog_daftar/{$potensi_umum->id}/unduh")?>" class="btn btn-social btn-box bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Data Pembangunan" title="Unduh Data Pembangunan <?= $potensi_umum->judul ?> "><i class="fa fa-download "></i> Unduh</a>
							<a href="<?= site_url('potensi_umum') ?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Kembali"><i class="fa fa-arrow-circle-left"></i> Kembali </a>
						</div>
						<div class="box-body">
							<h5 class="text-bold">Rincian Dokumen</h5>
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-hover tabel-rincian">
									<tbody>
										<tr>
											<td width="20%">Bulan, Tahun Laporan</td>
											<td width="1">:</td>
											<td><?= $potensi_umum->bulan_laporan ?>, <?= $potensi_umum->tahun_laporan ?></td>
										</tr>
										<tr>
											<td>Nama Kepala <?= ucwords($this->setting->sebutan_desa)?></td>
											<td> : </td>
											<td><?= $potensi_umum->nama_kepala ?></td>
										</tr>
										<tr>
											<td>Keterangan</td>
											<td> : </td>
											<td>Silahkan unggah dokumen pendukung potensi umum berupa Peraturan Desa, Peraturan Daerah, Gedung Kantor Desa, atau referensi lainnya yang menunjang. Unggahan dalam bentuk Foto dengan format *.png / *.jpg</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="row">
										<div class="col-sm-12">
											<div class="table-responsive">
												<table id="tabel-dokumentasi" class="table table-bordered dataTable table-hover">
													<thead class="bg-gray">
														<tr>
															<th width="20px" class="text-center">No</th>
															<th width="80px" class="text-center">Aksi</th>
															<th class="text-center">Gambar</th>
															<th class="text-center">Judul</th>
															<th class="text-center">Keterangan</th>
															<th class="text-center">Tgl Rekam</th>
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
<script>
	$(function() {
		let tabelDokumentasi = $('#tabel-dokumentasi').DataTable({
			'processing': true,
			'serverSide': true,
			'autoWidth': false,
			'pageLength': 10,
			'order': [
				[3, 'asc']
			],
			'columnDefs': [{
				'orderable': false,
				'targets': [0,1,2]
			}],

			'ajax': {
				'url': "<?= site_url("potensi_umum_dokumentasi/show/{$potensi_umum->id}") ?>",
				'method': 'POST'
			},
			'columns': [
				{'data': null},
				{
					'data': function(data) {
						return `<a href="<?= site_url("potensi_umum_dokumentasi/form/"); ?>${data.id}" title="Edit Data"  class="btn bg-orange btn-box btn-sm"><i class="fa fa-edit"></i> </a>
								<a href="#" data-href="<?= site_url("potensi_umum_dokumentasi/delete/{$potensi_umum->id}/"); ?>${data.id}" class="btn bg-maroon btn-box btn-sm"  title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
							   `
					}, 'class': 'text-center'
				},
				{
					'data': function (data) {
						return `<div class="user-panel">
									<div class="image2">
										<img src="<?= base_url(LOKASI_GALERI) ?>${data.gambar}" class="img-circle" alt="Foto Dokumentasi">
									</div>
								</div>`
					}
				},
				{'data': 'judul'},
				{'data': 'keterangan'},
				{'data': 'created_at'}
			],
			'language': {
				'url': "<?= base_url('/assets/bootstrap/js/dataTables.indonesian.lang') ?>"
			}
		});

		tabelDokumentasi.on('draw.dt', function() {
			let PageInfo = $('#tabel-dokumentasi').DataTable().page.info();
			tabelDokumentasi.column(0, {
				page: 'current'
			}).nodes().each(function(cell, i) {
				cell.innerHTML = i + 1 + PageInfo.start;
			});
		});
	});
</script>
