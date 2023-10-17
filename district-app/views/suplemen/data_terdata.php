<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Data Terdata Suplemen</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda')?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url("suplemen/rincian/$suplemen[id]"); ?>"></i> Rincian Suplemen</a></li>
			<li class="active">Data Terdata Suplemen</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<a href="<?= site_url("suplemen/rincian/$suplemen[id]"); ?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-arrow-circle-left"></i> Kembali Ke Rincian Suplemen</a>
					</div>
					<div class="box-body ">
						<h5><b>Rincian Suplemen</b></h5>
						<table class="table table-bordered table-striped table-hover tabel-rincian">
							<tbody>
								<tr>
									<td width="20%">Nama Suplemen</td>
									<td width="1%">:</td>
									<td><?= strtoupper($suplemen["nama"]); ?></td>
								</tr>
								<tr>
									<td>Sasaran</td>
									<td>:</td>
									<td><?= $sasaran[$suplemen["sasaran"]]?></td>
								</tr>
								<tr>
									<td>Keterangan</td>
									<td>:</td>
									<td><?= $suplemen["keterangan"]?></td>
								</tr>
							</tbody>
						</table>
					</div>

					<div class="box-body">
						<h5><b>Data Terdata</b></h5>
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-hover tabel-rincian">
								<tbody>
									<?php $judul = ($suplemen['sasaran'] == 1) ? 'Penduduk' : 'KK' ?>
									<tr>
										<td width="20%"><?= ($suplemen["sasaran"] == 1) ? 'NIK / Nama Penduduk' : 'No. KK / Nama KK'; ?></td>
										<td width="1%">:</td>
										<td> <?= $terdata["terdata_nama"] . ' / ' . $terdata["terdata_info"]?></td>
									</tr>
									<tr>
										<td>Alamat <?= $judul; ?></td>
										<td>:</td>
										<td><?= $individu['alamat_wilayah']; ?></td>
									</tr>
									<tr>
										<td>Tempat Tanggal Lahir (Umur) <?= $judul; ?></td>
										<td>:</td>
										<td><?= $individu['tempatlahir']?> <?= tgl_indo($individu['tanggallahir'])?> (<?= $individu['umur']?> Tahun)</td>
									</tr>
									<tr>
										<td>Pendidikan <?= $judul; ?></td>
										<td>:</td>
										<td><?= $individu['pendidikan']?></td>
									</tr>
									<tr>
										<td>Warganegara / Agama <?= $judul; ?></td>
										<td>:</td>
										<td><?= $individu['warganegara']?> / <?= $individu['agama']?></td>
									</tr>
									<tr>
										<td>Keterangan</td>
										<td>:</td>
										<td><?= $terdata["keterangan"]?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>

