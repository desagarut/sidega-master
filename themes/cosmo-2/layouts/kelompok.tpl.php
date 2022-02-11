<!DOCTYPE html>
<html lang="en">
<head>

<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<style type="text/css">
	h3.subtitle {
		margin-top: 5px;
		margin-bottom: 15px;
	}
	p.info {
		margin-bottom: 15px;
	}
</style>

	<?php $this->load->view($folder_themes . '/commons/meta') ?>
	<?php $this->load->view($folder_themes . '/commons/source_css') ?>

</head>
<body>
   
	<?php $this->load->view($folder_themes .'/commons/header') ?>
	<?php $this->load->view($folder_themes .'/partials/newsticker') ?>

	<section class="main-wrapper">
		<main class="content">
			<div class="innertube">
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title"> Data Kelompok - <?= $detail['nama']; ?></h3>
					</div>
					<div class="box-body">
						<p class="info"><?= $detail['keterangan']?></p>
						<h3 class="subtitle">Daftar Pengurus</h3>
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover">
								<thead class="bg-gray disabled color-palette">
									<tr>
										<th>No</th>
										<th>Jabatan</th>
										<th>Nama</th>
										<th>Alamat</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($pengurus as $key => $data): ?>
										<tr>
											<td><?= $key + 1?></td>
											<td><?= $this->referensi_model->list_ref(JABATAN_KELOMPOK)[$data['jabatan']]?></td>
											<td nowrap><?= $data['nama']?></td>
											<td><?= $data['alamat']?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
						<h3 class="subtitle">Daftar Anggota</h3>
						<div class="table-responsive">
							<table class="table table-striped table-bordered dataTable table-hover nowrap" id="tabel-data">
								<thead class="bg-gray disabled color-palette">
									<tr>
										<th>No</th>
										<th>No. Anggota</th>
										<th>Nama</th>
										<th>Alamat</th>
										<th>Jenis Kelamin</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($anggota as $key => $data): ?>
										<tr>
											<td><?= $key + 1?></td>
											<td><?= $data['no_anggota'] ?:'-'?></td>
											<td nowrap><?= $data['nama']?></td>
											<td><?= $data['alamat']?></td>
											<td><?= ($data['sex'] == 1) ? 'LAKI-LAKI' : 'PEREMPUAN'?></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</main>
		<?php $this->load->view($folder_themes .'/partials/sidebar.php') ?>
	</section>
	<?php $this->load->view($folder_themes .'/commons/footer') ?>
    <?php $this->load->view($folder_themes . '/commons/source_js') ?>
	<?php $this->load->view($folder_themes . '/partials/tawkto') ?>

</body>
</html>    
    	<script>
		$(document).ready(function(){
			$('#tabel-data').DataTable({
				'processing': true,
				"pageLength": 10,
				'order': [],
				'columnDefs': [
					{
						'searchable': false,
						'targets': 0
					},
					{
						'orderable': false,
						'targets': 0
					}
				],
				'language': {
					'url': BASE_URL + '/assets/bootstrap/js/dataTables.indonesian.lang'
				},
			});
		});
	</script>
    

