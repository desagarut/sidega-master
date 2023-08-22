<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//$usulan_total = $this->db->query('SELECT COUNT(id) AS jumlah FROM tbl_pembangunan ')->result_array()[0]['jumlah'];
//$penduduk_perempuan = $this->db->query('SELECT COUNT(id) AS jumlah FROM tbl_pembangunan WHERE status_dasar = 1 and sex = 2')->result_array()[0]['jumlah'];
//$keluarga_laki = $this->db->query('SELECT COUNT(id) AS jumlah FROM tbl_pembangunan WHERE status_dasar = 1 and sex = 1 and kk_level = 1')->result_array()[0]['jumlah'];
//$keluarga_perempuan = $this->db->query('SELECT COUNT(id) AS jumlah FROM tbl_pembangunan WHERE status_dasar = 1 and sex = 2 and kk_level = 1')->result_array()[0]['jumlah'];
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<section class="content-header">
		<h1>Rencana Kegiatan Pembangunan</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('pembangunan') ?>"> Pembangunan</a></li>
			<li class="active">Daftar Usulan Kegiatan</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<form id="mainformexcel" name="mainformexcel" method="post" class="form-horizontal">
			<div class="row">
				<div class="col-md-2">
					<?php $this->load->view('pembangunan/menu'); ?>
				</div>
				<div class="col-md-10">
					<div class="box">
						<div class="box-header">
							<h5 class="box-title">Daftar Usulan Tingkat <?= ucwords($this->setting->sebutan_dusun); ?> <?php foreach ($usulan_total as $data) : ?><?= $data['jumlah'] ?><?php endforeach; ?>
								<!--<a href="<?= site_url("pembangunan") ?>" class="btn btn-success btn-sm mb-2 mr-2">1. Usulan TK. Dusun</a>
								<a href="<?= site_url("pembangunan/daftar_usulan_tk_desa") ?>" class="btn btn-default btn-sm mb-2 mr-2">2. Usulan TK. <?= ucwords($this->setting->sebutan_desa); ?></a>
								<a href="<?= site_url("pembangunan") ?>" class="btn btn-default btn-sm mb-2 mr-2">3. Penetuan Prioritas</a>
								<a href="<?= site_url("pembangunan") ?>" class="btn btn-default btn-sm mb-2 mr-2">4. Hasil Penetuan Prioritas</a>
								<a href="<?= site_url("pembangunan") ?>" class="btn btn-default btn-sm mb-2 mr-2">5. Penetapan RKP <?= ucwords($this->setting->sebutan_desa); ?></a>
								<a href="<?= site_url("pembangunan") ?>" class="btn btn-default btn-sm mb-2 mr-2">6. Daftar RKP <?= ucwords($this->setting->sebutan_desa); ?></a>
								<a href="<?= site_url("pembangunan") ?>" class="btn btn-default btn-sm mb-2 mr-2">7. Pelaksanaan RKP <?= ucwords($this->setting->sebutan_desa); ?></a>-->
							</h5>
							<div class="box-tools">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
							</div>
						</div>
						<div class="box-body">
							<div class="row">
								<div class="col-lg-3 col-xs-6">
									<a href="<?= site_url('pembangunan/daftar_usulan_tk_desa') ?>" title="Lihat Dusun" class="small-box-footer">
										<div class="small-box bg-purple">
											<div class="inner">
											<?php foreach ($usulan_total as $data) : ?><?= $data['jumlah'] ?><?php endforeach; ?>
												<p>Usulan Aktif</p>
											</div>
											<div class="icon">
												<i class="ion ion-map"></i>
											</div>
										</div>
									</a>
								</div>

								<div class="col-lg-3 col-xs-6">
									<a href="<?= site_url('pembangunan/daftar_usulan_tk_desa') ?>" class="small-box-footer" title="Lihat Daftar Penduduk">
										<div class="small-box bg-blue">
											<div class="inner">
												<?php foreach ($penduduk as $data) : ?>
													<h3>
														<?= $data['jumlah'] ?>
													</h3>
												<?php endforeach; ?>
												<p>Usulan TK. <?= ucwords($this->setting->sebutan_dusun); ?></p>
											</div>
											<div class="icon"> <i class="ion ion-person"></i> </div>
										</div>
									</a>
								</div>
								<div class="col-lg-3 col-xs-6">
									<a href="<?= site_url('penduduk/clear') ?>" class="small-box-footer" title="Lihat Daftar Penduduk">
										<div class="small-box bg-aqua">
											<div class="inner">
												<?php foreach ($penduduk as $data) : ?>
													<h3>
														<?= $data['jumlah'] ?>
													</h3>
												<?php endforeach; ?>
												<p>Usulan TK. <?= ucwords($this->setting->sebutan_desa); ?></p>
											</div>
											<div class="icon"> <i class="ion ion-person"></i> </div>
										</div>
									</a>
								</div>
								<div class="col-lg-3 col-xs-6">
									<a href="<?= site_url('penduduk/clear') ?>" class="small-box-footer" title="Lihat Daftar Penduduk">
										<div class="small-box bg-green">
											<div class="inner">
												<?php foreach ($penduduk as $data) : ?>
													<h3>
														<?= $data['jumlah'] ?>
													</h3>
												<?php endforeach; ?>
												<p>Penentuan Prioritas</p>
											</div>
											<div class="icon"> <i class="ion ion-person"></i> </div>
										</div>
									</a>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-3 col-xs-6">
									<a href="<?= site_url('penduduk/clear') ?>" class="small-box-footer" title="Lihat Daftar Penduduk">
										<div class="small-box bg-yellow">
											<div class="inner">
												<?php foreach ($penduduk as $data) : ?>
													<h3>
														<?= $data['jumlah'] ?>
													</h3>
												<?php endforeach; ?>
												<p>Hasil Penentuan Prioritas</p>
											</div>
											<div class="icon"> <i class="ion ion-person"></i> </div>
										</div>
									</a>
								</div>
								<div class="col-lg-3 col-xs-6">
									<a href="<?= site_url('penduduk/clear') ?>" class="small-box-footer" title="Lihat Daftar Penduduk">
										<div class="small-box bg-orange">
											<div class="inner">
												<?php foreach ($penduduk as $data) : ?>
													<h3>
														<?= $data['jumlah'] ?>
													</h3>
												<?php endforeach; ?>
												<p>Penetapan RKP <?= ucwords($this->setting->sebutan_desa); ?></p>
											</div>
											<div class="icon"> <i class="ion ion-person"></i> </div>
										</div>
									</a>
								</div>
								<div class="col-lg-3 col-xs-6">
									<a href="<?= site_url('penduduk/clear') ?>" class="small-box-footer" title="Lihat Daftar Penduduk">
										<div class="small-box bg-red">
											<div class="inner">
												<?php foreach ($penduduk as $data) : ?>
													<h3>
														<?= $data['jumlah'] ?>
													</h3>
												<?php endforeach; ?>
												<p>Penetapan RKP <?= ucwords($this->setting->sebutan_desa); ?></p>
											</div>
											<div class="icon"> <i class="ion ion-person"></i> </div>
										</div>
									</a>
								</div>
								<div class="col-lg-3 col-xs-6">
									<a href="<?= site_url('penduduk/clear') ?>" class="small-box-footer" title="Lihat Daftar Penduduk">
										<div class="small-box bg-maroon">
											<div class="inner">
												<?php foreach ($penduduk as $data) : ?>
													<h3>
														<?= $data['jumlah'] ?>
													</h3>
												<?php endforeach; ?>
												<p>Pelaksanaan RKP <?= ucwords($this->setting->sebutan_desa); ?></p>
											</div>
											<div class="icon"> <i class="ion ion-person"></i> </div>
										</div>
									</a>
								</div>

							</div>
						</div>
					</div>
				</div>
				<div class="col-md-10">
					<div class="box">
						<div class="row">
							<div class="col-md-12">
								<div class="box-header">
									<!--<h4>Daftar Usulan Tingkat <?= ucwords($this->setting->sebutan_dusun); ?></h4>-->
									<div class="row">
										<div class="col-sm-10">
											<?php if ($this->CI->cek_hak_akses('u')) : ?>
												<a href="<?= site_url('pembangunan/form_usulan_masyarakat') ?>" class="btn btn-success btn-sm" title="Tambah Data Baru"><i class="feather icon-plus"></i> Tambah Usulan</a>
											<?php endif; ?>
											<a href="<?= site_url("pembangunan/dialog_daftar/{$desa_musdus->id}/cetak") ?>" class="btn btn-info btn-sm mb-2 mr-2" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Cetak Data" title="Cetak Data <?= $desa_musdus->judul ?> "><i class="fa fa-print "></i> Cetak</a>
											<a href="<?= site_url("pembangunan/dialog_daftar/{$desa_musdus->id}/unduh") ?>" class="btn bg-navy btn-sm mb-2 mr-2" data-remote="false" data-toggle="modal" data-target="#modalBox" data-title="Unduh Data " title="Unduh Data <?= $desa_musdus->judul ?> "><i class="fa fa-download "></i> Unduh</a>
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
							status = `<a href="<?= site_url('pembangunan/lock/') ?>${data.id}" title="Ubah ke Draft">TK. Wilayah: <i class="fa fa-check" style="color: green"></i></a>`
						} else {
							status = `<a href="<?= site_url('pembangunan/unlock/') ?>${data.id}" title="Ubah jadi Aktif">TK. Wilayah: <i class="fa fa-times" style="color: red"></i></a>`
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
							status_rkp = `Status RKPDes : <i class="fa fa-minus" style="color: yellow"></i>`
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
						<div class="btn-group text-center">
						<a href="#" class="btn btn-block btn-social btn-sm btn-success" data-toggle="dropdown" title="Pilihan Aksi"><i class="fa fa-arrow-down"></i> Pilihan Aksi </a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="<?= site_url('pembangunan/detail_usulan/'); ?>${data.id}">Lihat Usulan</a></li>
								<li><a href="<?= site_url('pembangunan/form_usulan_masyarakat/'); ?>${data.id}">Ubah Usulan</a></li>
								<li><a href="<?= site_url('pembangunan/lokasi_maps/'); ?>${data.id}">Peta lokasi</a></li>
								<li><a href="<?= site_url('pembangunan_dok/show/'); ?>${data.id}">Dokumen Usulan</a></li>
								<li class="divider"></li>
								<li><a href="<?= site_url('pembangunan/unlock/'); ?>${data.id}">Aktifkan Usulan</a></li>
								<li><a href="<?= site_url('pembangunan/lock/'); ?>${data.id}">Non Aktivkan Usulan</a></li>
								<li class="divider"></li>
								<li><a href="<?= site_url('pembangunan/ajukan/'); ?>${data.id}">Ajukan Usulan Ke TK. <?= ucwords($this->setting->sebutan_desa); ?></a></li>
								<li><a href="<?= site_url('pembangunan/batalkan/'); ?>${data.id}">Batalkan Usulan dari TK. <?= ucwords($this->setting->sebutan_desa); ?></a></li>
								<li class="divider"></li>
								<li><a href="#" data-href="<?= site_url('pembangunan/delete/'); ?>${data.id}" data-toggle="modal" data-target="#confirm-delete"">Hapus</a></li>
							</ul>
						</div>
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