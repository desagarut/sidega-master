<?php defined('BASEPATH') || exit('No direct script access allowed');?>

<form id="mainformexcel" name="mainformexcel"method="post" class="form-horizontal">
	<div class="box box-info">
		<div class="box-header with-border">
			<div class="row">
				<div class="col-sm-2">
					<select class="form-control input-sm select2" id="tahun" name="tahun">
						<option selected value="semua">Semua Tahun</option>
						<?php foreach ($list_tahun as $list) : ?>
							<option value="<?= $list->tahun ?>"><?= $list->tahun ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="col-sm-10">
					<a href="<?= site_url($this->controller . '/dialog/cetak'); ?>" class="btn btn-social btn-flat bg-purple btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Cetak Buku Rencana Kerja Pembangunan" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Buku Rencana Kerja Pembangunan"><i class="fa fa-print "></i> Cetak</a>
					<a href="<?= site_url($this->controller . '/dialog/unduh'); ?>" class="btn btn-social btn-flat bg-navy btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block" title="Unduh Buku Rencana Kerja Pembangunan" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Buku Rencana Kerja Pembangunan"><i class="fa fa-download"></i> Unduh</a>
				</div>
			</div>
		</div>
		<div class="box-body">
			<div class="table-responsive">
				<table id="tabel-pembangunan" class="table table-bordered dataTable table-striped table-hover tabel-daftar">
					<thead class="bg-gray disabled color-palette">
						<tr>
							<th >NO.</th>
							<th >NAMA PROGRAM / KEGIATAN</th>
							<th >LOKASI</th>
							<th >SUMBER DANA</th>
							<th >ANGGARAN</th>
							<th >VOLUME</th>
							<th >PELAKSANA</th>
							<th >MANFAAT</th>
							<th >KET</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</form>
<?php $this->load->view('global/confirm_delete'); ?>
<script>
	$(document).ready(function() {
		let tabelPembangunan = $('#tabel-pembangunan').DataTable({
			'processing': true,
			'serverSide': true,
			'autoWidth': false,
			'pageLength': 10,
			'order': [
				[1, 'desc'],
			],
			'columnDefs': [
				{ 'orderable': false, 'targets': [0] },
				{ 'className' : 'padat', 'targets': [0, 3, 4, 5, 6, 7] },
			],
			'ajax': {
				'url': SITE_URL + 'ba_rencana_pembangunan',
				'method': 'POST',
				'data': function(d) {
					d.tahun = $('#tahun').val();
				}
			},
			'columns': [
				{
					'data': null,
				},
				{
					'data': 'nama_program_kegiatan'
				},
				{
					'data': 'lokasi'
				},
				{
					'data': 'sumber_dana',
					'render': $.fn.dataTable.render.number( '.', '.', 0, 'Rp ' )
				},
				{
					'data': 'anggaran',
					'render': $.fn.dataTable.render.number( '.', '.', 0, 'Rp ' )
				},
				{
					'data': 'volume'
				},
				{
					'data': 'pelaksana_kegiatan'
				},
				{
					'data': 'manfaat'
				},
				{
					'data': 'keterangan'
				},
			],
			'language': {
				'url': BASE_URL + '/assets/bootstrap/js/dataTables.indonesian.lang'
			}
		});

		tabelPembangunan.on('draw.dt', function() {
			let PageInfo = $('#tabel-pembangunan').DataTable().page.info();
			tabelPembangunan.column(0, {
				page: 'current'
			}).nodes().each(function(cell, i) {
				cell.innerHTML = i + 1 + PageInfo.start;
			});
		});

		$('#tahun').on('select2:select', function (e) {
			tabelPembangunan.ajax.reload();
		});
	});
</script>
