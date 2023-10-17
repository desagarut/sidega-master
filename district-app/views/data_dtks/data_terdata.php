<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Data Individu Terdata</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url("data_dtks/rincian/$data_dtks[id]"); ?>"></i> Rincian Data Kemiskinan</a></li>
			<li class="active">Data Individu</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<a href="<?= site_url("data_dtks/rincian/$data_dtks[id]"); ?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-arrow-circle-left"></i> Kembali Ke Rincian Kategori</a>
					</div>
					<div class="box-body ">
						<h5><b>Info Kelompok Data Kemiskinan</b></h5>
						<table class="table table-bordered table-striped table-hover tabel-rincian">
							<tbody>
								<tr>
									<td width="20%">Nama Data</td>
									<td width="1%">:</td>
									<td><?= strtoupper($data_dtks["nama"]); ?></td>
								</tr>
								<tr>
									<td>Sasaran</td>
									<td>:</td>
									<td><?= $sasaran[$data_dtks["sasaran"]] ?></td>
								</tr>
								<tr>
									<td>Keterangan</td>
									<td>:</td>
									<td><?= $data_dtks["keterangan"] ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h5><b>Data Individu Penduduk Terdata</b></h5>
					</div>
					<div class="box-body">
						<div class="row">
							<div class="col-md-3 text-center">
								<img class="img-circle" style="width: 150px;" alt="Foto Penduduk" src="<?= AmbilFoto($individu['foto'], '', $individu['id_sex']) ?>" />
							</div>
							<div class="col-md-9">
								<div class="table-responsive">
									<table class="table table-bordered table-striped table-hover tabel-rincian">
										<tbody>
											<?php $judul = ($data_dtks['sasaran'] == 1) ? 'Penduduk' : 'KK' ?>
											<tr>
												<td width="20%"><?= ($data_dtks["sasaran"] == 1) ? 'NIK / Nama Penduduk' : 'No. KK / Nama KK'; ?></td>
												<td width="1%">:</td>
												<td> <?= $terdata["terdata_nama"] . ' / ' . $terdata["terdata_info"] ?></td>
											</tr>
											<tr>
												<td>Alamat <?= $judul; ?></td>
												<td>:</td>
												<td><?= $individu['alamat_wilayah']; ?></td>
											</tr>
											<tr>
												<td>Tempat Tanggal Lahir (Umur) <?= $judul; ?></td>
												<td>:</td>
												<td><?= $individu['tempatlahir'] ?> <?= tgl_indo($individu['tanggallahir']) ?> (<?= $individu['umur'] ?> Tahun)</td>
											</tr>
											<tr>
												<td>Pendidikan <?= $judul; ?></td>
												<td>:</td>
												<td><?= $individu['pendidikan'] ?></td>
											</tr>
											<tr>
												<td>Warganegara / Agama <?= $judul; ?></td>
												<td>:</td>
												<td><?= $individu['warganegara'] ?> / <?= $individu['agama'] ?></td>
											</tr>
											<tr>
												<td>Keterangan</td>
												<td>:</td>
												<td><?= $terdata["keterangan"] ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>