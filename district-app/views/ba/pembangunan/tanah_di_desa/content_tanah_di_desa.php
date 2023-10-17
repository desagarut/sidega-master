<?php defined('BASEPATH') || exit('No direct script access allowed');?>

<div class="box box-info">
	<div class="box-header with-border">
		<?php if ($this->CI->cek_hak_akses('u')): ?>
			<a href="<?= site_url('ba_tanah_desa/form')?>" class="btn btn-social btn-flat btn-success btn-sm btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Tambah Data Baru"> <i class="fa fa-plus"></i>Tambah Data </a>
		<?php endif; ?>
		<a href="#" class="btn btn-social btn-flat bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Cetak Buku Tanah di Desa" data-remote="false" data-toggle="modal" data-href="<?= site_url('ba_tanah_desa/cetak_tanah_desa/cetak'); ?>" data-target="#cetakBox" data-aksi="Cetak" data-title="Buku Tanah di Desa"><i class="fa fa-print "></i> Cetak</a>
		<a href="#" class="btn btn-social btn-flat bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Unduh Buku Tanah di Desa" data-remote="false" data-toggle="modal" data-href="<?= site_url('ba_tanah_desa/cetak_tanah_desa/unduh'); ?>" data-target="#cetakBox" data-aksi="Unduh" data-title="Buku Tanah di Desa"><i class="fa fa-download"></i> Unduh</a>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-sm-12">
				<div class="row">
					<div class="col-sm-12">
						<div class="table-responsive">
							<table id="tabel-tanahdesa" class="table table-bordered dataTable table-hover">
								<thead class="bg-gray">
									<tr>
										<th class="text-center">No</th>
										<th width="120" class="text-center">Aksi</th>
										<th class="text-center">Nama Perorangan &nbsp/ <br> Badan Hukum</th>
										<th class="text-center">Luas Total (M<sup>2</sup>)</th>
										<th class="text-center">Mutasi</th>
										<th class="text-center">Keterangan</th>
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
		<?php $this->load->view('global/cetak_box'); ?>
	</div>
</div>
<?php $this->load->view('global/confirm_delete'); ?>
<script>
	$(document).ready(function()
	{
		let tabelTanahDesa = $('#tabel-tanahdesa').DataTable({
			'processing': true,
			'serverSide': true,
			'autoWidth': false,
			'pageLength': 10,
			'order': [],
			'columnDefs': [{
				'orderable': false,
				'targets': [0, 1, 2, 3, 4, 5],
			}],
			'ajax': {
				'url': "<?= site_url('ba_tanah_desa') ?>",
				'method': 'POST',
				'data': function(d) {
				}
			},
			'columns': [
				{
					'data': null,
				},
				{
					'data': function(data)
					{
						return `
							<a href="<?= site_url('ba_tanah_desa/view_tanah_desa/') ?>${data.id}" title="Lihat Data" class="btn bg-info btn-flat btn-sm"><i class="fa fa-eye"></i></a>
							<?php if ($this->CI->cek_hak_akses('u')): ?>
								<a href="<?= site_url('ba_tanah_desa/form/') ?>${data.id}" title="Edit Data" class="btn bg-orange btn-flat btn-sm"><i class="fa fa-edit"></i> </a>
							<?php endif; ?>
							<?php if ($this->CI->cek_hak_akses('h')): ?>
							<a href="#" data-href="<?= site_url('ba_tanah_desa/delete_tanah_desa/') ?>${data.id}" class="btn bg-maroon btn-flat btn-sm" title="Hapus" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i></a>
							<?php endif; ?>
							`
					}
				},
				{
					'data': function(data)
					{
						return data.nama_pemilik_asal ? data.nama_pemilik_asal : data.nama;
					}
				},
				{
					'data': 'luas'
				},
				{
					'data': 'mutasi'
				},
				{
					'data': 'keterangan'
				},
			],
			'language': {
				'url': "<?= base_url('/assets/bootstrap/js/dataTables.indonesian.lang') ?>"
			}
		});

		tabelTanahDesa.on('draw.dt', function()
		{
			let PageInfo = $('#tabel-tanahdesa').DataTable().page.info();
			tabelTanahDesa.column(0, {
				page: 'current'
			}).nodes().each(function(cell, i) {
				cell.innerHTML = i + 1 + PageInfo.start;
			});
		});
	});
</script>