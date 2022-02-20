<?php  if(!defined('BASEPATH')) exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php $this->load->view($folder_themes . '/commons/meta') ?>
	<?php $this->load->view($folder_themes . '/commons/for_css') ?>
</head>
<body data-theme="light">

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
	<?php $this->load->view($folder_themes . '/commons/for_css') ?>

</head>
<body>
   
	<?php $this->load->view($folder_themes .'/commons/header') ?>

<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">

	<div class="d-flex justify-content-between align-items-center">
	  <h5>Statistik</h5>
	  <ol>
		<li><a href="<?= site_url("first"); ?>">Home</a></li>
		<li><?= $detail['nama']; ?></li>
	  </ol>
	</div>

  </div>
</section><!-- End Breadcrumbs -->


<section id="blog" class="blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-8" data-aos="fade-up">            
						<h4 align="center"> Lembaga Masyarakat <?= ucfirst($this->setting->sebutan_desa).' '.ucwords($desa['nama_desa']) ?></h4>
                        <h4 align="center"><small>Kelompok <?= $detail['nama']; ?></small></h4>
					<div class="box-body">
						<p class="info"><?= $detail['keterangan']?></p>
						<h5 class="subtitle">Pengurus</h3>
						<div class="table"><small>
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
							</table></small>
						</div>
						<h5 class="subtitle">Anggota</h5>
						<div class="table-responsive"><small>
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
							</table></small>
						</div>
					</div>
			</div>
		<?php $this->load->view($folder_themes .'/partials/sidebar-kelompok.php') ?>
        </div>
    </div>
</section>
	<?php $this->load->view($folder_themes .'/commons/footer') ?>
    <?php $this->load->view($folder_themes . '/commons/for_js') ?>

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
    

