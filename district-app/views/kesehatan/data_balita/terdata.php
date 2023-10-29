<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<div class="content-wrapper">
	<section class="content-header">
		<h1>Detail Profil Balita</h1>
		<ol class="breadcrumb">
			<li><a href="<?= site_url('beranda') ?>"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?= site_url('data_balita') ?>"><i class="fa fa-home"></i> Data Balita</a></li>
			<li class="active">Profil Balita</li>
		</ol>
	</section>
	<section class="content" id="maincontent">
		<div class="box box-info">
			<div class="box-header with-border">
				<a href="<?= site_url("data_balita") ?>" class="btn btn-social btn-box btn-info btn-sm visible-xs-block visible-sm-inline-block visible-md-inline-block visible-lg-inline-block"><i class="fa fa-arrow-circle-left"></i> Kembali</a>
			</div>
			<div class="box-body">
				<h5><b>Biodata Balita</b></h5>
				<div class="table-responsive">
					<table class="table table-striped table-hover tabel-rincian">
						<tbody>
							<?php $judul = ($data_balita['sasaran'] == 1) ? 'Penduduk' : 'KK' ?>
							<tr>
								<td width="25%">Nama Balita</td>
								<td width="1%">:</td>
								<td><?= strtoupper($profil["nama"]) ?></td>
								<td rowspan="8" width=200px><img class="img-responsive img-circle" src="<?= AmbilFoto($profil['foto'], '', $penduduk['id_sex']) ?>" alt="Foto Penduduk"></td>

							</tr>
							<tr>
								<td>NIK</td>
								<td>:</td>
								<td><?= $profil["nik"] ?></td>
							</tr>
							<tr>
								<td>Tempat, Tanggal Lahir</td>
								<td>:</td>
								<td><?= $profil["tempatlahir"] ?>, <?= $profil["tanggallahir"] ?></td>
							</tr>
							<tr>
								<td>Jenis Kelamin</td>
								<td width="1%">:</td>
								<td><?= $profil["sex"] ?></td>
							</tr>
							<tr>
								<td>Nama Ayah -- Ibu</td>
								<td width="1%">:</td>
								<td><?= $profil["nama_ibu"] ?> -- <?= $profil["nama_ayah"] ?></td>
							</tr>
							<tr>
								<td>Alamat</td>
								<td width="1%">:</td>
								<td> <?= $profil["alamat"] ?></td>
							</tr>

						</tbody>
					</table>
				</div>
			</div>
			<div class="box-body">
				<h5><b>Data Kelahiran</b></h5>
				<div class="table-responsive">
					<table class="table table-striped table-hover tabel-rincian">
						<tbody>
							<tr>
								<td width="25%">Berat Lahir</td>
								<td width="1%">:</td>
								<td> <?= $profil["ndesc"] ?></td>
							</tr>
							<tr>
								<td>Panjang Lahir</td>
								<td width="1%">:</td>
								<td> <?= $profil[""] ?></td>
							</tr>
							<tr>
								<td>Jenis Kelahiran</td>
								<td width="1%">:</td>
								<td> <?= $profil[""] ?></td>
							</tr>
							<tr>
								<td>Kelahiran Ke</td>
								<td width="1%">:</td>
								<td> <?= $profil[""] ?></td>
							</tr>
							<tr>
								<td>Akta Lahir</td>
								<td width="1%">:</td>
								<td> <?= $profil[""] ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>


			<div class="box-body">
				<h5>Kelompok Data Lain dari <b><?= strtoupper($profil["nama"]) ?></b></h5>
				<div class="table-responsive">
					<table class="table table-bordered dataTable table-hover tabel-daftar">
						<thead class="bg-gray disabled color-palette">
							<tr>
								<th>No</th>
								<th>Nama Kelompok Data</th>
								<th width="65%">Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($daftar_data_balita as $key => $item) : ?>
								<tr>
									<td class="padat"><?= ($key + 1); ?></td>
									<td><a href="<?= site_url("data_balita/rincian/$item[id]"); ?>"><?= $item["nama"] ?></a></td>
									<td><?= $item["keterangan"]; ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>