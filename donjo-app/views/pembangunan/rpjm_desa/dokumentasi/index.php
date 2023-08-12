<div class="pcoded-main-container">
	<div class="pcoded-content">

	<div class="page-header">
		<h5 class="m-b-10">Daftar Dokumentasi Pembangunan</h5>
		<ul class="breadcrumb">
			<li class="breadcrumb-item"><a href="<?= site_url('beranda') ?>"><i class="feather icon-home"></i></a></li>
						<li class="breadcrumb-item active">Daftar Jenis</li>
					</ol>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</div>
	<div class="card">
		<form id="mainformexcel" name="mainformexcel"method="post" class="form-horizontal">
			<div class="row">
				<div class="col-md-12">
					
						<div class="card-header">
							<a href="<?= site_url('pembangunan_dokumentasi/form') ?>" class="btn btn-success btn-sm btn-sm " title="Tambah Data Baru">
								<i class="fa fa-plus"></i>Tambah Data
							</a>
							<a href="<?= site_url("pembangunan/dialog_daftar/{$pembangunan->id}/cetak")?>" class="btnbg-purple btn-sm " data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Data Pembangunan" title="Cetak Data Pembangunan <?= $pembangunan->judul ?> "><i class="fa fa-print "></i> Cetak</a>
							<a href="<?= site_url("pembangunan/dialog_daftar/{$pembangunan->id}/unduh")?>" class="btnbg-navy btn-sm " data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Data Pembangunan" title="Unduh Data Pembangunan <?= $pembangunan->judul ?> "><i class="fa fa-download "></i> Unduh</a>
							<a href="<?= site_url('pembangunan') ?>" class="btn btn-info btn-sm " title="Kembali Ke Daftar Pembagunan"><i class="fa fa-arrow-circle-left"></i> Kembali Ke Daftar Pembangunan</a>
						</div>
						<div class="card-body">
							<h5 class="text-bold">Rincian Dokumentasi Pembangunan</h5>
							<div class="table-responsive">
								<table class="table table-hover tabel-rincian">
									<tbody>
										<tr>
											<td width="20%">Nama Kegiatan</td>
											<td width="1">:</td>
											<td><?= $pembangunan->judul ?></td>
										</tr>
										<tr>
											<td>Sumber Dana</td>
											<td> : </td>
											<td><?= $pembangunan->sumber_dana ?></td>
										</tr>
										<tr>
											<td>Lokasi Pembangunan</td>
											<td> : </td>
											<td><?= $pembangunan->alamat ?></td>
										</tr>
										<tr>
											<td>Keterangan</td>
											<td> : </td>
											<td><?= $pembangunan->keterangan ?></td>
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
															<th class="text-center">Persentase</th>
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
	</div>
</section>
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
				'url': "<?= site_url("pembangunan_dokumentasi/show/{$pembangunan->id}") ?>",
				'method': 'POST'
			},
			'columns': [
				{'data': null},
				{
					'data': function(data) {
						return `<a href="<?= site_url("pembangunan_dokumentasi/form/"); ?>${data.id}" title="Edit Data"  class="btn bg-orange btn-flat btn-sm"><i class="fa fa-edit"></i> </a>
								<a href="#" data-href="<?= site_url("pembangunan_dokumentasi/delete/{$pembangunan->id}/"); ?>${data.id}" class="btn bg-maroon btn-flat btn-sm"  title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash"></i></a>
							   `
					}, 'class': 'text-center'
				},
				{
					'data': function (data) {
						return `<div class="user-panel">
									<div class="image2 text-center">
										<img src="<?= base_url(LOKASI_GALERI) ?>${data.gambar}" class="img-user wid-80 align-top m-r-15" alt="Foto Dokumentasi">
									</div>
								</div>`
					}
				},
				{'data': 'persentase'},
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
